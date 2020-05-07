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
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');


Route::group(['prefix' => 'admin'], function () {
	Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.home');
	Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
	
});

Route::get('pdf/mealday','pdfController@mealday')->name('pdf.mealday');
	Route::get('pdf/snackday','pdfController@snackday')->name('pdf.snackday');

  
	Route::get('api/meal', 'MealController@apiMeal')->name('api.meal');
	Route::get('meal/addcheck', 'MealController@addcheck')->name('api.mealaddcheck');
	Route::resource('meal', 'MealController');

	Route::get('api/snack', 'SnackController@apiSnack')->name('api.snack');
	Route::get('snack/addcheck', 'SnackController@addcheck')->name('api.snackaddcheck');
	Route::resource('snack', 'SnackController');


	Route::get('api/mealsemua', 'MealSemuaController@apiMealSemua')->name('api.mealsemua')->middleware('admin');
	Route::resource('mealsemua', 'MealSemuaController')->middleware('admin');
	Route::get('exportmealsemua', 'MealSemuaController@mealsemuaExport')->name('mealsemua.export')->middleware('admin');

	Route::get('api/allmeal', 'AllMealController@apiAllMeal')->name('api.allmeal')->middleware('admin');
	Route::resource('allmeal', 'AllMealController')->middleware('admin');
	Route::get('exportmealjumlah', 'AllMealController@mealjumlahExport')->name('mealjumlah.export')->middleware('admin');


	Route::get('api/mealsiang', 'MealSiangController@apiMealSiang')->name('api.mealsiang')->middleware('admin');
	Route::resource('mealsiang', 'MealSiangController')->middleware('admin');
	
	Route::get('api/user', 'UserController@apiUser')->name('api.user')->middleware('admin');
	Route::resource('user', 'UserController')->middleware('admin');
	
	

	Route::get('api/snacksemua', 'SnackSemuaController@apiSnackSemua')->name('api.snacksemua')->middleware('admin');
	Route::resource('snacksemua', 'SnackSemuaController')->middleware('admin');
	Route::get('exportsnacksemua', 'SnackSemuaController@snacksemuaExport')->name('snacksemua.export')->middleware('admin');

	Route::get('api/snackjumlah', 'SnackjumlahController@apisnackJumlah')->name('api.snackjumlah')->middleware('admin');
	Route::resource('snackjumlah', 'SnackjumlahController')->middleware('admin');
	Route::get('exportsnackjumlah', 'SnackjumlahController@snackjumlahExport')->name('snackjumlah.export')->middleware('admin');

	Route::get('api/kegiatan', 'KegiatanController@apiKegiatan')->name('api.kegiatan')->middleware('admin');
	Route::resource('kegiatan', 'KegiatanController')->middleware('admin');

	

	Route::get('api/karyawan', 'KaryawanController@apiKaryawan')->name('api.karyawan')->middleware('admin');
	Route::resource('karyawan', 'KaryawanController')->middleware('admin');

	



