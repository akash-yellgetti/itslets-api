<?php

/**
 * This website is developed by Favworks and all the codes are written by favworks.
 * Favworks does not hold any responsibility if any changes done to this code
 * FGeneral Class
 * @package FavCMS
 */

class FGeneral {

    /**
     * Tab string
     *
     * @var        string
     * @access    private
     */
    static $_tab = "\11";

    /**
     * Contains the line end string
     *
     * @var        string
     * @access    private
     */
    static $_lineEnd = "\12";

    /**
     * Contains the character encoding string
     *
     * @var     string
     * @access  private
     */
    static $_charset = 'utf-8';

    /**
     * Array of linked scripts
     *
     * @var        array
     * @access   private
     */
    static $_scripts = array();

    /**
     * Array of linked style sheets
     *
     * @var        array
     * @access   private
     */
    static $_styleSheets = array();

    /**
     * function to encrypt the string
     */
    function encodeString($str) {
        for ($i = 0; $i < 5; $i++) {
            $str = strrev(base64_encode($str)); /* apply base64 first and then reverse the string */
        }
        return $str;
    }

    /**
     * function to decrypt the string
     */
    function decodeString($str) {
        for ($i = 0; $i < 5; $i++) {
            $str = base64_decode(strrev($str)); //apply base64 first and then reverse the string}
        }
        return $str;
    }

    /**
     * Checks the form field for special characters and converts it based on get_magic_quotes_gpc function.
     *
     * @return string
     */
    function getFormField($formField) {
        $formField = trim($formField);
        if (get_magic_quotes_gpc() == 1) {
            return $formField;
        } else {
            return addslashes($formField);
        }
    }

    /**
     * Check whether a numeric
     */
    function isNum($var) {
        if (ereg("^[[:digit:]]+$", $var)) {
            return true;
        } else {
            return false;
        }
    }

    function dateToDB($dateVal) {
        $monthNameS = array('jan' => 1, 'feb' => 2, 'mar' => 3, 'apr' => 4, 'may' => 5, 'jun' => 6, 'jul' => 7, 'aug' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'dec' => 12);
        $dateArr = explode('-', $dateVal);
        $dateFormat = $dateArr[2] . "/" . $monthNameS[strtolower($dateArr[1])] . "/" . $dateArr[0];
        return $dateFormat;
    }

    function dateToDisplay($dateVal) {
        $monthName = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $dateArr = explode('-', $dateVal);
        $dateFormat = $dateArr[2] . "-" . $monthName[$dateArr[1] - 1] . "-" . $dateArr[0];
        return $dateFormat;
    }

    function dateWithTime($dateVal) {
        $dateFormat = date(F . " " . j . "" . S . ", " . Y . " " . h . ":" . i . " " . a, strtotime($dateVal));
        return $dateFormat;
    }

    function dateDiff($date1, $date2) {
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        return round(abs($date1 - $date2) / 60 / 60 / 24);
    }

    function shortString($str, $length) {
        if (strlen(strip_tags($str)) > $length):
            $str = substr(strip_tags($str), 0, $length) . "..";
        endif;
        return $str;
    }

    /**
     * Adds a linked script to the page
     * @param  string $url URL to the linked script
     * @param  string $type Type of script. Defaults to 'text/javascript'
     */
    function addScript($url, $type = "text/javascript") {
        FGeneral::$_scripts[$url] = $type;
    }

    /**
     * Adds a linked stylesheet to the page
     * @param  string $url URL to the linked style sheet
     * @param  string $type Mime encoding type
     * @param  string $media Media type that this stylesheet applies to
     */
    function addStyleSheet($url, $type = 'text/css', $media = null, $attribs = array()) {
        FGeneral::$_styleSheets[$url]['mime'] = $type;
        FGeneral::$_styleSheets[$url]['media'] = $media;
        FGeneral::$_styleSheets[$url]['attribs'] = $attribs;
    }

    /**
     * Get Header Includes
     */
    function includeHeader() {
        $headerVar = '';
        $tagEnd = ' />';
        if (sizeof(FGeneral::$_scripts) > 0) {
            foreach (FGeneral::$_scripts as $strSrc => $strType):
                $headerVar .= FGeneral::$_tab . '<script type="' . $strType . '" src="' . $strSrc . '"></script>' . FGeneral::$_lineEnd;
            endforeach;
        }
        if (sizeof(FGeneral::$_styleSheets) > 0) {
            foreach (FGeneral::$_styleSheets as $strSrc => $strAttr):
                $headerVar .= FGeneral::$_tab . '<link rel="stylesheet" href="' . $strSrc . '" type="' . $strAttr['mime'] . '"';
                if (!is_null($strAttr['media'])):
                    $headerVar .= ' media="' . $strAttr['media'] . '" ';
                endif;
                $headerVar .= $tagEnd . FGeneral::$_lineEnd;
            endforeach;
        }
        return $headerVar;
    }

    /**
     * Random String Genration
     * @name random_id_length parameter for getting random string size
     */
    function getRandString($random_id_length = 5) {
        //generate a random id encrypt it and store it in $rnd_id
        $rnd_id = crypt(uniqid(rand(), 1));

        //to remove any slashes that might have come
        $rnd_id = strip_tags(stripslashes($rnd_id));

        //Removing any . or / and reversing the string
        $rnd_id = str_replace(".", "", $rnd_id);
        $rnd_id = strrev(str_replace("/", "", $rnd_id));

        //finally I take the first 5 characters from the $rnd_id
        $rnd_id = substr($rnd_id, 0, $random_id_length);

        return $rnd_id;
    }

    /**
     * Function to generate OTP
     * @return string
     */
    function getOTP() {
        $otp = '';
        for ($i = 0; $i < 4; $i++) {
            $otp = $otp . rand(0, 9);
        }
        return $otp;
    }

    /**
     * Function used to find a value within an array
     * @param <type> $needle
     * @param <type> $needle_field
     * @param <type> $haystack
     * @param <type> $strict
     * @return <type> true/false
     */
    function in_array_field($needle, $needle_field, $haystack, $strict = false) {
        if ($strict) {
            foreach ($haystack as $item)
                if (isset($item->$needle_field) && $item->$needle_field === $needle)
                    return true;
        } else {
            foreach ($haystack as $item):
                if (isset($item->$needle_field) && $item->$needle_field == $needle)
                    return true;
            endforeach;
        }
        return false;
    }

    function getPrettyURL($URL) {
        $specialCharacters = array("#" => "", "$" => "", "%" => "", "&" => "", "@" => "", "." => "", "â‚¬" => "", "+" => "", "=" => "", "Â§" => "", "\"" => "", "/" => "", "'" => "", '"' => "", "!" => "", ":" => "", ";" => "", "^" => "", "*" => "", "(" => "", ")" => "", "{" => "", "}" => "", "[" => "", "]" => "", "?" => "", "<" => "", ">" => "", "~" => "", "`" => "", "," => "", "â€˜" => "", "â€™" => "", "'" => "", "â€œ" => "", "â€�" => "");
        while (list($character, $replacement) = each($specialCharacters)) {
            $URL = str_replace($character, $replacement, $URL);
        }
        $URL = strtr($URL, "Ã€Ã�Ã‚ÃƒÃ„Ã…? Ã¡Ã¢Ã£Ã¤Ã¥Ã’Ã“Ã”Ã•Ã–Ã˜Ã²Ã³Ã´ÃµÃ¶Ã¸ÃˆÃ‰ÃŠÃ‹Ã¨Ã©ÃªÃ«Ã‡Ã§ÃŒÃ�ÃŽÃ�Ã¬Ã­Ã®Ã¯Ã™ÃšÃ›ÃœÃ¹ÃºÃ»Ã¼Ã¿Ã‘Ã±", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
        );
        // Remove all remaining other unknown characters
        $URL = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $URL);
        $URL = preg_replace('/^[\-]+/', '', $URL);
        $URL = preg_replace('/[\-]+$/', '', $URL);
        $URL = preg_replace('/[\-]{2,}/', ' ', $URL);
        return str_replace(' ', '', $URL);
    }

    function imageResize($src = '', $width = 0, $height = 0, $cropratio = '') {
        $variable = '?';
        if ($width > 0):
            $variable = $variable . "width=" . $width;
        endif;
        if ($height > 0):
            if ($variable != ''):
                $variable = $variable . "&";
            endif;
            $variable = $variable . "height=" . $height;
        endif;
        if ($cropratio != ''):
            if ($variable != ''):
                $variable = $variable . "&";
            endif;
            $variable = $variable . "cropratio=" . $cropratio;
        else:
//            if ($variable != ''):
//                $variable = $variable . "&";
//            endif;
//            $variable = $variable . "cropratio=1:1";
        endif;
        $variable = $variable . "quality=100";
        if ($variable != ''):
            $variable = $variable . "&";
        endif;

        if ($variable != ''):
            $variable = $variable . "&";
        endif;
        $imageName = strrev(substr(strrev($src), 0, strpos(strrev($src), "/")));
        $variable = $variable . "image=" . FURI::base() . $src;
        return FURI::base() . "/lib/image.php" . $variable;
    }

    /**
     * Function to get File size
     */
    public function getImageSize($fileName) {
        $fileArr = getimagesize($fileName);
        $imageSize = explode(' ', $fileArr[3]);
        $imageWidth = explode('=', str_replace('"', '', $imageSize[0]));
        $imageHeight = explode('=', str_replace('"', '', $imageSize[1]));
        $fileSize = (filesize($fileName) * 0.001);
        return json_encode(array("file_size" => $fileSize, "width" => $imageWidth[1], "height" => $imageHeight[1]));
    }

    /**
     * Function to get IP Address
     * @return string
     */
    function get_client_ip() {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP']):
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        elseif ($_SERVER['HTTP_X_FORWARDED_FOR']):
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif ($_SERVER['HTTP_X_FORWARDED']):
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        elseif ($_SERVER['HTTP_FORWARDED_FOR']):
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        elseif ($_SERVER['HTTP_FORWARDED']):
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        elseif ($_SERVER['REMOTE_ADDR']):
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else:
            $ipaddress = 'UNKNOWN';
        endif;
        return $ipaddress;
    }

    public function createOTP() {
        $otp = '';
        for ($i = 0; $i < 6; $i++) {
            $otp = $otp . rand(0, 9);
        }
        return $otp;
        //return 123456;
    }

    function generateReferralCode($length = 6) {
        $dbObj=new FDatabase();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $referralCode = '';
        for ($i = 0; $i < $length; $i++) {
            $referralCode .= $characters[rand(0, $charactersLength - 1)];
        }
        $selQry = "SELECT user_id FROM user_mas WHERE referral_code=?";
        $result=$dbObj->query($selQry,array($referralCode))->fetchObjList();
        if($dbObj->getNumRows()>0):
            $this->generateReferralCode($length);
        else:
            return $referralCode;
        endif;
    }
	
    /**
    * Function to send SMS
    */
	public function sendSMS($message, $phoneNumber){
		// // Authorisation details.
		// $username = "letsinbiz@gmail.com";
		// $hash = "648a5b04061c406c4a7d79f5971163665781ccdce4fe50d0f7c768ef841df7dc";
		// // Config variables. Consult http://api.textlocal.in/docs for more info.
		// $test = "0";		
		// $sender = "ITSLET";
		// $numbers = $phoneNumber; 				
		// $message = urlencode($message);
		// $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		// $ch = curl_init('http://api.textlocal.in/send/?');
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $result = curl_exec($ch); // This is the result from the API
		// curl_close($ch);


        //Send SMS via API
        // Account details
        $apiKey = urlencode('NTI3OTVhNGU3MDQ4NTQ0ZjYxNDc2YTQ0MzA3NDY3MzU=');
        
        // Message details
        $numbers = array($phoneNumber);
        $sender = urlencode('ITSLET');
        $message = rawurlencode($message);
        $numbers = implode(',', $numbers);
    
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

		return 1;
	}

    function getCountryPhoneCodes(){
        $dbObj=new FDatabase();
        $selQry="SELECT country_id,country_phone_code,country_name"
        . " FROM country_mas"
        . " WHERE country_phone_code!='' AND min_mobile!=0 AND max_mobile!=0 AND del_flag=0"
        . " ORDER BY country_phone_code ASC";
        return $dbObj->query($selQry)->fetchObjList();
    }

    /**
     * Function to send Push Notification
     */
    public function sendPushNotification($userID, $title="", $message=""){
		$dbObj=new FDatabase();
        $confObj=new FConfig();
		$img="";
		$data = [           
            'image'=>$img,
            'message'=>$message,
            'title'=>$title
        ];
        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';
        //apiKey available in:    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key        
		$apiKey = $confObj->fcm_apikey;		
        $dbObj->query("SELECT fcm_token_id 
        FROM user_device AS a 
        INNER JOIN user_mas AS b ON b.user_id=a.user_id AND b.del_flag=0 AND b.active_flag=1
        WHERE a.del_flag=0 AND a.user_id=?
        GROUP BY a.fcm_token_id
        ORDER BY a.id DESC",array($userID));
        $result = $dbObj->fetchObjList();
        foreach($result as $item):
            $tokenID=$item->fcm_token_id;
            $fields = array (
                'notification'=>array(
                    'title'=>$title,
                    'body'=>$message
                ),                   
                'registration_ids' => array (
                        $tokenID
                ),
                'data' =>$data
            );
            //header includes Content type and api key
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key='.$apiKey
            );						
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
        endforeach;
        return 1;
    }
}
?>

