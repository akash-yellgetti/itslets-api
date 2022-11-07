<?php

/**
 * This website is developed by Favworks and all the codes are written by favworks.
 * Any changes to this website will be the violation of the copyright.
 */

/**
 * FURI Class
 *
 * This class serves two purposes.  First to parse a URI and provide a common interface
 * for the FAVCMS Framework to access and manipulate a URI.  Second to attain the URI of
 * the current executing script from the server regardless of server.
 * @package       FavCMS
 */
class FURI extends FObject {

    var $_host = "";
    var $_query = "";
    var $_port = "";
    var $_vars = "";

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        return
                ($https ? 'https://' : 'http://') .
                (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
                        ($https && $_SERVER['SERVER_PORT'] === 443 ||
                        $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) .
                substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    function base() {
        $pageURL = 'http';
        if (!empty($_SERVER['HTTPS'])):
            $pageURL .= "s";
        endif;
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") :
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        else:
            $pageURL .= $_SERVER["SERVER_NAME"];
        endif;
        $pageURL.=FURI::getBasePath();
        $pageURL = substr($pageURL, 0, strpos($pageURL, ROOT_FOLDER)) . ROOT_FOLDER;
        return $pageURL;
    }

    function setURL($url) {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on"):
            $pageURL .= "s";
        endif;
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") :
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        else:
            $pageURL .= $_SERVER["SERVER_NAME"];
        endif;
        return $pageURL . "" . $url;
    }

    function getBasePath() {
        $uri = & FURI::getInstance();
        $base['prefix'] = $uri->toString(array('scheme', 'host', 'port'));

        if (strpos(php_sapi_name(), 'cgi') !== false && !empty($_SERVER['REQUEST_URI'])) {
            //Apache CGI
            $base['path'] = rtrim(dirname(str_replace(array('"', '<', '>', "'"), '', $_SERVER["PHP_SELF"])), '/\\');
        } else {
            //Others
            $base['path'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        }
        $pathonly = "";
        return $pathonly === false ? $base['prefix'] . $base['path'] . '/' : $base['path'];
    }

    function &getInstance($uri = 'SERVER') {
        static $instances = array();

        if (!isset($instances[$uri])) {
            // Are we obtaining the URI from the server?
            if ($uri == 'SERVER') {
                // Determine if the request was over SSL (HTTPS)
                if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) {
                    $https = 's://';
                } else {
                    $https = '://';
                }

                /*
                 * Since we are assigning the URI from the server variables, we first need
                 * to determine if we are running on apache or IIS.  If PHP_SELF and REQUEST_URI
                 * are present, we will assume we are running on apache.
                 */
                if (!empty($_SERVER['PHP_SELF']) && !empty($_SERVER['REQUEST_URI'])) {

                    /*
                     * To build the entire URI we need to prepend the protocol, and the http host
                     * to the URI string.
                     */
                    $theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                    /*
                     * Since we do not have REQUEST_URI to work with, we will assume we are
                     * running on IIS and will therefore need to work some magic with the SCRIPT_NAME and
                     * QUERY_STRING environment variables.
                     */

                    if (strlen($_SERVER['QUERY_STRING']) && strpos($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']) === false) {
                        $theURI .= '?' . $_SERVER['QUERY_STRING'];
                    }
                } else {
                    // IIS uses the SCRIPT_NAME variable instead of a REQUEST_URI variable... thanks, MS
                    $theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

                    // If the query string exists append it to the URI string
                    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
                        $theURI .= '?' . $_SERVER['QUERY_STRING'];
                    }
                }

                // Now we need to clean what we got since we can't trust the server var
                $theURI = urldecode($theURI);
                $theURI = str_replace('"', '&quot;', $theURI);
                $theURI = str_replace('<', '&lt;', $theURI);
                $theURI = str_replace('>', '&gt;', $theURI);
                $theURI = preg_replace('/eval\((.*)\)/', '', $theURI);
                $theURI = preg_replace('/[\\\"\\\'][\\s]*javascript:(.*)[\\\"\\\']/', '""', $theURI);
            } else {
                // We were given a URI
                $theURI = $uri;
            }

            // Create the new FURI instance
            $instances[$uri] = new FURI($theURI);
        }
        return $instances[$uri];
    }

    function toString($parts = array('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment')) {
        $query = $this->getQuery(); //make sure the query is created

        $uri = '';
        $uri .= in_array('scheme', $parts) ? (!empty($this->_scheme) ? $this->_scheme . '://' : '') : '';
        $uri .= in_array('user', $parts) ? $this->_user : '';
        $uri .= in_array('pass', $parts) ? (!empty($this->_pass) ? ':' : '') . $this->_pass . (!empty($this->_user) ? '@' : '') : '';
        $uri .= in_array('host', $parts) ? $this->_host : '';
        $uri .= in_array('port', $parts) ? (!empty($this->_port) ? ':' : '') . $this->_port : '';
        $uri .= in_array('path', $parts) ? $this->_path : '';
        $uri .= in_array('query', $parts) ? (!empty($query) ? '?' . $query : '') : '';
        $uri .= in_array('fragment', $parts) ? (!empty($this->_fragment) ? '#' . $this->_fragment : '') : '';

        return $uri;
    }

    function getQuery($toArray = false) {
        if ($toArray) {
            return $this->_vars;
        }

        //If the query is empty build it first
        if (is_null($this->_query)) {
            $this->_query = $this->buildQuery($this->_vars);
        }

        return $this->_query;
    }

    function buildQuery($params, $akey = null) {
        if (!is_array($params) || count($params) == 0) {
            return false;
        }

        $out = array();

        //reset in case we are looping
        if (!isset($akey) && !count($out)) {
            unset($out);
            $out = array();
        }

        foreach ($params as $key => $val) {
            if (is_array($val)) {
                $out[] = FURI::buildQuery($val, $key);
                continue;
            }

            $thekey = (!$akey ) ? $key : $akey . '[' . $key . ']';
            $out[] = $thekey . "=" . urlencode($val);
        }

        return implode("&", $out);
    }

    function __construct() {
        
    }

}

?>