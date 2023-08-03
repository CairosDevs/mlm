<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AsingPinController;
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
Route::post('/validatePinUserLogin', [AsingPinController::class, 'validatePinUser'])->name('pin.validatePinUserLogin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','pin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/asignPin', [ProfileController::class, 'asingPin'])->name('profile.asingPin');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/asignProfile', [ProfileController::class, 'asignProfile'])->name('profile.asignProfile');
    Route::post('/validatePinUser', [AsingPinController::class, 'validatePinUser'])->name('pin.validatePinUser');
    /**
     * TODO
     * ADD PERMISION ONLY ADMINSUPPORT
     */
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});

require __DIR__.'/auth.php';
