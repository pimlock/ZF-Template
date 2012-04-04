<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_View_Helper_Url extends Zend_View_Helper_Abstract
{
    private $_zendUrlHelper;

    public function __construct()
    {
        $this->_zendUrlHelper = new Zend_View_Helper_Url();
    }

    public function url($action, $controller = null, $module = null, $params = array())
    {
        $urlOptions = array('action' => $action);
        if ($controller !== null) {
            $urlOptions['controller'] = $controller;
        }
        if ($module !== null) {
            $urlOptions['module'] = $module;
        }
        return $this->_zendUrlHelper->url($urlOptions + $params);
    }
}