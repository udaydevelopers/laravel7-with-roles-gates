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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/employee/{id}', 'EmployeeController@show');

Route::resource('photos', 'PhotoController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/contact','ContactsController', ['except'=>['create','show','edit','destroy','update']]);
//Route::resource('/admin/users','Admin\UsersController', ['except'=>['show','store','create']]);

route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users','UsersController', ['except'=>['show','store','create']]);
});

route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-contacts')->group(function(){
    Route::resource('/contacts','ContactsController', ['except'=>['show','store','create']]);
});

route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('/dashboard','DashboardsController', ['except'=>['show','store','create']]);
});

Route::get('/upload', 'PhotoController@upload_doc')->name('upload_doc');
Route::post('/upload', 'PhotoController@upload_form')->name('upload');