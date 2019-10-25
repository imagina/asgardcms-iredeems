<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/redeems'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

  $router->post('/', [
    'as' => $locale . 'api.iredeems.redeems.create',
    'uses' => 'RedeemApiController@create',
    //'middleware' => ['auth:api']
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iredeems.redeems.index',
    'uses' => 'RedeemApiController@index'
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iredeems.redeems.update',
    'uses' => 'RedeemApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iredeems.redeems.delete',
    'uses' => 'RedeemApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iredeems.redeems.show',
    'uses' => 'RedeemApiController@show',
  ]);

});
