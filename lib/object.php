<?php

/**
  * This website is developed by Favworks and all the codes are written by favworks.
 * Any changes to this website will be the violation of the copyright.
 * FObject Class
 * @package       FavCMS
 */
class FObject {

    /**
     * A hack to support __construct() on PHP 4
     *
     * Hint: descendant classes have no PHP4 class_name() constructors,
     * so this constructor gets called first and calls the top-layer __construct()
     * which (if present) should call parent::__construct()
     *
     * @access	public
     * @return	Object
     * @since	1.5
     */
    function FObject() {
        $args = func_get_args();
        call_user_func_array(array(&$this, '__construct'), $args);
    }

    /**
     * Class constructor, overridden in descendant classes.
     *
     * @access	protected
     * @since	1.5
     */
    //function __construct() {}
}