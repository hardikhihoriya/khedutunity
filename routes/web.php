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

Route::get('/login', 'HomeController@checkLogin');

Auth::routes();


// Contact-us Routes

Route::post('/savecontact', 'ContactController@save');

Route::get('/home', 'UsersController@getUser')->name('home');
Route::get('/admin/add-user', 'UsersController@addUser');
Route::post('/admin/saveUser', 'UsersController@saveUser');
Route::get('/admin/users', 'UsersController@getUser');
Route::get('/admin/edituser/{id}', 'UsersController@editUser');
Route::get('/admin/deleteuser/{id}', 'UsersController@deleteUser');

// Dashboard Page Routes
Route::get('/admin/dashboard','Admin\dashboardController@index');

// Blank Land Routes
Route::get('/admin/blank-land','Admin\blanklandController@index');

// District List In Gujarat
Route::get('/admin/district','Admin\districtController@index');
Route::get('/admin/add-district','Admin\districtController@addDistrict');
Route::post('/admin/list-district-ajax', 'Admin\districtController@listDistrictAjax');
Route::get('/admin/edit-district/{id}', array('as' => 'district.edit', 'uses' => 'Admin\districtController@editDistrict'));
Route::post('/admin/district-save','Admin\districtController@saveDistrict');

// Taluka List In Gujarat 
Route::get('/admin/taluka','Admin\talukaController@index');
Route::get('/admin/add-taluka','Admin\talukaController@addTaluka');
Route::post('/admin/list-taluka-ajax', 'Admin\talukaController@listTalukaAjax');
Route::get('/admin/edit-taluka/{id}', array('as' => 'taluka.edit', 'uses' => 'Admin\talukaController@editTaluka'));
Route::post('/admin/taluka-save','Admin\talukaController@saveTaluka');
