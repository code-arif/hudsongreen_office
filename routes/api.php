<?php

use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\WorkScheduleRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthenticationController;

//health-check
Route::get("/check", function () {
    return "All Right 👍";
});

//Guest user routes
Route::group(['middleware' => 'guest:api'], function () {

    // Login & Register
    Route::post('/login', [AuthenticationController::class, 'login']);
});



Route::group(['middleware' => 'auth:api'], function () {
    //User logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    // Work reschedule request
    Route::post('/reschedule-request/store',[WorkScheduleRequest::class, 'store']);
    Route::get('/reschedule-request/edit/{id}',[WorkScheduleRequest::class, 'edit']);
    Route::post('/reschedule-request/update/{id}',[WorkScheduleRequest::class, 'update']);
    Route::delete('/reschedule-request/delete/{id}',[WorkScheduleRequest::class, 'destroy']);

    // Work manage
    Route::group(['prefix' => 'work'],function(){
        Route::get('/list', [WorkController::class,'index']);
        Route::get('/map', [WorkController::class,'mapView']);
        Route::post('/complete/{id}', [WorkController::class,'completeWork']);
        Route::get('/details/{id}', [WorkController::class, 'show']);
    });

});
