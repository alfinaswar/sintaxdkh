<?php

namespace App\Http\Controllers;

use App\Models\DataInventaris;
use App\Models\MasterDepartemen;
use App\Models\MasterItem;
use App\Models\MasterMerk;
use App\Models\MasterRs;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class DataInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->hasRole('Admin')) {
                $query = DataInventaris::with('getDepartemen', 'getUnit', 'getMerk', 'getItem')->orderBy('id', 'desc');
            } else {
                $query = DataInventaris::with('getDepartemen', 'getUnit', 'getMerk', 'getItem')
                    ->where('KodeRS', auth()->user()->KodeRS)
                    ->orderBy('id', 'desc');
            }
            if ($request->filled('filter_rs')) {
                $query->where('KodeRS', $request->filter_rs);
            }
            if ($request->filled('filter_item')) {
                $query->where('ItemID', $request->filter_item);
            }
            if ($request->filled('filter_dept')) {
                $query->where('Departemen', $request->filter_dept);
            }
            if ($request->filled('filter_unit')) {
                $query->where('Unit', $request->filter_unit);
            }
            $data = $query->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = encrypt($row->id);
                    $btn = '
                        <div class="btn-group w-100">
                            <button type="button" class="btn btn-primary btn-md dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="' . route('data-inventaris.show', $id) . '">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('data-inventaris.edit', $id) . '">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item btn-delete" href="javascript:void(0);" data-id="' . $id . '">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('data-inventaris.cetak-label', $id) . '" target="_blank">
                                        <i class="fa fa-print"></i> Cetak Label
                                    </a>
                                </li>
                            </ul>
                        </div>
                    ';
                    return $btn;
                })
                ->addColumn('Gambar', function ($row) {
                    return '<img src="' . asset('storage/gambar-inventaris/' . $row->Gambar) . '" class="img-thumbnail" width="100">';
                })
                ->addColumn('ManualBook', function ($row) {
                    return '<a href="' . asset('storage/manualbook-inventaris/' . $row->ManualBook) . '" class="btn btn-info btn-sm" target="_blank">Download</a>';
                })
                ->addColumn('PosisiBarang', function ($row) {
                    return $row->getDepartemen->NamaDepartemen . ' - ' . $row->getUnit->NamaUnit;
                })
                ->rawColumns(['action', 'Gambar', 'ManualBook', 'PosisiBarang'])
                ->make(true);
        }
        $rs = MasterRs::get();
        $departemen = MasterDepartemen::get();
        $items = DataInventaris::with('getItem')->orderBy('ItemID', 'ASC')->get();
        return view('data-inventaris.index', compact('rs', 'departemen', 'items'));
    }

    public function create()
    {
        $items = MasterItem::get();
        $merks = MasterMerk::get();
        $departemens = MasterDepartemen::get();
        return view('data-inventaris.create', compact('items', 'merks', 'departemens'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'ItemID' => 'required',
            'SerialNumber' => 'required|string|max:255',
            'Merk' => 'required',
            'Tipe' => 'required|string|max:255',
            'TanggalBeli' => 'required|date',
            'Departemen' => 'required',
            'Unit' => 'required',
            'ManualBook' => 'required|file|mimes:pdf,doc,docx|max:5000',
            'Klasifikasi' => 'required',
            'Gambar' => 'required|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Proses upload file
        $gambarPath = null;
        $manualBookPath = null;

        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/gambar-inventaris', $fileName);
            $gambarPath = $fileName;
        }

        if ($request->hasFile('ManualBook')) {
            $file = $request->file('ManualBook');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/manualbook-inventaris', $fileName);
            $manualBookPath = $fileName;
        }

        DataInventaris::create([
            'NoInventaris' => $this->GenerateNomor(),
            'ItemID' => $request->ItemID,
            'SerialNumber' => $request->SerialNumber,
            'Merk' => $request->Merk,
            'Tipe' => $request->Tipe,
            'TanggalBeli' => $request->TanggalBeli,
            'Departemen' => $request->Departemen,
            'Unit' => $request->Unit,
            'ManualBook' => $manualBookPath,
            'Klasifikasi' => $request->Klasifikasi,
            'Keterangan' => $request->Keterangan,
            'Gambar' => $gambarPath,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id,
        ]);

        return redirect()
            ->route('data-inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan');
    }

    private function GenerateNomor()
    {
        $prefix = 'INV';
        $tahun = date('y');
        $bulan = date('m');

        $kodeAwal = $prefix . $tahun . $bulan;

        $last = DataInventaris::where('NoInventaris', 'like', $kodeAwal . '%')
            ->orderBy('NoInventaris', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->NoInventaris, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $kodeAwal . $newNumber;
    }

    public function Cetaklabel($id)
    {
        $id = Crypt::decrypt($id);
        $data = DataInventaris::with('getItem', 'getRS')->findOrFail($id);
        // dd($data);
        $writer = new PngWriter();
        $barcode = [];

        $link = route('hasilscan', $data->NoInventaris);
        $qrCode = QrCode::create($link)
            ->setSize(50)
            ->setMargin(0);

        $barcode[$data->id] = base64_encode($writer->write($qrCode)->getString());


        $viewData = [
            'data' => $data,
            'barcode' => $barcode,
        ];

        $pdf = app('dompdf.wrapper')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('data-inventaris.cetak-label', $viewData)->setPaper([0, 0, 161.57, 70.0], 'portrait');

        return $pdf->stream('stiker.pdf');
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data = DataInventaris::with(
            'getDepartemen',
            'getUnit',
            'getMerk',
            'getItem',
            'getWo',
            'getWo.getDitugaskanKe',
            'getWo.getDitugaskanOleh',
            'getPm',
            'getPm.getDikerjakanOleh',
            'getKalibrasi'
        )->find($id);
        // dd($data);
        return view('data-inventaris.show', compact('data'));
    }
    public function ShowCetak($id)
    {
        $data = DataInventaris::with(
            'getDepartemen',
            'getUnit',
            'getMerk',
            'getItem',
            'getWo',
            'getWo.getDitugaskanKe',
            'getWo.getDitugaskanOleh',
            'getPm',
            'getPm.getDikerjakanOleh',
            'getKalibrasi'
        )->where('NoInventaris', $id)->first();
        // dd($data);
        return view('data-inventaris.show-dari-barcode', compact('data'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $items = MasterItem::get();
        $merks = MasterMerk::get();
        $departemens = MasterDepartemen::get();
        $dataInventaris = DataInventaris::findOrFail($id);
        return view('data-inventaris.edit', compact('dataInventaris', 'items', 'merks', 'departemens'));
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $validator = Validator::make($request->all(), [
            'ItemID' => 'required',
            'SerialNumber' => 'required|string|max:255',
            'Merk' => 'required',
            'Tipe' => 'required|string|max:255',
            'TanggalBeli' => 'required|date',
            'Departemen' => 'required',
            'Unit' => 'required',
            'ManualBook' => 'nullable|file|mimes:pdf,doc,docx|max:5000',
            'Klasifikasi' => 'required',
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInventaris = DataInventaris::findOrFail($id);

        $gambarPath = $dataInventaris->Gambar;
        $manualBookPath = $dataInventaris->ManualBook;

        if ($request->hasFile('Gambar')) {
            if ($dataInventaris->Gambar) {
                Storage::delete('public/gambar-inventaris/' . $dataInventaris->Gambar);
            }

            $file = $request->file('Gambar');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/gambar-inventaris', $fileName);
            $gambarPath = $fileName;
        }

        if ($request->hasFile('ManualBook')) {
            if ($dataInventaris->ManualBook) {
                Storage::delete('public/manualbook-inventaris/' . $dataInventaris->ManualBook);
            }

            $file = $request->file('ManualBook');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/manualbook-inventaris', $fileName);
            $manualBookPath = $fileName;
        }

        $dataInventaris->update([
            'ItemID' => $request->ItemID,
            'SerialNumber' => $request->SerialNumber,
            'Merk' => $request->Merk,
            'Tipe' => $request->Tipe,
            'TanggalBeli' => $request->TanggalBeli,
            'Departemen' => $request->Departemen,
            'Unit' => $request->Unit,
            'ManualBook' => $manualBookPath,
            'Klasifikasi' => $request->Klasifikasi,
            'Keterangan' => $request->Keterangan,
            'Gambar' => $gambarPath,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id,
        ]);

        return redirect()
            ->route('data-inventaris.index')
            ->with('success', 'Data inventaris berhasil diperbarui');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $inventaris = DataInventaris::find($id);
        if ($inventaris) {
            $inventaris->delete();
            return response()->json(['message' => 'Data inventaris berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Data inventaris tidak ditemukan'], 404);
        }
    }
}
