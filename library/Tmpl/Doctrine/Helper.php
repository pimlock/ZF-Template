<?php
/**
 * Copyright (c) 2012, Piotr Młocek <piotr@mlocek.it>.
 * All rights reserved.
 *
 * @author     Piotr Młocek <piotr@mlocek.it>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */

class Tmpl_Doctrine_Helper
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $_em;

    /**
     * @static
     * @return Doctrine\ORM\EntityManager
     */
    public static function getEM()
    {
        /** @var Bisna\Doctrine\Container $doctrine */
        $doctrine = Zend_Registry::get('doctrine');
        return $doctrine->getEntityManager();
    }

    /**
     * @static
     * @return Doctrine\DBAL\Connection
     */
    public static function getConnection()
    {
        /** @var Bisna\Doctrine\Container $doctrine */
        $doctrine = Zend_Registry::get('doctrine');
        return $doctrine->getConnection();
    }

    public function __construct(Doctrine\ORM\EntityManager $em = null)
    {
        if ($em === null) {
            $em = self::getEM();
        }
        $this->_em = $em;
    }
}