<?php
require_once 'Slim/Slim.php';
require_once 'app/libs/Array2XML.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);
require_once 'app/libs/connect.php';
require_once 'app/routes/api.php';

require_once("php/Usuario.php");
require_once("php/Producto.php");
require_once("php/Pedido.php");
require_once("php/Local.php");
require_once("php/Personal.php");

$app->run();

