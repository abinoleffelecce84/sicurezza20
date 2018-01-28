<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// controller utenti
Route::post('/home/{id}/ultimate/check',['as'=>'check','uses'=>'Register2Controller@check']);
Route::post('/home/{id}/ultimate',['as'=>'ultimate','uses'=>'Register2Controller@update']);


// controller enti
Route::get('gestionente/{id}/delete',['as'=>'delete','uses'=>'AgencyController@delete']);
Route::resource('gestionente','AgencyController');


// controller cruds
Route::get('cruds/{id}/index',['as'=>'index','uses'=>'CrudsController@indexs']);
Route::get('{agency}/show/{descr}',['as'=>'show','uses'=>'CrudsController@shows']);
Route::get('/delete{id}',['as'=>'delete','uses'=>'CrudsController@delete']);
Route::get('cruds/{agency}/edit/{descr}',['as'=>'edit','uses'=>'CrudsController@change']);
Route::any('cruds/{agency}/edited/{descr}',['as'=>'updated','uses'=>'CrudsController@updates']);
Route::get('cruds/{agency}/forum/{descr}',['as'=>'forum','uses'=>'CrudsController@forum']);
Route::post('cruds/{agency}/forum/{descr}/{user}/posted',['as'=>'posted','uses'=>'CrudsController@addComment']);
Route::get('cruds/{id}/delete',['as'=>'deleted','uses'=>'CrudsController@delete']);
Route::get('cruds/utilities',['as'=>'utilities','uses'=>'CrudsController@utilities']);
Route::get('cruds/utilities/add',['as'=>'add','uses'=>'CrudsController@createUtility']);
Route::any('cruds/utilities/added',['as'=>'new_utility','uses'=>'CrudsController@addUtility']);
Route::get('cruds/utilities/{id}/edit',['as'=>'edit_utility','uses'=>'CrudsController@changeUtility']);
Route::any('cruds/utilities/{id}/edited',['as'=>'edited','uses'=>'CrudsController@editUtility']);
Route::get('cruds/utilities/{id}/deleted',['as'=>'deleted','uses'=>'CrudsController@deleteUtility']);
//Route::get('changepassword',['as'=>'change','uses'=>'Register2Controller@showChangePassword']);
//Route::any('changepassword/nick',['as'=>'change','uses'=>'Register2Controller@checkNick']);
//Route::any('changepassword/nick/email/{id}',['as'=>'change','uses'=>'Register2Controller@checkEmail']);
//Route::any('changepassword/nick/email/{id}/changedOk',['as'=>'change','uses'=>'Register2Controller@changePassword']);


Route::get('/general',['as'=>'general','uses'=>'Register2Controller@index']);
