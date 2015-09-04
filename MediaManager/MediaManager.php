<?php

namespace MediaManager;

use \MediaManager\API\API as API;

/**
 * Description of MediaManager
 *
 * @author Dale
 */
class MediaManager {

    /**
     * The API Object
     * @var API 
     */
    public $API;

    /**
     * Media Manager Object
     * @param type $client
     * @param type $apiKey
     */
    public function __construct($client, $apiKey) {
        $this->API = new API($client, $apiKey);
    }

}
