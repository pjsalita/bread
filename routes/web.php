<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'json'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');

        $router->group(['middleware' => 'auth'], function () use ($router) {
            $router->get('customers', 'CustomerController@index');
            $router->get('customers/{id}', 'CustomerController@show');
            $router->patch('customers/{id}', 'CustomerController@update');
            $router->put('customers', 'CustomerController@store');
            $router->delete('customers/{id}', 'CustomerController@destroy');
        });
    });
});
