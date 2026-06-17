<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RainfallController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\PredictionController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('data')->name('data.')->group(function () {
    Route::get('/', [RainfallController::class, 'index'])->name('index');
    Route::post('/upload', [RainfallController::class, 'upload'])->name('upload');
    Route::post('/generate', [RainfallController::class, 'generateMockData'])->name('generate');
    Route::post('/reset', [RainfallController::class, 'reset'])->name('reset');
});

Route::prefix('training')->name('training.')->group(function () {
    Route::get('/', [ModelController::class, 'index'])->name('index');
    Route::post('/run', [ModelController::class, 'train'])->name('run');
});

Route::prefix('prediction')->name('prediction.')->group(function () {
    Route::get('/', [PredictionController::class, 'index'])->name('index');
    Route::post('/predict', [PredictionController::class, 'predict'])->name('predict');
});

