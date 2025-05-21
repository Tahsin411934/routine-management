<?php

use App\Http\Controllers\Teacher\OffersController;

Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    //offer-list
    Route::get('/offers', [OffersController::class, 'index']);
    Route::post('/offers-store', [OffersController::class, 'store']);
});
