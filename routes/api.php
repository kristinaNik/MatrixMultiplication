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

Route::middleware('auth.basic')->group( function () {
    Route::post('matrix/set_dimensions', 'MatrixController@setDimensions');
    Route::put('matrix/update_dimensions/{id}', 'MatrixController@updateDimensions');
    Route::get('matrix/multiply_matrices', 'MatrixController@multiplyMatrices');
});

