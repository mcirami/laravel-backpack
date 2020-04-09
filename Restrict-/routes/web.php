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

// Admin Interface Routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin,access_backend']], function() {
    CRUD::resource('permission', 'Permission\PermissionCrudController');
    CRUD::resource('role', 'Permission\RoleCrudController');
    CRUD::resource('user', 'Permission\UserCrudController');
});
