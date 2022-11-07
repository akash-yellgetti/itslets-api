<?php
header('Access-Control-Allow-Origin: *');
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', '');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
$delRes = array("lets_id"=>$_GET['param'],"socket_id"=>$_GET["param1"]);
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
require __DIR__ . '/vendor/autoload.php';
$client = new Client(new Version2X('http://147.139.1.65:3000'));
$client->initialize();
$client->emit('acceptpartner', $delRes);
$client->close();
?>