<?php


use App\Http\Controllers\Apis\Plans\WeeklyPlanController;
use App\Http\Controllers\Apis\Plans\YearlyPlanController;

Route::controller(YearlyPlanController::class)
    ->prefix('plans')
    ->middleware(['auth:api', 'teacher'])
    ->group(function () {

        Route::get('/teacher-classrooms', 'getTeacherClassrooms');
        Route::get('/subject-teacher-classrooms/{id}', 'getSubjectForTeacherClassrooms');

        Route::post('/upload-lesson-plan', 'storeLessonPlan');
        Route::post('/upload-annual-plan', 'storeAnnualPlan');

    });
Route::get('/plans/get-schedule', [YearlyPlanController::class,'getSchedule'])->middleware('auth:api');


Route::controller(WeeklyPlanController::class)
    ->prefix('weekly-plans')
    ->middleware(['auth:api', 'teacher'])
    ->group(function () {

        Route::get('/days-of-teacher-lessons', 'getDaysOfTeacherLessons');
        Route::post('/filter-classrooms-by-select-day', 'getClassroomsBySelectedDay');
        Route::post('/filter-sections-by-select-classroom', 'getSectionsBySelectedClassroom');
        Route::post('/filter-subjects-by-select-section', 'getSubjectBySelectedSection');
        Route::post('/check-status', 'checkStatus');
        Route::post('/store-weekly-plan', 'storeWeeklyPlan');
        Route::post('/update-weekly-plan', 'updateWeeklyPlan');

    });

Route::controller(WeeklyPlanController::class)
    ->prefix('homework')
    ->middleware(['auth:api', 'student'])
    ->group(function () {

        Route::get('/get-student-homework', 'getStudentHomework');
        Route::get('/finish-student-homework/{id}', 'finishStudentHomework');
        Route::post('/get-student-Plan-by-day', 'getStudentPlanByDay');

    });
