<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_Resource_Translate extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * Strategy pattern: initialize resource
     *
     * @return mixed
     */
    public function init()
    {
        // TODO  - choose appropriate language
        $translate = new Zend_Translate('Array', APPLICATION_PATH . '/languages/pl/forms.php', 'pl');
        Zend_Registry::set('Zend_Translate', $translate);
    }
}