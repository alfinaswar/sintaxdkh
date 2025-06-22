<?php

namespace App\Http\Controllers;

use App\Models\Pm;
use Illuminate\Http\Request;
use Str;

class PmController extends Controller
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
        if ($request->hasFile('Before')) {
            $file = $request->file('Before');
            $fileName = rand() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/preventif/before', $fileName);
            $data['Before'] = $fileName;
        }
        if ($request->hasFile('After')) {
            $file = $request->file('After');
            $fileName = rand() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/preventif/after', $fileName);
            $data['After'] = $fileName;
        }
        $data['DikerjakanOleh'] = auth()->user()->id;
        $data['KodeRS'] = auth()->user()->KodeRS ?? 'A';
        Pm::create($data);
        return redirect()->back()->with('suceess', 'Preventif Maintenance Berhasil Ditambahkan');
    }

    public function show(Pm $pm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pm $pm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pm $pm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pm $pm)
    {
        //
    }
}
