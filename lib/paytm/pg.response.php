<?php
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'lib'.DS.'paytm');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
require_once(ROOT . 'bookings' . DS . 'model' . DS . 'model.php');
$modObj = new ModBookings();
// following files need to be included
require_once(ROOT.DS."lib".DS."paytm".DS."lib".DS."config_paytm.php");
require_once(ROOT.DS."lib".DS."paytm".DS."lib".DS."encdec_paytm.php");
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";
$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
//Log Transaction
$genObj->logPayTM(1);
if ($isValidChecksum == "TRUE"):
    if ($_POST["STATUS"] == "TXN_SUCCESS"): //Transaction Success
        //Validating Transaction Status by Call Back URL
        $requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $_POST["ORDERID"]);  
        $responseParamList = getTxnStatus($requestParamList);
        if(isset($responseParamList) && count($responseParamList)>0):
            if($responseParamList["ORDERID"] == $_POST["ORDERID"] && $responseParamList["TXNAMOUNT"] == $_POST["TXNAMOUNT"]):
                $orderID = $modObj->placePckOrder($_POST["ORDERID"]);
				header("location:" . BASE_PATH . "/package-booking-success/" . $genObj->encodeString($orderID));                
            else:
	          header("location:" . BASE_PATH . "/package-booking-failed");
            endif;
        else:
           header("location:" . BASE_PATH . "/package-booking-failed");
        endif;                
    else: //Transaction Failed
        header("location:" . BASE_PATH . "/package-booking-failed");
    endif;
else:
    //Transaction Failed
   header("location:" . BASE_PATH . "/package-booking-failed");
endif;
?>