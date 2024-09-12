<?php

use App\Http\Controllers\Apis\Marks\MarkController;

Route::controller(MarkController::class)
    ->prefix('marks')
    ->middleware(['auth:api'])
    ->group(function () {

        Route::get('/get-school-terms', 'getSchoolTerms');
        Route::post('/teacher/upload-section-marks', 'uploadMarks');
        Route::post('/student/get-student-marks/{id?}', 'getStudentsMarks');
        Route::get('/student/get-student-grade/{id?}', 'getStudentGrade');
    });
