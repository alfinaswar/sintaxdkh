<?php

namespace App\Http\Controllers;

use App\Models\DataInventaris;
use App\Models\MasterDepartemen;
use App\Models\MasterItem;
use App\Models\MasterMerk;
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
                $data = DataInventaris::with('getDepartemen', 'getUnit', 'getMerk', 'getItem')->orderBy('id', 'desc');
            } else {
                $data = DataInventaris::with('getDepartemen', 'getUnit', 'getMerk', 'getItem')
                    ->where('KodeRS', auth()->user()->KodeRS)
                    ->orderBy('id', 'desc');
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('data-inventaris.show', encrypt($row->id)) . '" class="btn btn-info btn-md"><i class="fa fa-eye"></i> Detail</a>';
                    $btn .= ' <a href="' . route('data-inventaris.edit', encrypt($row->id)) . '" class="btn btn-warning btn-md"><i class="fa fa-edit"></i> Edit</a>';
                    $btn .= ' <a href="' . route('data-inventaris.show', encrypt($row->id)) . '" class="btn btn-danger btn-md btn-delete" data-id="' . encrypt($row->id) . '"><i class="fa fa-trash"></i> Delete</a>';
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

        return view('data-inventaris.index');
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
            return redirect()->back()
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

        return redirect()->route('data-inventaris.index')
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
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data = DataInventaris::with('getDepartemen', 'getUnit', 'getMerk', 'getItem')->find($id);
        return view('data-inventaris.show', compact('data'));
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
            return redirect()->back()
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

        return redirect()->route('data-inventaris.index')
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
