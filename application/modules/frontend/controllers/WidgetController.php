<?php

class WidgetController extends Tmpl_Controller_Action_Frontend
{
    public function sidebarAction()
    {
        $this->view->layout()->mainSpan = 'span9';
    }
}

