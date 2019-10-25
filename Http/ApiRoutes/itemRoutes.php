<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/items'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

  $router->post('/', [
    'as' => $locale . 'api.iredeems.items.create',
    'uses' => 'ItemApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iredeems.items.index',
    'uses' => 'ItemApiController@index'
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iredeems.items.update',
    'uses' => 'ItemApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iredeems.items.delete',
    'uses' => 'ItemApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iredeems.items.show',
    'uses' => 'ItemApiController@show',
  ]);
  

});
