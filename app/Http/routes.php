<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return response()->json([
        'message' => 'Hello World!'
    ]);
});

$app->post('/', 'UploadController@handle');

$app->get('/{hash}', 'MainController@index');