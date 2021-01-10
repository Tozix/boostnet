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
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');
Route::get('/anywhere', function () {
    return view('services.anywhere');
})->name('anywhere');
Route::get('/bower', function () {
    return view('services.bower');
})->name('bower');

Route::get('/cat', function () {
    return view('catalog.index');
});

//Каталог
Route::get('/catalog', 'CatalogController@index')->name('catalog.index');
Route::get('/catalog/category/{slug}', 'CatalogController@category')->name('catalog.category');
Route::get('/catalog/brand/{slug}', 'CatalogController@brand')->name('catalog.brand');
Route::get('/catalog/product/{slug}', 'CatalogController@product')->name('catalog.product');

//Корзина вазелина
Route::get('/basket/index', 'BasketController@index')->name('basket.index');
Route::get('/basket/checkout', 'BasketController@checkout')->name('basket.checkout');
Route::post('/basket/add/{id}', 'BasketController@add')->where('id', '[0-9]+')->name('basket.add');
Route::post('/basket/plus/{id}', 'BasketController@plus')->where('id', '[0-9]+')->name('basket.plus');
Route::post('/basket/minus/{id}', 'BasketController@minus')->where('id', '[0-9]+')->name('basket.minus');
Route::post('/basket/remove/{id}', 'BasketController@remove')->where('id', '[0-9]+')->name('basket.remove');
Route::post('/basket/clear', 'BasketController@clear')->name('basket.clear');
Route::post('/basket/saveorder', 'BasketController@saveOrder')->name('basket.saveorder');
Route::get('/basket/success', 'BasketController@success')->name('basket.success');


//Контент роуты
Route::get('/speedtest', 'ContentController@ServerList')->name('speedtest');
Route::match(['get', 'post'], '/market/{cat?}/', 'ContentController@Market')->name('market');;
Route::match(['get', 'post'], '/tarifs', 'ContentController@TarifList')->name('tarifs');;

Route::prefix('speedtest')->name('speedtest')->group(function () {
    Route::match(['get', 'post'], 'empty', 'SpeedTestController@emptyResponse')->name('empty');
    Route::match(['get', 'post'], 'garbage', 'SpeedTestController@garbage')->name('garbage');
    Route::match(['get', 'post'], 'getip', 'SpeedTestController@getip')->name('getip');
    Route::match(['get', 'post'], 'result', 'SpeedTestController@result')->name('result');
});

//Route::match(['get', 'post'], '/pdf', 'AdminController@pdf');

Auth::routes();

//Админка каталога
Route::group([
    'as' => 'admin.catalog.', // имя маршрута, например admin.index
    'prefix' => 'admin/catalog', // префикс маршрута, например admin/index
    'namespace' => 'Admin', // пространство имен контроллера
    'middleware' => ['auth', 'check-permission:admin'] // один или несколько посредников
], function () {
    // CRUD-операции над категориями каталога
    Route::resource('category', 'CategoryController');
    // CRUD-операции над брендами каталога
    Route::resource('brand', 'BrandController');
    // CRUD-операции над товарами каталога
    Route::resource('product', 'ProductController');
    // доп.маршрут для просмотра товаров категории
    Route::get('product/category/{category}', 'ProductController@category')
        ->name('product.category');
});

Route::group([
    'as' => 'admin.', // имя маршрута, например admin.index
    'prefix' => 'admin', // префикс маршрута, например admin/index
    'namespace' => 'Admin', // пространство имен контроллера
    'middleware' => ['auth', 'check-permission:admin'] // один или несколько посредников
], function () {
    // главная страница панели управления
    Route::get('index', 'IndexController')->name('index');
});




Route::group(['middleware' => 'auth'], function () {
    /*Админка 
    Route::get('admin', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@index'])->name('admin');
    //Route::get('pdf',['middleware'=>'check-permission:admin','uses'=>'AdminController@pdf'])->name('pdf');
    //Юзьвери
    Route::match(['get', 'post'], '/admin/user/{action?}/{id?}', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@user'])->name('admin_user');
    //Сервера
    Route::match(['get', 'post'], '/admin/server/{action?}/{id?}', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@server'])->name('admin_server');
    //Тарифы
    Route::match(['get', 'post'], '/admin/tarif/{action?}/{id?}', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@tarif'])->name('admin_tarif');
    //Организации
    Route::match(['get', 'post'], '/admin/org/{action?}/{id?}', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@org'])->name('admin_org');
    //Платежи
    Route::get('admin_payments', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@index'])->name('admin_payments');
    //Рассылка
    Route::get('admin_mailing', ['middleware' => 'check-permission:admin', 'uses' => 'AdminController@index'])->name('admin_mailing');
*/

    /* Пользовательские маршруты */
    //Роуты для юр лиц
    Route::get('home_org', ['middleware' => 'check-permission:org_user|admin', 'uses' => 'HomeorgController@index'])->name('home_org');
    Route::match(['get', 'post'], 'tarifs_org', ['middleware' => 'check-permission:org_user|admin', 'uses' => 'HomeorgController@ChangeTarif'])->name('tarifs_org');

    //Роуты для физ лиц
    Route::get('home', ['middleware' => 'check-permission:user|admin', 'uses' => 'HomeController@index'])->name('home');
    Route::match(['get', 'post'], 'u_tarifs', ['middleware' => 'check-permission:user|admin', 'uses' => 'HomeController@ChangeTarif'])->name('u_tarifs');
    Route::match(['get', 'post'], 'payment', ['middleware' => 'check-permission:user|admin', 'uses' => 'HomeController@showPayForm'])->name('payment');
});
Route::get('/home', 'HomeController@index')->name('home');
