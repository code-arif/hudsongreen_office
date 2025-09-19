<?php

use App\Http\Controllers\Api\WorkScheduleRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\AuthenticationController;

//health-check
Route::get("/check", function () {
    return "All Right 👍";
});

//Guest user routes
Route::group(['middleware' => 'guest:api'], function () {

    // Login & Register
    Route::post('/login', [AuthenticationController::class, 'login']);

    // Password Reset
    Route::post('/reset-password', [ResetPasswordController::class, 'ResetPassword']);
});



Route::group(['middleware' => 'auth:api'], function () {
    //User logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    // Work reschedule request
    Route::post('/reschedule-request/store',[WorkScheduleRequest::class, 'store']);
    Route::get('/reschedule-request/edit/{id}',[WorkScheduleRequest::class, 'edit']);
    Route::post('/reschedule-request/update/{id}',[WorkScheduleRequest::class, 'update']);
    Route::delete('/reschedule-request/delete/{id}',[WorkScheduleRequest::class, 'destroy']);
});
