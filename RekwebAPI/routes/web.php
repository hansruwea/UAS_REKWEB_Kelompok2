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

$router->group(['middleware' => 'basicAuth'], function () use ($router) {
    $router->get('/detail/{id}', 'ControllerDataMahasiswa@detail');
    $router->post('/datamahasiswa','ControllerDataMahasiswa@create');
    $router->get('/datamahasiswa','ControllerDataMahasiswa@index');
    $router->put('/update/{id}','ControllerDataMahasiswa@update');
    $router->delete('/delete/{id}', 'ControllerDataMahasiswa@delete');

});