<?php

use App\Http\Controllers\DataInventarisController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\MasterDepartemenController;
use App\Http\Controllers\MasterItemController;
use App\Http\Controllers\MasterMerkController;
use App\Http\Controllers\MasterRsController;
use App\Http\Controllers\WorkOrderController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\MasterMerk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
    Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
    Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
    Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    Route::prefix('inventaris')->group(function () {
        Route::get('/', [DataInventarisController::class, 'index'])->name('data-inventaris.index');
        Route::get('/create', [DataInventarisController::class, 'create'])->name('data-inventaris.create');
        Route::post('/store', [DataInventarisController::class, 'store'])->name('data-inventaris.store');
        Route::get('/edit/{id}', [DataInventarisController::class, 'edit'])->name('data-inventaris.edit');
        Route::get('/detail/{id}', [DataInventarisController::class, 'show'])->name('data-inventaris.show');
        Route::put('/update/{id}', [DataInventarisController::class, 'update'])->name('data-inventaris.update');
        Route::put('/work-order/{id}', [DataInventarisController::class, 'WorkOrder'])->name('data-inventaris.Wo');
        Route::put('/preventif-maintenance/{id}', [DataInventarisController::class, 'Pm'])->name('data-inventaris.Pm');
        Route::put('/kalibrasi/{id}', [DataInventarisController::class, 'Kalibrasi'])->name('data-inventaris.Kalibrasi');
        Route::delete('/destroy/{id}', [DataInventarisController::class, 'destroy'])->name('data-inventaris.destroy');
    });
    Route::prefix('master-item')->group(function () {
        Route::get('/', [MasterItemController::class, 'index'])->name('master-item.index');
        Route::get('/create', [MasterItemController::class, 'create'])->name('master-item.create');
        Route::post('/store', [MasterItemController::class, 'store'])->name('master-item.store');
        Route::get('/edit/{id}', [MasterItemController::class, 'edit'])->name('master-item.edit');
        Route::put('/update/{id}', [MasterItemController::class, 'update'])->name('master-item.update');
        Route::delete('/destroy/{id}', [MasterItemController::class, 'destroy'])->name('master-item.destroy');
    });
    Route::prefix('work-order')->group(function () {
        Route::get('/', [WorkOrderController::class, 'index'])->name('work-order.index');
        Route::get('/create', [WorkOrderController::class, 'create'])->name('work-order.create');
        Route::post('/store', [WorkOrderController::class, 'store'])->name('work-order.store');
        Route::get('/edit/{id}', [WorkOrderController::class, 'edit'])->name('work-order.edit');
        Route::get('/response/{id}', [WorkOrderController::class, 'reply'])->name('work-order.reply');
        Route::put('/update/{id}', [WorkOrderController::class, 'update'])->name('work-order.update');
        Route::delete('/destroy/{id}', [WorkOrderController::class, 'destroy'])->name('work-order.destroy');
    });
    Route::prefix('master-merk')->group(function () {
        Route::get('/', [MasterMerkController::class, 'index'])->name('master-merk.index');
        Route::get('/create', [MasterMerkController::class, 'create'])->name('master-merk.create');
        Route::post('/store', [MasterMerkController::class, 'store'])->name('master-merk.store');
        Route::get('/edit/{id}', [MasterMerkController::class, 'edit'])->name('master-merk.edit');
        Route::put('/update/{id}', [MasterMerkController::class, 'update'])->name('master-merk.update');
        Route::delete('/destroy/{id}', [MasterMerkController::class, 'destroy'])->name('master-merk.destroy');
    });
    Route::prefix('master-rumah-sakit')->group(function () {
        Route::get('/', [MasterRsController::class, 'index'])->name('master-rs.index');
        Route::get('/create', [MasterRsController::class, 'create'])->name('master-rs.create');
        Route::post('/store', [MasterRsController::class, 'store'])->name('master-rs.store');
        Route::get('/edit/{id}', [MasterRsController::class, 'edit'])->name('master-rs.edit');
        Route::put('/update/{id}', [MasterRsController::class, 'update'])->name('master-rs.update');
        Route::delete('/destroy/{id}', [MasterRsController::class, 'destroy'])->name('master-rs.destroy');
    });
    Route::prefix('master-departemen-unit')->group(function () {
        Route::get('/', [MasterDepartemenController::class, 'index'])->name('master-dept.index');
        Route::get('/create', [MasterDepartemenController::class, 'create'])->name('master-dept.create');
        Route::post('/store', [MasterDepartemenController::class, 'store'])->name('master-dept.store');
        Route::get('/edit/{id}', [MasterDepartemenController::class, 'edit'])->name('master-dept.edit');
        Route::put('/update/{id}', [MasterDepartemenController::class, 'update'])->name('master-dept.update');
        Route::delete('/destroy/{id}', [MasterDepartemenController::class, 'destroy'])->name('master-dept.destroy');
        Route::get('/get-units-by-departemen', [MasterDepartemenController::class, 'getByDepartemen'])->name('master-dept.get-item-by-departemen');

    });
    Route::prefix('bukti-upload')->group(function () {
        Route::GET('/bukti-upload', [UserController::class, 'index'])->name('bukti.index');
        Route::GET('/bukti-upload/edit/{id}', [UserController::class, 'editProfil'])->name('bukti.edit');
        Route::PUT('/bukti-upload/update/{id}', [UserController::class, 'updateProfil'])->name('bukti.update');

    });
});
