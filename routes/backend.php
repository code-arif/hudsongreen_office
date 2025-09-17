<?php

use App\Http\Controllers\Web\Backend\CMS\FitnessTestController;
use App\Http\Controllers\Web\Backend\CMS\HeroController;
use App\Http\Controllers\Web\Backend\CMS\HowItWorksController;
use App\Http\Controllers\Web\Backend\CMS\NeedController;
use App\Http\Controllers\Web\Backend\CMS\ReadyToTransformController;
use App\Http\Controllers\Web\Backend\SchoolApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\SchoolManageController;
use App\Http\Controllers\Web\Backend\TestimonialController;
use App\Http\Controllers\Web\Backend\Settings\SocialController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SettingController;
use App\Http\Controllers\Web\Backend\Settings\DynamicPageController;
use App\Http\Controllers\Web\Backend\Settings\MailSettingController;
use App\Http\Controllers\Web\Backend\Settings\SocialSettingController;


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // cms management
    Route::prefix('cms')->name('cms.')->group(function () {
        //hero section
        Route::get('/hero', [HeroController::class, 'index'])->name('hero.section');
        Route::post('/hero/update', [HeroController::class, 'update'])->name('hero.section.update');

        // everything you need section
        Route::get('/everything-you-need', [NeedController::class, 'index'])->name('need.section');
        Route::post('/everything-you-need/store', [NeedController::class, 'store'])->name('store.need.section');
        Route::post('/everything-you-need/item/store', [NeedController::class, 'storeItem'])->name('need.item.store');
        Route::get('/everything-you-need/item/edit/{id}', [NeedController::class, 'editItem'])->name('need.item.edit');
        Route::post('/everything-you-need/item/update/{id}', [NeedController::class, 'updateItem'])->name('need.item.update');
        Route::delete('/everything-you-need/item/delete/{id}', [NeedController::class, 'destroy'])->name('need.item.destroy');

        // how it works section
        Route::get('/how-it-works', [HowItWorksController::class, 'index'])->name('how-it-works.section');
        Route::post('/how-it-works/store', [HowItWorksController::class, 'store'])->name('store.how-it-works.section');
        Route::post('/how-it-works/item/store', [HowItWorksController::class, 'storeItem'])->name('how-it-works.item.store');
        Route::get('/how-it-works/item/edit/{id}', [HowItWorksController::class, 'editItem'])->name('how-it-works.item.edit');
        Route::post('/how-it-works/item/update/{id}', [HowItWorksController::class, 'updateItem'])->name('how-it-works.item.update');
        Route::delete('/how-it-works/item/delete/{id}', [HowItWorksController::class, 'destroy'])->name('how-it-works.item.destroy');


        // how it works section
        Route::get('/fitness-test', [FitnessTestController::class, 'index'])->name('fitness-test.section');
        Route::post('/fitness-test/store', [FitnessTestController::class, 'store'])->name('store.fitness-test.section');
        Route::post('/fitness-test/item/store', [FitnessTestController::class, 'storeItem'])->name('fitness-test.item.store');
        Route::get('/fitness-test/item/edit/{id}', [FitnessTestController::class, 'editItem'])->name('fitness-test.item.edit');
        Route::post('/fitness-test/item/update/{id}', [FitnessTestController::class, 'updateItem'])->name('fitness-test.item.update');
        Route::delete('/fitness-test/item/delete/{id}', [FitnessTestController::class, 'destroy'])->name('fitness-test.item.destroy');

        //ready to transform section
        // how it works section
        Route::get('/ready-to-transform', [ReadyToTransformController::class, 'index'])->name('ready-to-transform.section');
        Route::post('/ready-to-transform/update', [ReadyToTransformController::class, 'update'])->name('update.ready-to-transform.section');
    });

    //approve school
    Route::get('/school/approve/{token}', [SchoolApprovalController::class, 'approveFromEmail'])->name('admin.schools.approve');
    Route::get('/school/cancel/{token}', [SchoolApprovalController::class, 'cancelFromEmail'])->name('admin.schools.cancel');

    //school manage form dashobard
    Route::get('/school/list', [SchoolManageController::class, 'index'])->name('schools.list');
    Route::get('/school/show', [SchoolManageController::class, 'show'])->name('school.show');
    
    // Route::get('/school/status/{id}', [SchoolManageController::class, 'status'])->name('school.status');
    Route::post('/school/status/{id}', [SchoolManageController::class, 'status'])->name('school.status');
});



Route::get('/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonial.index');
Route::post('/testimonial/status/{id}', [TestimonialController::class, 'status'])->name('admin.testimonial.status');
Route::delete('/testimonial/delete/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.destroy');


Route::get('/admin/social-media-settings', [SocialSettingController::class, 'index'])->name('admin.social_media.index');
Route::get('/admin/social-media/{id}/edit', [SocialSettingController::class, 'edit'])->name('admin.social_media.edit');
Route::put('/admin/social-media/{id}', [SocialSettingController::class, 'update'])->name('admin.social_media.update');





//! Route for Profile Settings
Route::controller(ProfileController::class)->group(function () {
    Route::get('setting/profile', 'index')->name('setting.profile.index');
    Route::put('setting/profile/update', 'UpdateProfile')->name('setting.profile.update');
    Route::put('setting/profile/update/Password', 'UpdatePassword')->name('setting.profile.update.Password');
    Route::post('setting/profile/update/Picture', 'UpdateProfilePicture')->name('update.profile.picture');
});

//! Route for Mail Settings
Route::controller(MailSettingController::class)->group(function () {
    Route::get('setting/mail', 'index')->name('setting.mail.index');
    Route::patch('setting/mail', 'update')->name('setting.mail.update');
});

//! Route for Firebase Settings
Route::controller(SocialController::class)->prefix('setting/social')->name('setting.social.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/update', 'update')->name('update');
});

//! Route for Stripe Settings
Route::controller(SettingController::class)->group(function () {
    Route::get('setting/general', 'index')->name('setting.general.index');
    Route::patch('setting/general', 'update')->name('setting.general.update');
});


Route::controller(DynamicPageController::class)->group(function () {
    Route::get('/dynamic-page', 'index')->name('admin.dynamic_page.index');
    Route::get('/dynamic-page/create', 'create')->name('admin.dynamic_page.create');
    Route::post('/dynamic-page/store', 'store')->name('admin.dynamic_page.store');
    Route::get('/dynamic-page/edit/{id}', 'edit')->name('admin.dynamic_page.edit');
    Route::put('/dynamic-page/update/{id}', 'update')->name('admin.dynamic_page.update');
    Route::post('/dynamic-page/status/{id}', 'status')->name('admin.dynamic_page.status');
    Route::delete('/dynamic-page/destroy/{id}', 'destroy')->name('admin.dynamic_page.destroy');
});
