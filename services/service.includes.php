<?php
header("access-control-allow-origin: *");
header('content-type: application/x-www-form-urlencoded');
$_POST=json_decode(file_get_contents('php://input'),true);
?>