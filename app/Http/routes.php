<?php

$app->get('/', function () use ($app) {
    return response()->json([
        'message' => 'Hello World!'
    ]);
});

$app->post('/', 'UploadController@handle');
$app->get('{hash}', 'MainController@index');
