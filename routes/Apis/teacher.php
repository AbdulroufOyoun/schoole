<?php


use App\Http\Controllers\Apis\Teacher\TeacherController;

Route::controller(TeacherController::class)
    ->prefix('teacher')
    ->middleware(['auth:api', 'teacher'])
    ->group(function () {

        Route::post('/filter-teacher-section-by-classroom', 'getTeacherSectionByClassroom');
        Route::post('/filter-teacher-subject-by-section', 'getTeacherSubjectBySection');
        Route::post('/student-of-section', 'getStudentOfSection');
        Route::post('/send-group-message', 'sendGroupMessage');
        Route::post('/send-student-message', 'SendStudentMessage');
        Route::post('/send-parent-message', 'sendParentMessage');
//      teacher schedule
        Route::get('/get-schedule', 'getTeacherSchedule');

    });

