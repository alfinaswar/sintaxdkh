<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($data = Kuisoner::orderBy('id', 'desc')->get());
        if ($request->ajax()) {
            $data = MasterItem::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master-item.edit', encrypt($row->id)) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . encrypt($row->id) . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.master-item.index'); // Return your view for non-AJAX requests
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.master-item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        MasterItem::create([
            'Nama' => $request->Nama,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id
        ]);

        return redirect()->route('master-item.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterItem $masterItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $item = MasterItem::findOrFail($id);
        return view('master.master-item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = Crypt::decrypt($id);
        // dd($id);
        $item = MasterItem::find($id);

        $item->update([
            'Nama' => $request->Nama,
            'KodeRS' => auth()->user()->KodeRS
        ]);

        return redirect()->route('master-item.index')
            ->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $item = MasterItem::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Item berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }
    }
}
