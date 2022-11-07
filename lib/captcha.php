<?php

define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'lib');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
$sessObj = new FSessions();
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$sessObj->set('cap_code', $ranStr);
$newImage = imagecreatefromjpeg(BASE_PATH . "/images/cap_bg.jpg");
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($newImage);
?>
