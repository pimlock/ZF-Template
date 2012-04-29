<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initPlaceholders()
    {
        $view = $this->_getView();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('ZF Template')->setSeparator(' | ');

        $view->addHelperPath('Tmpl/View/Helper', 'Tmpl_View_Helper_');
    }

    protected function _initDoctrineEncoding()
    {
        $this->bootstrap('doctrine');
        $doctrine = $this->getResource('doctrine');

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $doctrine->getEntityManager();

        $em->getEventManager()->addEventSubscriber(
            new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit('utf8', 'utf8_unicode_ci')
        );
    }

    protected function _initLayoutParams()
    {
        $this->bootstrap('layout');

        $view = $this->_getView();
        $view->layout()->mainSpan = 'span12';
    }

    protected function _initAutoloader()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        require_once 'Doctrine/Common/ClassLoader.php';

        $autoloader->pushAutoloader(array(new \Doctrine\Common\ClassLoader('Tmpl'), 'loadClass'), 'Tmpl');
        $autoloader->pushAutoloader(array(new \Doctrine\Common\ClassLoader('Doctrine'), 'loadClass'), 'Doctrine');
        $autoloader->pushAutoloader(array(new \Doctrine\Common\ClassLoader('Symfony'), 'loadClass'), 'Symfony');
    }

    protected function _initPlugins()
    {
        /** @var Zend_Controller_Front $front */
        $front = $this->getResource('FrontController');
        $front->registerPlugin(new Tmpl_Controller_Plugin());
    }

    /**
     * @return Zend_View
     */
    private function _getView()
    {
        $this->bootstrap('view');
        /** @var Zend_View $view */
        $view = $this->getResource('view');

        return $view;
    }

    protected function _initZFDebug()
    {
        if (APPLICATION_ENV === 'production') {
            return;
        }
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('ZFDebug');

        $options = array(
            'plugins' => array(
                'Variables',
                'File' => array('basePath' => APPLICATION_PATH),
                'Exception',
                'Time',
                'Tmpl_ZFDebug_Plugin_Doctrine'
            )
        );
        $debug = new ZFDebug_Controller_Plugin_Debug($options);

        $this->bootstrap('frontController');
        $frontController = $this->getResource('frontController');
        $frontController->registerPlugin($debug);
    }
}
