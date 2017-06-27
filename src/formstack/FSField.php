<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 26/06/2017
 * Time: 01:51 PM
 */

namespace FormStack;


use FSExceptions\FSException;

class FSField extends FSClient {

    public function __construct($token = null, $baseUrl = null, $xmlResponseType = false) {
        parent::__construct($token, $baseUrl, $xmlResponseType);
    }

    /*
     * Get all the fields of a form
     * */
    public function all($formId) {
        $this->validateId($formId);
        $uri = "form/".$formId."/field";
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }

    /*
     * Get the details of a particular field
     * */
    public function get($fieldId) {
        $this->validateId($fieldId);
        $uri = "field/".$fieldId;
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }


    /*
     * This will create new field
     * */
    public function newField($formId, $param) {
        $this->validateId($formId);
        if(is_null($param) || !array_key_exists("field_type", $param) || !array_key_exists("label", $param)) {
            throw new FSException("The param supplied is missing required fields: 'field_type', 'label' ");
        }
        $uri = "form/".$formId."/field";
        $response = $this->client->post($uri, ["json" => $param]);
        return json_decode($response->getBody(), true);
    }

    /*
     * This will update the details of a field
     * */
    public function update($fieldId, $param) {
        $this->validateId($fieldId);
        if(is_null($param) || !array_key_exists("field_type", $param) || !array_key_exists("label", $param)) {
            throw new FSException("The param supplied is missing required fields: 'field_type', 'label' ");
        }
        $uri = "field/".$fieldId;
        $response = $this->client->put($uri, ["json" => $param]);
        return json_decode($response->getBody(), true);
    }


    /*
     * This will delete the form field
     * */
    public function delete($fieldId) {
        $this->validateId($fieldId);
        $uri = "field/".$fieldId;
        $response = $this->client->delete($uri);
        return json_decode($response->getBody(), true);
    }
}