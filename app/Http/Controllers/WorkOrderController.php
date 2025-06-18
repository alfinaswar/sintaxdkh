<?php

namespace App\Http\Controllers;

use App\Models\MasterDepartemen;
use App\Models\MasterItem;
use App\Models\MasterUnit;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WorkOrder::with('getDitugaskanOleh', 'getDitugaskanKe', 'getDepartemen')->orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('work-order.edit', encrypt($row->id)) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $btn .= ' <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . encrypt($row->id) . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('work-order.index');
    }

    public function create()
    {
        $items = MasterItem::get();
        $departemens = MasterDepartemen::get();
        $staffs = User::get();
        return view('work-order.create', compact('departemens', 'staffs', 'items'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ItemID' => 'required',
            'Tanggal' => 'required|date',
            'Judul' => 'required|string|max:255',
            'Departemen' => 'required',
            'Unit' => 'required',
            'Kasus' => 'required|string',
            'KategoriKasus' => 'required|in:HARDWARE,SOFTWARE',
            'Prioritas' => 'required|in:Rendah,Sedang,Tinggi,Kritis',
            'DitugaskanKe' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        WorkOrder::create([

            'ItemID' => $request->ItemID,
            'Tanggal' => $request->Tanggal,
            'Departemen' => $request->Departemen,
            'Unit' => $request->Unit,
            'Judul' => $request->Judul,
            'Kasus' => $request->Kasus,
            'KategoriKasus' => $request->KategoriKasus,
            'Prioritas' => $request->Prioritas,
            'DitugaskanKe' => $request->DitugaskanKe,
            'DitugaskanOleh' => auth()->user()->id,
            'DitugaskanTanggal' => $request->DitugaskanTanggal,
            'StatusID' => 'Open',
            'KodeRS' => auth()->user()->KodeRS,

        ]);

        return redirect()->route('work-order.index')
            ->with('success', 'Work Order berhasil ditambahkan');
    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $workOrder = WorkOrder::findOrFail($id);
        return view('work-order.show', compact('workOrder'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $departemens = MasterDepartemen::get();
        $staffs = User::get();
        $workOrder = WorkOrder::findOrFail($id);
        $units = MasterUnit::get();
        $items = MasterItem::get();
        return view('work-order.edit', compact('workOrder', 'departemens', 'staffs', 'units', 'items'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ItemID' => 'required',
            'Tanggal' => 'required|date',
            'Judul' => 'required|string|max:255',
            'Departemen' => 'required',
            'Unit' => 'required',
            'Kasus' => 'required|string',
            'KategoriKasus' => 'required|in:HARDWARE,SOFTWARE',
            'Prioritas' => 'required|in:Rendah,Sedang,Tinggi,Kritis',
            'DitugaskanKe' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = Crypt::decrypt($id);
        $workOrder = WorkOrder::findOrFail($id);

        $workOrder->update([
            'ItemID' => $request->ItemID,
            'Tanggal' => $request->Tanggal,
            'Departemen' => $request->Departemen,
            'Unit' => $request->Unit,
            'Judul' => $request->Judul,
            'Kasus' => $request->Kasus,
            'KategoriKasus' => $request->KategoriKasus,
            'Prioritas' => $request->Prioritas,
            'DitugaskanKe' => $request->DitugaskanKe,
            'StatusID' => 'Open',
            'KodeRS' => auth()->user()->KodeRS,
        ]);

        return redirect()->route('work-order.index')
            ->with('success', 'Work Order berhasil diperbarui');
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->delete();
        return response()->json(['message' => 'Work Order berhasil dihapus'], 200);
    }
}
