<?php


use App\Http\Controllers\Payment\PaymentController;

Route::controller(PaymentController::class)
    ->as('payment.')
    ->prefix('/payment')
    ->middleware(['auth', 'permission:payment management'])
    ->group(function () {

        Route::get('/students-fees', 'getStudentsFees')->name('get-students-fees');
        Route::post('/store-students-fee', 'storeStudentsFees')->name('store-students-fees');
        Route::post('/delete-student-fee', 'deleteStudentFee')->name('delete-student-fee');
        Route::get('/parents-payments', 'getParentsPayments')->name('get-parents-payments');
        Route::get('/payments-details/{id}', 'getParentPaymentsDetails')->name('get-parent-payments-details');
        Route::post('/store-batch', 'storeBatch')->name('store-batch');
        Route::post('/delete-batch', 'deleteBatch')->name('delete-batch');

    });


