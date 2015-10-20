<?php

namespace MediaManager\HTTP;

/**
 * Description of HTTP
 *
 * @author Dale
 */
class HTTP {

    /**
     * The Global Params
     * @var type 
     */
    private $globalParams = array();

    /**
     * Perform a GET request
     * @param type $url
     * @param type $params
     */
    public function Get($url, array $params = array()) {
        return $this->Request($url, $params, "GET");
    }

    /**
     * Send a HTTP request
     * @param type $url
     * @param type $data
     * @param type $type
     * @param type $sendingFile
     * @param type $headers
     * @param array $auth
     * @return type
     */
    public function Request($url, $data = array(), $type = 'POST', $sendingFile = false, $headers = false, $auth = false) {

        //MERGE GLOBAL PARAMS INTO DATA PASSED.
        $data = array_merge($data, $this->globalParams);
        
        //IF NOT SENDING FILE, THEN CONVERT PARAMS INTO QUERY STRING.
        $data = (!$sendingFile) ? http_build_query($data, '', '&') : $data;

        //IF TYPE A GET REQUEST.
        $url .= ($type != 'POST' && $type != 'PUT') ? '?' . $data : '';
        
        //SETUP CURL REQUEST
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER["HTTP_HOST"]);

        //IF ANY HEADERS PASSED, THEN SET THEM.
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        //IF SENDING AUTH
        if ($auth) {
            curl_setopt($ch, CURLOPT_USERPWD, "{$auth["username"]}:{$auth["password"]}");
        }

        //IF POST TYPE
        if ($type == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else if ($type == "PUT") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        }

        $result = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($result, true);

        //IF VALID JSON, THEN RETURN THAT
        if (!is_null($json)) {

            //IF AN ERROR HAS HAPPEND
            if (isset($json["error"])) {
                return array("error" => $json["error"]["message"]);
            }

            return $json;
        }

        return $result;
    }

    /**
     * Set any global parameters that will be passed to all HTTP requests.
     * @param array $params
     */
    public function setGlobalParams(array $params) {
        $this->globalParams = array_merge($params, $this->globalParams);
    }

}
