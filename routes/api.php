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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('sections/get-main-section','MainSectionController@getMainSection');

Route::post('sections/get-sections','SectionController@getSections');
Route::post('sections/update-section','SectionController@updateSection');

Route::post('sections/get-page','SectionController@getPage');

Route::resource('sections','SectionController');



Route::resource('profiles','ProfileController');
Route::post('profiles/get-profiles','ProfileController@getProfiles');
