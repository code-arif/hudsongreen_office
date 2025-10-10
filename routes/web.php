<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GoogleAuthContreoller;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Web\Backend\WorkCalendarController;


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



Route::middleware(['auth'])->group(function () {
    // Calendar Routes
    Route::get('/calendar', [GoogleCalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [GoogleCalendarController::class, 'getEvents'])->name('calendar.events');

    // Google OAuth Routes
    Route::get('/google/redirect', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::get('/google/disconnect', [GoogleCalendarController::class, 'disconnect'])->name('google.disconnect');
    Route::post('/google/sync', [GoogleCalendarController::class, 'syncFromGoogle'])->name('google.sync');

    // Work CRUD Routes (Modal based)
    Route::post('/calendar/store', [GoogleCalendarController::class, 'store'])->name('calendar.store');
    Route::get('/calendar/{work}', [GoogleCalendarController::class, 'show'])->name('calendar.show');
    Route::post('/calendar/{work}', [GoogleCalendarController::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/{work}', [GoogleCalendarController::class, 'destroy'])->name('calendar.destroy');
    Route::post('/calendar/{work}/toggle', [GoogleCalendarController::class, 'toggleStatus'])->name('calendar.toggle');
});


// Temporary debug route
Route::get('/debug-calendar', function () {
    $user = Auth::user();
    $works = \App\Models\Work::latest()->take(5)->get();

    return response()->json([
        'google_connected' => !empty($user->google_access_token),
        'works_count' => \App\Models\Work::count(),
        'latest_works' => $works->map(function ($work) {
            return [
                'id' => $work->id,
                'title' => $work->title,
                'work_date' => $work->work_date,
                'time' => $work->time,
                'start_datetime' => $work->start_datetime,
                'end_datetime' => $work->end_datetime,
                'google_event_id' => $work->google_event_id,
            ];
        }),
        'token_exists' => !empty($user->google_access_token),
        'token_length' => $user->google_access_token ? strlen($user->google_access_token) : 0,
    ]);
})->middleware('auth');


require __DIR__ . '/auth.php';
