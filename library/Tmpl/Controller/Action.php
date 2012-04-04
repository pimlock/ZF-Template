<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_Controller_Action extends Zend_Controller_Action
{
    public function init()
    {
        parent::init();
        $this->view->messages = $this->_getFlashMessenger()->getMessages();
    }

    /**
     * @param string $message
     */
    public function addMessage($message)
    {
        $this->_getFlashMessenger()->addMessage($message);
    }

    /**
     * @param string $action
     * @param string $controller
     */
    public function gotoSimple($action, $controller = null)
    {
        $this->_getRedirector()->gotoSimple($action, $controller);
    }

    protected function _setTitle($title = '')
    {
        $this->view->headTitle($title, Zend_View_Helper_Placeholder_Container_Abstract::PREPEND);
    }

    protected function _processForm(Zend_Form $form, Closure $onFormValid)
    {
        $request = $this->_request;

        if ($request->isPost()) {
            $data = $request->getPost();

            if ($form->isValid($data)) {
                $onFormValid();
            }
        }
    }

    /**
     * @return Zend_Auth
     */
    protected function _getAuth()
    {
        return Zend_Auth::getInstance();
    }

    /**
     * @return Zend_Controller_Action_Helper_FlashMessenger
     */
    protected function _getFlashMessenger()
    {
        return $this->_helper->getHelper('FlashMessenger');
    }

    /**
     * @return Zend_Controller_Action_Helper_Redirector
     */
    protected function _getRedirector()
    {
        return $this->_helper->getHelper('Redirector');
    }

    /**
     * @return Bisna\Doctrine\Container
     */
    protected function _getDoctrine()
    {
        return Zend_Registry::get('doctrine');
    }
}