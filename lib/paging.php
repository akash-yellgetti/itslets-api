<?php

class FPaging {

    var $num_results = 0;
    var $num_pages = 0;
    var $limit = 0;
    var $page = 0;
    var $noOfPages = 10;

    public function __construct($num_results = null, $limit = null, $page = null, $noOfPages = 10) {
        if (!is_null($num_results) && !is_null($limit) && !is_null($page)) {
            $this->num_results = $num_results;
            $this->limit = $limit;
            $this->page = $page;
            $this->num_pages = ceil($this->num_results / $this->limit);
            $this->noOfPages = $noOfPages;
        }
    }

    /**
     * function to display paging
     * @return string
     */
    public function displayPaging() {
        if ($this->num_pages > 1):

            $url = $this->getAddress();
            $pagePresent = 0;
            if (strPos(strrev($url), "?") > 0 && strPos(strrev($url), "&") <= 0) {
                $val = substr(strrev(substr(strrev($url), 0, strPos(strrev($url), "?"))), 0, 4);
                if ($val == "page") {
                    $url = strrev(substr(strrev($url), strPos(strrev($url), "?") + 1));
                    $pagePresent = 1;
                }
            } else if (strPos(strrev($url), "&") > 0) {
                $val = substr(strrev(substr(strrev($url), 0, strPos(strrev($url), "&"))), 0, 4);
                if ($val == "page") {
                    $url = strrev(substr(strrev($url), strPos(strrev($url), "&") + 1));
                    $pagePresent = 1;
                }
            }

            if (strPos(strrev($url), "?") > 0) {
                $url = $url . "&";
            } else {
                $url = $url . "?";
            }

            $menuStart = "<ul class='ulpaging'>";
            $start = 1;
            $end = $this->num_pages;

            /*             * * if this is page 1 there is no previous link ** */
            if ($this->page != 1) {
                $menu = $menu . "<li><a href='" . $url . "page=" . ( $this->page - 1 ) . "' class='pagelink'>PREV</a></li>";
                $firstVar = "<li><a href='" . $url . "page=1' class='pagelink'>FIRST</a></li>";
            } else {
                $firstVar = "";
            }

            /*             * * loop over the pages ** */

            if ($this->num_pages > $this->noOfPages):
                if ((ceil($this->page / $this->noOfPages) >= 1)):
                    $start = ($this->page) - ($this->page % $this->noOfPages);
                    if (($start + $this->noOfPages) > $this->num_pages):
                        $end = $this->page + ($this->num_pages - $this->page);
                    else:
                        $end = $start + $this->noOfPages;
                    endif;
                else:
                    $end = $this->noOfPages;
                endif;

                if ($start <= 0):
                    $start = 1;
                endif;
            endif;

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $this->page) {
                    $menu = $menu . "<li><a href='" . $url . "page=" . $i . "' class='paging_active'>" . $i . "</a></li>";
                } else {
                    $menu = $menu . "<li><a href='" . $url . "page=" . $i . "' class='paging'>" . $i . "</a></li>";
                }
            }

            /*             * * if we are on the last page, we do not need the NEXT link ** */
            if ($this->page < $this->num_pages) {
                $menu = $menu . "<li><a href='" . $url . "page=" . ( $this->page + 1 ) . "' class='pagelink'>NEXT</a></li>";
                $lastVar = "<li><a href='" . $url . "page=" . $this->num_pages . "' class='pagelink'>LAST</a></li>";
            } else {
                $lastVar = "";
            }
            $menu = $menuStart . $firstVar . $menu . $lastVar . "</ul>";
            return $menu;
        endif;
    }

    function displayAjaxPaging($presentPage, $url, $divcont) {
        if ($this->num_pages > 1):
            $this->page = $presentPage;
            $menuStart = "<ul class='ulpaging'>";
            $start = 1;
            $end = $this->num_pages;

            /*             * * if this is page 1 there is no previous link ** */
            if ($this->page != 1) {
                $menu = $menu . "<li><a href='javascript:void(0);' onclick=ajaxPaging('" . $url . "'," . ( $this->page - 1 ) . ",'" . $divcont . "') class='pagelink'>PREV</a></li>";
                $firstVar = "<li><a href='javascript:void(0);' onclick=ajaxPaging('" . $url . "',1,'" . $divcont . "') class='pagelink'>FIRST</a></li>";
            } else {
                $firstVar = "";
            }


            if ($this->num_pages > $this->noOfPages):
                if ((ceil($this->page / $this->noOfPages) >= 1)):
                    $start = ($this->page) - ($this->page % $this->noOfPages);
                    if (($start + $this->noOfPages) > $this->num_pages):
                        $end = $this->page + ($this->num_pages - $this->page);
                    else:
                        $end = $start + $this->noOfPages;
                    endif;
                else:
                    $end = $this->noOfPages;
                endif;

                if ($start <= 0):
                    $start = 1;
                endif;
            endif;
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $this->page) {
                    $menu = $menu . "<li><a href='javascript:void(0);' onclick=ajaxPaging('" . $url . "'," . $i . ",'" . $divcont . "') class='paging_active'>" . $i . "</a></li>";
                } else {
                    $menu = $menu . "<li><a href='javascript:void(0);' onclick=ajaxPaging('" . $url . "'," . $i . ",'" . $divcont . "') class='paging'>" . $i . "</a></li>";
                }
            }

            /*             * * if we are on the last page, we do not need the NEXT link ** */
            if ($this->page < $this->num_pages) {
                $menu = $menu . "<li><a href='javascript:void(0);' onclick=ajaxPaging('" . $url . "'," . ( $this->page + 1 ) . ",'" . $divcont . "') class='pagelink'>NEXT</a></li>";
                $lastVar = "<li><a href='javascript:void(0);' onclick=ajaxPaging('" . $url . "'," . ( $this->num_pages) . ",'" . $divcont . "') class='pagelink'>LAST</a></li>";
            } else {
                $lastVar = "";
            }
            $menu = $menuStart . $firstVar . $menu . $lastVar . "</ul>";
            return $menu;
        endif;
    }

    /**
     * function to get page address
     * @return type
     */
    function getAddress() {
        if (!isset($_SERVER['REQUEST_URI'])) {
            $serverrequri = $_SERVER['PHP_SELF'];
        } else {
            $serverrequri = $_SERVER['REQUEST_URI'];
        }
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $serverrequri;
    }

    function strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }

}

?>