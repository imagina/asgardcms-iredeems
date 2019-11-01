<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/points'], function (Router $router) {
  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();

  $router->post('/', [
    'as' => $locale . 'api.iredeems.points.create',
    'uses' => 'PointApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.iredeems.points.index',
    'uses' => 'PointApiController@index'
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.iredeems.points.update',
    'uses' => 'PointApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => $locale . 'api.iredeems.points.delete',
    'uses' => 'PointApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.iredeems.points.show',
    'uses' => 'PointApiController@show',
  ]);
  
  $router->get('calculates/user', [
    'as' => $locale . 'api.iredeems.calculates.user',
    'uses' => 'PointApiController@calculates',
  ]);

});
