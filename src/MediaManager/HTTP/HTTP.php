<?php

namespace MediaManager\HTTP;

/**
 * Description of HTTP.
 *
 * @author Dale
 */
class HTTP
{

    /**
     * The Global Params.
     *
     * @var type
     */
    private $globalParams = [];

    /**
     * Perform a GET request.
     *
     * @param type $url
     * @param type $params
     */
    public function Get($url, array $params = [])
    {
        //New CurlRequest
        $CurlRequest = new CurlRequest($url);

        //Set the request data.
        $CurlRequest->setData($params);

        //Do the request.
        $response = $this->Request($CurlRequest);

        return $response->toArray();
    }

    /**
     * Get the HTTP Host.
     * @return string
     */
    public function getHost()
    {
        return $_SERVER["HTTP_HOST"];
    }

    /**
     * Send a HTTP request.
     *
     * @param type  $url
     * @param type  $data
     * @param type  $type
     * @param type  $sendingFile
     * @param type  $headers
     * @param array $auth
     *
     * @return JsonResponse
     */
    public function Request(CurlRequest $request)
    {
        //MERGE GLOBAL PARAMS INTO DATA PASSED.
        $data = array_merge($request->getData(), $this->globalParams);

        //IF NOT SENDING FILE, THEN CONVERT PARAMS INTO QUERY STRING.
        $data = (!$request->isSendingFile()) ? http_build_query($data, '', '&') : $data;

        //IF TYPE A GET REQUEST.
        $url = $request->getURL();
        $url .= ($request->getType() != 'POST' && $request->getType() != 'PUT') ? '?' . $data : '';

        //SETUP CURL REQUEST
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $this->getHost());

        //IF ANY HEADERS PASSED, THEN SET THEM.
        if ($request->hasHeaders()) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $request->getHeaders());
        }

        //IF SENDING AUTH
        if ($request->shouldAuth()) {

            //Get the basic auth crentials.
            $basicAuth = $request->getBasicAuth();

            curl_setopt($ch, CURLOPT_USERPWD, $basicAuth->getUsername() . ":" . $basicAuth->getPassword());
        }

        //IF POST TYPE
        if ($request->getType() == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request->getData());
        } elseif ($request->getType() == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->getType());
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request->getData());
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->getType());
        }

        $result = curl_exec($ch);
        
        //Close curl
        curl_close($ch);

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
     * @return type
     */
    public function getGlobalParams()
    {
        return $this->globalParams;
    }
}
