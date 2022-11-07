<?php

class ModServices {

	var $_dbObj;
	function __construct() {
		$this->_dbObj = new FDatabase();
	}

	/**
    * Function to get all countries
    */
    public function getCountries() {
        $result = $this->_dbObj->query("SELECT country_id,country_name,country_phone_code,min_mobile,max_mobile
        FROM country_mas
        WHERE del_flag=0 AND country_phone_code!=''
        ORDER BY country_name")->fetchObjList();
        if($result):
            $resultArr = array();
            foreach($result as $item):
                $resultArr[] = array(
                    "country_id" => $item->country_id,
                    "country_name" => $item->country_name,
                    "country_phone_code" => $item->country_phone_code,
                    "min_mobile" => $item->min_mobile,
                    "max_mobile" => $item->max_mobile,
                );
            endforeach;
           return json_encode(array("code" => 200, "result" => $resultArr));
        else:
            return json_encode(array("code"=>500));
        endif;
    }

    /**
     * function to save user in temp table
     */
    public function saveTempUser(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["mobile"]) && $_POST["mobile"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $result=$dbObj->query("SELECT user_id "
            ." FROM user_mas"
            ." WHERE mobile=? AND country_phone_code=? AND country_id=? AND del_flag=0 AND active_flag=1",array($_POST["mobile"],$_POST["country_phone_code"],$_POST["country_id"]))->fetchObj();
            if($dbObj->getNumRows()>0):
                return json_encode(array(
                    "code"=>501,
                    "message"=>"Mobile number already registered with us."
                ));
            else:
                $genObj=new FGeneral();
                $otp=$genObj->createOTP();
				//$otp="123456";
                $password=$genObj->encodeString($_POST["password"]);
                $dataArr=array($_POST["country_phone_code"],$_POST["mobile"],$_POST["country_id"],$password,$otp,date("Y-m-d H:i:s"));
                $insQry="INSERT INTO temp_user_mas (country_phone_code,mobile,country_id,password,reg_otp,added_date) VALUES (?,?,?,?,?,?)";
                $result=$dbObj->query($insQry,$dataArr);
                if ($result):
                    $tempUserID=$dbObj->getLastInsID();
                    $countryCode = "91";
                    if(isset($_POST["country_phone_code"]) && $_POST["country_phone_code"]!=""):
                        $countryCode = $_POST["country_phone_code"];
                    endif;
                    $message = "Your OTP to register/access ITSLETS is ".$otp.". Please do not share it with anyone.";                    
                    $mobileNum=$countryCode."".$_POST["mobile"];
                    $genObj->sendSMS($message,$mobileNum);
                    return json_encode(array(
                        "code"=>200,
                        "temp_user_id"=>$tempUserID,
                        "message"=>"OTP sent successfully."
                    ));
                else:
                    return json_encode(array(
                        "code"=>500,
                        "message"=>"Something went wrong. Please try again."
                    ));
                endif;
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
     * function to authenticate user registration OTP
     */
    public function authRegOtp(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["reg_otp"]) && $_POST["reg_otp"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $genObj = new FGeneral();
            $dataArr=array($_POST["temp_user_id"],$_POST["reg_otp"]);
            $selQry="SELECT temp_user_id,mobile,email,country_phone_code,country_id,password "
            . " FROM temp_user_mas WHERE temp_user_id=? AND reg_otp=?";
            $result=$dbObj->query($selQry,$dataArr)->fetchObj();
            if($dbObj->getNumRows()>0):
                $mobile=$result->mobile;
                $email=$result->email;
                $countryPhoneCode=$result->country_phone_code;
                $countryID=$result->country_id;
                $password=$result->password;
                $referralCode=$genObj->generateReferralCode(8);
                $dataArr=array($mobile,$countryPhoneCode,$countryID,$password,$referralCode,date("Y-m-d H:i:s"));
                $insQry="INSERT INTO user_mas (mobile,country_phone_code,country_id,password,referral_code,added_date) VALUES (?,?,?,?,?,?)";
                $result=$dbObj->query($insQry,$dataArr);
                if($result):
                    $userID=$dbObj->getLastInsID();
                    $subscriptionPlanID=4;
                    $selQry="SELECT subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,active_flag"
                    . " FROM subscription_plans"
                    . " WHERE active_flag=1 AND del_flag=0 AND subscription_plan_id=?";
                    $result = $dbObj->query($selQry,array($subscriptionPlanID))->fetchObj();
                    if($dbObj->getNumRows()>0):
                        $dataArr=array($userID,$result->subscription_plan_id,$result->plan_type,0,0,$result->num_of_lets,$result->validity_days,0,date('Y-m-d', strtotime(" + " . $result->validity_days . " days")),date("Y-m-d H:i:s"));
                        $insQry="INSERT INTO user_subscription (user_id,subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,payable_amt,expiry_date,added_date) VALUES(?,?,?,?,?,?,?,?,?,?)";
                        $dbObj->query($insQry,$dataArr);
                        if(!$result):
                            return json_encode(array(
                                "code"=>500,
                                "message"=>"Failed to assign free package"
                            ));
                        endif;
                    endif;
                    return json_encode(array(
                        "code"=>200,
                        "user_id"=>$userID,
                        "country_phone_code"=>$countryPhoneCode,
                        "country_id"=>$countryID,
                        "mobile"=>$mobile,
                        "email"=>$email,
                        "profile_complete_flag"=>0
                    ));
                else:
                    return json_encode(array(
                        "code"=>500,
                        "message"=>"Failed to register user."
                    ));
                endif;
            else:
                return json_encode(array(
                    "code"=>502,
                    "message"=>"Incorrect OTP."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }    

    /**
     * function to save the registration profile
     */
    public function saveRegProfile(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["name"]) && $_POST["name"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $result=$dbObj->query("SELECT user_id FROM user_mas WHERE email=? AND user_id!=? AND del_flag=0",array($_POST["email"],$_POST["user_id"]))->fetchObjList();
            if($dbObj->getNumRows()>0):
                return json_encode(array(
                    "code"=>502,
                    "message"=>"Email id already registered."
                ));
            endif;
            $upQry="UPDATE user_mas SET name=?,email=?,gender_id=?,vaccination_status=?,marital_status=?,profile_complete_flag=2 WHERE user_id=?";
            $result=$dbObj->query($upQry,array($_POST["name"],$_POST["email"],$_POST["gender_id"],$_POST["vaccination_status"],$_POST["marital_status"],$_POST["user_id"]));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "profile_complete_flag"=>2,
                    "messsage"=>"Profile saved successfully"
                ));
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
    * function to upload images from profile gallery
    */
    public function uplProfileGalPic(){
		$confObj = new FConfig();
        $clientKey = $confObj->clientKey;
		if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
			$dbObj = $this->_dbObj;
            $genObj = new FGeneral();
            $userGalleryID=$_POST["user_gallery_id"];
            $imgOrd=$_POST["img_ord"];
			$fileParts = pathinfo($_FILES["file"]["name"]);
			$ext = strtolower($fileParts['extension']);
			if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'bmp'):
				$newImg = 'gallery_' . md5(uniqid(time(), true)) . '.jpeg';
				move_uploaded_file($_FILES["file"]["tmp_name"], ROOT . "/images/profilegallery/" . $newImg);
				$imagePath = BASE_PATH . "/images/profilegallery/" . $newImg;
                if($userGalleryID==0):
                    $dataArr = array($_POST["user_id"], $newImg,$imgOrd, date("Y-m-d H:i:s"));
                    $result =$dbObj->query("INSERT INTO user_gallery_pics(user_id,img_name,img_ord,added_date) VALUES(?,?,?,?)",$dataArr);
                else:
                    $dataArr = array($newImg, date("Y-m-d H:i:s"),$userGalleryID);
                    $result =$dbObj->query("UPDATE user_gallery_pics SET img_name=?,added_date=? WHERE user_gallery_id=?",$dataArr);
                endif;
                if($result):
                    $userGalleryID=$dbObj->getLastInsID();
					// $imagePath = $genObj->imageResize("/images/profilegallery/".$newImg, 126, 126, '1:1');
                    $dbObj->query("UPDATE user_mas SET profile_complete_flag=3 WHERE user_id=?",array($_POST["user_id"]));
                    return json_encode(array("code" => 200,
                        "user_gallery_id"=>$userGalleryID,
                        "path" => $imagePath,
                        "image" => $newImg,
                        "img_url"=>BASE_PATH."/images/profilegallery/".$newImg
                    ));
				else:
					return json_encode(array("code" => 500, "message" => "Something went wrong. Please try again later.."));
				endif;
			else:
				return json_encode(array("code" => 500, "message" => "Upload image of type jpeg|jpg|png|bmp"));
			endif;
		else:
		    return json_encode(array("code"=>500,"message"=>"Sorry! Could not process your request.."));
		endif;
    }

    /**
     * function to gett the user profile pic gallery
     */
    public function getProfileGallery($userID=0){
		$confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            if($userID==0):
                $userID=$_POST["user_id"];
            endif;
            $result=$this->_dbObj->query("SELECT user_gallery_id,img_ord,img_name
            FROM user_gallery_pics
            WHERE user_id=? AND del_flag=0
            ORDER BY img_ord ASC",array($userID))->fetchObjList();
            if($this->_dbObj->getNumRows()>0):
                $imagesArr=array();
                foreach($result AS $item):
                    $imagesArr[]=array(
                        "user_gallery_id"=>$item->user_gallery_id,
                        "img_ord"=>$item->img_ord,
                        "img_name"=>$item->img_name,
                        "img_url"=>BASE_PATH."/images/profilegallery/".$item->img_name
                    );
                endforeach;
                return json_encode(array(
                    "code" => 200,
                    "images" => $imagesArr
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Images not available."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry! Could not process your request.."
            ));
		endif;
    }

    /**
     * function to authenticate the user login
     */
    public function authUserLogin(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["mobile"]) && $_POST["mobile"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $result=$dbObj->query("SELECT user_id "
            ." FROM user_mas"
            ." WHERE mobile=? AND country_phone_code=? AND country_id=? AND del_flag=0 AND active_flag=1",array($_POST["mobile"],$_POST["country_phone_code"],$_POST["country_id"]))->fetchObj();
            if($dbObj->getNumRows()>0):
                $userID=$result->user_id;
                $genObj=new FGeneral();
                $otp=$genObj->createOTP();
				//$otp="123456";
                $dataArr=array($otp,$userID);
                $upQry="UPDATE user_mas SET login_otp=? WHERE user_id=?";
                $result=$dbObj->query($upQry,$dataArr);
                if ($result):
                    $countryCode = "91";
                    if(isset($_POST["country_phone_code"]) && $_POST["country_phone_code"]!=""):
                        $countryCode = $_POST["country_phone_code"];
                    endif;
                    $message = $otp." ITSLETS OTP";                    
                    $mobileNum=$countryCode."".$_POST["mobile"];                    
                    $genObj->sendSMS($message,$mobileNum);
                    return json_encode(array(
                        "code"=>200,
                        "user_id"=>$userID,
                        "message"=>"OTP sent successfully."
                    ));
                else:
                    return json_encode(array(
                        "code"=>500,
                        "message"=>"Something went wrong. Please try again."
                    ));
                endif;
            else:
                return json_encode(array(
                    "code"=>502,
                    "message"=>"Mobile number not registered with us."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry! Could not process your request.."
            ));
		endif;
    }

    /**
     * Function to Auth user using Password
     */
    public function authUser(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["mobile"]) && $_POST["mobile"]!="" && isset($_POST["password"]) && $_POST["password"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $genObj=new FGeneral();
            $dataArr=array($_POST["mobile"],$genObj->encodeString($_POST["password"]));
            $selQry="SELECT user_id,name,mobile,email,country_phone_code,country_id,profile_pic,profile_complete_flag "
            . " FROM user_mas WHERE mobile=? AND password=?";
            $dbObj->query($selQry,$dataArr);
            if($dbObj->getNumRows()>0):
                $result=$dbObj->fetchObj();
                $mobile=$result->mobile;
                $countryPhoneCode=$result->country_phone_code;
                $countryID=$result->country_id;
                $profilePic=$result->profile_pic;
                $genObj=new FGeneral();
                // $profilePicPath = $genObj->imageResize("/images/profilegallery/".$profilePic, 126, 126, '1:1');
                $profilePicPath = BASE_PATH."/images/profilegallery/".$profilePic;
                return json_encode(array(
                    "code"=>200,
                    "user_id"=>$result->user_id,
                    "name"=>$result->name,
                    "country_phone_code"=>$result->country_phone_code,
                    "country_id"=>$result->country_id,
                    "mobile"=>$result->mobile,
                    "email"=>$result->email,
                    "profile_pic"=>$profilePic,
                    "profile_pic_path"=>$profilePicPath,
                    "profile_complete_flag"=>$result->profile_complete_flag
                ));
            else:
                return json_encode(array(
                    "code"=>502,
                    "message"=>"Incorrect Password."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
     * function to validate the user login otp
     */
    public function authLoginOtp(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["login_otp"]) && $_POST["login_otp"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $dataArr=array($_POST["user_id"],$_POST["login_otp"]);
            $selQry="SELECT user_id,name,mobile,email,country_phone_code,country_id,profile_pic,profile_complete_flag "
            . " FROM user_mas WHERE user_id=? AND login_otp=?";
            $result=$dbObj->query($selQry,$dataArr)->fetchObj();
            if($dbObj->getNumRows()>0):
                $mobile=$result->mobile;
                $countryPhoneCode=$result->country_phone_code;
                $countryID=$result->country_id;
                $profilePic=$result->profile_pic;
                $genObj=new FGeneral();
                // $profilePicPath = $genObj->imageResize("/images/profilegallery/".$profilePic, 126, 126, '1:1');
                $profilePicPath = BASE_PATH."/images/profilegallery/".$profilePic;
                return json_encode(array(
                    "code"=>200,
                    "user_id"=>$result->user_id,
                    "name"=>$result->name,
                    "country_phone_code"=>$result->country_phone_code,
                    "country_id"=>$result->country_id,
                    "mobile"=>$result->mobile,
                    "email"=>$result->email,
                    "profile_pic"=>$profilePic,
                    "profile_pic_path"=>$profilePicPath,
                    "profile_complete_flag"=>$result->profile_complete_flag
                ));
            else:
                return json_encode(array(
                    "code"=>502,
                    "message"=>"Incorrect OTP."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
     * Function to send OTP for resetting password
     */
    public function checkForgotPassword(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["mobile"]) && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $dbObj->query("SELECT user_id "
            ." FROM user_mas"
            ." WHERE mobile=? AND country_phone_code=? AND country_id=? AND del_flag=0 AND active_flag=1",array($_POST["mobile"],$_POST["country_phone_code"],$_POST["country_id"]));
            if($dbObj->getNumRows()>0):               
                $genObj=new FGeneral();
                $otp=$genObj->createOTP();
				//$otp="123456";
                $userID=$dbObj->fetchObj()->user_id;
                $dataArr=array($otp,$userID);
                $result = $dbObj->query("UPDATE user_mas SET reset_code=? WHERE user_id=?",$dataArr);
                if ($result):                
                    $countryCode = "91";
                    if(isset($_POST["country_phone_code"]) && $_POST["country_phone_code"]!=""):
                        $countryCode = $_POST["country_phone_code"];
                    endif;
                    $message = $otp." ITSLETS OTP"; 
                    $mobileNum=$countryCode."".$_POST["mobile"];
                    $genObj->sendSMS($message,$mobileNum);
                    return json_encode(array(
                        "code"=>200,
                        "user_id"=>$userID,
                        "message"=>"OTP sent successfully."
                    ));
                else:
                    return json_encode(array(
                        "code"=>502,
                        "message"=>"OTP could not be generated, try again."
                    ));
                endif;
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Sorry!! This Mobile Number is not registered."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
     * Function to save new password
     */
    public function saveResetPassword(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["otp"]) && $_POST["otp"]!="" & isset($_POST["password"]) && $_POST["password"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $result=$dbObj->query("SELECT user_id "
            ." FROM user_mas"
            ." WHERE user_id=? AND reset_code=? AND del_flag=0",array($_POST["user_id"],$_POST["otp"]))->fetchObj();
            if($dbObj->getNumRows()>0):               
                $genObj=new FGeneral();
                $password=$genObj->encodeString($_POST["password"]);
                $dataArr=array($password,$_POST["user_id"]);
                $result = $dbObj->query("UPDATE user_mas SET password=? WHERE user_id=?",$dataArr);
                if ($result):                                    
                    return json_encode(array(
                        "code"=>200,
                        "message"=>"Password set successfully."
                    ));
                else:
                    return json_encode(array(
                        "code"=>502,
                        "message"=>"OTP could not be generated, try again."
                    ));
                endif;
            else:
                return json_encode(array(
                    "code"=>503,
                    "message"=>"Sorry!! OTP does not match."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
     * Function to save new password
     */
    public function saveNewPassword(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["password"]) && $_POST["password"]!="" & isset($_POST["newpassword"]) && $_POST["newpassword"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $genObj=new FGeneral();
            $oldPassword=$genObj->encodeString($_POST["password"]);
            $result=$dbObj->query("SELECT user_id "
            ." FROM user_mas"
            ." WHERE user_id=? AND password=? AND del_flag=0",array($_POST["user_id"],$oldPassword))->fetchObj();
            if($dbObj->getNumRows()>0):                             
                $password=$genObj->encodeString($_POST["newpassword"]);
                $dataArr=array($password,$_POST["user_id"]);
                $result = $dbObj->query("UPDATE user_mas SET password=? WHERE user_id=?",$dataArr);
                if ($result):                                    
                    return json_encode(array(
                        "code"=>200,
                        "message"=>"Password set successfully."
                    ));
                else:
                    return json_encode(array(
                        "code"=>502,
                        "message"=>"Sorry!! could not process your request."
                    ));
                endif;
            else:
                return json_encode(array(
                    "code"=>503,
                    "message"=>"Sorry!! Old Password did not match."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

    /**
     * function to update the profile pic
     */
    public function updateProfilePic(){
		$confObj = new FConfig();
        $clientKey = $confObj->clientKey;
		if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
			$dbObj = $this->_dbObj;
            $genObj = new FGeneral();
			$fileParts = pathinfo($_FILES["file"]["name"]);
			$ext = strtolower($fileParts['extension']);
			if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'bmp'):
				$newImg = 'profile_' . md5(uniqid(time(), true)) . '.jpeg';
				move_uploaded_file($_FILES["file"]["tmp_name"], ROOT . "/images/profilegallery/" . $newImg);
				$imagePath = BASE_PATH . "/images/profilegallery/" . $newImg;
                $dataArr = array($newImg,$_POST["user_id"]);
                $result =$dbObj->query("UPDATE user_mas SET profile_pic=? WHERE user_id=?",$dataArr);
                if($result):
					// $imagePath = $genObj->imageResize("/images/profilegallery/".$newImg, 126, 126, '1:1');
                    $dbObj->query("UPDATE user_mas SET profile_complete_flag=3 WHERE user_id=?",array($_POST["user_id"]));
                    return json_encode(array("code" => 200,
                        "path" => $imagePath,
                        "image" => $newImg,
                        "img_url"=>BASE_PATH."/images/profilegallery/".$newImg
                    ));
				else:
					return json_encode(array("code" => 500, "message" => "Something went wrong. Please try again later.."));
				endif;
			else:
				return json_encode(array("code" => 502, "message" => "Upload image of type jpeg|jpg|png|bmp"));
			endif;
		else:
		    return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
		endif;
    }

    /**
     * function too get the user profile details
     */
    public function getUserProfileDetails(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $genObj=new FGeneral();
            $profileGallery=array();
            $galleryResArr=json_decode($this->getProfileGallery());
            if($galleryResArr->code==200):
                $profileGallery=$galleryResArr->images;
            endif;
            $selQry="SELECT user_id,name,profile_pic,email,country_phone_code,mobile,country_id,gender_id,vaccination_status,COALESCE(dob,'') AS dob,marital_status,referral_code,pet_type,pet_type_text"
            . " FROM user_mas WHERE user_id=?";
            $result=$dbObj->query($selQry,array($_POST["user_id"]))->fetchObj();
            if($result):
                $profilePic="";
                $dob="";
                if($result->dob!=''):
                    $dob=$genObj->dateToDisplay($result->dob);
                endif;
                return json_encode(array(
                    "code"=>200,
                    "user_id"=>$result->user_id,
                    "name"=>$result->name,
                    "profile_pic"=>$result->name,
                    "profile_pic"=>$profilePic,
                    "email"=>$result->email,
                    "country_phone_code"=>$result->country_phone_code,
                    "mobile"=>$result->mobile,
                    "country_id"=>$result->country_id,
                    "gender_id"=>$result->gender_id,
                    "dob"=>$dob,
                    "marital_status"=>$result->marital_status,
                    "vaccination_status"=>$result->vaccination_status,
                    "pet_type"=>$result->pet_type,
                    "pet_type_text"=>$result->pet_type_text,
                    "referral_code"=>$result->referral_code,
                    "gallery"=>$profileGallery
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Record not found."));
            endif;

        else:
		    return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
		endif;
    }

    /**
     * function to save the user profile
     */
    public function saveUserProfile(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $genObj=new FGeneral();
            $result=$dbObj->query("SELECT user_id FROM user_mas WHERE email=? AND user_id!=? AND del_flag=0",array($_POST["email"],$_POST["user_id"]))->fetchObjList();
            if($dbObj->getNumRows()>0):
                return json_encode(array(
                    "code"=>502,
                    "message"=>"Email id already registered."
                ));
            endif;
            $dataArr=array($_POST["name"],$_POST["email"],$_POST["gender_id"],$_POST["vaccination_status"],$_POST["marital_status"],$_POST["pet"],$_POST["pet_name"]);
            $upQry="UPDATE user_mas SET name=?,email=?,gender_id=?,vaccination_status=?,marital_status=?,pet_type=?,pet_type_text=?";
            $dob='';
            if(isset($_POST["dob"]) && $_POST["dob"]!=""):
                $dob=$genObj->dateToDB($_POST["dob"]);
                $dataArr[]=$dob;
                $upQry=$upQry. ",dob=?";
            endif;
            $dataArr[]=$_POST["user_id"];
            $upQry=$upQry. " WHERE user_id=?";
            $result=$dbObj->query($upQry,$dataArr);
            if($result):
                return json_encode(array("code" => 200, "message" => "Profile updated successfully."));
            else:
                return json_encode(array("code" => 500, "message" => "Something went wrong. Please try again later.."));
            endif;
        else:
		    return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
		endif;
    }

    /**
     * function to get discover profiles
     */
    public function getDiscoverProfile(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $genObj=new FGeneral();
            $selQry="SELECT user_id,name,profile_pic,email,country_phone_code,mobile,country_id,gender_id,COALESCE(dob,'') AS dob,marital_status"
            . " FROM user_mas 
            WHERE del_flag=0 AND active_flag=1 AND (profile_complete_flag=1 || profile_complete_flag=3) AND user_id!=? AND user_id NOT IN (SELECT reported_user_id FROM user_reports WHERE user_id=?)";
            $result=$dbObj->query($selQry, array($_POST["user_id"], $_POST["user_id"]))->fetchObjList();
            if($dbObj->getNumRows()>0):
                $profilesArr=array();
                foreach($result AS $item):
                    $profilePic=BASE_PATH."/images/profilegallery/default_profile_pic.jpg";
                    if($item->profile_pic!=''):
                        $profilePic=BASE_PATH."/images/profilegallery/".$item->profile_pic;
                    endif;

                    $dob="";
                    $age="";
                    if($item->dob!=''):
                        $age = (date('Y') - date('Y',strtotime($item->dob)));
                        $dob=$genObj->dateToDisplay($item->dob);
                    endif;
                    $profileGallery=array();
                    $galleryResArr=json_decode($this->getProfileGallery($item->user_id));
                    if($galleryResArr->code==200):
                        $profileGallery=$galleryResArr->images;
                    endif;
                    $profilesArr[]=array(
                        "user_id"=>$item->user_id,
                        "name"=>$item->name,
                        "age"=>$age,
                        "profile_pic"=>$profilePic,
                        "email"=>$item->email,
                        "country_phone_code"=>$item->country_phone_code,
                        "mobile"=>$item->mobile,
                        "country_id"=>$item->country_id,
                        "gender_id"=>$item->gender_id,
                        "dob"=>$dob,
                        "marital_status"=>$item->marital_status,
                        "gallery"=>$profileGallery
                    );
                endforeach;
                return json_encode(array(
                    "code"=>200,
                    "profiles"=>$profilesArr
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Record not found."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get lets keywords
     */
    public function getLetsKeywords(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $dataArr=array();
            $selQry="SELECT lets_keyword_id,lets_keyword "
            . " FROM lets_keywords_mas"
            . " WHERE del_flag=0 AND active_flag=1";
            if(isset($_POST["search_key"]) && $_POST["search_key"]!=""):
                $searchKey = '%' . strtolower(str_replace(' ', '', trim($_POST["search_key"]))). '%';
                $dataArr[] = $searchKey;
                $selQry .= " AND LOWER(REPLACE(lets_keyword, ' ', '')) LIKE ? ";
            endif;
            $selQry=$selQry." ORDER BY lets_keyword ASC";
            $result=$dbObj->query($selQry,$dataArr)->fetchObjList();
            if($dbObj->getNumRows()>0):
                $keywordsArr=array();
                foreach($result AS $item):
                    $keywordsArr[]=array(
                       "lets_keyword_id"=>$item->lets_keyword_id,
                       "lets_keyword"=>$item->lets_keyword

                    );
                endforeach;
                return json_encode(array(
                    "code"=>200,
                    "keywords"=>$keywordsArr
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Record not found."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to save the users lets
     */
    public function saveLets(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $userID=$_POST["user_id"];
            $letsText=$_POST["lets_text"];
            $letsKeywordID=0;
            if(isset($_POST["lets_keyword_id"]) && $_POST["lets_keyword_id"]!=""):
                $letsKeywordID=$_POST["lets_keyword_id"];
            endif;
            $letsDuration=$_POST["minutes"];
            $genderID=$_POST["gender"];
            $dbObj = $this->_dbObj;

            // check lets for restricted keywords
            $restictedKeyword = '%' . strtolower(str_replace(' ', '', trim($_POST["lets_text"]))). '%';
            $dbObj->query("SELECT keyword_id "
            . " FROM restricted_keywords"
            . " WHERE del_flag=0"
            . " AND LOWER(REPLACE(keyword_text, ' ', '')) LIKE ? ",array($restictedKeyword));
            if($dbObj->getNumRows()>0):
                return json_encode(array("code" => 502, "message" => "Lets contain some restricted keywords."));
            endif;

            //Check Subscription plan_type:1-General, 2-Package
            $selQry = "SELECT a.subscription_id,a.num_of_lets,a.plan_type,a.expiry_date,a.added_date,b.cap_perday"
            . " FROM user_subscription AS a"
            . " LEFT OUTER JOIN subscription_plans AS b ON a.subscription_plan_id=b.subscription_plan_id"
            . " WHERE a.user_id=? AND a.expiry_date>=? AND a.del_flag=0 ORDER BY a.subscription_id DESC LIMIT 0,1";
			$dbObj->query($selQry,array($userID,date("Y-m-d")));
            if($dbObj->getNumRows()>0):
				$result=$dbObj->fetchObj();
                $planType=$result->plan_type;
                $subscriptionID=$result->subscription_id;
                $numOfLets=$result->num_of_lets;
                $startDate=$result->added_date;
                $expiryDate=$result->expiry_date;
                $capPerDay=$result->cap_perday;

                if($planType==1):
                    // general
                    $totLetsDone = 0;
                    $selQry="SELECT lets_id"
                    . " FROM lets_request"
                    . " WHERE del_flag=0 AND user_id=? AND lets_status=3 AND added_date>=?";
					$dbObj->query($selQry,array($userID, $startDate));
					$totLetsDone = $dbObj->getNumRows();
                    if($totLetsDone>0):
                        if($totLetsDone>=$numOfLets):
                            return json_encode(array("code" => 504, "message" => "You have already used your all lets."));
                        endif;
                    endif;
                else:
                    //package
                    $totLetsDoneToday = 0;
                    $selQry="SELECT lets_id"
                    . " FROM lets_request"
                    . " WHERE del_flag=0 AND user_id=? AND lets_status=3 AND DATE(added_date)=?";
                    $dbObj->query($selQry,array($userID,date("Y-m-d")));
					$totLetsDoneToday = $dbObj->getNumRows();
                    if($totLetsDoneToday>0):                        
                        if($totLetsDoneToday>=$capPerDay):
                            return json_encode(array("code" => 505, "message" => "You have used your all lets for today."));
                        endif;
                    endif;
                endif;
            else:
                return json_encode(array("code" => 503, "message" => "User do not have any Subscribtion."));
            endif;

            // save lets
            $expriresAt=date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")) + $_POST["minutes"]*60);
            $dataArr=array($userID,$letsText,$letsKeywordID,$letsDuration,$genderID,$expriresAt,date("Y-m-d H:i:s"));
            $insQry="INSERT INTO lets_request (user_id,lets_text,lets_keyword_id,lets_duration,gender_id,expires_at,added_date) VALUES(?,?,?,?,?,?,?)";
            $result=$dbObj->query($insQry,$dataArr);
            if($result):
                $letsID=$dbObj->getLastInsID();
                return json_encode(array(
                    "code"=>200,
                    "lets_id"=>$letsID,
                    "lets_in_seconds"=>$letsDuration*60,
                    "message"=>"Yours Lets created successfully."
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get running lets details
     */
    public function getRunningLets(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $selQry="SELECT lets_id,user_id,lets_text,lets_keyword_id,lets_duration,gender_id,expires_at,accepted_user_flag,accepted_user_id,lets_status,added_date"
            . " FROM lets_request"
            . " WHERE (user_id=? || accepted_user_id=?) AND active_flag=1 AND del_flag=0 AND expires_at>? AND lets_status!=2"
            . " ORDER BY added_date DESC"
            . " LIMIT 0,1";
            $result=$dbObj->query($selQry,array($_POST["user_id"],$_POST["user_id"],date("Y-m-d H:i:s")))->fetchObj();
            if($dbObj->getNumRows()>0):
                return json_encode(array(
                    "code"=>200,
                    "lets_id"=>$result->lets_id,
                    "user_id"=>$result->user_id,
                    "lets_text"=>$result->lets_text,
                    "lets_keyword_id"=>$result->lets_keyword_id,
                    "lets_duration"=>$result->lets_duration,
                    "gender_id"=>$result->gender_id,
                    "accepted_user_flag"=>$result->accepted_user_flag,
                    "accepted_user_id"=>$result->accepted_user_id,
                    "lets_status"=>$result->lets_status,
                    "remaining_secs"=>strtotime($result->expires_at) - strtotime(date("y-m-d H:i:s"))
                ));
            endif;
            return json_encode(array("code" => 500, "message" => "No running lets found."));
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }


	/**
    * Function to get all tags
    */
    public function getTags() {
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $result = $this->_dbObj->query("SELECT a.tag_id,a.tag_name,COALESCE(b.tag_id,0) AS tag_flag
            FROM tag_mas AS a
            LEFT OUTER JOIN user_tag AS b ON b.tag_id=a.tag_id AND b.del_flag=0 AND b.user_id=?
            WHERE a.del_flag=0 AND a.active_flag=1",array($_POST["user_id"]))->fetchObjList();
            if($result):
                $resultArr = array();
                $genderID=$this->getUserGender($_POST["user_id"]);
                foreach($result as $item):
                    if($item->tag_flag>0):
                        $flag="true";
                    else:
                        $flag="false";
                    endif;
                    if($genderID == 2 && $item->tag_id == 4):

                    else:
                        $resultArr[] = array(
                            "tag_id" => $item->tag_id,
                            "tag_name" => $item->tag_name,
                            "tag_flag" => $flag
                        );
                    endif;
                endforeach;
            return json_encode(array("code" => 200, "result" => $resultArr));
            else:
                return json_encode(array("code"=>500));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get user gender
     */
    public function getUserGender($userID){
        $dbObj = $this->_dbObj;
        $selQry="SELECT gender_id FROM user_mas WHERE del_flag=0 AND active_flag=1 AND user_id=?";
        $result = $dbObj->query($selQry,array($userID))->fetchObj();
        if($dbObj->getNumRows()>0):
            return $result->gender_id;
        else:
            return 0;
        endif;
    }

    /**
     * function to save the users tags
     */
    public function saveProfileTags(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $userID=$_POST["user_id"];
            $dbObj = $this->_dbObj;
            foreach($_POST["unselect_tag_id"] AS $unSelectedTagID):
                $dataArr=array($userID,$unSelectedTagID);
                $delQry="DELETE FROM user_tag WHERE user_id=? AND tag_id=? AND del_flag=0";
                $dbObj->query($delQry,$dataArr);
            endforeach;
            foreach($_POST["select_tag_id"] AS $selectedTagID):
                $selQry="SELECT user_id FROM user_tag WHERE user_id=? AND tag_id=? AND del_flag=0";
                $result=$dbObj->query($selQry,array($userID,$selectedTagID))->fetchObj();
                if($dbObj->getNumRows()==0):
                    $dataArr=array($userID,$selectedTagID,date("Y-m-d H:i:s"));
                    $insQry="INSERT INTO user_tag (user_id,tag_id,added_date) VALUES(?,?,?)";
                    $dbObj->query($insQry,$dataArr);
                endif;
            endforeach;
            return json_encode(array(
                "code"=>200,
                "message"=>"Tags added successfully."
            ));
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
    * Function to get all lets tags
    */
    public function getLetsTags() {
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $result = $this->_dbObj->query("SELECT a.tag_id,b.tag_name
                                            FROM user_tag AS a
                                            INNER JOIN tag_mas AS b ON b.tag_id=a.tag_id AND b.del_flag=0 AND b.active_flag=1
                                            WHERE a.del_flag=0 AND a.user_id=?",array($_POST["user_id"]))->fetchObjList();
            $resultArr = array();
            if($this->_dbObj->getNumRows()>0):
                foreach($result as $item):
                    $resultArr[] = array(
                        "tag_id" => $item->tag_id,
                        "tag_name" => $item->tag_name
                    );
                endforeach;
            else:
                $result = $this->_dbObj->query("SELECT tag_id,tag_name FROM tag_mas WHERE del_flag=0")->fetchObjList();
                foreach($result as $item):
                    $resultArr[] = array(
                        "tag_id" => $item->tag_id,
                        "tag_name" => $item->tag_name
                    );
                endforeach;
            endif;
            return json_encode(array("code" => 200, "data" =>$resultArr));
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to updateing running lets to cancel
     */
    public function cancelLets(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $letsID=$_POST["lets_id"];
            $upQry="UPDATE lets_request SET lets_status=2 WHERE lets_id=?";
            $result=$dbObj->query($upQry,array($letsID));
            if($result):
                $selQry="SELECT accepted_user_id FROM lets_request WHERE lets_id=?";
                $result=$dbObj->query($selQry,array($letsID))->fetchObj();
                if($dbObj->getNumRows()>0):
                    $partnerID=$result->accepted_user_id;
                    if($partnerID>0):
                        return json_encode(array(
                            "code"=>200,
                            "partner_socket_id"=>$this.getUserSocketID($partnerID),
                            "message"=>"Lets got cancelled successfully."
                        ));
                    else:
                        return json_encode(array(
                            "code"=>200,
                            "partner_socket_id"=>"",
                            "message"=>"Lets got cancelled successfully."
                        ));
                    endif;
                else:
                    return json_encode(array(
                        "code"=>200,
                        "partner_socket_id"=>"",
                        "message"=>"Lets got cancelled successfully."
                    ));
                endif;
                return json_encode(array(
                    "code"=>200,
                    "partner_socket_id"=>"",
                    "message"=>"Lets got cancelled successfully."
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

     /**
     * function to updateing expire lets
     */
    public function setLetsExpired(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $selQry="SELECT lets_id FROM lets_request WHERE user_id=? AND active_flag=1 AND del_flag=0 AND expires_at<? AND lets_status=0";
            $result=$dbObj->query($selQry,array($_POST["user_id"],date("Y-m-d H:i:s")))->fetchObj();
            if($dbObj->getNumRows()>0):
                $upQry="UPDATE lets_request SET lets_status=1 WHERE lets_id=? AND user_id=?";
                $result=$dbObj->query($upQry,array($result->lets_id,$_POST["user_id"]));
                if($result):
                    return json_encode(array(
                        "code"=>200,
                        "message"=>"Lets got expired successfully."
                    ));
                else:
                    return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
                endif;
            else:
                return json_encode(array("code" => 500, "message" => "No running lets found."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }


    /**
     * function to get lets accepted user
     */
    public function checkLetsAcceptdPartner(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $selQry="SELECT accepted_user_id,lets_id
                    FROM lets_request
                    WHERE user_id=? AND active_flag=1 AND del_flag=0 AND expires_at>? AND lets_status=0 AND accepted_user_flag=1";
            $result=$dbObj->query($selQry,array($_POST["user_id"],date("Y-m-d H:i:s")))->fetchObj();
            if($dbObj->getNumRows()>0):
                return json_encode(array(
                    "code"=>200,
                    "lets_id"=>$result->lets_id,
                    "accepted_user_id"=>$result->accepted_user_id
                ));
            else:
                return json_encode(array("code" => 500, "message" => "No user has been accepted lets."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

     /**
     * function to get lets accepted user details
     */
    public function getLetsPartnerDetails(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["lets_id"]) && $_POST["lets_id"]!="" && isset($_POST["accepted_user_id"]) && $_POST["accepted_user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $genObj=new FGeneral();
            $selQry="SELECT a.lets_id,a.user_id,a.accepted_user_id,b.name,COALESCE(b.dob,'') AS dob,b.vaccination_status,accepted_user_lat,accepted_user_lng
            FROM lets_request AS a
            INNER JOIN user_mas AS b ON b.user_id=a.accepted_user_id AND b.active_flag=1 AND b.del_flag=0
            WHERE a.del_flag=0 AND a.active_flag=1  AND a.lets_status=0 AND a.accepted_user_flag=1 AND a.accepted_user_id=? AND a.lets_id=?";
            $result=$dbObj->query($selQry,array($_POST["accepted_user_id"],$_POST["lets_id"]))->fetchObj();
            if($dbObj->getNumRows()>0):
                $age = "";
                if($result->dob!=""):
                    $age = (date('Y') - date('Y',strtotime($result->dob)));
                endif;
                $profileGallery=array();
                $galleryResArr=json_decode($this->getProfileGallery($result->accepted_user_id));
                if($galleryResArr->code==200):
                    $profileGallery=$galleryResArr->images;
                endif;
                $vaccination = "";
                if($result->vaccination_status==0):
                    $vaccination="I am not vaccinated";
                elseif($result->vaccination_status==1):
                    $vaccination="I am not vaccinated";
                elseif($result->vaccination_status==2):
                    $vaccination="I am Partially vaccinated";
                elseif($result->vaccination_status==3):
                    $vaccination="I am vaccinated";
                endif;
                return json_encode(array(
                    "code"=>200,
                    "user_id"=>$result->accepted_user_id,
                    "accepted_user_lat"=>$result->accepted_user_lat,
                    "accepted_user_lng"=>$result->accepted_user_lng,
                    "name"=>$result->name,
                    "age"=>$age,
                    "vaccination_status"=>$result->vaccination_status,
                    "vaccination"=>$vaccination,
                    "gallery"=>$profileGallery
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Record not found."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

     /**
     * function to gett the user profile pic gallery
     */
    public function getletSelfiGallery($letsID,$userID){
		$result=$this->_dbObj->query("SELECT lets_selfi_id,img_name
            FROM lets_selfi_pics
            WHERE lets_id=? AND user_id=? AND del_flag=0
            ORDER BY img_ord ASC",array($letsID,$userID))->fetchObjList();
            if($this->_dbObj->getNumRows()>0):
                $imagesArr=array();
                foreach($result AS $item):
                    $imagesArr[]=array(
                        "lets_selfi_id"=>$item->lets_selfi_id,
                        "img_url"=>BASE_PATH."/images/letsselfi/".$item->img_name
                    );
                endforeach;
                return json_encode(array(
                    "code" => 200,
                    "images" => $imagesArr
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Images not available."
                ));
            endif;
    }

    /**
     * function to accept lets partner
     */
    public function acceptLetsPartner(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $partnerID=$_POST["accepted_user_id"];
            $letsID=$_POST["lets_id"];
            $upQry="UPDATE lets_request SET lets_status=3 WHERE lets_id=?";
            $result=$dbObj->query($upQry,array($letsID));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "partner_socket_id"=>$this->getUserSocketID($partnerID),
                    "message"=>"Partner accepted, Lets completed successfully"
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to reject the lets partner
     */
    public function rejectLetsPartner(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $letsID=$_POST["lets_id"];
            $partnerID=$_POST["accepted_user_id"];
            $upQry="UPDATE lets_request SET accepted_user_flag=0,accepted_user_id=0 WHERE lets_id=?";
            $result=$dbObj->query($upQry,array($letsID));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "partner_socket_id"=>$this->getUserSocketID($partnerID),
                    "message"=>"Partner rejected successfully"
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to check lets request
     */
    public function checkLetsRequest(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $selQry="SELECT lets_id
                    FROM lets_request
                    WHERE user_id!=? AND active_flag=1 AND del_flag=0 AND expires_at>? AND lets_status=0 AND accepted_user_flag=0";
            $result=$dbObj->query($selQry,array($_POST["user_id"],date("Y-m-d H:i:s")))->fetchObj();
            if($dbObj->getNumRows()>0):
                return json_encode(array("code"=>200));
            else:
                return json_encode(array("code" => 500, "message" => "No lets request are available."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

     /**
     * function to get active lets request
     */
    public function getLetsRequest(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $selQry="SELECT a.lets_id,a.user_id,a.lets_text,a.locality,a.lets_lat,a.lets_lng,b.name,b.profile_pic,COALESCE(b.dob,'') AS dob,b.vaccination_status,COALESCE(d.lets_id,0) AS reported_lets_id
            FROM lets_request AS a
            INNER JOIN user_mas AS b ON b.user_id=a.user_id AND a.active_flag=1 AND a.del_flag=0
            LEFT OUTER JOIN ignored_lets AS c ON c.lets_id=a.lets_id AND c.user_id=" . $_POST["user_id"] . " AND c.del_flag=0
            LEFT OUTER JOIN lets_reports AS d ON d.lets_id=a.lets_id AND d.user_id=" . $_POST["user_id"] . " AND d.del_flag=0
            WHERE a.user_id!=? AND a.active_flag=1 AND a.del_flag=0 AND a.expires_at>? AND a.lets_status=0 AND a.accepted_user_flag=0 AND (a.lets_id!=COALESCE(c.lets_id,0))
            GROUP BY a.lets_id";
            $result=$dbObj->query($selQry,array($_POST["user_id"],date("Y-m-d H:i:s")))->fetchObjList();
            if($dbObj->getNumRows()>0):
                $dataArr=array();
                foreach($result AS $item):
                    $profilePic=BASE_PATH."/images/profilegallery/default_profile_pic.jpg";
                    if($item->profile_pic!=''):
                        $profilePic=BASE_PATH."/images/profilegallery/".$item->profile_pic;
                    endif;
                    $age = "";
                    if($item->dob!=""):
                        $age = (date('Y') - date('Y',strtotime($item->dob)));
                    endif;
                    $reportFlag=0;
                    if($item->reported_lets_id>0):
                        $reportFlag=1;
                    endif;
                    $vaccination = "";
                    if($item->vaccination_status==0):
                        $vaccination="I am not vaccinated";
                    elseif($item->vaccination_status==1):
                        $vaccination="I am not vaccinated";
                    elseif($item->vaccination_status==2):
                        $vaccination="I am Partially vaccinated";
                    elseif($item->vaccination_status==3):
                        $vaccination="I am vaccinated";
                    endif;
                    $dataArr[]=array(
                        "lets_id"=>$item->lets_id,
                        "user_id"=>$item->user_id,
                        "lets_text"=>$item->lets_text,
                        "name"=>$item->name,
                        "age"=>$age,
                        "vaccination"=>$vaccination,
                        "vaccination_status"=>$item->vaccination_status,
                        "locality"=>$item->locality,
                        "lets_lat"=>$item->lets_lat,
                        "lets_lng"=>$item->lets_lng,
                        "profile_pic"=>$profilePic,
                        "report_flag"=>$reportFlag
                    );
                endforeach;
                return json_encode(array("code"=>200,"data"=>$dataArr));
            else:
                return json_encode(array("code" => 500, "message" => "No lets request are available."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

   /**
    * function to upload lets request selfi
    */
    public function uploadLetsReqSelfi(){
		$confObj = new FConfig();
        $clientKey = $confObj->clientKey;
		if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
			$dbObj = $this->_dbObj;
            $genObj = new FGeneral();
            $letsID=$_POST["lets_id"];
            $letsSelfiID=$_POST["lets_selfi_id"];
            $imgOrd=$_POST["img_ord"];
			$fileParts = pathinfo($_FILES["file"]["name"]);
			$ext = strtolower($fileParts['extension']);
			if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'bmp'):
				$newImg = 'selfi'.$imgOrd.'_' . md5(uniqid(time(), true)) . '.jpeg';
				move_uploaded_file($_FILES["file"]["tmp_name"], ROOT . "/images/letsselfi/" . $newImg);

                if($letsSelfiID==0):
                    $selQry="SELECT lets_selfi_id FROM lets_selfi_pics WHERE lets_id=? AND user_id=? AND img_ord=?";
                    $dbObj->query($selQry,array($letsID,$_POST["user_id"],$imgOrd))->fetchObj();
                    if($dbObj->getNumRows()>0):
                        $dbObj->query("DELETE FROM lets_selfi_pics WHERE lets_id=? AND user_id=? AND img_ord=?",array($letsID,$_POST["user_id"],$imgOrd));
                    endif;
                    $dataArr = array($letsID,$_POST["user_id"], $newImg,$imgOrd, date("Y-m-d H:i:s"));
                    $result =$dbObj->query("INSERT INTO lets_selfi_pics (lets_id,user_id,img_name,img_ord,added_date) VALUES(?,?,?,?,?)",$dataArr);
                else:
                    $dataArr = array($newImg, date("Y-m-d H:i:s"),$letsSelfiID);
                    $result =$dbObj->query("UPDATE lets_selfi_pics SET img_name=?,added_date=? WHERE lets_selfi_id=?",$dataArr);
                endif;
                if($result):
                    $letsSelfiID=$dbObj->getLastInsID();
					// $imagePath = $genObj->imageResize("/images/letsselfi/".$newImg, 126, 126, '1:1');
                    return json_encode(array("code" => 200,
                        "lets_selfi_id"=>$letsSelfiID,
                        "image" => $newImg,
                        "img_ord" =>$imgOrd,
                        "img_url"=>BASE_PATH."/images/letsselfi/".$newImg
                    ));

				else:
					return json_encode(array("code" => 500, "message" => "Something went wrong. Please try again later.."));
				endif;
			else:
				return json_encode(array("code" => 500, "message" => "Upload image of type jpeg|jpg|png|bmp"));
			endif;
		else:
		    return json_encode(array("code"=>500,"message"=>"Sorry! Could not process your request.."));
		endif;
    }

    /**
     * function to updateing lets request status
     */
    public function acceptLetsRequest(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $letsID=$_POST["lets_id"];
            $selQry="SELECT lets_id,user_id"
            . " FROM lets_request"
            . " WHERE lets_id=? AND active_flag=1 AND del_flag=0 AND expires_at>? AND lets_status=0 AND accepted_user_id=0 AND accepted_user_flag=0";
            $result=$dbObj->query($selQry,array($letsID,date("Y-m-d H:i:s")))->fetchObj();
            if($dbObj->getNumRows()>0):
                $letsUserID=$result->user_id;
                $upQry="UPDATE lets_request SET accepted_user_id=?,accepted_user_flag=?,accepted_user_lat=?,accepted_user_lng=? WHERE lets_id=?";
                $result=$dbObj->query($upQry,array($_POST["user_id"],1,$_POST["current_lat"],$_POST["current_lng"],$letsID));
                if($result):
                    return json_encode(array(
                        "code"=>200,
                        "lets_user_socket_id"=>$this->getUserSocketID($letsUserID)
                    ));
                else:
                    return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
                endif;
            else:
                return json_encode(array("code" => 500, "message" => "No running lets found."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get the user socket id
     */
    public function getUserSocketID($userID){
        $dbObj = $this->_dbObj;
        $result = $dbObj->query("SELECT socket_id FROM user_mas WHERE user_id=?",array($userID))->fetchObj();
        return $result->socket_id;
    }

    /**
     * function to ignore lets request
     */
    public function ignoreLetsRequest(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $upQry="INSERT INTO ignored_lets(lets_id,user_id,added_date) VALUES(?,?,?)";
            $result=$dbObj->query($upQry,array($_POST["lets_id"],$_POST["user_id"],date("Y-m-d H:i:s")));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"Ignored successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to report a Lets
     */
    public function reportLets(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $letsID=0;
            if(isset($_POST["lets_id"]) && $_POST["lets_id"]!=""):
                $letsID=$_POST["lets_id"];
            endif;
            $upQry="INSERT INTO lets_reports(lets_id,user_id,report_user_id,added_date) VALUES(?,?,?,?)";
            $result=$dbObj->query($upQry,array($letsID,$_POST["user_id"],$_POST["report_user_id"],date("Y-m-d H:i:s")));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"Reported successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to update the user location and device details
     */
    public function updateUserLocation(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $dataArr=array($_POST["current_lat"], $_POST["current_lang"], $_POST["user_id"]);
            $upQry="UPDATE user_mas SET current_lat=?,current_lng=? WHERE user_id=?";
            $result=$dbObj->query($upQry,$dataArr);
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"User location updated successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }
    /**
     * function to update the user location and device details
     */
    public function updateUserDeviceType(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $dataArr=array($_POST["device_type"], $_POST["user_id"]);
            $upQry="UPDATE user_mas SET last_device_type=? WHERE user_id=?";
            $result=$dbObj->query($upQry,$dataArr);
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"User device type updated successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }
    /**
     * function to update the user location and device details
     */
    public function updateUserDeviceID(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $dataArr=array($_POST["device_id"], $_POST["user_id"]);
            $upQry="UPDATE user_mas SET last_device_id=? WHERE user_id=?";
            $result=$dbObj->query($upQry,$dataArr);
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"User device id updated successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to update the lets location
     */
    public function updateLetsLocDetails(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $dataArr=array($_POST["current_address"], $_POST["current_lat"], $_POST["current_lng"], $_POST["lets_id"]);
            $upQry="UPDATE lets_request SET locality=?, lets_lat=?, lets_lng=? WHERE lets_id=?";
            $result=$dbObj->query($upQry,$dataArr);
            if($result):
                $lat = $_POST["current_lat"];
                $lng = $_POST["current_lng"];
				$gender=$this->getLetsGender($_POST["lets_id"]);
                $totalAvailableUsers = 0;
				// $dataArr=array($lat,$lat,$lng,$gender,$_POST["user_id"]);
                // $selQry = "SELECT user_id, socket_id, 6371 * 2 * ASIN(SQRT(POWER(SIN((? - abs(current_lat)) * pi()/180 / 2), 2)
                // + COS(? * pi()/180 ) * COS(abs(current_lat) * pi()/180)
                // * POWER(SIN((? - current_lng) * pi()/180 / 2), 2) )) as  distance
                // FROM user_mas WHERE del_flag=0 AND gender_id=? AND user_id!=?
                // HAVING distance < 1
                // ORDER BY distance
                // LIMIT 0,5";

                $dataArr=array($gender,$_POST["user_id"]);
				$selQry = "SELECT user_id, socket_id
                FROM user_mas WHERE del_flag=0 AND gender_id=? AND user_id!=?
                LIMIT 0,5";
                $result = $dbObj->query($selQry,$dataArr)->fetchObjList();
                $totalAvailableUsers=$dbObj->getNumRows();
                if($totalAvailableUsers>0):
                    $genObj=new FGeneral();
                    foreach($result AS $item):
                        $genObj->sendPushNotification($item->user_id, "New Lets Request", "You have a new lets near you.");
						$this->sendLetsSocket($item->socket_id);
                    endforeach;
                else:
                    $upQry="UPDATE lets_request SET lets_status=2 WHERE lets_id=?";
                    $result=$dbObj->query($upQry,array($_POST["lets_id"]));
                    return json_encode(array(
                        "code"=>201,
                        "message"=>"Lets cancelled. No nearby user found."
                    ));
                endif;
				
                return json_encode(array(
                    "code"=>200,
                    "total_available_users"=>$totalAvailableUsers,
                    "message"=>"Lets location details updated successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }
	/**
	* Function to get Lets Gender
	*/
	public function getLetsGender($letsID){
		$this->_dbObj->query("SELECT gender_id FROM lets_request WHERE lets_id=?",array($letsID));
		return $this->_dbObj->fetchObj()->gender_id;
	}
	/**
	* Function to send the Socket Notification
	*/
	public function sendLetsSocket($socketID){			
		//Socket to Send Lets Notification
		$curlURL="http://147.139.1.65/task.emitter.php?param=".$_POST["lets_id"]."&param1=".$socketID;
		$cURLConnection = curl_init();
		curl_setopt($cURLConnection, CURLOPT_URL,$curlURL);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
		$curlResult = curl_exec($cURLConnection);
		curl_close($cURLConnection);
	}

    /**
     * function to cancel the lets accepted by user
     */
    public function cancelLetsByReceiver(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $userID=$_POST["user_id"];
            $upQry="UPDATE lets_request SET lets_status=4,accepted_user_flag=0,accepted_user_id=0,accepted_user_lat=0,accepted_user_lng=0 WHERE lets_id=?";
            $result=$dbObj->query($upQry,array($_POST["lets_id"]));
            if($result):
                $selQry="SELECT user_id,accepted_user_lat,accepted_user_lng FROM lets_request WHERE lets_id=?";
                $result=$dbObj->query($selQry,array($_POST["lets_id"]))->fetchObj();
                if($result):
                    $letsUserID=$result->user_id;
                    $insQry="INSERT INTO lets_receiver_log(lets_id,receiver_id,log_flag,receiver_lat,receiver_lng,added_date) VALUES(?,?,?,?,?,?)";
                    $result=$dbObj->query($insQry,array($_POST["lets_id"],$_POST["user_id"],2,$result->accepted_user_lat,$result->accepted_user_lng,date("Y-m-d H:i:s")));
                    if($result):
                        return json_encode(array(
                            "code"=>200,
                            "lets_user_socket_id"=>$this->getUserSocketID($letsUserID),
                            "message"=>"Cancelled successfully."
                        ));
                    else:
                        return json_encode(array("code"=>500,"message"=>"Sorry! Could not process your request.."));
                    endif;
                else:
                    return json_encode(array("code"=>500,"message"=>"Sorry! Could not process your request.."));
                endif;
            else:
                return json_encode(array("code"=>500,"message"=>"Sorry! Could not process your request.."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get subscription plan and packages
     * 1-Plan, 2-Packages
     */
    public function getSubscriptionPlans(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $planType=$_POST["plan_type"];
            $selQry="SELECT subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,cap_perday,apple_product_key,active_flag"
            . " FROM subscription_plans"
            . " WHERE active_flag=1 AND del_flag=0 AND plan_type=?";
            $result = $dbObj->query($selQry,array($planType))->fetchObjList();
            if($dbObj->getNumRows()>0):
                $plansArr=array();
                foreach($result AS $item):
                    $capPerDay=$item->cap_perday;
                    $validityInMonths="";
                    if($planType==2):
                        $validityInMonths = floor($item->validity_days/30);
                    endif;
                    $plansArr[]=array(
                        "subscription_plan_id"=>$item->subscription_plan_id,
                        "plan_type"=>$item->plan_type,
                        "plan_price"=>$item->plan_price,
                        "discount_price"=>$item->discount_price,
                        "num_of_lets"=>$item->num_of_lets,
                        "validity_days"=>$item->validity_days,
                        "validiity_months"=>$validityInMonths,
						"apple_product_key"=>$item->apple_product_key
                    );
                endforeach;
                return json_encode(array(
                    "code"=>200,
                    "plans"=>$plansArr,
                    "cap_perday"=>$capPerDay
                ));
            else:
                return json_encode(array("code"=>500,"message"=>"Records not found."));
            endif;

        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to save the temp subscription
     */
    public function saveTempSubscription(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $userID=$_POST["user_id"];
            $subscriptionPlanID=$_POST["subscription_plan_id"];
            $payableAmt=$_POST["payable_amt"];
            $selQry="SELECT subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,active_flag"
            . " FROM subscription_plans"
            . " WHERE active_flag=1 AND del_flag=0 AND subscription_plan_id=?";
            $result = $dbObj->query($selQry,array($subscriptionPlanID))->fetchObj();
            if($dbObj->getNumRows()>0):
                $dataArr=array($userID,$result->subscription_plan_id,$result->plan_type,$result->plan_price,$result->discount_price,$result->num_of_lets,$result->validity_days,$payableAmt,date('Y-m-d', strtotime(" + " . $result->validity_days . " days")),date("Y-m-d H:i:s"));
                $insQry="INSERT INTO temp_user_subscription(user_id,subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,payable_amt,expiry_date,added_date) VALUES(?,?,?,?,?,?,?,?,?,?)";
                $result = $dbObj->query($insQry,$dataArr);
                if($result):
                    $tempSubscriptionID= $dbObj->getLastInsID();
                    return json_encode(array(
                        "code"=>200,
                        "temp_subscription_id"=>$tempSubscriptionID
                    ));
                else:

                endif;
            else:
                return json_encode(array("code"=>500,"message"=>"Sorry!! something went wrong. Try again."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * Function to save User Subscription
     */
    public function saveIOSSubscription(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["p_id"]) && $_POST["p_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $userID = $_POST["user_id"];
            $transactionDevice=1;
            $transactionID = '';
            if(isset($_POST["transaction_id"]) && $_POST["transaction_id"]!=''):
                $transactionID = $_POST["transaction_id"];
            endif;
            if(isset($_POST["transaction_device"]) && $_POST["transaction_device"]!=''):
                $transactionDevice = $_POST["transaction_device"];
            endif;

            
            //Check any Active Subscription
            // $dbObj->query("SELECT subscription_id FROM user_subscription WHERE user_id=? AND expiry_date>=? AND del_flag=0",array($_POST["user_id"], date("Y-m-d H:i:s")));
            // if($dbObj->getNumRows()>0):
            //     $item = $dbObj->fetchObj();
            //     $dbObj->query("UPDATE user_subscription SET del_flag=1 WHERE subscription_id=?",array($item->subscription_id));
            // endif;
            $dbObj->query("UPDATE user_subscription SET del_flag=1 WHERE user_id=?",array($userID));
            //Insert into Subscription
            $selQry="SELECT subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,active_flag"
            . " FROM subscription_plans"
            . " WHERE active_flag=1 AND del_flag=0 AND apple_product_key=?";
            $result = $dbObj->query($selQry,array($_POST["p_id"]))->fetchObj();
            if($dbObj->getNumRows()>0):
                $dataArr=array($userID,$result->subscription_plan_id,$result->plan_type,$result->plan_price,$result->discount_price,$result->num_of_lets,$result->validity_days,$result->discount_price,date('Y-m-d', strtotime(" + " . $result->validity_days . " days")),$transactionDevice,$transactionID,date("Y-m-d H:i:s"));
                $insQry="INSERT INTO user_subscription (user_id,subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,payable_amt,expiry_date,transaction_device, transaction_id, added_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                $result = $dbObj->query($insQry,$dataArr);
                if($result):
                    $subscriptionID= $dbObj->getLastInsID();
                    return json_encode(array(
                        "code"=>200,
                        "subscription_id"=>$subscriptionID
                    ));
                else:
                    return json_encode(array(
                        "code"=>500,
                        "message"=>"Something went wrong. Try again."
                    ));
                endif;
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Something went wrong. Try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to save the subscription
     */
    public function saveSubscription(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["temp_subscription_id"]) && $_POST["temp_subscription_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            
            $insQry="INSERT into user_subscription(user_id,subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,payable_amt,expiry_date,added_date) "
            . " (SELECT user_id,subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,payable_amt,expiry_date,?"
            . " FROM temp_user_subscription"
            . " WHERE temp_subscription_id=?)";
            $result= $dbObj->query($insQry,array(date("Y-m-d H:i:s"),$_POST["temp_subscription_id"]));
            if($result):
                $subscriptionID= $dbObj->getLastInsID();
                return json_encode(array(
                    "code"=>200,
                    "subscription_id"=>$subscriptionID
                ));
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Something went wrong. Try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to save the pet type
     */
    public function savePetType(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $petType=$_POST["pet_type"];
            $petTypeText="";
            if($petType==3):
                $petTypeText=$_POST["pet_type_text"];
            endif;
            $userID=$_POST["user_id"];
            $upQry="UPDATE user_mas SET pet_type=?, pet_type_text=? WHERE user_id=?";
            $result=$dbObj->query($upQry,array($petType,$petTypeText,$userID));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"Saved successfully."
                ));
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Something went wrong. Try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /***
     * function to get the user subscription
     */
    public function getUserSubscription(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $selQry = "SELECT subscription_plan_id,plan_type,plan_price,discount_price,num_of_lets,validity_days,payable_amt,expiry_date FROM user_subscription WHERE del_flag=0 AND user_id=? AND expiry_date>?";
            $result =$dbObj->query($selQry,array($_POST["user_id"],date("Y-m-d")))->fetchObj();
            if($dbObj->getNumRows()>0):
                $validityInMonths="";
                    if($result->plan_type==2):
                        $validityInMonths = floor($result->validity_days/30);
                    endif;
                return json_encode(array(
                    "code"=>200,
                    "subscription_plan_id"=>$result->subscription_plan_id,
                    "plan_type"=>$result->plan_type,
                    "plan_price"=>$result->plan_price,
                    "discount_price"=>$result->discount_price,
                    "num_of_lets"=>$result->num_of_lets,
                    "validity_days"=>$result->validity_days,
                    "payable_amt"=>$result->payable_amt,
                    "expiry_date"=>date("d-M-Y",strtotime($result->expiry_date)),
                    "validiity_months"=>$validityInMonths
                ));
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Records not found"
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to update user socket id
     */
    public function updateSocketID(){
        $confObj=new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $upQry="UPDATE user_mas SET socket_id=? WHERE user_id=?";
            $result=$dbObj->query($upQry,array($_POST["socket_id"],$_POST["user_id"]));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"Updated successfully."
                ));
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Sorry!! something went wrong.Try again."
                ));
            endif;
        else:
            return json_encode(array(
                "code"=>501,
                "message"=>"Sorry!! could not process your request."
            ));
        endif;
    }

     /**
     * function to save the fcm token to server
     */
    public function saveFCMTokenToServer(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!=0 && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj=$this->_dbObj;
            $selQry = "SELECT id"
            . " FROM user_device WHERE device_id=? AND del_flag=0";
            $dbObj->query($selQry,array($_POST["device_id"]));
            if($dbObj->getNumRows()>0):
                $upQry="UPDATE user_device SET user_id=?,fcm_token_id=?,os_type=?,updated_date=? WHERE device_id=?";
                $result=$dbObj->query($upQry, array($_POST["user_id"],$_POST["token"],$_POST["os_platform"], date("Y-m-d H::s"), $_POST["device_id"]));
            else:
                $insQry = "INSERT INTO user_device(user_id,device_id,fcm_token_id,os_type,added_date) VALUES (?,?,?,?,?)";
                $result=$dbObj->query($insQry, array($_POST["user_id"],$_POST["device_id"],$_POST["token"],$_POST["os_platform"],date("Y-m-d H::s")));
            endif;
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"Updated successfully."
                ));
            else:
                return json_encode(array(
                    "code"=>500,
                    "message"=>"Sorry!! something went wrong. Try again."
                ));
            endif;
        else:
		    return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your requests.."));
		endif;
    }

    /**
     * funtion to save the lets request in temp table
     */
    public function saveTempLets(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $userID=$_POST["user_id"];
            $letsText=$_POST["lets_text"];
            $letsKeywordID=$_POST["lets_keyword_id"];
            $letsDuration=$_POST["minutes"];
            $genderID=$_POST["gender"];
            $dbObj = $this->_dbObj;

            // save lets
            $dataArr=array($userID,$letsText,$letsKeywordID,$letsDuration,$genderID,date("Y-m-d H:i:s"));
            $insQry="INSERT INTO temp_lets_request(user_id,lets_text,lets_keyword_id,lets_duration,gender_id,added_date) VALUES(?,?,?,?,?,?)";
            $result=$dbObj->query($insQry,$dataArr);
            if($result):
                $tempLetsID=$dbObj->getLastInsID();
                return json_encode(array(
                    "code"=>200,
                    "temp_lets_id"=>$tempLetsID,
                    "message"=>"Saved successfully."
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }
        /**
     * funtion to save the lets request in temp table
     */
    public function moveTempLetsToLetsRequest(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["temp_lets_id"]) && $_POST["temp_lets_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $result=$dbObj->query("SELECT user_id,lets_text,lets_keyword_id,lets_duration,gender_id FROM temp_lets_request WHERE temp_lets_id=? AND del_flag=0",array($_POST["temp_lets_id"]))->fetchObj();
            if($dbObj->getNumRows()>0):
                $userID=$result->user_id;
                $letsText=$result->lets_text;
                $letsKeywordID=$result->lets_keyword_id;
                $letsDuration=$result->lets_duration;
                $genderID=$result->gender_id;
                // save lets
                $expriresAt=date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")) + $letsDuration*60);
                $dataArr=array($userID,$letsText,$letsKeywordID,$letsDuration,$genderID,$expriresAt,date("Y-m-d H:i:s"));
                $insQry="INSERT INTO lets_request(user_id,lets_text,lets_keyword_id,lets_duration,gender_id,expires_at,added_date) VALUES(?,?,?,?,?,?,?)";
                $result=$dbObj->query($insQry,$dataArr);
                if($result):
                    $letsID=$dbObj->getLastInsID();
                    return json_encode(array(
                        "code"=>200,
                        "lets_id"=>$letsID,
                        "lets_in_seconds"=>$letsDuration*60,
                        "message"=>"Yours Lets created successfully."
                    ));
                else:
                    return json_encode(array("code" => 500, "message" => "Sorry!! something went wrong. Please try again."));
                endif;
            else:
                return json_encode(array("code" => 500, "message" => "No Pending lets."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get the users referral code
     */
    public function getReferrralCode(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $upQry="SELECT referral_code FROM user_mas WHERE user_id=?";
            $result=$dbObj->query($upQry,array($_POST["user_id"]))->fetchObj();
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "referral_code"=>$result->referral_code
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get active lets details
     */
    public function getActiveLetsDetails(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["lets_id"]) && $_POST["lets_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $genObj=new FGeneral();
            $selQry="SELECT a.lets_id,a.user_id,c.name,COALESCE(c.dob,'') AS dob,c.vaccination_status,a.lets_lat,a.lets_lng,
            a.accepted_user_id,b.name AS accepted_name,COALESCE(b.dob,'') AS accepted_dob,b.vaccination_status AS accepted_vaccination_status,a.accepted_user_lat,a.accepted_user_lng
            FROM lets_request AS a
            INNER JOIN user_mas AS b ON b.user_id=a.accepted_user_id AND b.active_flag=1 AND b.del_flag=0
            INNER JOIN user_mas AS c ON c.user_id=a.user_id AND c.active_flag=1 AND c.del_flag=0
            WHERE a.del_flag=0 AND a.active_flag=1 AND a.accepted_user_flag=1 AND a.lets_id=?";
            $result=$dbObj->query($selQry,array($_POST["lets_id"]))->fetchObj();
            if($dbObj->getNumRows()>0):
                $age = "";
                if($result->dob!=""):
                    $age = (date('Y') - date('Y',strtotime($result->dob)));
                endif;
                $acceptedAge = "";
                if($result->accepted_dob!=""):
                    $acceptedAge = (date('Y') - date('Y',strtotime($result->accepted_dob)));
                endif;
                $selfiGallery=array();
                $galleryResArr=json_decode($this->getletSelfiGallery($result->lets_id,$result->user_id));
                if($galleryResArr->code==200):
                    $selfiGallery=$galleryResArr->images;
                endif;
                $profileGallery=array();
                $galleryResArr=json_decode($this->getProfileGallery($result->user_id));
                if($galleryResArr->code==200):
                    $profileGallery=$galleryResArr->images;
                endif;
                $acceptedProfileGallery=array();
                $galleryResArr=json_decode($this->getProfileGallery($result->accepted_user_id));
                if($galleryResArr->code==200):
                    $acceptedProfileGallery=$galleryResArr->images;
                endif;
                $vaccination = "";
                if($result->vaccination_status==0):
                    $vaccination="I am not vaccinated";
                elseif($result->vaccination_status==1):
                    $vaccination="I am not vaccinated";
                elseif($result->vaccination_status==2):
                    $vaccination="I am Partially vaccinated";
                elseif($result->vaccination_status==3):
                    $vaccination="I am vaccinated";
                endif;
                $acceptedVaccination = "";
                if($result->accepted_vaccination_status==0):
                    $acceptedVaccination="I am not vaccinated";
                elseif($result->accepted_vaccination_status==1):
                    $acceptedVaccination="I am not vaccinated";
                elseif($result->accepted_vaccination_status==2):
                    $acceptedVaccination="I am Partially vaccinated";
                elseif($result->accepted_vaccination_status==3):
                    $acceptedVaccination="I am vaccinated";
                endif;
                return json_encode(array(
                    "code"=>200,
                    "user_id"=>$result->user_id,
                    "name"=>$result->name,
                    "age"=>$age,
                    "vaccination_status"=>$result->vaccination_status,
                    "vaccination"=>$vaccination,
                    "lets_lat"=>$result->lets_lat,
                    "lets_lng"=>$result->lets_lng,
                    "selfi_gallery"=>$selfiGallery,
                    "profile_gallery"=>$profileGallery,
                    "accepted_user_id"=>$result->accepted_user_id,
                    "accepted_name"=>$result->accepted_name,
                    "accepted_age"=>$acceptedAge,
                    "accepted_vaccination_status"=>$result->accepted_vaccination_status,
                    "accepted_vaccination"=>$acceptedVaccination,
                    "accepted_user_lat"=>$result->accepted_user_lat,
                    "accepted_user_lng"=>$result->accepted_user_lng,
                    "accepted_profile_gallery"=>$acceptedProfileGallery,
                ));
            else:
                return json_encode(array("code" => 500, "message" => "Record not found."));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to get all genders
     */
    public function getGenders() {
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $result = $this->_dbObj->query("SELECT tag_id,tag_name
            FROM tag_mas AS a
            WHERE del_flag=0 AND active_flag=1")->fetchObjList();
            if($result):
                $resultArr = array();
                foreach($result as $item):
                    $resultArr[] = array(
                        "tag_id" => $item->tag_id,
                        "tag_name" => $item->tag_name
                    );
                endforeach;
            return json_encode(array("code" => 200, "data" => $resultArr));
            else:
                return json_encode(array("code"=>500));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }

    /**
     * function to report a User
     */
    public function reportUser(){
        $confObj = new FConfig();
        $clientKey = $confObj->clientKey;
        if(isset($_POST["user_id"]) && $_POST["user_id"]!="" && isset($_POST["client_key"]) && $_POST["client_key"] == $clientKey):
            $dbObj = $this->_dbObj;
            $upQry="INSERT INTO user_reports(user_id,reported_user_id,added_date) VALUES(?,?,?)";
            $result=$dbObj->query($upQry,array($_POST["user_id"],$_POST["reported_user_id"],date("Y-m-d H:i:s")));
            if($result):
                return json_encode(array(
                    "code"=>200,
                    "message"=>"Reported successfully."
                ));
            else:
                return json_encode(array(
                    "code" => 500,
                    "message" => "Sorry!! something went wrong. Please try again."
                ));
            endif;
        else:
            return json_encode(array("code"=>501,"message"=>"Sorry! Could not process your request.."));
        endif;
    }
}
?>

