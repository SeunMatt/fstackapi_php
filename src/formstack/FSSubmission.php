<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 11:55 AM
 */

namespace FormStack;


class FSSubmission extends FSClient {

    public function __construct($token = null, $baseUrl = null, $xmlResponseType = false) {
        parent::__construct($token, $baseUrl, $xmlResponseType);
    }

    /*
     * Get all the submissions for this particular form
     * @param $id of the form associated with the submissions required
     * @param $query string appended to the api url. It is optional
     * @return assoc array of the API response
     * */
    public function all($formId, $query = null) {
        if(is_null($formId) || strlen($formId) <= 0) {
            throw new FSException("The supplied form id should not be null and empty");
        }
        $uri = "form/".$formId."/submission";
        if(!is_null($query) && count($query) > 0) {
            $uri = $uri . "?".http_build_query($query);
        }
        $response = $this->client->get($uri);
        return json_decode($response->getBody(), true);
    }


    /*
     * This add a new submission to a form
     * @param $id of the form associated with the submissions required
     * @param $data: an assoc array of data to insert into the form
     * Note: the form fields should be in the form field_x where x is the id of the form field
     * it does require a pre-knowledge of the fields and their id.
     * see https://developers.formstack.com/docs/form-id-submission-post for more
     * @return assoc array of the API response
     * */
    public function newSubmission($formId, $data) {
        if(is_null($formId) || is_null($data) || count($data) <= 0) {
            throw new FSException("Form Submission require a form id, and a non-null and empty assoc array of data");
        }
        $uri = "form/".$formId."/submission";
        $response = $this->client->post($uri, ["json" => $data]);
        return json_decode($response->getBody(), true);
    }



}