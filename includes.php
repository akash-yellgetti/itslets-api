<?php

session_start(); //Session Starts
date_default_timezone_set("Asia/Calcutta"); //Set Indian Time Zone
require_once(ROOT . DS . "config" . DS . "config.php");
require_once(ROOT . DS . "lib" . DS . "object.php");
require_once(ROOT . DS . "lib" . DS . "sessions.php");
require_once(ROOT . DS . "lib" . DS . "uri.php");
require_once(ROOT . DS . "lib" . DS . "database.php");
require_once(ROOT . DS . "lib" . DS . "general.php");
require_once(ROOT . DS . "lib" . DS . "csInclude.php");
require_once(ROOT . DS . 'lib' . DS . 'emailer' . DS . 'PHPMailerAutoload.php');
require_once(ROOT . DS . 'lib' . DS . 'emailer' . DS . 'csEmailer.php');
require_once(ROOT . DS . "lib" . DS . "paging.php");
$confObj = new FConfig();
$uriObj = new FURI();
$genObj = new FGeneral();
$sessObj = new FSessions();

$siteTitle=$confObj->siteName;
$metaDesc="";
define("SITE_NAME", $confObj->siteName);
define("SITE_URL", $confObj->siteURL);
define("ROOT_FOLDER", $confObj->rootfolder);
define('BASE_PATH', $confObj->baseURL);
?>
