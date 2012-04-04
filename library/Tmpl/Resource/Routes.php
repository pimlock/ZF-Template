<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_Resource_Routes extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var Zend_Controller_Router_Rewrite
     */
    private $_router;

    /**
     * @var Zend_Controller_Front
     */
    private $_frontController;

    public function init()
    {
        $bootstrap = $this->getBootstrap();

        $bootstrap->bootstrap('FrontController');
        $this->_frontController = $bootstrap->getResource('FrontController');

        $this->_router = $this->_frontController->getRouter();

        $this->_addRoutes();
    }

    private function _addRoutes()
    {
    }
}