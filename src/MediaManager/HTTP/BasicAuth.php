<?php

namespace MediaManager\HTTP;

/**
 * The Basic Auth credentials.
 */
class BasicAuth
{

    /**
     * The username and password
     * @var string 
     */
    private $username, $password;

    /**
     * Create new Basic Auth creds.
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the username.
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the basic auth username.
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set the password for basic auth.
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
