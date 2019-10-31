<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/iredeems/v1'], function (Router $router) {

  //======  ITEMS
  require('ApiRoutes/itemRoutes.php');
  //======  REDEEMS
  require('ApiRoutes/redeemRoutes.php');
  //======  Points
  require('ApiRoutes/pointRoutes.php');


});
