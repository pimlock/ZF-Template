<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_View_Helper_LoggedInUser extends Zend_View_Helper_Abstract
{
    public function loggedInUser()
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        if ($identity === null) {
            return '<a href="' . $this->view->url('index', 'login') . '">log in</a>';
        }
        return '<span>' . $identity->getName() . '</span>&nbsp|&nbsp;<a href="' . $this->view->url('logout', 'login') . '">log out</a>';
    }
}