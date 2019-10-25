<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/redeems'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

  $router->post('/', [
    'as' => $locale . 'api.iredeems.redeems.create',
    'uses' => 'RedeemApiController@create',
    'middleware' => ['auth:api']
  ]);
});
