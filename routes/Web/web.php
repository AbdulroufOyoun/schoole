<?php

use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ClassesManagment\ClassroomController;
use App\Http\Controllers\ClassesManagment\SubjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Schools\SchoolController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\SocialMedia\MessageController;
use App\Http\Controllers\SocialMedia\PagesController;
use App\Http\Controllers\SocialMedia\PostsController;
use App\Http\Controllers\Calender\CalenderController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'advertising'])->name('home');

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin|academic|accountant|super admin'])->name('dashboard');

Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

Route::controller(SchoolController::class)
    ->prefix('/schools')
    ->as('schools.')
    ->middleware(['auth', 'role:super admin'])
    ->group(function () {
        Route::get('/index', 'schools')->name('index');
        Route::post('/create', 'createSchool')->name('create');
        Route::post('/update', 'updateSchool')->name('update');
        Route::get('/admins/create', 'createSchoolAdmin')->name('create-admin');
        Route::post('/admins/store', 'storeSchoolAdmin')->name('store-admin');
        Route::get('/admins', 'schoolsAdmins')->name('admins');
        Route::post('/delete', 'deleteSchool')->name('delete');

    });

Route::controller(UserController::class)
    ->prefix('/user')
    ->as('user.')
    ->middleware(['auth', 'role:admin|academic|super admin'])
    ->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::get('/index', 'index')->name('index');
        Route::post('/list', 'getUser')->name('list');
        Route::post('/delete', 'delete')->name('delete');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/update-profile', 'updateProfile')->name('update-profile');
        Route::post('/delete-social-media', 'deleteSocialMedia')->name('delete-social-media');

    });


Route::resource('roles', RoleController::class)->middleware(['auth', 'role:admin|super admin']);


Route::controller(PagesController::class)
    ->prefix('/advertising')
    ->as('advertising.')
    ->middleware(['auth', 'role:super admin'])
    ->group(function () {
        Route::get('/activites', 'activites')->name('activtes');
        Route::post('/activites/store', 'store_activities')->name('activites.store');
        Route::get('/activites/delete', 'delete_activities')->name('activites.delete');
        Route::get('/activites/edit/{id}', 'edit_activities')->name('activites.edit');
        Route::post('/activites/update', 'update_activities')->name('activites.update');
    });

Route::controller(ClassroomController::class)
    ->as('classrooms.')
    ->prefix('/classroom')
    ->middleware(['auth', 'permission:Classroom management'])
    ->group(function () {

        Route::get('/create', 'index')->name('index');
        Route::post('/delete', 'delete')->name('delete');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/section/add', 'add_section')->name('section.add');
        Route::get('/section/index/{id}', 'index_section')->name('section.index');
        Route::post('/section/delete', 'delete_section')->name('section.delete');
        Route::post('/section/update', 'update_section')->name('section.update');

        Route::group(['middleware' => ['permission:advance student']], function () {
            Route::get('/select-option', 'select_option')->name('select-option');
            Route::post('/select-students', 'select_students')->name('select_students');
            Route::post('/promotion', 'promotion')->name('promotion');
            Route::post('/deposition', 'deposition')->name('deposition');

        });


    });


Route::controller(SettingsController::class)
    ->as('settings.')
    ->prefix('/settings')
    ->middleware(['auth', 'role:super admin'])
    ->group(function () {

        Route::get('', 'settings')->name('index');
        Route::post('/update', 'update_settings')->name('update');
        Route::get('/advertising-teacher', 'advertisingTeacher')->name('advertising-teacher');
        Route::post('/store-advertising-teacher', 'storeAdvertisingTeacher')->name('store-advertising-teacher');
        Route::post('/delete-advertising-teacher', 'deleteAdvertisingTeacher')->name('delete-advertising-teacher');


    });

Route::controller(SettingsController::class)
    ->as('settings.')
    ->prefix('/settings')
    ->middleware(['auth', 'permission:settings management'])
    ->group(function () {

        Route::get('/school', 'schoolSettings')->name('school-settings');
        Route::post('/school/update', 'updateSchoolSettings')->name('school-update');
        Route::get('/years', 'years')->name('years');
        Route::post('/year/create', 'create_year')->name('year.create');
        Route::post('/year/update', 'update_year')->name('year.update');
        Route::get('/year/activation-message/{id}', 'activation_message')->name('year.activation_message');
        Route::get('/year/activation/{id?}', 'activation')->name('year.activation');


    });


Route::controller(SubjectController::class)
    ->as('subject.')
    ->prefix('/subject')
    ->middleware(['auth', 'permission:subjects management'])
    ->group(function () {

        Route::get('/index', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/assign-teacher', 'assign_teacher')->name('assign_teacher');
        Route::get('/filter-section/{id}', 'filter_section')->name('filter_section');
        Route::post('/assign', 'assign')->name('assign');
        Route::get('/teacher', 'teachers')->name('teacher');
        Route::get('/teacher/filter/{id}', 'filter_years')->name('filter_years');
        Route::post('/teacher/delete', 'delete_teacher')->name('delete_teacher');
        Route::get('/teacher/edit/{id}', 'edit_assign_teacher')->name('edit_assign_teacher');
        Route::post('/teacher/update', 'update_assign_teacher')->name('update_assign_teacher');


    });


Route::controller(PostsController::class)
    ->as('posts.')
    ->prefix('/posts')
    ->middleware(['auth', 'permission:social media management'])
    ->group(function () {

        Route::get('/reject-posts', 'getRejectedPosts')->name('getRejectedPosts');
        Route::get('/details/{id}', 'getPostDetails')->name('getPostDetails');
        Route::post('/delete', 'delete')->name('delete');

        Route::get('/posts-reports', 'getPostsRerports')->name('getPostsRerports');
        Route::post('/delete-report', 'deleteReport')->name('deleteReport');


    });


Route::controller(CalenderController::class)
    ->as('calender.')
    ->prefix('/calender')
    ->middleware(['auth', 'permission:calendar management'])
    ->group(function () {

        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::post('/delete', 'delete')->name('delete');

    });

