<?php

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

$app->get('/', function () use ($app) {
    return "Post views counter for Hexo created by @printempw. Built on {$app->version()}.";
});

$app->get('/get/{slug}', 'PostViewController@get');

$app->get('/popular-posts', 'PopularPostsController@getSlugs');

$app->group(['middleware' => 'throttle:'.env('RATE_LIMIT').',1'], function () use ($app) {
    $app->post('/increase/{slug}', 'PostViewController@increase');
});
