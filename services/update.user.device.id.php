<?php
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'services');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
require_once(ROOT . DS . RELATIVE_PATH . DS . 'service.includes.php');
require_once(ROOT . DS . RELATIVE_PATH . DS . 'model' . DS . 'model.php');
$modObj = new ModServices();
echo $modObj->updateUserDeviceID();
?>