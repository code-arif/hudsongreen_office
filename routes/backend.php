<?php

use App\Http\Controllers\Web\Backend\CalendarController;
use App\Http\Controllers\Web\Backend\EmployeeAssignController;
use App\Http\Controllers\Web\Backend\WorkManageController;
use App\Http\Controllers\Web\Backend\WorkScheduleRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\EmployeeManageController;
use App\Http\Controllers\Web\Backend\MapController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SettingController;
use App\Http\Controllers\Web\Backend\TeamManageController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');

    // employee manage
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/list', [EmployeeManageController::class, 'index'])->name('list');
        Route::post('/store', [EmployeeManageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EmployeeManageController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EmployeeManageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EmployeeManageController::class, 'delete'])->name('delete');

        // empoyee work view in map with polyline
        Route::get('/map/{id}/works', [EmployeeManageController::class, 'mapWorkList'])->name('user.map.list');
    });

    // team manage
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('/list', [TeamManageController::class, 'index'])->name('list');
        Route::post('/store', [TeamManageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TeamManageController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [TeamManageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TeamManageController::class, 'delete'])->name('delete');

        Route::get('/teams', [TeamManageController::class, 'teamList'])->name('list.work');

        // team work view in map with polyline
        Route::get('/map/team/{id}/works', [TeamManageController::class, 'mapWorkList'])->name('work.map.list');
    });

    // assing employee into team manage
    Route::prefix('assign-emplyee')->name('assing.employee.')->group(function () {
        Route::post('/store', [EmployeeAssignController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EmployeeAssignController::class, 'edit'])->name('edit');
    });

    // work manage
    Route::prefix('work')->name('work.')->group(function () {
        Route::get('/list', [WorkManageController::class, 'index'])->name('list');
        Route::post('/store', [WorkManageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WorkManageController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [WorkManageController::class, 'update'])->name('update');
        Route::delete('/delete/{work}', [WorkManageController::class, 'destroy'])->name('delete');
        Route::post('/complation/{id}', [WorkManageController::class, 'complation'])->name('complation.status');

        // category
        Route::get('/category', [WorkManageController::class, 'getCategory'])->name('categroy');

        // work reschedule request
        Route::get('/reschedule-request/edit/{id}', [WorkManageController::class, 'reschedultEdit'])->name('reschedule.edit');
        Route::post('/reschedule-request/update/{id}', [WorkManageController::class, 'rescheduleUpdate'])->name('reschedule.update');
    });

    // work reschedule request
    Route::get('reschedule-request', [WorkScheduleRequest::class, 'index'])->name('reschedule.work.list');
    Route::get('reschedule-request/edit/{id}', [WorkScheduleRequest::class, 'edit'])->name('reschedule.work.edit');
    Route::post('reschedule-request/update/{id}', [WorkScheduleRequest::class, 'update'])->name('reschedule.work.update');

    // work calendar
    Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');

    // work map view
    Route::get('/global-map', [MapController::class, 'globalMap'])->name('map.global');
    Route::get('/filter-works/{teamId}', [MapController::class, 'filterWorksByTeam'])->name('works.filter');
    Route::get('/works/search-teams', [MapController::class, 'searchTeams'])->name('works.searchTeams');
});



//! Route for Profile Settings
Route::controller(ProfileController::class)->group(function () {
    Route::get('setting/profile', 'index')->name('setting.profile.index');
    Route::put('setting/profile/update', 'UpdateProfile')->name('setting.profile.update');
    Route::put('setting/profile/update/Password', 'UpdatePassword')->name('setting.profile.update.Password');
    Route::post('setting/profile/update/Picture', 'UpdateProfilePicture')->name('update.profile.picture');
});



//! Route for Stripe Settings
Route::controller(SettingController::class)->group(function () {
    Route::get('setting/general', 'index')->name('setting.general.index');
    Route::patch('setting/general', 'update')->name('setting.general.update');
});
