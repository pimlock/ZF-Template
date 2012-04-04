<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function setUp()
    {
        global $application;
        $this->bootstrap = $application;

        parent::setUp();
    }

    /**
     * @test
     * @group
     */
    public function testLoginAction()
    {
        // given
        Zend_Auth::getInstance()->clearIdentity();
        // when
        $this->dispatch('/backend');
        // then
        $this->assertRedirectTo('/backend/login');
    }
}

