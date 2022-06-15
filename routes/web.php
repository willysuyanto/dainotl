<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeLoanController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\NozzleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShiftController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    //master data route
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('product', ProductController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('nozzle', NozzleController::class);
    Route::resource('customer', CustomerController::class);
    

    //profile route
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    //password update route
    Route::get('change-password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::post('change-password', [ChangePasswordController::class, 'update'])->name('password.update');

    //supply route
    Route::get('supply',[SupplyController::class, 'index'])->name('supply.index');
    Route::get('supply/create',[SupplyController::class, 'create'])->name('supply.create');
    Route::post('supply',[SupplyController::class, 'store'])->name('supply.store');
    Route::patch('supply/{id}',[SupplyController::class, 'update'])->name('supply.update');
    Route::delete('supply/{id}',[SupplyController::class, 'delete'])->name('supply.delete');
    Route::post('supply/arrival',[SupplyController::class, 'addToStock'])->name('supply.addToStock');
    Route::get('supply/{id}/details',[SupplyController::class, 'details'])->name('supply.details');
    Route::get('supply/{id}/edit', [SupplyController::class, 'edit'])->name('supply.edit');
    Route::get('supply/{id}/arrival',[SupplyController::class, 'arrival'])->name('supply.arrival');

    //stock route
    Route::resource('stock', StockController::class);
    Route::get('stock/{id}/stock-awal', [StockController::class, 'createInitialStock'])->name('stock.stock-awal');
    Route::post('stock/{id}/stock-awal', [StockController::class, 'storeInitialStock'])->name('stock.store-stok-awal');

    //sales route
    Route::post('sales/{shift}/{id}', [SalesController::class, 'store'])->name('sales.create');

    //employee loan route
    Route::resource('employee-loan', EmployeeLoanController::class);

    //shift route
    Route::get('first-shift', [ShiftController::class, 'firstShift'])->name('shift.first');
    Route::get('second-shift', [ShiftController::class, 'secondShift'])->name('shift.second');
    Route::get('third-shift', [ShiftController::class, 'thirdShift'])->name('shift.third');

});

require __DIR__.'/auth.php';
