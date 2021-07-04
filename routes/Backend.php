<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;



/*
|--------------------------------------------------------------------------
| BackEnd Routes
|--------------------------------------------------------------------------
*/


// Route::get('Dashboard_Admin',[DashboardController::class,'index']);

// Route::get('/dashboard/user', function () {
//     return view('Dashboard.User.dashboard');
// })->middleware(['auth'])->name('dashboard.user');

// Route::get('/dashboard/admin', function () {
//     return view('Dashboard.Admin.dashboard');
// })->middleware(['auth:admin'])->name('dashboard.admin');


// require __DIR__.'/auth.php';

Route::get('Dashboard_Admin',[DashboardController::class,'index']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 

################################ dashboard user#####################################
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth'])->name('dashboard.user');
################################ end  dashboard user#####################################


################################ dashboard admin #####################################

        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('dashboard.admin');
################################ end dashboard admin #####################################

#------------------------------------------------------------------#
Route::middleware(['auth:admin'])->group(function () {
    Route::resource('Sections',SectionController::class);
    Route::resource('Doctors',DoctorController::class);
    Route::post('update_password',[DoctorController::class,'update_password'])->name('update_password');
    Route::post('update_status',[DoctorController::class,'update_status'])->name('update_status');

    ################################ service Controller  #####################################
    Route::resource('Service',SingleServiceController::class);
//############################# GroupServices route ##########################################

Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');
//############################# end GroupServices route ######################################
Route::resource('Insurance',InsuranceController::class);
Route::resource('Ambulance',AmbulanceController::class);

//############################# Patient route ######################################
Route::resource('Patients',PatientController::class);

//############################# Invoices route ######################################
Route::view('Single-Invoices','livewire.single-invoices.index')->name('Single-Invoices');

//############################# ReceiptAccount route ######################################
Route::resource('Receipt',ReceiptAccountController::class);


});
#------------------------------------------------------------------#

require __DIR__.'/auth.php';

    });


