<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/iredeems'], function (Router $router) {

  //======  ITEMS
  require('ApiRoutes/itemRoutes.php');
  //======  REDEEMS
  require('ApiRoutes/redeemRoutes.php');


});
