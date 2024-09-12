<?php

use App\Http\Controllers\Apis\Parents\ParentController;
use App\Http\Controllers\Apis\Plans\WeeklyPlanController;

Route::controller(ParentController::class)
    ->prefix('parent')
    ->middleware(['auth:api', 'parent'])
    ->group(function () {

        Route::get('/my-sons', 'getParentSons');
        Route::get('/get-sons-classrooms', 'getSonsClassrooms');
        Route::post('/get-teacher-of-classrooms', 'getClassroomTeachers');
        Route::get('/get-sons-teachers', 'getSonsTeacher');
        Route::post('/send-message-to-manager', 'sendMessageToManager');
//       payment
        Route::get('/get-payments', 'getPayment');
        Route::get('/get-batches', 'getBatches');
        Route::post('/get-son-plan-by-day', 'getSonPlanByDay');

    });

Route::get('parent/get-son-homework/{id}', [WeeklyPlanController::class,'getSonHomework'])->middleware('auth:api');
