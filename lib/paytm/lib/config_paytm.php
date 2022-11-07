<?php
define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', '');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
/*

- Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
- Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
- Above details will be different for testing and production environment.

*/
$confObj = new FConfig();
define('PAYTM_RESPONSE_URL', $confObj->paytmResponseURL);
define('PAYTM_ENVIRONMENT', $confObj->paytmEnviroment); // PROD
define('PAYTM_MERCHANT_KEY', $confObj->paytmMerchantKey); //Change this constant's value with Merchant key downloaded from portal
define('PAYTM_MERCHANT_MID', $confObj->paytmMID); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_MERCHANT_WEBSITE', $confObj->paytmAppWebsite); //Change this constant's value with Website name received from Paytm
define('PAYTM_INDUSTRY_TYPE_ID', $confObj->paytmIndustryTypeID);
define('PAYTM_CHANNEL_ID', $confObj->paytmChannelID);
// define('PAYTM_CUSTOMRESPONSE_URL', $confObj->paytmCustomResponseURL);
// define('PAYTM_MANNUALRESPONSE_URL', $confObj->paytmMannualResponseURL);
//$PAYTM_DOMAIN = 'securegw-stage.paytm.in'; //STAGING
$PAYTM_DOMAIN = 'securegw.paytm.in'; //PROD
define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/merchant-status/getTxnStatus');
define('PAYTM_STATUS_QUERY_NEW_URL', 'https://'.$PAYTM_DOMAIN.'/merchant-status/getTxnStatus');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/theia/processTransaction');
?>
