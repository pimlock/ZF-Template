<?php

//namespace Bisna\Application\Resource;

use Bisna\Doctrine\Container as DoctrineContainer;

/**
 * Zend Application Resource Doctrine class
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class Bisna_Application_Resource_Doctrine extends \Zend_Application_Resource_ResourceAbstract
{
    /**
     * Initializes Doctrine Context.
     *
     * @return \Bisna\Doctrine\Container|mixed
     */
    public function init()
    {
        $this->_bootstrap->bootstrap('autoloader');

        $config = $this->getOptions();

        // Starting Doctrine container
        require_once 'Bisna/Doctrine/Container.php';
        $container = new DoctrineContainer($config);

        // Add to Zend Registry
        \Zend_Registry::set('doctrine', $container);

        return $container;
    }
}