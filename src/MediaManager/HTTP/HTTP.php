<?php

namespace MediaManager\HTTP;

/**
 * Perform a HTTP request to a given URL based on a CurlRequest.
 *
 * @author Dale
 */
class HTTP
{
    /**
     * The Request.
     *
     * @var \MediaManager\HTTP\CurlRequest
     */
    private $request;

    /**
     * The Global Params.
     *
     * @var type
     */
    private $globalParams = [];

    /**
     * Create new HTTP request.
     *
     * @param \MediaManager\HTTP\CurlRequest $request
     */
    public function __construct(\MediaManager\HTTP\CurlRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Perform a GET request.
     *
     * @param type $url
     * @param type $params
     */
    public function Get()
    {
        //Set the type to GET.
        $this->request->setType('GET');

        //Do the request.
        $response = $this->Request();

        //Return resutls as an array.
        return $response->toArray();
    }

    /**
     * Get the HTTP request object.
     *
     * @return \MediaManager\HTTP\CurlRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Make the HTTP request.
     *
     * @return \MediaManager\HTTP\JsonResponse
     */
    public function Request()
    {

        //Merge the global params with the request params.
        $data = array_merge($this->request->getData(), $this->globalParams);

        //Update the request params with the new combined params.
        $this->request->setData($data);

        //Do the request.
        $result = $this->request->doRequest();

        //The JSON response.
        $Response = new JsonResponse($result);

        return $Response;
    }

    /**
     * Set any global parameters that will be passed to all HTTP requests.
     *
     * @param array $params
     */
    public function setGlobalParams(array $params)
    {
        $this->globalParams = array_merge($params, $this->globalParams);
    }

    /**
     * Get Global params.
     *
     * @return type
     */
    public function getGlobalParams()
    {
        return $this->globalParams;
    }
}
