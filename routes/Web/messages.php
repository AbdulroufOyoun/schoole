<?php


use App\Http\Controllers\SocialMedia\MessageController;

Route::controller(MessageController::class)
    ->as('messages.')
    ->prefix('/messages')
    ->middleware(['auth', 'permission:messages'])
    ->group(function () {

        Route::get('/messages', 'getMessages')->name('get-messages');
        Route::get('/group-messages', 'getGroupMessage')->name('get-group-messages');
        Route::get('/accept-message/{id}', 'acceptMessage')->name('accept-message');
        Route::get('/accept-group-message/{id}', 'acceptGroupMessage')->name('accept-group-message');
        Route::post('/delete', 'delete')->name('delete');
        Route::get('/message-details/{id}', 'getMessageDetails')->name('message-details');
        Route::get('/academic-messages', 'getAcademicMessages')->name('get-academic-messages');
        Route::get('/admin-messages', 'getAdminMessages')->name('get-admin-messages')->middleware('permission:admins messages');
        Route::get('/academic-messages', 'getAcademicMessages')->name('get-academic-messages');
        Route::post('/reply-message', 'replyMessage')->name('reply-message');
        Route::get('/create-message', 'createMessage')->name('create-message');
        Route::post('/send-message', 'sendMessage')->name('send-message');
        Route::post('/send-group-message', 'sendGroupMessage')->name('send-group-message');
        Route::get('/sent-messages', 'getSentMessages')->name('sent-messages');

    });


