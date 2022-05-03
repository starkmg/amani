<?php
    session_start();
//    var_dump($_SESSION);
//    die();
    date_default_timezone_set('Africa/Kinshasa');
    $path = "";
    require_once("controllers/Router.php");
    $router = new Router();
    $router->routeReq();
    $router->logToFile();