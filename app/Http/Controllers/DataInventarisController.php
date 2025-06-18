<?php

namespace App\Http\Controllers;

use App\Models\DataInventaris;
use App\Models\MasterDepartemen;
use App\Models\MasterMerk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataInventaris::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('data-inventaris.edit', encrypt($row->id)) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . encrypt($row->id) . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('data-inventaris.index');
    }

    public function create()
    {
        $items = DataInventaris::get();
        $merks = MasterMerk::get();
        $departemens = MasterDepartemen::get();
        return view('data-inventaris.create', compact('items', 'merks', 'departemens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NamaBarang' => 'required|string|max:255',
            'Departemen' => 'required|exists:master_departemen,id',
            'Unit' => 'required|exists:master_unit,id',
            'Jumlah' => 'required|numeric|min:0',
            'Kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'Keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DataInventaris::create([
            'NamaBarang' => $request->NamaBarang,
            'Departemen' => $request->Departemen,
            'Unit' => $request->Unit,
            'Jumlah' => $request->Jumlah,
            'Kondisi' => $request->Kondisi,
            'Keterangan' => $request->Keterangan,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id
        ]);

        return redirect()->route('data-inventaris.index')
            ->with('success', 'Data inventaris berhasil ditambahkan');
    }

    public function show(DataInventaris $dataInventaris)
    {
        return view('data-inventaris.show', compact('dataInventaris'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $inventaris = DataInventaris::findOrFail($id);
        return view('data-inventaris.edit', compact('inventaris'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'NamaBarang' => 'required|string|max:255',
            'Departemen' => 'required|exists:master_departemen,id',
            'Unit' => 'required|exists:master_unit,id',
            'Jumlah' => 'required|numeric|min:0',
            'Kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'Keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = Crypt::decrypt($id);
        $inventaris = DataInventaris::find($id);

        $inventaris->update([
            'NamaBarang' => $request->NamaBarang,
            'Departemen' => $request->Departemen,
            'Unit' => $request->Unit,
            'Jumlah' => $request->Jumlah,
            'Kondisi' => $request->Kondisi,
            'Keterangan' => $request->Keterangan,
            'KodeRS' => auth()->user()->KodeRS
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
