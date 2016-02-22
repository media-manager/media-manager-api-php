<?php

namespace MediaManager\HTTP;

/**
 * A CurlRequest, which can be anything from a GET,POST or PUT request and also 
 * allows sending of files.
 */
class CurlRequest
{

    private $url;
    private $data = [];
    private $type = 'GET';
    private $sendingFile = false;
    private $headers = false;
    private $auth = false;

    /**
     * Create a new CurlRequest object.
     * @param type $url
     */
    public function __construct($url, $type = "GET")
    {
        $this->url = $url;
        $this->type = $type;
    }

    /**
     * Get the request URL.
     * @return string
     */
    public function getURL()
    {
        return $this->url;
    }

    /**
     * Set CurlRequest data that is passed along.
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Is a file being sent with the request.
     * @return boolean
     */
    public function isSendingFile()
    {
        return $this->sendingFile;
    }

    /**
     * Get request data (the request parameters).
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * If request has headers to be sent.
     * @return boolean TRUE|FALSE
     */
    public function hasHeaders()
    {
        return is_array($this->headers);
    }

    /**
     * Get request headers to be sent.
     * @return type
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get the request type (GET,POST,DELETE,PUT,ect).
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * If auth creds should be sent with request (HTTP Basic Auth).
     * @return boolean
     */
    public function shouldAuth()
    {
        return ($this->auth !== false);
    }

    /**
     * Get the basic auth credentials.
     * @return BasicAuth
     */
    public function getBasicAuth()
    {
        return $this->auth;
    }
}
