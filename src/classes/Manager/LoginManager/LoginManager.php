<?php
namespace MyLegacyProject\Manager\LoginManager;

/**
 * The most powerful login manager of the World!
 * @author Bill
 *
 */
class LoginManager
{
    /**
     * Associative array username => password.
     * @var array
     */
    private $_allowedUsers = array();

    /**
     * Tests if the given username/password are allowed.
     * Returns the username back if true.
     *
     * @param string $username
     * @param string $password
     * @throws LoginManagerException If the login fails
     * @return string
     */
    public function login($username, $password)
    {
        if (empty($username)) {
            throw new LoginManagerException('Please enter a username');
        }
        if (empty($password)) {
            throw new LoginManagerException('Please enter a password');
        }
        if (!isset($this->_allowedUsers[$username]) || $password !== $this->_allowedUsers[$username]) {
            throw new LoginManagerException('Your username and/or your password are not correct');
        }

        return $username;
    }

    /**
     * Adds a username/password.
     * @param string $username
     * @param string $password
     */
    public function addAllowedUser($username, $password)
    {
        $this->_allowedUsers[$username] = $password;
    }
}