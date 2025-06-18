<?php

namespace App\Http\Controllers;

use App\Models\MasterMerk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterMerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterMerk::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master-merk.edit', encrypt($row->id)) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . encrypt($row->id) . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.master-merk.index');
    }

    public function create()
    {
        return view('master.master-merk.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Merk' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        MasterMerk::create([
            'Merk' => $request->Merk,
            'KodeRS' => auth()->user()->KodeRS
        ]);

        return redirect()->route('master-merk.index')
            ->with('success', 'Merk berhasil ditambahkan');
    }

    public function show(MasterMerk $masterMerk)
    {
        //
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $merk = MasterMerk::findOrFail($id);
        return view('master.master-merk.edit', compact('merk'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Merk' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = Crypt::decrypt($id);
        $merk = MasterMerk::find($id);

        $merk->update([
            'Merk' => $request->Merk,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id
        ]);

        return redirect()->route('master-merk.index')
            ->with('success', 'Merk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $merk = MasterMerk::find($id);
        if ($merk) {
            $merk->delete();
            return response()->json(['message' => 'Merk berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Merk tidak ditemukan'], 404);
        }
    }
}
