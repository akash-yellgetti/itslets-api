<?php
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'lib'.DS.'paytm');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT.DS."lib".DS."paytm".DS."lib".DS."config_paytm.php");
require_once(ROOT.DS."lib".DS."paytm".DS."lib".DS."encdec_paytm.php");

/*$checkSum = "";
$paramList = array();

$ORDER_ID = 358;
$CUST_ID = 18;
$INDUSTRY_TYPE_ID = 'Retail';
$CHANNEL_ID = 'WEB';
$TXN_AMOUNT = 423;

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = PAYTM_RESPONSE_URL;
// if(isset($jsonArr->mobile) &&  $jsonArr->mobile!=''):
//     $paramList["MSISDN"] = $jsonArr->mobile; 
// endif;
// if(isset($jsonArr->email_id) &&  $jsonArr->email_id!=''):
//     $paramList["EMAIL"] = $jsonArr->email_id; 
// endif; 
/*
$paramList["CALLBACK_URL"] = "http://localhost/PaytmKit/pgResponse.php";
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
//$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
//echo $checkSum;
//echo "<br/>";

$url='https://securegw-stage.paytm.in/merchant-status/getTxnStatus?JsonData={"MID":"SSPrin40539025121246",
    "ORDERID":"360","CHECKSUMHASH":"'. urlencode("w5jD8UOn9J3cpEuwCmhavTqzPSrS3jB8W9xwv3XyXftlhv3XD6bQad/nEWNZ8eeo3FlG6qtA/9ItN2HAvFGG0yWRd62VJ1GoZDXI+wGb970=").'"}';

echo $url;
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
var_dump(json_decode($result, true));