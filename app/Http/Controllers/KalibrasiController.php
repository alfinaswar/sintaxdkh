<?php

namespace App\Http\Controllers;

use App\Models\Kalibrasi;
use Illuminate\Http\Request;

class KalibrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('Dokumen')) {
            $file = $request->file('Dokumen');
            $fileName = rand() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kalibrasi', $fileName);
            $data['Dokumen'] = $fileName;
        }

        $data['IdUser'] = auth()->user()->id;
        $data['KodeRS'] = auth()->user()->KodeRS ?? 'A';
        Kalibrasi::create($data);
        return redirect()->back()->with('suceess', 'Data Kalibrasi Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kalibrasi $kalibrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kalibrasi $kalibrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kalibrasi $kalibrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kalibrasi $kalibrasi)
    {
        //
    }
}
