<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/iredeems'], function (Router $router) {
    $router->bind('item', function ($id) {
        return app('Modules\Iredeems\Repositories\ItemRepository')->find($id);
    });
    $router->get('items', [
        'as' => 'admin.iredeems.item.index',
        'uses' => 'ItemController@index',
        'middleware' => 'can:iredeems.items.index'
    ]);
    $router->get('items/create', [
        'as' => 'admin.iredeems.item.create',
        'uses' => 'ItemController@create',
        'middleware' => 'can:iredeems.items.create'
    ]);
    $router->post('items', [
        'as' => 'admin.iredeems.item.store',
        'uses' => 'ItemController@store',
        'middleware' => 'can:iredeems.items.create'
    ]);
    $router->get('items/{item}/edit', [
        'as' => 'admin.iredeems.item.edit',
        'uses' => 'ItemController@edit',
        'middleware' => 'can:iredeems.items.edit'
    ]);
    $router->put('items/{item}', [
        'as' => 'admin.iredeems.item.update',
        'uses' => 'ItemController@update',
        'middleware' => 'can:iredeems.items.edit'
    ]);
    $router->delete('items/{item}', [
        'as' => 'admin.iredeems.item.destroy',
        'uses' => 'ItemController@destroy',
        'middleware' => 'can:iredeems.items.destroy'
    ]);
    $router->bind('redeem', function ($id) {
        return app('Modules\Iredeems\Repositories\RedeemRepository')->find($id);
    });
    $router->get('redeems', [
        'as' => 'admin.iredeems.redeem.index',
        'uses' => 'RedeemController@index',
        'middleware' => 'can:iredeems.redeems.index'
    ]);
    $router->get('redeems/create', [
        'as' => 'admin.iredeems.redeem.create',
        'uses' => 'RedeemController@create',
        'middleware' => 'can:iredeems.redeems.create'
    ]);
    $router->post('redeems', [
        'as' => 'admin.iredeems.redeem.store',
        'uses' => 'RedeemController@store',
        'middleware' => 'can:iredeems.redeems.create'
    ]);
    $router->get('redeems/{redeem}/edit', [
        'as' => 'admin.iredeems.redeem.edit',
        'uses' => 'RedeemController@edit',
        'middleware' => 'can:iredeems.redeems.edit'
    ]);
    $router->put('redeems/{redeem}', [
        'as' => 'admin.iredeems.redeem.update',
        'uses' => 'RedeemController@update',
        'middleware' => 'can:iredeems.redeems.edit'
    ]);
    $router->delete('redeems/{redeem}', [
        'as' => 'admin.iredeems.redeem.destroy',
        'uses' => 'RedeemController@destroy',
        'middleware' => 'can:iredeems.redeems.destroy'
    ]);

    $router->bind('pointhistory', function ($id) {
        return app('Modules\Iredeems\Repositories\PointHistoryRepository')->find($id);
    });
    $router->get('pointhistories', [
        'as' => 'admin.iredeems.pointhistory.index',
        'uses' => 'PointHistoryController@index',
        'middleware' => 'can:iredeems.pointhistories.index'
    ]);
    $router->get('pointhistories/create', [
        'as' => 'admin.iredeems.pointhistory.create',
        'uses' => 'PointHistoryController@create',
        'middleware' => 'can:iredeems.pointhistories.create'
    ]);
    $router->post('pointhistories', [
        'as' => 'admin.iredeems.pointhistory.store',
        'uses' => 'PointHistoryController@store',
        'middleware' => 'can:iredeems.pointhistories.create'
    ]);
    $router->get('pointhistories/{pointhistory}/edit', [
        'as' => 'admin.iredeems.pointhistory.edit',
        'uses' => 'PointHistoryController@edit',
        'middleware' => 'can:iredeems.pointhistories.edit'
    ]);
    $router->put('pointhistories/{pointhistory}', [
        'as' => 'admin.iredeems.pointhistory.update',
        'uses' => 'PointHistoryController@update',
        'middleware' => 'can:iredeems.pointhistories.edit'
    ]);
    $router->delete('pointhistories/{pointhistory}', [
        'as' => 'admin.iredeems.pointhistory.destroy',
        'uses' => 'PointHistoryController@destroy',
        'middleware' => 'can:iredeems.pointhistories.destroy'
    ]);
    $router->bind('point', function ($id) {
        return app('Modules\Iredeems\Repositories\PointRepository')->find($id);
    });
    $router->get('points', [
        'as' => 'admin.iredeems.point.index',
        'uses' => 'PointController@index',
        'middleware' => 'can:iredeems.points.index'
    ]);
    $router->get('points/create', [
        'as' => 'admin.iredeems.point.create',
        'uses' => 'PointController@create',
        'middleware' => 'can:iredeems.points.create'
    ]);
    $router->post('points', [
        'as' => 'admin.iredeems.point.store',
        'uses' => 'PointController@store',
        'middleware' => 'can:iredeems.points.create'
    ]);
    $router->get('points/{point}/edit', [
        'as' => 'admin.iredeems.point.edit',
        'uses' => 'PointController@edit',
        'middleware' => 'can:iredeems.points.edit'
    ]);
    $router->put('points/{point}', [
        'as' => 'admin.iredeems.point.update',
        'uses' => 'PointController@update',
        'middleware' => 'can:iredeems.points.edit'
    ]);
    $router->delete('points/{point}', [
        'as' => 'admin.iredeems.point.destroy',
        'uses' => 'PointController@destroy',
        'middleware' => 'can:iredeems.points.destroy'
    ]);
// append





});
