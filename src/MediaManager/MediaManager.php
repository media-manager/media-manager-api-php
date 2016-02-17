<?php

namespace MediaManager;

use MediaManager\API\API as API;
use MediaManager\API\External as External;

/**
 * Description of MediaManager.
 *
 * @author Dale
 */
class MediaManager
{
    /**
     * The API Object.
     *
     * @var API
     */
    public $API;

    /**
     * The API Object.
     *
     * @var API
     */
    public $ExternalAPI;

    /**
     * Media Manager Object.
     *
     * @param type $client
     * @param type $apiKey
     */
    public function __construct($client, $apiKey)
    {
        $this->API = new API($client, $apiKey);
        $this->ExternalAPI = new External($client, $apiKey);
    }
}
