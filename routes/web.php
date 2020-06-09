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




Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/openvpn', function () {
    return view('home.openvpn');
})->name('openvpn');



Route::get('/getconfig/{file}', 'HomeController@download')->middleware('auth');;

Route::match(['get', 'post'], '/pay_success', 'PayController@successPay');
Route::match(['get', 'post'], '/pay_fail', 'PayController@failPay');
Route::match(['get', 'post'], '/pay_result', 'PayController@resultPay');



Route::get('/vpn', function () {
    return view('services.openvpn');
})->name('vpn');
Route::get('/ptarifs', function () {
    return view('ptarifs');
})->name('ptarifs');
Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');
Route::get('/anywhere', function () {
    return view('services.anywhere');
})->name('anywhere');
Route::get('/bower', function () {
    return view('services.bower');
})->name('bower');

//Контент роуты
Route::get('/', 'ContentController@ServerList');
Route::match(['get', 'post'], '/tarifs', 'ContentController@TarifList')->name('tarifs');;

Route::prefix('speedtest')->name('speedtest')->group(function () {
    Route::match(['get', 'post'], 'empty', 'SpeedTestController@emptyResponse')->name('empty');
    Route::match(['get', 'post'], 'garbage', 'SpeedTestController@garbage')->name('garbage');
    Route::match(['get', 'post'], 'getip', 'SpeedTestController@getip')->name('getip');
    Route::match(['get', 'post'], 'result', 'SpeedTestController@result')->name('result');
});
Route::match(['get', 'post'], '/pdf', 'AdminController@pdf');


Auth::routes();

Route::group(['middleware'=>'auth'], function () {
                                                        /*Админка */
    Route::get('admin',['middleware'=>'check-permission:admin','uses'=>'AdminController@index'])->name('admin');
    //Route::get('pdf',['middleware'=>'check-permission:admin','uses'=>'AdminController@pdf'])->name('pdf');
    //Юзьвери
    Route::match(['get', 'post'],'/admin/user/{action?}/{id?}',['middleware'=>'check-permission:admin','uses'=>'AdminController@user'])->name('admin_user');
    //Сервера
    Route::match(['get', 'post'],'/admin/server/{action?}/{id?}',['middleware'=>'check-permission:admin','uses'=>'AdminController@server'])->name('admin_server');
    //Тарифы
    Route::match(['get', 'post'],'/admin/tarif/{action?}/{id?}',['middleware'=>'check-permission:admin','uses'=>'AdminController@tarif'])->name('admin_tarif');
    //Организации
    Route::match(['get', 'post'],'/admin/org/{action?}/{id?}',['middleware'=>'check-permission:admin','uses'=>'AdminController@org'])->name('admin_org');
    //Платежи
    Route::get('admin_payments',['middleware'=>'check-permission:admin','uses'=>'AdminController@index'])->name('admin_payments');
    //Рассылка
    Route::get('admin_mailing',['middleware'=>'check-permission:admin','uses'=>'AdminController@index'])->name('admin_mailing');
    

                                                        /* Пользовательские маршруты */
    //Роуты для юр лиц
    Route::get('home_org',['middleware'=>'check-permission:org_user|admin','uses'=>'HomeorgController@index'])->name('home_org');
    Route::match(['get', 'post'], 'tarifs_org',['middleware'=>'check-permission:org_user|admin','uses'=>'HomeorgController@ChangeTarif'])->name('tarifs_org');
    
	//Роуты для физ лиц
    Route::get('home',['middleware'=>'check-permission:user|admin','uses'=>'HomeController@index'])->name('home');
    Route::match(['get', 'post'], 'u_tarifs',['middleware'=>'check-permission:user|admin','uses'=>'HomeController@ChangeTarif'])->name('u_tarifs');
    Route::match(['get', 'post'], 'payment',['middleware'=>'check-permission:user|admin','uses'=>'HomeController@showPayForm'])->name('payment');
    
	
});
//Route::get('/home', 'HomeController@index')->name('home');
