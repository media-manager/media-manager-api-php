<?php

namespace MediaManager;

use MediaManager\API\API as API;
use MediaManager\API\External as External;

/**
 * The Media Manager object to access external or general API.
 * @author Dale
 */
class MediaManager
{

    /**
     * The api key and client shortname.
     * @var string 
     */
    private $apikey;
    private $client;

    /**
     * The request gateway
     * @var \MediaManager\HTTP\CurlRequest
     */
    private $request;

    /**
     * Media Manager Object.
     *
     * @param type $client
     * @param type $apiKey
     */
    public function __construct($client, $apiKey, \MediaManager\HTTP\CurlRequest $request)
    {
        $this->apikey = $apiKey;
        $this->client = $client;
        $this->request = $request;
    }

    /**
     * Get the API object.
     * @return API
     */
    public function api()
    {
        return new API($this->client, $this->apikey, $this->request);
    }

    /**
     * Get the External object.
     * @return External
     */
    public function external()
    {
        return new External($this->client, $this->apikey, $this->request);
    }

    /**
     * Get the APIKey.
     * @return string
     */
    public function getAPIKey()
    {
        return $this->apikey;
    }

    /**
     * Get the client shortname.
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }
}
