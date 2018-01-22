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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

  /*
  * Page Management
  */
  Route::get('pages/create', 'PagesController@create')->name('pages.create');
  Route::get('pages', 'PagesController@index')->name('pages.index');
  Route::get('pages/{page}', 'PagesController@show')->name('pages.show');

  Route::get('pages/edit/{page}', 'PagesController@edit')->name('pages.edit');
  Route::get('pages/delete/{page}', 'PagesController@destroy')->name('pages.delete');
  Route::get('pages/restore/{page}', 'PagesController@restore')->name('pages.restore');
  Route::get('pages/force/{page}', 'PagesController@force')->name('pages.force');
  Route::post('pages/store', 'PagesController@store')->name('pages.store');
  Route::post('pages/update', 'PagesController@update')->name('pages.update');

});

Route::get('blog', 'PagesController@index')->name('blog');
Route::get('blog/{page}', 'PagesController@show');


