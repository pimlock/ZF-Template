<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_Controller_Action_Backend extends Tmpl_Controller_Action
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;

    public function init()
    {
        parent::init();

        /** @var Bisna\Doctrine\Container $doctrine */
        $doctrine = Zend_Registry::get('doctrine');
        $this->_em = $doctrine->getEntityManager();
    }

    public function preDispatch()
    {
        // if user is not logged in, he can only access /login action
        if (!$this->_getAuth()->hasIdentity()) {
            if (!$this->_isLoginActionRequested()) {
                $this->addMessage('Log in to access backend!');
                $this->gotoSimple('index', 'login');
            }
        } else {
            // we can add authorization checking here
        }
    }

    private function _isLoginActionRequested()
    {
        $request = $this->_request;
        return $request->getControllerName() === 'login' && $request->getActionName() === 'index';
    }
}