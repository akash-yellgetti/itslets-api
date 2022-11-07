<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $confObj->siteName; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_PATH . '/css/jquery-ui.css'; ?>"/>
        <link href="<?php echo BASE_PATH; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_PATH . '/css/datatables.min.css' ?>"/>
        <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/font-awesome/css/fontawesome.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_PATH . '/css/jquery.mCustomScrollbar.css' ?>"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_PATH . '/css/general.css' ?>"/>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo BASE_PATH . '/css/general.res.css' ?>"/>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/config.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/jquery.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/bootstrap/js/bootstrap.min.js'; ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/bootstrap/js/bootstrap.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BASE_PATH . '/jscript/datatables.min.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/fontawesome-all.min.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/jquery-ui.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/jquery.mCustomScrollbar.concat.min.js'; ?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo BASE_PATH . '/jscript/general.js'; ?>"></script>
        <?php echo $genObj->includeHeader(); ?>        
    </head>
    <body>
    <!--#Header-->
    <div class="dvheader">
        <div class="dvlogo">
        <a href="<?php echo BASE_PATH?>"><img src="<?php echo BASE_PATH."/images/itslets.png"?>" alt="Itslets App" /></a>
        </div>
        <a href="javascript:void(0);" class="menu-ico" onclick="showHideMenu()"></a>
        <div class="dvmenu">
            <ul class="ulmenu">
                <li class='limenu-title'>Menu</li>
                <li>
                    <a href="<?php echo BASE_PATH."/"?>" id='menu1' class="menu-lnk">HOME</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH."/about-us"?>"  id='menu2' class="menu-lnk">ABOUT</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH."/how-it-works"?>"  id='menu3' class="menu-lnk">HOW ITLETS WORK</a>
                </li>
                <!-- <li>
                    <a href="<?php echo BASE_PATH."/"?>" class="menu-lnk">PRICING</a>
                </li> -->
                <li>
                    <a href="https://brokensarcophagus.wordpress.com/" target="letsin_blogs" class="menu-lnk">BLOGS</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH."/contact-us"?>"  id='menu4' class="menu-lnk">CONTACT US</a>
                </li>
            </ul>
        </div>
    </div>      