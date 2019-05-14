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


//Home
Route::get('index', 'PageController@getIndex');

// Products List

Route::get('loai-san-pham/{id}', 'PageController@getLoaiSP' );

//Product Detail

Route::get('chi-tiet-san-pham/{id}', 'PageController@getChiTietSP' );

//Introduction and Contact

Route::get('lien-he', 'PageController@getLienHe' );

Route::post('lien-he', 'PageController@postLienHe' );

Route::get('gioi-thieu', 'PageController@getGioiThieu' );


//Cart 
Route::get('add-to-cart/{id}', 'PageController@getAddtoCart' );

Route::get('del-cart/{id}', 'PageController@getDelCart' );

Route::get('dat-hang',[
	'as' => 'dathang',
	'uses' => 'PageController@getCheckout'
	]);

Route::post('dat-hang',[
	'as' => 'dathang',
	'uses' => 'PageController@postCheckout'
	]);

//Login
Route::get('dang-nhap',[
	'as' => 'dangnhap',
	'uses' => 'PageController@getLogin'
	]);
Route::post('dang-nhap',[
	'as' => 'dangnhap',
	'uses' => 'PageController@postLogin'
	]);

// logout, registry
Route::get('dang-ky',[
	'as' => 'dangky',
	'uses' => 'PageController@getRegistry'
	]);
Route::post('dang-ky',[
	'as' => 'dangky',
	'uses' => 'PageController@postRegistry'
	]);

Route::get('dang-xuat',[
	'as' => 'dangxuat',
	'uses' => 'PageController@getLogout'
	]);


//Search
Route::get('tim-kiem',[
	'as' => 'timkiem',
	'uses' => 'PageController@getSearch'
	]);
