<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthenticatingMiddleware;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyCustomer;


//* Authentication
Route::middleware(AuthenticatingMiddleware::class)->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registration']);
});

Route::get('logout', [AuthController::class, 'logout']);
Route::get('home', [UserController::class, 'getHome']);
Route::get('dashboard', [AdminController::class, 'getDashboard']);

//* End Authentication

Route::middleware(OnlyCustomer::class)->group(function () {
    //* Penjemputan Sampah
    Route::get('order', [UserController::class, 'createOrder']);
    Route::get('success-payment', [UserController::class, 'getSuccessPayment']);
    Route::post('order', [UserController::class, 'submitOrder'])->name('order');
    //* End Penjemputan Sampah

    //* History
    Route::get('riwayat', [UserController::class, 'getRiwayat']);
    Route::get('riwayat', [UserController::class, 'getDataRiwayat']);
    Route::get('riwayat-delete/{schedule_id}', [UserController::class, 'deleteRiwayat']);
    Route::get('detail-riwayat', [UserController::class, 'getDetailRiwayat']);

    //* End History

    //* Redeems Points

    //* End Redeems Points

    //* Customer Sercice 
    Route::get('customer-service', [UserController::class, 'getCustomerService']);
    Route::post('customer-service', [UserController::class, 'submitComplaint']);
    Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
    Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);

    //* End Customer Sercice 
});


/*--------------------------------------------------------------
# Admin
--------------------------------------------------------------*/

Route::middleware(OnlyAdmin::class)->group(function () {
    //* Customer Sercice 
    Route::get('response-complaint', [AdminController::class, 'getResponseComplaint']);
    //* End Customer Sercice
    
    //* Kelola Kendaraan
    Route::get('manage-vehicles', [AdminController::class, 'getManageVehicle']);
    Route::put('manage-vehicles/{vehicle_id}', [AdminController::class, 'updateStatusVehicle'])->name('status-vehicle.update');
    Route::get('add-vehicles', [AdminController::class, 'getAddVehicle']);
    Route::post('add-vehicles', [AdminController::class, 'submitAddVehicle']);
    Route::get('manage-vehicles/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('data-vehicle.delete');
    //* End Kelola Kendaraan






});