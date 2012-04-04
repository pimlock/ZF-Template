<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

abstract class Tmpl_Form_Horizontal extends Zend_Form
{
    public function init()
    {
        $this->_initForm();
        $this->_buildForm();
        $this->_initElements();
    }

    public function setDescription($value)
    {
        parent::setDescription($value);
        $decorator = $this->getDecorator('Fieldset');
        if ($decorator) {
            $decorator->setOption('legend', $value);
        }
        return $this;
    }

    protected abstract function _buildForm();

    protected function _initForm()
    {
        $this->setDecorators(array(
            'FormElements',
            array('Fieldset', array('legend' => $this->getDescription())),
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));
        $this->addAttribs(array('class' => 'form-horizontal'));

        $this->setDefaultDisplayGroupClass('Tmpl_Form_DisplayGroup');
    }

    protected function _initElements()
    {
        $this->_initElementsDecorator();

        /** @var Zend_Form_Element $element */
        foreach ($this->getElements() as $element) {
            switch ($element->getType()) {
                case 'Zend_Form_Element_Submit':
                    $cssClass = $element->getAttrib('class');
                    $element->setAttrib('class', 'btn btn-primary ' . $cssClass);

                    $element->setDecorators(array(
                        array('ViewHelper'),
                        array('decorator' => 'HtmlTag', 'options' => array('tag' => 'div', 'class' => 'form-actions'))
                    ));
                    break;
            }
        }
    }

    protected function _initElementsDecorator()
    {
        $this->setElementDecorators(array(
            'PrepareElements',
            array('ViewScript', array('viewScript' => 'form_control.phtml'))
        ));
    }
}