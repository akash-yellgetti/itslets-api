<?php

define('DS', DIRECTORY_SEPARATOR);
define('ABSOLUTE_PATH', dirname(__FILE__));
define('RELATIVE_PATH', 'main');
define('ROOT', str_replace(RELATIVE_PATH, "", ABSOLUTE_PATH));
require_once(ROOT . DS . 'includes.php');
require_once(ROOT . DS . RELATIVE_PATH . DS . 'model' . DS . 'model.php');

$modObj = new ModMain();
$result = $modObj->sendContact();

if ($result == 1):
    ?>
    <script language="javascript" type="text/javascript">
        window.parent.showPageMsg("passmsg","We have received your request. We'll get back to you shortly..");
        window.parent.document.FrmContact.action = "javascript:void(0);";  
        window.parent.$(".submitloader").replaceWith("<input type='submit' name='BtnContact' id='BtnContact' value='Send' class='btn-submit' />");
        window.parent.resetContactForm();
    </script>
    <?php

else:
    ?>
    <script language="javascript" type="text/javascript">
        window.parent.showPageMsg("failmsg","Sorry! Could not process your request. Please try again..");
        window.parent.document.FrmContact.action = "javascript:void(0);";  
    </script>
<?php

endif;
?>