<?php
define( 'DS', DIRECTORY_SEPARATOR );
define ('ABSOLUTE_PATH', dirname(__FILE__) );
define ('RELATIVE_PATH', '');
define ('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once ( ROOT .DS.'includes.php' );
session_destroy();
header("Location:" . BASE_PATH );
?>
