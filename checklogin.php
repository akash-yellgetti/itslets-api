<?php
if (!$sessObj->check("m3p_partner_id")):
    header("Location:" . BASE_PATH."/partner" );
endif;
?>
