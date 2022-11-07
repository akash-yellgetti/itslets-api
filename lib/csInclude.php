<?php

/**
 * This website is developed by Favworks and all the codes are written by favworks.
 * Any changes to this website will be the violation of the copyright.
 * FInclude Class
 * @package       FavCMS
 */
class FInclude {

    /**
     * Contains the line end string
     *
     * @var        string
     * @access    private
     */
    static $_lineEnd = "\12";

    function getImport($url) {
        return "require_once('" . $url . "')";
    }

    function getFilePath($url) {
        $DS = DIRECTORY_SEPARATOR;
        $rootPath = str_replace("lib" , '', dirname(__FILE__));
        $path = $rootPath . $url;
        return $path;
    }

}

?>
