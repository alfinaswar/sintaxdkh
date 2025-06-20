<?php

namespace App\Http\Controllers;

use App\Models\MasterRs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Str;
use Yajra\DataTables\Facades\DataTables;

class MasterRsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterRs::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master-rs.edit', encrypt($row->id)) . '" class="btn btn-warning btn-md"><i class="fa fa-edit"></i> Edit</a>';
                    $btn .= ' <button type="button" class="btn btn-danger btn-md btn-delete" data-id="' . encrypt($row->id) . '"><i class="fa fa-trash"></i> Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.master-rs.index');
    }

    public function create()
    {
        return view('master.master-rs.create');
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'NamaRS' => 'required|string|max:255',
        //     'JenisRs' => 'required|string|max:100',
        //     'KelasRs' => 'nullable|string|max:100',
        //     'NamaDirektur' => 'nullable|string|max:255',
        //     'Telepon' => 'nullable|string|max:20',
        //     'Email' => 'nullable|email|max:255',
        //     'Alamat' => 'nullable|string|max:255',
        //     'Provinsi' => 'nullable|integer',
        //     'Kota' => 'nullable|integer',
        //     'Kecamatan' => 'nullable|integer',
        //     'KodePos' => 'nullable|string|max:10',
        //     'Website' => 'nullable|string|max:255',
        //     'StatusPenyelenggara' => 'nullable|string|max:100',
        //     'TanggalBerdiri' => 'nullable|date',
        //     'NomorIzin' => 'nullable|string|max:100',
        //     'TanggalIzin' => 'nullable|date',
        //     'Logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $data = $request->all();
        // dd($data);
        if ($request->hasFile('Logo')) {
            $file = $request->file('Logo');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/logo-rs', $fileName);
            $data['Logo'] = $fileName;
        }

        // UUID 10 karakter
        MasterRs::create($data);

        return redirect()->route('master-rs.index')
            ->with('success', 'Rumah Sakit berhasil ditambahkan');
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $rs = MasterRs::findOrFail($id);
        return view('master.master-rs.show', compact('rs'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $rs = MasterRs::with('getKota', 'getKecamatan')->findOrFail($id);
        return view('master.master-rs.edit', compact('rs'));
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $data = $request->all();
        // dd($data);
        if ($request->hasFile('Logo')) {
            $file = $request->file('Logo');
            $fileName = \Illuminate\Support\Str::uuid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/logo-rs', $fileName);
            $data['Logo'] = $fileName;
        } else {
            unset($data['Logo']);
        }

        $rs = MasterRs::findOrFail($id);
        $rs->update($data);

        return redirect()->route('master-rs.index')
            ->with('success', 'Rumah Sakit berhasil diperbarui');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $userCount = User::where('KodeRS', $id)->count();
        if ($userCount > 0) {
            return response()->json(['message' => 'Tidak dapat menghapus, masih ada user yang terkait dengan rumah sakit ini'], 400);
        }

        $rs = MasterRs::find($id);
        if ($rs) {
            $rs->delete();
            return response()->json(['message' => 'Rumah Sakit berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Rumah Sakit tidak ditemukan'], 404);
        }
    }
}
