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

Route::post('sections/get-page','SectionController@getPage');


Route::post('sections/get-main-section','MainSectionController@getMainSection');

Route::post('sections/get-sections','SectionController@getSections');
Route::post('sections/update-section','SectionController@updateSection');

Route::resource('sections','SectionController');

Route::resource('profiles','ProfileController');
Route::post('profiles/get-profiles','ProfileController@getProfiles');
Route::post('profiles/update-profile','ProfileController@updateProfile');

Route::resource('social-media','SocialMediaController');
Route::post('social-media/get-social-media','SocialMediaController@getSocialMedia');
Route::post('social-media/update-social-media','SocialMediaController@updateSocialMedia');


Route::resource('folder','FolderController');
Route::post('folder/get-folders', 'FolderController@getFolders');
Route::post('folder/update-folder', 'FolderController@updateFolder');

Route::resource('document','DocumentController');
Route::post('document/get-documents', 'DocumentController@getDocuments');
Route::post('document/update-document', 'DocumentController@updateDocument');

Route::resource('event', 'EventController');
Route::resource('notice', 'NoticeController');
