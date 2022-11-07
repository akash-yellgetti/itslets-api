<?php
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'services');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
require_once(ROOT . DS . RELATIVE_PATH . DS . 'service.includes.php');
require_once(ROOT . DS . RELATIVE_PATH . DS . 'model' . DS . 'model.php');
$modObj = new ModServices();
$confObj=new FConfig();
$clientKey = $confObj->clientKey;
if(isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
	$jsonObj=array("code"=>200,"api_key"=>$confObj->api_key, "api_secret"=>$confObj->api_secret, "api_merchant_id"=>$confObj->api_merchant_id);
else:
	$jsonObj=array("code"=>500);
endif;
echo json_encode($jsonObj);
?>