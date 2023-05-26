<?php

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

Route::get('vehicle', 'VehicleController@index')->name('vehicle');
Route::post('vehicle', 'VehicleController@index')->name('vehicle');

Route::get('clearFilter', 'VehicleController@clearFilter')->name('clearFilter');
Route::get('vehicle/{vehicleId}', 'VehicleController@vehicleParts')->name('vehicleParts');

Route::get('vehiclesList', 'VehicleController@getVehicleList')->name('vehiclesList');
// Route::post('vehiclesList', 'VehicleController@getVehicleList')->name('vehiclesList');


Route::post('showBikeModelList', 'VehicleController@getVehicleModelList')->name('showBikeModelList');
Route::post('showEnginSizeList', 'VehicleController@getVehicleEngineList')->name('showEnginSizeList');
Route::post('showModelYearList', 'VehicleController@getVehicleModelYearList')->name('showModelYearList');

