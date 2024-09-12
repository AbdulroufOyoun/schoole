<?php


use App\Http\Controllers\Marks\MarkController;
use App\Http\Controllers\Marks\TermController;

Route::controller(TermController::class)
    ->as('semesters.')
    ->prefix('/semesters')
    ->middleware(['auth', 'permission:marks management'])
    ->group(function () {

        Route::get('/', 'getSemesters')->name('get-semesters');
        Route::post('/store-semester', 'storeSemester')->name('store-semester');
        Route::post('/update-semester', 'updateSemester')->name('update-semester');

    });


Route::controller(TermController::class)
    ->as('terms.')
    ->prefix('/terms')
    ->middleware(['auth', 'permission:marks management'])
    ->group(function () {

        Route::get('/', 'getTerms')->name('get-terms');
        Route::post('/store-term', 'storeTerm')->name('store-term');
        Route::post('/update-term', 'updateTerm')->name('update-term');
        Route::get('/term-activation/{id}', 'termActivation')->name('term-activation');

    });

Route::controller(MarkController::class)
    ->as('marks.')
    ->prefix('/marks')
    ->middleware(['auth', 'permission:marks management'])
    ->group(function () {

        Route::get('/subject-marks', 'getSubjectMarks')->name('get-subject-marks');
        Route::post('/delete', 'delete')->name('delete');
        Route::get('/students-marks/{id}', 'getStudentsMarks')->name('students-marks');
        Route::post('/update-student-marks', 'updateStudentMarks')->name('update-student-marks');
        Route::get('/config-subjects-marks', 'configSubjectsMarks')->name('config-subjects-marks');
        Route::get('/filter-subject/{id}', 'filterSubject')->name('filter-subject');
        Route::post('/store-configuration', 'storeConfiguration')->name('store-configuration');
        Route::get('/marks-configuration', 'marksConfiguration')->name('marks-configuration');


    });

Route::controller(MarkController::class)
    ->as('marks.')
    ->prefix('/marks')
    ->middleware(['auth', 'permission:marks management'])
    ->group(function () {

        Route::get('/select-student', 'selectStudent')->name('select-student');
        Route::get('/filter_students/{id}', 'filterStudents')->name('filter_students');
        Route::post('/student-score', 'studentScore')->name('student-score');

    });
