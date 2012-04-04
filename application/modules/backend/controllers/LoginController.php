<?php

class Backend_LoginController extends Tmpl_Controller_Action_Backend
{
    /**
     * @var Zend_Auth
     */
    private $_auth;

    public function init()
    {
        parent::init();
        $this->_auth = $this->_getAuth();
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if ($this->_userLoggedIn()) {
            if (!$this->_userIsLoggingOut()) {
                $this->gotoSimple('index', 'index');
            }
        }
    }

    public function indexAction()
    {
        $form = new Backend_Form_Login();

        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();

            $auth = $form->loginUser($formData);
            if ($auth !== null) {
                $this->addMessage('Hurray! You are in!');
                $this->gotoSimple('index', 'index');
            }
        }

        $this->view->form = $form;
    }

    public function logoutAction()
    {
        $this->_auth->clearIdentity();

        $this->addMessage('You are logged out now!');
        $this->gotoSimple('index');
    }

    private function _userIsLoggingOut()
    {
        return 'logout' === $this->_request->getActionName();
    }

    private function _userLoggedIn()
    {
        return $this->_auth->hasIdentity();
    }
}

