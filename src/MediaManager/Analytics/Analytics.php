<?php

namespace MediaManager\Analytics;

use MediaManager\Pager\Pager as Pager;

/**
 * Description of Analytics.
 *
 * @author Dale
 */
class Analytics
{
    /**
     * The API URL.
     *
     * @var string
     */
    private $API_URL;

    /**
     * The HTTP Object.
     *
     * @var HTTP
     */
    private $HTTP;

    /**
     * New query Object.
     *
     * @param type $apiURL
     * @param type $HTTP
     */
    public function __construct($apiURL, $HTTP)
    {
        $this->API_URL = $apiURL;
        $this->HTTP = $HTTP;
    }

    /**
     * Run a query on the analytics.
     *
     * @param type $query
     * @param type $from
     * @param type $to
     *
     * @return Pager
     */
    public function Query($query, $from, $to)
    {
        $api = "/analytics/{$query}/{$from}/{$to}";

        //GET CLIENT DATA
        $response = $this->HTTP->Get($this->API_URL.$api);

        return new Pager($response);
    }
}
