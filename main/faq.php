<?php

define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'main');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');

/* Includes view */
$genObj->addStyleSheet(BASE_PATH . DS . RELATIVE_PATH . "/css/main.css");
$genObj->addScript(BASE_PATH . DS . RELATIVE_PATH . "/jscript/main.js");

$genObj->addStyleSheet(BASE_PATH . DS . "/owlcarousel/assets/owl.carousel.min.css");
$genObj->addStyleSheet(BASE_PATH . DS . "/owlcarousel/assets/owl.theme.default.min.css");
$genObj->addScript(BASE_PATH . DS . "/owlcarousel/owl.carousel.min.js");


$incObj = new FInclude();
require_once($incObj->getFilePath('header.php'));
require_once($incObj->getFilePath(RELATIVE_PATH . DS . 'view' . DS . 'faq.php'));
require_once($incObj->getFilePath('footer.php'));
?>