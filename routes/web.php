<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

});

Route::prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index');
});

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/forum', 'HomeController@index');
Route::get('/posts/new', 'HomeController@index');
Route::get('/schedule', 'HomeController@index');
Route::post('/getSchedule', 'ScheduleController@getSchedule');
Route::get('/doctors', 'HomeController@index');
Route::get('/appointments', 'HomeController@index');
Route::get('/user-info', 'HomeController@index');
Route::get('/create-medical-record', 'HomeController@index');
Route::get('/createTreatment', 'HomeController@index');
Route::get('/messagesHistory', 'MessageController@getmessagesHistory');
Route::get('/user-info/{id}', 'HomeController@index');
Route::get('/show-medical-record/{id}', 'HomeController@index');
Route::get('/medical-record-list', 'HomeController@index');
Route::get('/call/{id}', 'HomeController@index');
Route::get('/userManage', 'HomeController@index');
Route::get('/createUser', 'HomeController@index');
Route::post('/call', 'HomeController@call');
Route::post('/callResponse', 'HomeController@callResponse');
Route::post('/reportPost', 'HomeController@reportPost');
Route::post('/reportComment', 'HomeController@reportComment');
Route::get('/getNotifications', 'HomeController@getNotifications');
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/postManage', 'HomeController@index');
Route::get('/reportManage', 'HomeController@index');
Route::post('/markNoti', 'HomeController@markNotification');
// Route::post('/broadcasting/auth', 'HomeController@checkAuth');
Route::resources([
    'posts' => 'PostController',
    'comments' => 'CommentController',
    'likes' => 'LikeController',
    'schedules' => 'ScheduleController',
    'messages' => 'MessageController',
    'users' => 'UserController',
    'specialists' => 'SpecialistController',
    'appointments' => 'AppointmentController',
    'medicalRecords' => 'MedicalRecordController',
    'progress' => 'ProgressController',
    'treatments' => 'TreatmentController',
]);
Route::get('/csrf', function () {
    return csrf_token();
});
