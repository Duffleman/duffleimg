<?php

$app->get('/', function () use ($app) { return view('upload'); });
$app->post('/', 'UploadController@handle');
$app->get('{hash}', 'MainController@index');
