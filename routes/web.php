<?php

use App\Http\Controllers\BarcodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',[
        'products' => App\Models\Product::all()
    ]);
});

Route::get('/show/{product}', [BarcodeController::class, 'show'])->name('show');

Route::post('/generate-qrcode', [BarcodeController::class, 'store'])->name('generate-qrcode');