<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginol'])->name('login.ol');
Route::get('register', [AuthController::class, 'register'])->name('register.view');
Route::post('register', [AuthController::class, 'registerol'])->name('register.ol');

// admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/verif', [DashboardController::class, 'verif'])->name('verif');

    // user
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/rating', [HomeController::class, 'ratingView'])->name('rating.view');
    Route::post('/rating/{tempat_kuliner_id}', [HomeController::class, 'store'])->name('rating.store');
    // Route::get('/detail-perumahan/{id}', [HomeController::class, 'showResidence'])->name('residence.show');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/tentang-kami', function () {
        return view('main.about');
    })->name('about');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
