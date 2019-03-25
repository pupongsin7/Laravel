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

Route::get('/nut/{name?}/{surname?}/{age?}', function ($name,$surname,$age) {
    return view('test', array(
        'name' => $name,
        'surname' => $surname,
        'age' => $age,
    )

    );
});
// Route::get('/', function () {
//     return view('layouts.master');
// });
Route::get('/', function () {
    return view('test');
});
Route::get('/product', 'ProductController@index' )->middleware('auth');
Route::get('/product/edit/{id?}', 'ProductController@edit' )->middleware('auth');
Route::post('/product/update', 'ProductController@update' )->middleware('auth');
Route::post('/product/insert', 'ProductController@insert' )->middleware('auth');
Route::get('/product/remove/{id}', 'ProductController@remove')->middleware('auth');
Route::post('/product/search', 'ProductController@search')->middleware('auth');
Route::get('/product/search', 'ProductController@search')->middleware('auth');
Route::get('/home', 'HomeController@index');
Route::get('/cart/view','CartController@viewCart')->middleware('auth');
Route::get('/cart/add/{id}','CartController@addToCart')->middleware('auth');
Route::get('/cart/delete/{id}','CartController@deleteCart')->middleware('auth');
Route::get('/cart/update/{id}/{qty}','CartController@updateCart')->middleware('auth');
Route::get('/logout','HomeController@logout')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect','SocialAuthController@redirect');
Route::get('/callback','SocialAuthController@callback');
