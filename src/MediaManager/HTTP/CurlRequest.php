<?php

namespace MediaManager\HTTP;

/**
 * A CurlRequest, which can be anything from a GET,POST or PUT request and also 
 * allows sending of files.
 */
class CurlRequest
{
    private $initalUrl;
    private $url;
    private $data = [];
    private $type = 'GET';
    private $sendingFile = false;
    private $headers = false;
    private $auth = false;

    /**
     * Create a new CurlRequest object.
     *
     * @param type $url
     */
    public function __construct($url, $type = 'GET')
    {
        //Original URL. Sometimes URL may be appended
        $this->initalUrl = $url;

        //URL used by CurlRequest
        $this->url = $url;

        //The request Type (GET,POST, etc).
        $this->type = $type;
    }

    /**
     * Get the request URL.
     *
     * @return string
     */
    public function getURL()
    {
        return $this->url;
    }

    /**
     * Get the initial URL passed to CurlRequest object. This allows you to
     * consinder this the "base url".
     *
     * @return type
     */
    public function getInitialURL()
    {
        return $this->initalUrl;
    }

    /**
     * Set the CurlRequest URL.
     *
     * @param type $url
     */
    public function setURL($url)
    {
        $this->url = $url;
    }

    /**
     * Set CurlRequest data that is passed along.
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Is a file being sent with the request.
     *
     * @return bool
     */
    public function isSendingFile()
    {
        return $this->sendingFile;
    }

    /**
     * If request will be sending a file.
     *
     * @param type $boolean
     */
    public function sendFile($boolean)
    {
        $this->sendingFile = $boolean;
    }

    /**
     * Get request data (the request parameters).
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * If request has headers to be sent.
     *
     * @return bool TRUE|FALSE
     */
    public function hasHeaders()
    {
        return is_array($this->headers);
    }

    /**
     * Get request headers to be sent.
     *
     * @return type
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the request headers to be sent.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Get the request type (GET,POST,DELETE,PUT,ect).
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the request type.
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * If auth creds should be sent with request (HTTP Basic Auth).
     *
     * @return bool
     */
    public function shouldAuth()
    {
        return $this->auth !== false;
    }

    /**
     * Set the basic auth.
     *
     * @param \MediaManager\HTTP\BasicAuth $auth
     */
    public function setAuth(BasicAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get the basic auth credentials.
     *
     * @return \MediaManager\HTTP\BasicAuth
     */
    public function getBasicAuth()
    {
        return $this->auth;
    }

    /**
     * Do the CurlRequest, Returns a string (usually JSON).
     *
     * @return string
     */
    public function doRequest()
    {
        //MERGE GLOBAL PARAMS INTO DATA PASSED.
        $data = $this->getData();

        //IF NOT SENDING FILE, THEN CONVERT PARAMS INTO QUERY STRING.
        $data = (!$this->isSendingFile()) ? http_build_query($data, '', '&') : $data;

        //IF TYPE A GET REQUEST.
        $url = $this->getURL();
        $url .= ($this->getType() != 'POST' && $this->getType() != 'PUT') ? '?'.$data : '';

        //SETUP CURL REQUEST
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);

        //IF ANY HEADERS PASSED, THEN SET THEM.
        if ($this->hasHeaders()) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $request->getHeaders());
        }

        //IF SENDING AUTH
        if ($this->shouldAuth()) {

            //Get the basic auth crentials.
            $basicAuth = $this->getBasicAuth();

            curl_setopt($ch, CURLOPT_USERPWD, $basicAuth->getUsername().':'.$basicAuth->getPassword());
        }

        //IF POST TYPE
        if ($this->getType() == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getData());
        } elseif ($this->getType() == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->getType());
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getData());
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->getType());
        }

        $result = curl_exec($ch);

        //Close curl
        curl_close($ch);

        return $result;
    }
}
