<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_View_Helper_CommonIncludes extends Zend_View_Helper_Abstract
{
    public function commonIncludes()
    {
        $styles = array(
            'css/bootstrap.min.css',
            'css/bootstrap-responsive.min.css',
            'css/tmpl.css',
        );
        /** @var Zend_View_Helper_HeadLink $headLink */
        $headLink = $this->view->headLink();
        /** @var Zend_View_Helper_BaseUrl $baseUrl */
        $baseUrl = $this->view->getHelper('baseUrl');
        foreach ($styles as $style) {
            $headLink->appendStylesheet($baseUrl->baseUrl($style));
        }
    }
}