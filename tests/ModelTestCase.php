<?php

class ModelTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Bisna\Doctrine\Container
     */
    protected $_doctrine;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;

    protected function setUp()
    {
        parent::setUp();

        global $application;
        $application->bootstrap();

        /** @var Bisna\Doctrine\Container $doctrine */
        $this->_doctrine = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrine->getEntityManager();

        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->_em);
        $schemaTool->createSchema($this->_em->getMetadataFactory()->getAllMetadata());
    }

    protected function tearDown()
    {
        parent::tearDown();
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->_em);
        $schemaTool->dropDatabase();
    }
}