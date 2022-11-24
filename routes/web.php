<?php

use Illuminate\Support\Facades\Auth;
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


/*

Route::get('teste', function (){
//    dd(\App\Models\Client::first());
    $client = \App\Models\Client::first();
    $token = $client->createToken('token-teste');
    dd($token->plainTextToken);
});

*/

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function (){


        /**
         * Rota para debugar
         */
//         Route::get('test-ACL', function (){
//             dd(auth()->user()->isAdmin());
//         });


        /**
         * Role x User
         */
        Route::get('users/{id}/role/{idRole}/dettach','ACL\RoleUserController@rolesUserDettach')->name('roles.users.dettach');
        Route::post('users/{id}/roles/store','ACL\RoleUserController@rolesUserAttach')->name('roles.users.attach');
        Route::any('users/{id}/roles/create','ACL\RoleUserController@rolesUserCreate')->name('roles.users.create');
        Route::get('roles/{id}/user','ACL\RoleUserController@rolesUser')->name('roles.user');
        Route::get('users/{id}/role','ACL\RoleUserController@usersRole')->name('users.role');


        /**
         * Permission x Role
         */
        Route::get('roles/{id}/permission/{idPermission}/dettach','ACL\PermissionRoleController@PermissionsRoleDettach')->name('permissions.roles.dettach');
        Route::post('roles/{id}/permissions/store','ACL\PermissionRoleController@PermissionsRoleAttach')->name('permissions.roles.attach');
        // Route::any('roles/{id}/permissions/search','ACL\PermissionRoleController@PermissionsProfileSearch')->name('permissions.roles.search');
        Route::any('roles/{id}/permissions/create','ACL\PermissionRoleController@PermissionsRoleCreate')->name('permissions.roles.create');
        Route::get('permissions/{id}/role','ACL\PermissionRoleController@PermissionsRole')->name('permissions.role');
        Route::get('roles/{id}/permission','ACL\PermissionRoleController@rolesPermission')->name('roles.permission');


        /**
         * Routes Roles
         */
        Route::any('roles/search','ACL\RoleController@search')->name('roles.search');
        Route::resource('roles', 'ACL\RoleController');


        /**
         * Routes Tenants
         */
        Route::any('tenants/search','TenantController@search')->name('tenants.search');
        Route::resource('tenants', 'TenantController');



        /**
         * Routes Tables
         */
//        Route::get('tables/qrcode/{identify}','TableController@qrcode')->name('tables.qrcode');
        Route::get('tables/qrcode/{identify}','TableController@qrcode')->name('tables.qrcode');
        Route::any('tables/search','TableController@search')->name('tables.search');
        Route::resource('tables', 'TableController');

        /**
         * Category x Product
         */
        Route::get('products/{id}/category/{idCategory}/dettach','CategoryProductController@categoriesProductDettach')->name('categories.products.dettach');
        Route::post('products/{id}/categories/store','CategoryProductController@categoriesProductAttach')->name('categories.products.attach');
        // Route::any('products/{id}/categories/search','CategoryProductController@PermissionsProfileSearch')->name('categories.products.search');
        Route::any('products/{id}/categories/create','CategoryProductController@categoriesProductCreate')->name('categories.products.create');
        Route::get('categories/{id}/product','CategoryProductController@categoriesProduct')->name('categories.product');
        Route::get('products/{id}/category','CategoryProductController@productsCategory')->name('products.category');


        /**
         * Routes Products
         */
        Route::any('products/search','ProductController@search')->name('products.search');
        Route::resource('products', 'ProductController');


        /**
         * Routes Categories
         */
        Route::any('categories/search','CategoryController@search')->name('categories.search');
        Route::resource('categories', 'CategoryController');

        /**
         * Routes Users
         */
        Route::any('users/search','UserController@search')->name('users.search');
        Route::resource('users', 'UserController');

        /**
         * Plan x Profile
         */
        Route::get('plan/{id}/profile/{idProfile}/dettach','ACL\ProfilePlanController@profilesPlanDettach')->name('profiles.plan.dettach');
        Route::post('plan/{id}/profiles/store','ACL\ProfilePlanController@profilesPlanAttach')->name('profiles.plan.attach');
        Route::any('plan/{id}/profiles/create','ACL\ProfilePlanController@profilesPlanCreate')->name('profiles.plan.create');
        Route::get('profiles/{id}/profile','ACL\ProfilePlanController@permissionsProfile')->name('profiles.profile');
        Route::get('plan/{id}/profiles','ACL\ProfilePlanController@profilesPlan')->name('profiles.plan');


        /**
         * Permission x Profile
         */
        Route::get('profiles/{id}/permission/{idPermission}/dettach','ACL\PermissionProfileController@PermissionsProfileDettach')->name('permissions.profiles.dettach');
        Route::post('profiles/{id}/permissions/store','ACL\PermissionProfileController@PermissionsProfileAttach')->name('permissions.profiles.attach');
        // Route::any('profiles/{id}/permissions/search','ACL\PermissionProfileController@PermissionsProfileSearch')->name('permissions.profiles.search');
        Route::any('profiles/{id}/permissions/create','ACL\PermissionProfileController@PermissionsProfileCreate')->name('permissions.profiles.create');
        Route::get('permissions/{id}/profile','ACL\PermissionProfileController@permissionsProfile')->name('permissions.profile');
        Route::get('profiles/{id}/permission','ACL\PermissionProfileController@profilesPermission')->name('profiles.permission');

        /**
         * Routes Permissions
         */
        Route::any('permissions/search','ACL\PermissionController@search')->name('permissions.search');
        Route::resource('permissions', 'ACL\PermissionController');


        /**
         * Routes Profiles
         */
        Route::any('profiles/search','ACL\ProfileController@search')->name('profiles.search');
        Route::resource('profiles', 'ACL\ProfileController');


        /**
         * Routes Details Plan
         */
        Route::delete('plan/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
        Route::get('plan/{url}/details/{idDetail}/show', 'DetailPlanController@show')->name('details.plan.show');
        Route::put('plan/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
        Route::get('plan/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
        Route::post('plan/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
        Route::get('plan/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
        Route::get('plan/{url}/details', 'DetailPlanController@index')->name('details.plan.index');




        /**
         * Routes Plan
         */
        Route::get('plans/create', 'PlanController@create')->name('plans.create');
        Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
        Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
        Route::any('plans/search', 'PlanController@search')->name('plans.search');
        Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
        Route::post('plans', 'PlanController@store')->name('plans.store');
        Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
        Route::get('plans', 'PlanController@index')->name('plans.index');

        /**
         * Route Dashboard
         */
        Route::get('/', 'PlanController@index')->name('admin.index');



});

/**
 * Route Site
 */
Route::get('/', 'Site\SiteController@index')->name('site.home');
Route::get('/plan/{url}','Site\SiteController@plan')->name('plan.subscription');


//Route::get('/', function () {
//    return view('site.page.home.index');
//});

/**
 * Route Auth
 */
Auth::routes();
//Auth::routes(['register' =>false]); Desativar o formulario de registro de usuario no laravel auth

//Route::get('/home', 'HomeController@index')->name('home');
