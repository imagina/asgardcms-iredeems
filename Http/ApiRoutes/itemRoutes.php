<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/items'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

  // $router->post('/', [
  //   'as' => $locale . 'api.iredeems.users.create',
  //   'uses' => 'ItemApiController@create',
  //   'middleware' => ['auth:api']
  // ]);
  $router->get('/', [
    'as' => $locale . 'api.iredeems.items.index',
    'uses' => 'ItemApiController@index',
    // 'middleware' => ['auth:api']
  ]);
  // $router->put('change-password', [
  //   'as' => $locale .'api.iredeems.change.password',
  //   'uses' => 'ItemApiController@changePassword',
  //   //'middleware' => ['auth:api']
  // ]);
  // $router->put('/{criteria}', [
  //   'as' => $locale . 'api.iredeems.users.update',
  //   'uses' => 'ItemApiController@update',
  //   'middleware' => ['auth:api']
  // ]);
  // $router->delete('/{criteria}', [
  //   'as' => $locale . 'api.iredeems.users.delete',
  //   'uses' => 'ItemApiController@delete',
  //   'middleware' => ['auth:api']
  // ]);
  // $router->get('/{criteria}', [
  //   'as' => $locale . 'api.iredeems.users.show',
  //   'uses' => 'ItemApiController@show',
  //   'middleware' => ['auth:api']
  // ]);
});
