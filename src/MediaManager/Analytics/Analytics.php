<?php

namespace MediaManager\Analytics;

use MediaManager\Pager\Pager as Pager;

/**
 * The Analytics Object used for querying Media Manager analytics.
 */
class Analytics
{
    /**
     * The HTTP Object.
     *
     * @var MediaManager\HTTP\HTTP
     */
    private $HTTP;

    /**
     * New Analytics object.
     *
     * @param \MediaManager\HTTP\HTTP $HTTP
     */
    public function __construct(\MediaManager\HTTP\HTTP $HTTP)
    {
        $this->HTTP = $HTTP;
    }

    /**
     * Perform a raw query on Media Manager.
     *
     * @param string $query The MMQL string
     * @param string $from  The from date as a string
     * @param type   $to    The to date as a string
     *
     * @return Pager
     */
    public function query(\MediaManager\Analytics\Query $Query)
    {
        $api = '/analytics/'.$Query->get().'/'.$Query->getFrom()->get().'/'.$Query->getTo()->get();

        //Set the request URL to clients API
        $this->HTTP->getRequest()->setURL($this->HTTP->getRequest()->getInitialURL().$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return new Pager($response);
    }

    /**
     * Get the HTTP object.
     *
     * @return MediaManager\HTTP\HTTP
     */
    public function getHTTP()
    {
        return $this->HTTP;
    }
}
