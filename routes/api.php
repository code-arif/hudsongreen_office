<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CMSDataController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\FitnessTestController;
use App\Http\Controllers\Api\Auth\UserProfileController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\FitnessTestScoreController;

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

    //Profile
    Route::get('/profile', [UserProfileController::class, 'profile']);
    Route::post('/update-profile', [UserProfileController::class, 'updateProfile']);
    Route::post('/update-avatar', [UserProfileController::class, 'updateAvatar']);
});
