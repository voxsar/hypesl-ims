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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('App\Http\Controllers\API')->middleware('auth:api')->group(function (){
	Route::apiResource('calendar', 'CalendarController')->parameters(['calendar' => 'appointment']);
	Route::apiResource('messagetopics', 'CalendarController')->parameters(['calendar' => 'appointment']);
	Route::apiResource('calendar', 'CalendarController')->parameters(['calendar' => 'appointment']);

	Route::apiResource('topics', MessageTopicController::class)->parameters(['topic' => 'messageTopic']);
	Route::apiResource('topics.messages', MessageController::class)->parameters(['topic'=> 'messageTopic'])->scoped();
});