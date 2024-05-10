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
Route::get('/dashboard', [AdminController::class, 'getDashboard']);

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
    Route::get('redeems-point', [UserController::class, 'getTukarPoint']);
    Route::put('redeems-point/{redeem_id}', [UserController::class, 'submitTukarPoint'])->name('redeems-point.redeems');

    //* End Redeems Points

    //* Customer Sercice 
    Route::get('customer-service', [UserController::class, 'getCustomerService']);
    Route::post('customer-service', [UserController::class, 'submitComplaint']);
    Route::put('customer-service/{complaint_id}', [AdminController::class, 'updateStatus'])->name('customer-service.update');
    Route::get('complaint-delete/{complaint_id}', [AdminController::class, 'deleteComplaint']);
    //* End Customer Sercice 
    
    //* Edukasi Lingkungan
    Route::get('article', [UserController::class, 'getArticle']);
    Route::get('/read-article/{article_id}', [UserController::class, 'getDetailArticle'])->name('read-article');
    //* End Edukasi Lingkungan
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
    
    //* Kelola Driver
    Route::get('manage-driver', [AdminController::class, 'getManageDriver']);
    Route::get('add-driver', [AdminController::class, 'getAddDriver']);
    Route::post('add-driver', [AdminController::class, 'submitAddDriver']);
    Route::get('manage-driver/{driver_id}', [AdminController::class, 'deleteDriver'])->name('data-driver.delete');
    //* End Kelola Driver
    

    //* Kelola Artikel
    Route::get('/manage-article', [AdminController::class, 'getArticle']);

    Route::get('add-article', [AdminController::class, 'getAddArticle']);

    Route::post('add-article', [AdminController::class, 'submitAddArticle']);

    Route::get('article/{article_id}/detail', [AdminController::class, 'show_detail_article']); 
    
    Route::delete('remove-article/{article_id}', [AdminController::class, 'destroy_article']);
    
    //* End Kelola Artikel
    
    Route::get('manage-order', [AdminController::class, 'getManageOrder']);
    Route::get('manage-order-detail/{schedule_id}', [AdminController::class, 'detailOrder'])->name('manage-order-detail');
    Route::put('manage-order-detail/{schedule_id}', [AdminController::class, 'submitUpdateOrder']);
    
    
    Route::get('manage-points', [AdminController::class, 'getManagePoint']);
    Route::get('add-rewarder', [AdminController::class, 'getAddRewarder']);
    Route::post('add-rewarder', [AdminController::class, 'submitAddRewarder']);
    Route::get('manage-points/{redeem_id}', [AdminController::class, 'deleteRewarder'])->name('delete-rewarder.delete');

});