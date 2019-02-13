<?php
namespace MyLegacyProject\Manager\LoginManager;

class LoginManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $_manager;

    protected function setUp()
    {
        $this->_manager = new LoginManager();
    }

    /**
     * @expectedException \MyLegacyProject\Manager\LoginManager\LoginManagerException
     * @expectedExceptionMessage Please enter a username
     */
    public function testEmptyLoginFails()
    {
        $this->_manager->login('', 'xxx');
    }

    /**
     * @expectedException \MyLegacyProject\Manager\LoginManager\LoginManagerException
     * @expectedExceptionMessage Please enter a password
     */
    public function testEmptyPasswordFails()
    {
        $this->_manager->login('test', '');
    }

    /**
     * @expectedException \MyLegacyProject\Manager\LoginManager\LoginManagerException
     * @expectedExceptionMessage Your username and/or your password are not correct
     */
    public function testUnknownLoginFails()
    {
        $this->_manager->login('test', 'xxx');
    }

    /**
     * @expectedException \MyLegacyProject\Manager\LoginManager\LoginManagerException
     * @expectedExceptionMessage Your username and/or your password are not correct
     */
    public function testBadPasswordFails()
    {
        $this->_manager->addAllowedUser('test', 'my-password');
        $this->_manager->login('test', 'xxx');
    }

    public function testSuccessfulLogin()
    {
        $this->_manager->addAllowedUser('test', 'my-password');
        $username = $this->_manager->login('test', 'my-password');
        $this->assertEquals('test', $username);
    }
}