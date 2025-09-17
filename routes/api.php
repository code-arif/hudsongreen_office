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
    Route::post('/register', [AuthenticationController::class, 'register']);

    // Password Reset
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword']);
    Route::post('/resend-otp', [ResetPasswordController::class, 'resendOtp']);
    Route::post('/verify-otp', [ResetPasswordController::class, 'verifyOTP']);
    Route::post('/reset-password', [ResetPasswordController::class, 'ResetPassword']);


    //CMS Data Routes
    Route::group(['prefix' => 'cms'], function () {
        Route::get('/landing', [CMSDataController::class, 'getData']);
    });
});



Route::group(['middleware' => 'auth:api'], function () {
    //User logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    //Profile
    Route::get('/profile', [UserProfileController::class, 'profile']);
    Route::post('/update-profile', [UserProfileController::class, 'updateProfile']);
    Route::post('/update-avatar', [UserProfileController::class, 'updateAvatar']);

    //Student Routes
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/student/{id}', [StudentController::class, 'show']);
    Route::post('/student/store', [StudentController::class, 'store']);
    Route::post('/student/update/{id}', [StudentController::class, 'update']);
    Route::delete('/student/delete/{id}', [StudentController::class, 'destroy']);

    //Fitness Test Routes
    Route::get('/fitness-tests', [FitnessTestController::class, 'index']);
    Route::get('/fitness-test/{id}', [FitnessTestController::class, 'show']);

    // Test score manage
    Route::post('/test/store', [FitnessTestScoreController::class, 'store']);
});
