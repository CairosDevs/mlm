<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/asignProfile', [ProfileController::class, 'asignProfile'])->name('profile.asignProfile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/payment', [PaymentController::class, 'paymentForm'])->name('payment.form');

    /**
 * TODO
     * ADD PERMISSION ONLY ADMIN
     */
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
    Route::put('/setting/{id}', [SettingController::class, 'update'])->name('setting.update');
    Route::post('/setting/{id}', [SettingController::class, 'destroy'])->name('setting.destroy');

    /**
     * TODO
     * ADD PERMISION ONLY SYSTEM
     */
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});

require __DIR__.'/auth.php';
