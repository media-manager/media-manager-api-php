<?php

namespace MediaManager\HTTP;

class JsonResponse
{

    private $jsonString = "";
    private $jsonArray = array();
    private $hasErrors = false;
    private $errorMessage = "";

    public function __construct($jsonString)
    {
        //Set original string
        $this->jsonString = $jsonString;

        //Parse the JSON to an array
        $this->parseJSON();
    }

    /**
     * Parse JSON string into a assoc array. An Exception will be thrown
     * if JSON string is not valid JSON.
     * @throws \MediaManager\Exception\InvalidJSONException
     */
    private function parseJSON()
    {
        //Parse the JSON
        $parsed = json_decode($this->jsonString, true);

        //Set json array on object.
        $this->jsonArray = $parsed;

        //If json has an error key.
        if (isset($parsed["error"])) {
            $this->hasErrors = true;
            $this->errorMessage = (isset($parsed["error"]["message"])) ? $parsed["error"]["message"] : "Unknown";
        }

        //If JSON does not parse correctly, then throw exception. q
        if (is_null($this->jsonArray)) {
            $this->hasErrors = true;
            throw new \MediaManager\Exception\InvalidJSONException("Invalid JSON String");
        }
    }

    /**
     * JSONReponse to string. Simply returns original string.
     * @return string
     */
    public function toString()
    {
        return $this->jsonString;
    }

    /**
     * Get the error message from a json response (if any).
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * CHeck if JSON has error message within it.
     * @return type
     */
    public function hasErrors()
    {
        return $this->hasErrors;
    }

    /**
     * Return JSON as an assoc array.
     * @return array
     */
    public function toArray()
    {
        return $this->jsonArray;
    }

    /**
     * Set the JSON string
     * @param string $jsonString
     */
    public function setJson($jsonString)
    {
        $this->jsonString = $jsonString;
        $this->parseJSON();
    }
}
