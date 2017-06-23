<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 11:09 AM
 */

namespace FormStack;

class FSForm extends FSClient {

    public function __construct($token = null, $baseUrl = null, $xmlResponseType = false) {
        parent::__construct($token, $baseUrl, $xmlResponseType);
    }

    /*
     * Returns all the forms available for the authenticated user
     * */
    public function all() {
        $uri = "form";
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }

    /*
     * Get details of a particular form
     * @param $id of the existing form
     * @return assoc array of API response
     * */
    public function get($id) {
        if(is_null($id) || strlen($id) <= 0) {
            throw new FSException("The supplied form id should not be null and empty");
        }
        $uri = "form/".$id;
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }


    /*
     * creates a new form
     * @param $param: an assoc array of params.
     * Check https://developers.formstack.com/docs/form-post for more info
     * Note: the param should at least have a name
     * @return assoc array of API response
     * */
    public function create($param) {
        if(!array_key_exists("name", $param) || is_null($param['name']) ) {
            throw new FSException("The supplied param assoc array must have a 'name' entry with a non-null key");
        }
        $uri = "form";
        $response = $this->client->post($uri, ["json" => $param]);
        return json_decode($response->getBody(), true);
    }


    /*
     * update the details of an existing form. Like the number of columns and others details. See more at
     * https://developers.formstack.com/docs/form-id-put
     * @param $id of the form to be updated
     * @param $param - an assoc array of the form properties
     * @return assoc array of API response
     * */
    public function update($id, $param) {
        if(!array_key_exists("name", $param) || is_null($param['name']) ) {
            throw new FSException("The supplied param assoc array must have a 'name' entry with a non-null key");
        }
        if(is_null($id) || strlen($id) <= 0) {
            throw new FSException("The supplied form id should not be null and empty");
        }
        $uri = "form/".$id;
        $response = $this->client->put($uri, ["json"    => $param]);
        return json_decode($response->getBody(), true);
    }


    /*
     * Delete a particular form on FormStack
     * @param $id of the form to be deleted
     * @return assoc array of API response
     * */
    public function delete($id){
        if(is_null($id) || strlen($id) <= 0) {
            throw new FSException("The supplied form id should not be null and empty");
        }
        $uri = "form/".$id;
        $response = $this->client->delete($uri);
        return json_decode($response->getBody(), true);
    }



}