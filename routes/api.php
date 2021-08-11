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

Route::group(['prefix' => 'auth','middleware' => 'api'], function () {
//    Route::post('register', [\App\Http\Controllers\AuthController::class,'register']);
    Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
});
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('userList',[\App\Http\Controllers\AuthController::class,'getUserList']);
    Route::get('typeMessageList',[\App\Http\Controllers\MessageController::class,'listTypeMessage']);

    //for customer
    Route::get('indexChat', [\App\Http\Controllers\CustomerController::class,'indexChat']);
    Route::post('chatToCustomer', [\App\Http\Controllers\CustomerController::class,'chatToCustomer']);
    Route::post('reportToStaff', [\App\Http\Controllers\CustomerController::class,'reportToStaff']);
    Route::post('feedbackToStaff', [\App\Http\Controllers\CustomerController::class,'feedbackToStaff']);

    //for staff
    Route::get('allChatStaff', [\App\Http\Controllers\StaffController::class,'indexAllChat']);
    Route::get('ownChatStaff', [\App\Http\Controllers\StaffController::class,'indexOwnChat']);
    Route::get('listCustomer', [\App\Http\Controllers\StaffController::class,'indexCustomer']);
    Route::post('chatCustomerOrStaff', [\App\Http\Controllers\StaffController::class,'chatToStaffOrCustomer']);
    Route::delete('deleteCustomer/{id}', [\App\Http\Controllers\StaffController::class,'deleteCustomer']);


});
