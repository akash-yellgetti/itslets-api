<?php
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'lib'.DS.'paytm');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
// require_once(ROOT . DS . 'checklogin.php');
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
//Get Order Info
require_once(ROOT . 'bookings' . DS . 'model' . DS . 'model.php');
$modObj = new ModBookings();
$jsonArr =  json_decode($modObj->getPayOrderInfo());
/* Includes view */
$genObj->addStyleSheet(BASE_PATH . "/bookings/css/bookings.css");
$genObj->addScript(BASE_PATH . "/bookings/jscript/bookings.js");
$incObj = new FInclude();
require_once($incObj->getFilePath('header.php'));
require_once($incObj->getFilePath(RELATIVE_PATH . DS . 'pg.request.php'));
require_once($incObj->getFilePath('footer.php'));
?>
