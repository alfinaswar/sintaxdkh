<?php

namespace App\Http\Controllers;

use App\Models\MasterDepartemen;
use App\Models\MasterUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterDepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->hasRole('Admin')) {
                $data = MasterDepartemen::orderBy('id', 'desc');
            } else {
                $data = MasterDepartemen::where('KodeRS', auth()->user()->KodeRS)
                    ->orderBy('id', 'desc');
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master-dept.edit', encrypt($row->id)) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . encrypt($row->id) . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.master-departemen.index');
    }

    public function create()
    {
        return view('master.master-departemen.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NamaDepartemen' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $departemen = MasterDepartemen::create([
            'NamaDepartemen' => $request->NamaDepartemen,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id
        ]);

        if ($request->has('NamaUnit')) {
            foreach ($request->NamaUnit as $unit) {
                if (!empty($unit)) {
                    MasterUnit::create([
                        'NamaUnit' => $unit,
                        'IdDepartemen' => $departemen->id,
                        'KodeRS' => auth()->user()->KodeRS
                    ]);
                }
            }
        }

        return redirect()->route('master-dept.index')
            ->with('success', 'Departemen berhasil ditambahkan');
    }

    public function show(MasterDepartemen $masterDepartemen)
    {
        //
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $departemen = MasterDepartemen::with('getUnit')->find($id);
        return view('master.master-departemen.edit', compact('departemen'));
    }

    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $validator = Validator::make($request->all(), [
            'NamaDepartemen' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $departemen = MasterDepartemen::find($id);
        $isUsed = DataInventarisController::where('Departemen', $id)->exists();

        if ($isUsed) {
            return redirect()
                ->back()
                ->with('error', 'Departemen tidak dapat dihapus karena sedang digunakan di Data Inventaris');
        }

        $departemen->update([
            'NamaDepartemen' => $request->NamaDepartemen,
            'KodeRS' => auth()->user()->KodeRS,
            'IdUser' => auth()->user()->id
        ]);

        if ($request->has('NamaUnit')) {
            foreach ($request->NamaUnit as $key => $unit) {
                if (!empty($unit)) {
                    $unitId = $request->unit_id[$key] ?? null;

                    if ($unitId) {
                        // Update unit yang sudah ada
                        MasterUnit::where('id', $unitId)
                            ->update([
                                'NamaUnit' => $unit,
                                'KodeRS' => auth()->user()->KodeRS
                            ]);
                    } else {
                        // Buat unit baru
                        MasterUnit::create([
                            'NamaUnit' => $unit,
                            'IdDepartemen' => $id,
                            'KodeRS' => auth()->user()->KodeRS
                        ]);
                    }
                }
            }
        }

        return redirect()->route('master-dept.index')
            ->with('success', 'Departemen berhasil diperbarui');
    }

    public function getByDepartemen(Request $request)
    {
        $departemenId = $request->departemen_id;

        $units = MasterUnit::where('IdDepartemen', $departemenId)->get(['id', 'NamaUnit']);

        return response()->json($units);
    }
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $departemen = MasterDepartemen::find($id);
        if ($departemen) {
            $departemen->delete();
            return response()->json(['message' => 'Departemen berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Departemen tidak ditemukan'], 404);
        }
    }
}
