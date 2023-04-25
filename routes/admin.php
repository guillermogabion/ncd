<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;


Route::group(['prefix' => '/v1'], function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
});
Route::group(['prefix' => '/v1', 'middleware' => ['auth:admin-api']], function () {

    Route::get('self', 'UserController@self');
    Route::get('user', 'UserController@index');
 

    Route::get('get-patient', 'PatientController@get');
    Route::delete('delete-patient', 'PatientController@delete');
    Route::post('add-patient', 'PatientController@store');
    Route::post('update-patient/{id}', 'PatientController@update');

    Route::get('get-medicine', 'MedicineController@get');
    Route::delete('delete-medicine', 'MedicineController@delete');
    Route::post('add-medicine', 'MedicineController@store');
    Route::post('update-medicine/{id}', 'MedicineController@update');
  
    Route::get('get-disease', 'DiseaseController@get');
    Route::delete('delete-disease', 'DiseaseController@delete');
    Route::post('add-disease', 'DiseaseController@store');
    Route::post('update-disease/{id}', 'DiseaseController@update');



});
