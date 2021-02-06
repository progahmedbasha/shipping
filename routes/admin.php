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

// Note That The Prefix [admin] For All Routes In This File

Route::prefix('admin')->group(function()
{
    Route::middleware('auth:admin')->namespace('Admin')->group(function()
{
    Route::get('Dashboard','DashboardController@index')->name('Dashboard');
    Route::get('logout','LoginController@logout')->name('admin.logout');

    
    Route::get('/test','DashboardController@test')->name('test');

    // ************************************** START ADMIN ROUTES ************************
    Route::prefix('admins')->group(function()
    {
        Route::get('/','adminsController@index')->name('admins.index');
        Route::post('/store','adminsController@store')->name('admins.store');
        Route::PUT('/update','adminsController@update')->name('admins.update');
        Route::post('/destroy','adminsController@destroy')->name('admins.destroy');
    });
    // ************************************** END ADMIN ROUTES ************************
    // ************************************** START SERVANTS ROUTES ************************
    Route::prefix('servants')->group(function()
    {
        Route::get('/','ServantsController@index')->name('servants.index');
        Route::post('/store','ServantsController@store')->name('servants.store');
        Route::get('/edit/{id}','ServantsController@edit')->name('servants.edit');
        Route::post('/update/{id}','ServantsController@update')->name('servants.update');
        Route::post('/destroy','ServantsController@destroy')->name('servants.destroy');
        Route::get('/getSoftDelete','ServantsController@getSoftDelete')->name('servants.getSoftDelete');
        Route::get('/restore','ServantsController@restore')->name('servants.restore');
    });
    // ************************************** END SERVANTS ROUTES ************************
    // ************************************** START ORDER STATUS ROUTES ************************
    Route::prefix('status')->group(function()
    {
        Route::get('/','StatusController@index')->name('status.index');
        Route::post('/store','StatusController@store')->name('status.store');
        Route::get('/edit/{id}','StatusController@edit')->name('status.edit');
        Route::post('/update/{id}','StatusController@update')->name('status.update');
        Route::post('/destroy','StatusController@destroy')->name('status.destroy');
        Route::get('/getSoftDelete','StatusController@getSoftDelete')->name('status.getSoftDelete');
        Route::get('/restore','StatusController@restore')->name('status.restore');
    });
    // ************************************** END ORDER STATUS ROUTES ************************
    // ************************************** START GOVERNORATES ROUTES ************************
    Route::prefix('governorates')->group(function()
    {
        Route::get('/','governoratesController@index')->name('governorates.index');
        Route::post('/store','governoratesController@store')->name('governorates.store');
        Route::get('/edit/{id}','governoratesController@edit')->name('governorates.edit');
        Route::post('/update/{id}','governoratesController@update')->name('governorates.update');
        Route::post('/destroy','governoratesController@destroy')->name('governorates.destroy');
        Route::get('/getSoftDelete','governoratesController@getSoftDelete')->name('governorates.getSoftDelete');
        Route::get('/restore','governoratesController@restore')->name('governorates.restore');
    });
    // ************************************** END GOVERNORATES ROUTES ************************
    // ************************************** START CITIES ROUTES ************************
    Route::prefix('cities')->group(function()
    {
        Route::get('/','CitiesController@index')->name('cities.index');
        Route::post('/store','CitiesController@store')->name('cities.store');
        Route::get('/edit/{id}','CitiesController@edit')->name('cities.edit');
        Route::post('/update/{id}','CitiesController@update')->name('cities.update');
        Route::post('/destroy','CitiesController@destroy')->name('cities.destroy');
        Route::get('/getSoftDelete','CitiesController@getSoftDelete')->name('cities.getSoftDelete');
        Route::get('/restore','CitiesController@restore')->name('cities.restore');
    });
    // ************************************** END CITIES ROUTES ************************
    // ************************************** START SUPPLIERS ROUTES ************************
    Route::prefix('suppliers')->group(function()
    {
        Route::get('/','SuppliersController@index')->name('suppliers.index');
        Route::get('cities/{id}','SuppliersController@cities')->name('Cities');
        Route::post('/store','SuppliersController@store')->name('suppliers.store');
        Route::get('/edit/{id}','SuppliersController@edit')->name('suppliers.edit');
        Route::post('/update/{id}','SuppliersController@update')->name('suppliers.update');
        Route::post('/destroy','SuppliersController@destroy')->name('suppliers.destroy');
        Route::get('/getSoftDelete','SuppliersController@getSoftDelete')->name('suppliers.getSoftDelete');
        Route::get('/restore','SuppliersController@restore')->name('suppliers.restore');
    });
    // ************************************** END SUPPLIERS ROUTES ************************
    // ************************************** START PRODUCTS ROUTES ************************
    Route::prefix('products')->group(function()
    {
        Route::get('/','ProductsController@index')->name('products.index');
        Route::get('cities/{id}','ProductsController@cities')->name('Cities');
        Route::get('show/{id}','ProductsController@show')->name('products.show');
        Route::post('/store','ProductsController@store')->name('products.store');
        Route::get('/edit/{id}','ProductsController@edit')->name('products.edit');
        Route::post('/update/{id}','ProductsController@update')->name('products.update');
        Route::post('/destroy','ProductsController@destroy')->name('products.destroy');
        Route::get('/getSoftDelete','ProductsController@getSoftDelete')->name('products.getSoftDelete');
        Route::get('/restore','ProductsController@restore')->name('products.restore');
    });
    // ************************************** END PRODUCTS ROUTES ************************
    // ************************************** START ORDER DETAILES ROUTES ************************
    Route::prefix('orderDetailes')->group(function()
    {        
        Route::get('/create','orderDetailesController@create')->name('orderDetailes.create');
        Route::get('cities/{id}','orderDetailesController@cities')->name('Cities');
        Route::post('search/','orderDetailesController@search')->name('orderDetailes.search');
        Route::post('forceDelete/{id}','orderDetailesController@forceDelete')->name('orderDetailes.forceDelete');  // DELETE ITEMS FROM ORDER DETAILES TABLE IF I DON,T CREATED NEW ORDER 
        Route::post('addToCart/','orderDetailesController@addToCart')->name('orderDetailes.addToCart');
        Route::get('submit_new_order/','orderDetailesController@submit_new_order')->name('orderDetailes.submit_new_order');
        Route::post('changeStatus/','orderDetailesController@changeStatus')->name('orderDetailes.changeStatus');
        Route::post('changeShippingPrice/','orderDetailesController@changeShippingPrice')->name('orderDetailes.changeShippingPrice');
    });
    // ************************************** END ORDER DETAILES ROUTES ************************
// ************************************** START ORDERS  ROUTES ************************
Route::prefix('orders')->group(function()
{        
    Route::get('index','ordersController@index')->name('orders.index');
    Route::post('store','ordersController@store')->name('orders.store');
    Route::get('edit/{id}','ordersController@edit')->name('orders.edit');
    Route::post('update/{id}','ordersController@update')->name('orders.update');
    Route::get('show/{id}','ordersController@show')->name('orders.show');
    Route::post('changeStatus','ordersController@changeStatusItems')->name('orders.changeStatus');
    Route::get('softDelete','ordersController@softDelete')->name('orders.softDelete');
    Route::get('restore','ordersController@restore')->name('orders.restore');
});
// ************************************** END ORDERS ROUTES ************************
// ************************************** START RETURNS  ROUTES ************************
Route::prefix('returns')->group(function()
{        
    Route::get('index','ReturnsController@index')->name('returns.index');
    Route::get('create','ReturnsController@create')->name('returns.create');
    Route::post('search/','ReturnsController@search')->name('returns.search');
    Route::post('addToCart/','ReturnsController@addToCart')->name('returns.addToCart');
    Route::get('submit_new_order','ReturnsController@submit_new_order')->name('returns.submit_new_order');
    Route::post('changeShippingPrice/','ReturnsController@changeShippingPrice')->name('returns.changeShippingPrice');
    Route::post('changeStatus/','ReturnsController@changeStatus')->name('returns.changeStatus');
    Route::post('store','ReturnsController@store')->name('returns.store');
    Route::post('changeStatusItems','ReturnsController@changeStatusItems')->name('returns.changeStatusItems');

    Route::get('edit/{id}','ReturnsController@edit')->name('returns.edit');
    Route::post('update/{id}','ReturnsController@update')->name('returns.update');
    Route::get('softDelete','ReturnsController@softDelete')->name('returns.softDelete');
    Route::get('restore','ReturnsController@restore')->name('returns.restore');
});
// ************************************** END RETURNS ROUTES ************************
    // ************************************** START REBORTS ROUTES ************************

    Route::prefix('reborts')->group(function()
    {        
        Route::get('index','RebortesController@index')->name('reborts.index');
        Route::post('/add/day','RebortesController@setday');
        Route::post('/add/day1','RebortesController@oneday');
        Route::get('servantindex','RebortesController@servantindex')->name('reborts.servantindex');
        Route::post('/add/day1','RebortesController@servantname');

        // Route::post('/add/test1','RebortesController@oneservdate');
        Route::post('/add/test','RebortesController@oneservday');
    });

    // ************************************** END REBORTS ROUTES ************************


});


Route::namespace('Admin')->middleware('guest:admin')->group(function()
    {
        Route::get('/login','LoginController@loginForm')->name('admin.login'); 
        Route::post('/makelogin','LoginController@login')->name('admin.MakeLogin'); 
    });
});







