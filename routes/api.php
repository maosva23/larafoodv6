<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::get('/tenants/{uuid}', 'Api\TenantApicontroller@show');
Route::get('/tenants', 'Api\TenantApicontroller@index');

Route::get('/categories/{url}', 'Api\CategoryApiController@show');
Route::get('/categories', 'Api\CategoryApiController@categoriesByTenant');

Route::get('/tables/{uuid}', 'Api\TableApiController@show');
Route::get('/tables', 'Api\TableApiController@tablesByTenant');

Route::get('/product/{url}', 'Api\ProductApiController@show');
Route::get('/products', 'Api\ProductApiController@productsByTenant');
*/


/*Cria o token para o cliente*/
Route::post('sanctum/token', 'Api\Auth\AuthClientController@auth');

/*Rotas com função de callback*/
Route::group([
    'middleware' => ['auth:sanctum']
], function (){
    Route::get('/auth/me', 'Api\Auth\AuthClientController@me');
    Route::post('/auth/logout', 'Api\Auth\AuthClientController@logout');
    Route::get('/auth/v1/my-orders', 'Api\OrderApiController@myOrders');
    Route::post('/auth/v1/orders', 'Api\OrderApiController@store'); //Pedido com autenticação

    Route::post('auth/v1/orders/{identifyOrder}/evaluations', 'Api\EvaluationApiController@store');


});



/**
 * VERSIONAMENTO DA API
 * Apenas adicionammos um prefixo 'prefix' => 'v1' como se pode verificar a seguir
 */
Route::prefix('v1')
    ->namespace('Api')
//    ->middleware('auth')
    ->group(function (){

        Route::get('/tenants/{uuid}', 'TenantApicontroller@show');
        Route::get('/tenants', 'TenantApicontroller@index');

        Route::get('/categories/{identify}', 'CategoryApiController@show');
        Route::get('/categories', 'CategoryApiController@categoriesByTenant');

        Route::get('/tables/{identify}', 'TableApiController@show');
        Route::get('/tables', 'TableApiController@tablesByTenant');

        Route::get('/product/{identify}', 'ProductApiController@show');
        Route::get('/products', 'ProductApiController@productsByTenant');

        Route::post('/client', 'Auth\RegisterController@store');//Cadastra um novo cliente


        Route::post('/orders', 'OrderApiController@store');//Cria um novo pedido
        Route::get('/orders/{identify}', 'OrderApiController@show'); //Recupera um pedido pelo identificador


});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
