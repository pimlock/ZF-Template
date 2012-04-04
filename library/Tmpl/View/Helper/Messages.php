<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_View_Helper_Messages extends Zend_View_Helper_Abstract
{
    private $_header;
    private $_footer;

    public function messages()
    {
        $html = '';
        if ($this->view->messages) {
            $messages = $this->view->messages;

            $this->_initParts();
            $messagesList = $this->_getMessagesList($messages);

            $html = $this->_header . $messagesList . $this->_footer;
        }
        return $html;
    }

    private function _initParts()
    {
        $this->_header = <<<END
<div class="alert alert-success">
    <a class="close" data-dismiss="alert">&times;</a>
    <ul class="unstyled">
END;
        $this->_footer = <<<END
    </ul>
</div>
END;
    }

    private function _getMessagesList($messages)
    {
        $html = '';
        foreach ($messages as $message) {
            $html .= '<li>' . $message . '</li>';
        }
        return $html;
    }
}