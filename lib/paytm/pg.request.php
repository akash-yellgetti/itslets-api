<?php
// following files need to be included
require_once(ROOT.DS."lib".DS."paytm".DS."lib".DS."config_paytm.php");
require_once(ROOT.DS."lib".DS."paytm".DS."lib".DS."encdec_paytm.php");

$checkSum = "";
$paramList = array();

$ORDER_ID = $jsonArr->order_id;
$CUST_ID = $jsonArr->user_id;
$INDUSTRY_TYPE_ID = PAYTM_INDUSTRY_TYPE_ID;
$CHANNEL_ID = PAYTM_CHANNEL_ID;
$TXN_AMOUNT = $jsonArr->amount;

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = PAYTM_RESPONSE_URL;
if(isset($jsonArr->mobile) &&  $jsonArr->mobile!=''):
    $paramList["MSISDN"] = $jsonArr->mobile; 
endif;
if(isset($jsonArr->email_id) &&  $jsonArr->email_id!=''):
    $paramList["EMAIL"] = $jsonArr->email_id; 
endif; 
/*
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //
*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
    <head>
        <title>Nammachef Payment redirection</title>
    </head>
    <body>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/jquery.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/jquery-ui.js'; ?>"></script>
    <center><br/><br/><br/><br/><h3>Please do not refresh this page...</h3><br/><img src="<?php echo BASE_PATH . "/images/loading.gif" ?>" alt='Page Loading' /><br/><br/><br/><br/></center>
    <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">		
        <?php
        foreach ($paramList as $name => $value) {
            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
        }
        ?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">			
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            document.f1.submit();
        });
    </script>
</body>
</html>