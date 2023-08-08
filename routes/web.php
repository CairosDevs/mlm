<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AsingPinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/pinView/{id}/{type}', [AsingPinController::class, 'pinView'])->name('pinView');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/validatePinLogin')->middleware(['auth', 'verified', 'pin'])->name('validatePinLogin');
Route::get('register/confirm/{token}', [UserController::class, 'confirm']);
Route::get('/password/reset', [UserController::class, 'createPassword'])->name('create.password');
Route::post('/password/create/store', [UserController::class, 'passwordCreateStore'])->name('password.create.store');

Route::middleware('auth')->group(function () {
    Route::get('/editProfile', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/asignPin', [ProfileController::class, 'asingPin'])->name('profile.asingPin');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/editValidate', [ProfileController::class, 'editValidate'])->name('editValidate');
    Route::get('/validationProfile', [ProfileController::class, 'validationProfile'])->name('validationProfile');
    Route::post('/asignPin', [ProfileController::class, 'asingPin'])->name('profile.asingPin');

    Route::get('/payment', [PaymentController::class, 'paymentForm'])->name('payment.form');
    Route::get('/viewPin', [ProfileController::class, 'viewPin'])->name('viewPin');
    Route::post('/forwardPin', [AsingPinController::class, 'forwardPin'])->name('forwardPin');

    Route::get('/listValidatation', [ProfileController::class, 'listValidatation'])->name('profile.list.validation');
    Route::get('/showValidatation/{id}', [ProfileController::class, 'showValidatation'])->name('profile.show.validation');
    Route::put('/profileStatusUpdate/{id}', [ProfileController::class, 'updateStatusDocs'])->name('profile.StatusUpdate');

    Route::get('/payment', [PaymentController::class, 'paymentForm'])->name('payment.form');

    /**
    * TODO
     * ADD PERMISSION ONLY ADMIN
     */
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
    Route::put('/setting/{id}', [SettingController::class, 'update'])->name('setting.update');
    Route::post('/setting/{id}', [SettingController::class, 'destroy'])->name('setting.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/roles', [RoleController::class, 'form'])->name('roles.form');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');

    Route::post('/asignProfile', [ProfileController::class, 'asignProfile'])->name('profile.asignProfile');
    Route::post('/validatePinUser', [AsingPinController::class, 'validatePinUser'])->name('pin.validatePinUser');
    
    /**
     * TODO
     * ADD PERMISION ONLY SYSTEM
     */
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});

require __DIR__.'/auth.php';
