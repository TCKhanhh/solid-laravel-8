<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;


// Route::prefix('auth')->group(function () {
//     Route::post('/register', [RegisterController::class, 'register'])
//         ->middleware('throttle:5,1');
// });

Route::prefix('auth')->group(function () {

    Route::post('/register', [RegisterController::class, 'register'])
        ->middleware('throttle:6,1');

    Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/resend', [RegisterController::class, 'resend'])
        ->middleware('throttle:3,1');
});