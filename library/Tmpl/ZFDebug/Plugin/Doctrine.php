<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_ZFDebug_Plugin_Doctrine
    extends ZFDebug_Controller_Plugin_Debug_Plugin
    implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * @var \Doctrine\DBAL\Logging\DebugStack
     */
    private $_debugStack;

    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'doctrine';

    public function __construct()
    {
        $connection = Tmpl_Doctrine_Helper::getConnection();
        $this->_debugStack = new Doctrine\DBAL\Logging\DebugStack();

        $connection->getConfiguration()->setSQLLogger($this->_debugStack);
    }

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
        if ($this->_debugStack === null) {
            return 'No Profiler';
        }

        $queries = $this->_debugStack->queries;
        $totalTime = 0;
        foreach ($queries as $query) {
            $totalTime += $query['executionMS'];
        }
        return count($queries) . ' in ' . round($totalTime * 1000, 2) . ' ms';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        if ($this->_debugStack === null) {
            return '';
        }

        $html = '<h4>Database queries</h4>';
        $html .= '<ol>';

        foreach ($this->_debugStack->queries as $query) {
            $html .= '<li><strong>[' . round($query['executionMS'] * 1000, 2) . ' ms]</strong>' . $query['sql'];
            $params = $query['params'];
            if (!empty($params)) {
//                $params = array_map('htmlspecialchars', $params);
//                $html .= '<ul><em>bindings:</em> <li>' . implode('</li><li>', $params) . '</li></ul>';
            }
            $html .= '</li>';
        }

        $html .= '</ol>';

        return $html;
    }

    /**
     * Returns the base64 encoded icon
     *
     * Doctrine Icon will be used if you're using ZFDebug > 1.5
     * icon taken from: http://code.google.com/p/zfdebug/issues/detail?id=20
     *
     * @return string
     **/
    public function getIconData()
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAidJREFUeNqUk9tLFHEUxz+/mdnZnV1Tt5ttWVC+pBG+9RAYRNBDICT5D1hgL/VQWRAVEfVoCGURhCBFEj6IRkRFF7BAxPZlIbvZBTQq0q677u5c9tdvZyPaS1QHZh7OnPM93/me8xWC4rAnR6WbuAdSYjRvwWzaVFpSFEZpwvvwGnu4GwJB5OwMfwutNKHXrQFrASJcjTM+RPJMh/wvALOpRVh7+pC6gahegjMxQvLsTvnPAHkN5NxbhB5AfptDy4OMD5PsrQwiRElz5uoJvKdjaMsb0FesxX3yEBGsQiY/YWxopWpvv/gjg8zgSXJvEojapVid5wl3DRLc3qWYfCz8ztgQqf6DsiJA5vZFmZuKIyI1kPyC9zJOvjLYuh9zx2Hk5/doNXU4Dwawpx7JMgA3cVe9VT4YRl/djHOnDzd+vQDSdgiz7QAy9RUcG29ytPwOcrPTiEX1RI7fQqhJeDbSdRVmTn30CLUfhfnvZEdOI7PpChoYAVWo5rmOz0R6XoER4ueTx/IKsv8m/S8G+sp1OK8ukzq1DS1cS85OY+3qwWhs8W8ic+UIzv1LSqMoWjRWziCwsV1dkQWKnjf9WIm3z2/OR1Y12zcvqHWG0RbG0GIN5QDm+s3C3LrbXxmBECK6rLCdgWN+M5a6hew8oc7eIoOJUqulr/VI+8Y5pJP2p+VmnkEogrZ4FaGO7jJ3ikpezV+k93wC790L31R6faNPu5K1fwgwAMKf1kgHZKePAAAAAElFTkSuQmCC';
    }
}
