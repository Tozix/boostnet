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


//Маршруты оплаты
//Route::match(['get', 'post'], '/pay_success', 'PayController@successPay');
//Route::match(['get', 'post'], '/pay_fail', 'PayController@failPay');
//Route::match(['get', 'post'], '/pay_result', 'PayController@resultPay');


Route::name('user.')->prefix('user')->group(function () {
    // регистрация, вход в ЛК, восстановление пароля
    Auth::routes();
});
//Профайл
Route::group([
    'as' => 'user.', // имя маршрута, например user.index
    'prefix' => 'user', // префикс маршрута, например user/index
    'middleware' => ['auth'] // один или несколько посредников
], function () {
    // главная страница личного кабинета пользователя
    Route::get('index', 'HomeController@index')->name('index');
    // CRUD-операции над профилями пользователя
    Route::resource('profile', 'ProfileController');
    // просмотр списка заказов в личном кабинете
    Route::get('order', 'OrderController@index')->name('order.index');
    // просмотр отдельного заказа в личном кабинете
    Route::get('order/{order}', 'OrderController@show')->name('order.show');
});


Route::get('/roles', 'PermissionController@Permission');
//Каталог
Route::get('/catalog/index', 'CatalogController@index')->name('catalog.index');
Route::get('/catalog/category/{category:slug}', 'CatalogController@category')->name('catalog.category');
Route::get('/catalog/brand/{brand:slug}', 'CatalogController@brand')->name('catalog.brand');
Route::get('/catalog/product/{product:slug}', 'CatalogController@product')->name('catalog.product');

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
Route::post('/basket/profile', 'BasketController@profile')->name('basket.profile');


//Контент роуты
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


//Статичные страницы
Route::get('/page/{page:slug}', 'PageController')->name('page.show');

//Speedtest
Route::get('/speedtest', 'ContentController@ServerList')->name('speedtest');
Route::match(['get', 'post'], '/tarifs', 'ContentController@TarifList')->name('tarifs');;

Route::prefix('speedtest')->name('speedtest')->group(function () {
    Route::match(['get', 'post'], 'empty', 'SpeedTestController@emptyResponse')->name('empty');
    Route::match(['get', 'post'], 'garbage', 'SpeedTestController@garbage')->name('garbage');
    Route::match(['get', 'post'], 'getip', 'SpeedTestController@getip')->name('getip');
    Route::match(['get', 'post'], 'result', 'SpeedTestController@result')->name('result');
});


//Домашка
Route::match(['get', 'post'], 'payment', ['middleware' => 'check-permission:user|admin', 'uses' => 'HomeController@showPayForm'])->name('payment');
Route::get('/home', 'HomeController@index')->name('home');




//Админка каталога
Route::group([
    'as' => 'admin.catalog.', // имя маршрута, например admin.index
    'prefix' => 'admin/catalog', // префикс маршрута, например admin/index
    'namespace' => 'Admin', // пространство имен контроллера
    'middleware' => 'auth' // один или несколько посредников
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
    // просмотр и редактирование заказов
    Route::resource('order', 'OrderController', ['except' => [
        'create', 'store', 'destroy'
    ]]);
});
//Админка
Route::group([
    'as' => 'admin.', // имя маршрута, например admin.index
    'prefix' => 'admin', // префикс маршрута, например admin/index
    'namespace' => 'Admin', // пространство имен контроллера
    'middleware' => 'auth' // один или несколько посредников
], function () {
    // главная страница панели управления
    Route::get('index', 'IndexController')->name('index');
    // просмотр и редактирование пользователей
    Route::resource('user', 'UserController', ['except' => [
        'create', 'store', 'show', 'destroy'
    ]]);
    // CRUD-операции над страницами сайта
    Route::resource('page', 'PageController');
    // загрузка изображения из редактора
    Route::post('page/upload/image', 'PageController@uploadImage')
        ->name('page.upload.image');
    // удаление изображения в редакторе
    Route::delete('page/remove/image', 'PageController@removeImage')
        ->name('page.remove.image');
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
