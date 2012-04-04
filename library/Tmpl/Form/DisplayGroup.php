<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_Form_DisplayGroup extends Zend_Form_DisplayGroup
{
    public function init()
    {
        $this->setDecorators(array(
            'FormElements',
            'Fieldset',
        ));
    }
}