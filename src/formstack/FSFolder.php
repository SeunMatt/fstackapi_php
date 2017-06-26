<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 26/06/2017
 * Time: 04:06 PM
 */

namespace FormStack;


use FormStack\FSClient;
use FSExceptions\FSException;

class FSFolder extends FSClient {

    public function __construct($token = null, $baseUrl = null, $xmlResponseType = false) {
        parent::__construct($token, $baseUrl, $xmlResponseType);
    }

    /*
     * This will list all the forms available to the auth user
     * */
    public function all() {
        $uri = "folder";
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }


    /*
     * Get the details of a specific folder
     * */
    public function get($folderId) {
        $this->validateId($folderId);
        $uri = "folder/".$folderId;
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }

    /*
     * Create a new folder.
     * @param $name of the folder - required
     * @param $parent id of the folder, if any - optional
     * */
    public function newFolder($name, $parent = null) {
        if(is_null($name) || strlen($name) <= 0) {
            throw new FSException("The name of the folder can not be null or an empty string");
        }
        $uri = "folder";
        $requestOptions = ["name" => $name];
        if(!is_null($parent)) {
            $requestOptions["parent"] = $parent;
        }
        $response = $this->client->post($uri, ["json" => $requestOptions]);
        return json_decode($response->getBody(), true);

    }

    /*
     * Update the name of the folder
     * @param $folderId - required
     * @param $name - new name to be set - required
     * */
    public function update($folderId, $name) {
        $this->validateId($folderId);
        if(is_null($name) || strlen($name) <= 0) {
            throw new FSException("The name of the folder can not be null or an empty string");
        }
        $uri = "folder/".$folderId;
        $response = $this->client->put($uri, ["json" => ["name" => $name]]);
        return json_decode($response->getBody(), true);
    }

    /*
     * Delete the folder identified by $folderId
     * @param $folderId - required
     * */
    public function delete($folderId) {
        $this->validateId($folderId);
        $uri = "folder/".$folderId;
        $response = $this->client->delete($uri);
        return json_decode($response->getBody(), true);
    }

}