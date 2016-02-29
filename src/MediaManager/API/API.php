<?php

namespace MediaManager\API;

use MediaManager\Analytics\Analytics as Analytics;
use MediaManager\HTTP\HTTP as HTTP;
use MediaManager\Pager\Pager as Pager;

/**
 * Description of API.
 *
 * @author Dale
 */
class API
{
    /**
     * The HTTP Object.
     *
     * @var HTTP
     */
    protected $HTTP;

    /**
     * The Client Shortname.
     *
     * @var type
     */
    protected $client;

    /**
     * The API Version.
     *
     * @var type
     */
    protected $apiVersion = 1;

    /**
     * Use a CurlRequest.
     *
     * @var MediaManager\HTTP\CurlRequest
     */
    protected $request;

    /**
     * The API Key.
     *
     * @var type
     */
    protected $apiKey;

    /**
     * The Base URI for the API.
     *
     * @var string
     */
    protected $BASE_URI = 'https://{client}.getmediamanager.com/api/v{version}';

    /**
     * Create new API instance.
     *
     * @param string                         $client  The client shortname
     * @param string                         $apiKey  The API Key
     * @param \MediaManager\HTTP\CurlRequest $request
     */
    public function __construct($client, $apiKey, \MediaManager\HTTP\CurlRequest $request)
    {
        //Set the global fields.
        $this->client = $client;
        $this->apiKey = $apiKey;

        //Parse the base uri based on client and version.
        $this->BASE_URI = str_replace(['{client}', '{version}'], [$this->client, $this->apiVersion], $this->BASE_URI);

        //The CurlRequest Object
        $this->request = $request;
        $this->request->setURL($this->BASE_URI, true);

        //ATTACH THE HTTP OBJECT
        $this->HTTP = new HTTP($this->request);

        //Set the API key as a global param.
        $this->HTTP->setGlobalParams(['_apikey' => $apiKey]);
    }

    /**
     * Get the Analyics object.
     *
     * @return Analytics
     */
    public function analytics()
    {
        return new Analytics($this->HTTP);
    }

    /**
     * Get the HTTP Object.
     *
     * @return HTTP
     */
    public function getHTTP()
    {
        return $this->HTTP;
    }

    /**
     * Add a filter to API calls.
     *
     * @param type $filterName
     * @param type $filterValue
     */
    public function addFilter($filterName, $filterValue)
    {
        $this->HTTP->setGlobalParams([$filterName => $filterValue]);
    }

    /**
     * Filter down by a playlist.
     *
     * @param type $playlist
     */
    public function addPlaylistFilter($playlist)
    {
        $this->addFilter('playlist', $playlist);
    }

    /**
     * Add a template filter.
     *
     * @param type $template
     */
    public function addTemplateFilter($template)
    {
        $this->addFilter('templateID', $template);
    }

    /**
     * Get client data.
     *
     * @return array
     */
    public function getClient()
    {
        $api = '/client';

        //Set the request URL to clients API
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    public function getTemplates()
    {
        $api = '/templates';

        //Set the request URL to clients API.
        $this->request->setURL($this->BASE_URI.$api);

        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get Video data.
     *
     * @param type $videoid
     *
     * @return type
     */
    public function getVideo($videoid)
    {
        $api = '/video/'.$videoid;

        //Set the request URL to clients API.
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    public function getPlaylists()
    {
        $api = '/playlists';

        //Set the request URL to clients API.
        $this->request->setURL($this->BASE_URI.$api);

        //GET CLIENT DATA
        $response = $this->HTTP->Get();

        return $response;
    }

    /**
     * Get client videos. This will be paged.
     *
     * @return type
     */
    public function getVideos()
    {
        $api = '/videos';

        //Set the request URL to clients API.
        $this->request->setURL($this->BASE_URI.$api);

        //Get API results
        $response = $this->HTTP->Get();

        return new Pager($response);
    }
}
