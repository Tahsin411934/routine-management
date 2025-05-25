<?php

use App\Http\Controllers\Admin\OfferListController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\RoutineController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    //session
    Route::get('/session', [SessionController::class, 'index']);
    Route::post('/session-store', [SessionController::class, 'store']);
    Route::post('/session-update/{id}', [SessionController::class, 'update']);
    Route::get('/session-delete/{id}', [SessionController::class, 'destroy']);
    //semester
    Route::get('/semester', [SemesterController::class, 'index']);
    Route::post('/semester-store', [SemesterController::class, 'store']);
    Route::post('/semester-update/{id}', [SemesterController::class, 'update']);
    Route::get('/semester-delete/{id}', [SemesterController::class, 'destroy']);
    //offer-list
    Route::get('/offer-list', [OfferListController::class, 'index']);
    Route::post('/offer-list-store', [OfferListController::class, 'store']);
    Route::post('/offer-list-update/{id}', [OfferListController::class, 'update']);
    Route::get('/offer-list-delete/{id}', [OfferListController::class, 'destroy']);
    //teacher
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::post('/teacher-store', [TeacherController::class, 'store']);
    Route::post('/teacher-update/{id}', [TeacherController::class, 'update']);
    Route::get('/teacher-delete/{id}', [TeacherController::class, 'destroy']);
    //routine
    Route::resource('routines', RoutineController::class);
    Route::get('/manage/routines', [RoutineController::class, 'manage_routine'])->name('routines.manage');

});
