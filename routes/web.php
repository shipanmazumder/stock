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

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']],function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/password-change', 'PasswordController@index')->name('password_change');
    Route::post('/password-change', 'PasswordController@changePassword');
    Route::get('/supplier', 'SupplierController@index')->name("supplier");
    Route::post('/supplier', 'SupplierController@store');
    Route::get('/supplier/edit/{supplier_id}', 'SupplierController@edit');
    Route::get('/supplier/delete/{supplier_id}', 'SupplierController@delete');
    Route::get('/supplier-control/{supplier_id}', 'SupplierController@control');

    Route::get('/category', 'CategoryController@index')->name("category");
    Route::post('/category', 'CategoryController@store');
    Route::get('/category/edit/{category_id}', 'CategoryController@edit');
    Route::get('/category/delete/{category_id}', 'CategoryController@delete');
    Route::get('/category-control/{category_id}', 'CategoryController@control');
    Route::get('/product', 'ProductController@index')->name("product");
    Route::post('/product', 'ProductController@store');
    Route::get('/product/edit/{product_id}', 'ProductController@edit');
    Route::get('/product/delete/{product_id}', 'ProductController@delete');
    Route::get('/product-control/{product_id}', 'ProductController@control');

    Route::get('/store', 'StoreController@index')->name("store");
    Route::get('/store/product-desc', 'StoreController@product_desc')->name("product_desc");
    Route::post('/store', 'StoreController@add');
    Route::get('/store-view', 'StoreController@view')->name("store/view");
});
Route::group(['middleware'=>['auth'],'namespace'=>'Permission'],function() {

    Route::get('/role-permission', 'RoleController@index')->name("role");
    Route::post('/role', 'RoleController@store');
    Route::get('/role/edit/{role_id}', 'RoleController@edit');
    Route::get('/role/delete/{role_id}', 'RoleController@delete');
    Route::get('/assign-permission/{role_id}', 'RoleController@assignPermission');
    Route::post('/assign-permission/{role_id}', 'RoleController@assignPermission');

    Route::get('/module', 'ModuleController@index')->name("module");
    Route::post('/module/add_parent', 'ModuleController@add_parent');
    Route::get('/module/get_subparent', 'ModuleController@get_subparent');
    Route::post('/module/add', 'ModuleController@add');
    Route::post('/module/control', 'ModuleController@control');
    Route::get('/module/edit/{id?}/{cat_id?}/{msg?}', 'ModuleController@edit');
    Route::post('/module/edit/{id?}/{cat_id?}/{msg?}', 'ModuleController@edit');
    Route::get('/module/delete/{id?}/{cat_id?}/{msg?}', 'ModuleController@delete');
    Route::post('/module/moduleUpdate/', 'ModuleController@moduleUpdate');

    Route::get('/users', 'UserController@index')->name("users");
    Route::get('/users/view', 'UserController@view');
    Route::post('/users', 'UserController@add');
    Route::get('/user/control/{user_id}', 'UserController@control');
    Route::get('/user/user-edit/{user_id}', 'UserController@userEdit');
    Route::post('/user/edit/{user_id}', 'UserController@userUpdate');
    Route::get('/user/delete/{user_id}', 'UserController@delete');
});
