<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Backend_Form_Login extends Tmpl_Form_Horizontal
{
    protected $_description = 'Log in to admin zone';

    protected function _buildForm()
    {
        $this->getDecorator('HtmlTag')->setOption('class', 'span6 offset1');

        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login')
            ->setRequired(true)
            ->addValidator(new Zend_Validate_NotEmpty());

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
            ->setRequired(true)
            ->addValidator(new Zend_Validate_NotEmpty());

        $submit = new Zend_Form_Element_Submit('login_btn');
        $submit->setLabel('Log in')->setIgnore(true);

        $this->addElement($login);
        $this->addElement($password);
        $this->addElement($submit);
    }

    /**
     * @param array $formData
     * @return null|Zend_Auth
     */
    public function loginUser($formData)
    {
        if ($this->isValid($formData)) {
            $login = $this->getValue('login');
            $password = $this->getValue('password');

            // TODO some Zend_Auth login here!
        }
        return null;
    }
}

