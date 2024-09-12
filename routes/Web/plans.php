<?php


use App\Http\Controllers\Plans\PlanController;
use App\Http\Controllers\Plans\WeeklyPlanController;

//
//Route::controller(PlanController::class)
//    ->prefix('/plans')
//    ->as('plans.')
//    ->middleware(['auth','permission:plans management'])
//    ->group(function () {
//
//        Route::get('/study-plans', 'getStudyPlans')->name('study-plans');
//        Route::get('/annual-plans', 'getAnnualPlans')->name('annual-plans');
//        Route::get('/browse-pdf/{id}', 'browsePdf')->name('browsePdf');
//        Route::post('/delete', 'delete')->name('delete');
//
////        school schedule
//        Route::get('/create-school-schedule', 'CreateSchoolSchedule')->name('CreateSchoolSchedule');
//        Route::post('/set-lessons-of-day', 'setLessonOfDay')->name('setLessonOfDay');
//        Route::post('/store-lessons-of-day', 'storeLessonsOfDay')->name('storeLessonsOfDay');
//        Route::get('/select-section', 'selectSection')->name('selectSection');
//        Route::post('/get-section-schedule', 'getSchedule')->name('getSchedule');
//
//
//    });

Route::controller(PlanController::class)
    ->prefix('/plans')
    ->as('plans.')
    ->middleware(['auth','permission:plans management'])
    ->group(function () {

        Route::get('/lesson-plans', 'getLessonPlans')->name('lesson-plans');
        Route::post('/update-lesson-plan-setting', 'updateLessonPlanSetting')->name('update-lesson-plan-setting');
        Route::get('/annual-plans', 'getAnnualPlans')->name('annual-plans');
        Route::get('/browse-pdf/{id}', 'browsePdf')->name('browsePdf');
        Route::post('/delete', 'delete')->name('delete');

//        school schedule
        Route::get('/create-school-schedule', 'CreateSchoolSchedule')->name('CreateSchoolSchedule');
        Route::post('/set-lessons-of-day', 'setLessonOfDay')->name('setLessonOfDay');
        Route::post('/store-lessons-of-day', 'storeLessonsOfDay')->name('storeLessonsOfDay');
        Route::get('/select-section', 'selectSection')->name('selectSection');
        Route::post('/get-section-schedule', 'getSchedule')->name('getSchedule');

    });

Route::controller(WeeklyPlanController::class)
    ->prefix('/weekly-plans')
    ->as('weekly-plans.')
    ->middleware(['auth','permission:plans management'])
    ->group(function () {

        Route::get('/index', 'index')->name('index');
        Route::post('/store-week', 'storeWeek')->name('store-week');
        Route::post('/update-week', 'updateWeek')->name('update-week');
        Route::get('/exception-teacher/{id}', 'getExceptionTeacher')->name('exception-teacher');
        Route::post('/store-exception-teacher', 'storeExceptionTeacher')->name('store-exception-teacher');
        Route::get('/browse-plans/{id}', 'getWeeklyPlans')->name('browse-plans');
        Route::post('/delete-plan', 'deletePlan')->name('delete-plan');
        Route::get('/activation-week/{id}', 'activationWeek')->name('activation-week');
        Route::post('/update-plan', 'updatePlan')->name('update-plan');
        Route::get('/cleaning', 'cleaning')->name('cleaning');

    });
