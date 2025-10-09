<?php

use App\Http\Controllers\GoogleAuthContreoller;
use App\Http\Controllers\Web\Backend\WorkCalendarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\GoogleCalendarController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/run-migrate', function () {
    try {
        $output = Artisan::call('migrate:fresh');
        return response()->json([
            'message' => 'Migrations executed.',
            'output' => nl2br($output)
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while running migrations.',
            'error' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/run-migrate-fresh', function () {
    try {
        $output = Artisan::call('migrate:fresh', ['--seed' => true]);
        return response()->json([
            'message' => 'Migrations executed.',
            'output' => nl2br($output)
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while running migrations.',
            'error' => $e->getMessage(),
        ], 500);
    }
});

// Run composer update
Route::get('/run-composer-update', function () {
    $output = shell_exec('composer update 2>&1');
    return response()->json([
        'message' => 'Composer update command executed.',
        'output' => nl2br($output)
    ]);
});
// Run optimize:clear
Route::get('/run-optimize-clear', function () {
    $output = Artisan::call('optimize:clear');
    return response()->json([
        'message' => 'Optimize clear command executed.',
        'output' => nl2br($output)
    ]);
});
// Run db:seed
Route::get('/run-db-seed', function () {
    $output = Artisan::call('db:seed', ['--force' => true]);
    return response()->json([
        'message' => 'Database seeding executed.',
        'output' => nl2br($output)
    ]);
});
// Run cache:clear
Route::get('/run-cache-clear', function () {
    $output = Artisan::call('cache:clear');
    return response()->json([
        'message' => 'Cache cleared.',
        'output' => nl2br($output)
    ]);
});
// Run queue:restart
Route::get('/run-queue-restart', function () {
    $output = Artisan::call('queue:restart');
    return response()->json([
        'message' => 'Queue workers restarted.',
        'output' => nl2br($output)
    ]);
});

// Create storage symbolic link
Route::get('/run-storage-link', function () {
    try {
        $output = Artisan::call('storage:link');
        return response()->json([
            'message' => 'Storage symbolic link created.',
            'output' => nl2br($output)
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while creating storage symbolic link.',
            'error' => $e->getMessage(),
        ], 500);
    }
});


// teacher email verification
Route::get('/verify-email/{token}', [AuthenticationController::class, 'verifyEmail'])->name('verify.email');



// Calendar Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/calendar', [GoogleCalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/create', [GoogleCalendarController::class, 'create'])->name('calendar.create');
    Route::post('/calendar', [GoogleCalendarController::class, 'store'])->name('calendar.store');
    Route::get('/calendar/{work}/edit', [GoogleCalendarController::class, 'edit'])->name('calendar.edit');
    Route::put('/calendar/{work}', [GoogleCalendarController::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/{work}', [GoogleCalendarController::class, 'destroy'])->name('calendar.destroy');
    Route::post('/calendar/{work}/toggle', [GoogleCalendarController::class, 'toggleStatus'])->name('calendar.toggle');
    Route::get('/calendar/events', [GoogleCalendarController::class, 'getEvents'])->name('calendar.events');
});

// Google Auth Routes
Route::get('/google/redirect', [GoogleAuthContreoller::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleAuthContreoller::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/google/disconnect', [GoogleAuthContreoller::class, 'disconnectGoogle'])->name('google.disconnect');

require __DIR__ . '/auth.php';
