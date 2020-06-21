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

// Группа для маршрутов административной части
Route::group(['prefix'=>'admin', 'namespace'=>'admin', 'middleware'=>['auth']], function() {
    // Подключаем метод dashboard контроллера DashboardController
    // по адресу admin/ , где admin.index - имя маршрута
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    // Подключить ресурсный (CRUD) контроллер CategoryController по адресу admin/category
    // as => admin - добавить префикс для именованого маршрута (чтобы не переплеталось с другими ресурсами)
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::resource('/article', 'ArticleController', ['as'=>'admin']);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
