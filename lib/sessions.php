<?php

class FSessions
{

    function set($sessionVar, $sessionVal, $encType = 0, $sessFlag = 0)
    {
        $sessionID = FSessions::getSessionID();
        if ($encType == 1):
            $sessionVal = FGeneral::encodeString($sessionVal);
        endif;
        if ($sessFlag == 1):
            $sessionVal = $sessionVal . "-" . FGeneral::encodeString($sessionID);
        endif;
        $_SESSION[$sessionVar] = $sessionVal;
        return $_SESSION[$sessionVar];
    }

    function get($sessionVar, $encType = 0, $sessFlag = 0)
    {
        $sessionVal = $_SESSION[$sessionVar];
        if ($sessFlag == 1):
            $sessionValArr = explode("-", $sessionVal);
            $sessionVal = $sessionValArr[0];
        endif;

        if ($encType == 1):
            $sessionVal = FGeneral::decodeString($sessionVal);
        endif;
        return $sessionVal;
    }

    function getSessionID()
    {
        if (FSessions::get("sessionid")):
            return FSessions::get("sessionid");
        else:
            return session_id();
        endif;
    }

    function check($sessionVar)
    {
        if (isset($_SESSION[$sessionVar]) && $_SESSION[$sessionVar] != '') {
            return true;
        } else {
            return false;
        }
    }

    function destroy()
    {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_unset();
        session_destroy();
        return true;
    }

    function unsetSess($sessionVar)
    {
        unset($_SESSION[$sessionVar]);
        return true;
    }

}

?>