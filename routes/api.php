<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//login
Route::post('/login','AuthController@login');
Route::post('/login-ad','AuthController@loginad');

//Menu
Route::get('/issues-closed','Admin\ApiController@Closed');
Route::get('/issues-new','Admin\ApiController@New');
Route::get('/issues-defer','Admin\ApiController@Defer');
Route::get('/appointments','Admin\ApiController@Appointments');

Route::post('/appointmentlist','Admin\ApiController@Appointmentlist');
Route::post('/commentlist','Admin\ApiController@Commentlist');
Route::post('/commentliststatus','Admin\ApiController@CommentlistStatus');


Route::post('/issues-poststatus','Admin\ApiController@poststatus');
Route::post('/issues-checkclosedstatus','Admin\ApiController@updateclosedstatus');
Route::post('/issues-checkkeepstatus','Admin\ApiController@updatekeepstatus');
Route::post('/issues-getstatus','Admin\ApiController@getstatus');

Route::post('/issues-getcountComment','Admin\ApiController@getcountComment');
Route::post('/issues-getComment','Admin\ApiController@getComment');
Route::post('/issues-postComment','Admin\ApiController@postComment');
Route::post('/issues-postStatusComment','Admin\ApiController@postStatusComment');


//service ย่อยต่างๆ
Route::post('/issues-deviceid','Admin\ApiController@Deviceid'); //รับค่า MacAddress
Route::post('/issues-postlogin', 'Admin\ApiController@postlogin'); //รับค่า MacAddress IpAddress Token วันหมดอายุ
Route::post('/issues-delete', 'Admin\ApiController@delete'); //ไม่ได้ใช้
Route::get('/issues-lastedVersion','Admin\ApiController@lastedVersion'); // เช็คเวอร์ชั้นล่าสุด


