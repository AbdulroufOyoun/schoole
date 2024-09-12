<?php


use App\Http\Controllers\Apis\Calender\CalenderController;
use App\Http\Controllers\Apis\UserManagement\PassportAuthController;
use App\Http\Controllers\Apis\ClassesManagment\StudentController;
use App\Http\Controllers\Apis\SocialMedia\PagesController;
use App\Http\Controllers\Apis\SocialMedia\PostController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(PassportAuthController::class)
    ->prefix('/user')
    ->group(function () {
        Route::group(['middleware' => ['auth:api']], static function () {
            Route::get('/profile', 'profile');
            Route::post('/update', 'update');
            Route::post('/update-fcm-token', 'FcmToken');
            Route::post('/change-password', 'changePassword');
            Route::post('/logout', 'logout');
            Route::get('/show-profile/{id}', 'showProfile');
            Route::get('/like-profile/{id}', 'like');
            Route::get('/likers/{id?}', 'likers');
            Route::get('/follow-profile/{id}', 'follow');
            Route::get('/followers/{id?}', 'followers');
            Route::get('/followings/{id?}', 'following');
            Route::get('/notifications', 'getNotifications');
            Route::get('/raed-notifications/{id}', 'readNotifications');
            Route::get('/messages', 'getMessages');
            Route::get('/message-details/{id}', 'getMessageDetails');
            Route::post('/send-message-to-user', 'sendMessageToUser')->middleware('role:teacher|parent');
            Route::post('/reply-message', 'replyMessage')->middleware('role:teacher|parent');
            Route::get('/sent-messages', 'getSentMessages');

        });
        Route::post('/login', 'login');

    });

Route::controller(PostController::class)
    ->prefix('/posts')
    ->group(function () {
        Route::group(['middleware' => ['auth:api']], static function () {
            Route::post('/create', 'create');
            Route::post('/update', 'update');
            Route::get('/delete/{id}', 'delete');
            Route::get('/like/{id}', 'like');
            Route::get('/likers/{id}', 'likers');
            Route::post('/add-comment', 'add_comment');
            Route::get('/delete-comment/{id}', 'delete_comment');
            Route::get('/all-comments/{id}', 'comments');
            Route::get('/set-post-private/{id}', 'setPostPrivate');
            Route::post('/report-post', 'createReportPost');

            Route::group(['middleware' => ['processing_posts']], function () {
                Route::get('/unprocessed-posts', 'unprocessed_posts');
                Route::get('/confirm-post/{id}', 'confirm_post');
                Route::post('/reject-post', 'reject_post');
                Route::post('/edit-and-confirm', 'updateAndConfirm');
            });
            Route::get('/home', 'home');

        });

    });


Route::controller(PagesController::class)
    ->prefix('/pages')
    ->group(function () {
        Route::group(['middleware' => ['auth:api']], static function () {
            Route::get('/private-page/{id?}', 'private_page');
        });
        Route::get('/advertising-page', 'advertising');
    });


Route::controller(StudentController::class)
    ->prefix('/student')
    ->group(function () {
        Route::group(['middleware' => ['auth:api']], static function () {
            Route::get('/student-teacher', 'getStudentTeacher');
        });
        Route::get('/advertising-page', 'advertising');
    });

Route::get('/calendar',[CalenderController::class,'getEvents'])->middleware('auth:api');
