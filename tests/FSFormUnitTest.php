<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 02:11 PM
 */

namespace Tests;


use FormStack\FSClient;
use FormStack\FSField;
use FormStack\FSForm;
use FormStack\FSSubmission;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class FSFormUnitTest extends TestCase {

    public function testForm_whenFormMethods_givenRequiredParams_thenPrintAPIResponse() {

       try {
           $fsForm = new FSForm();

           print("There are " . count($fsForm->all()) . " forms in record\n");

           print("\nTrying to create a form with the api\n");
           print_r($newForm = $fsForm->create(["name" => "Created by API"]));

           print("\nThere are " . count($allForms = $fsForm->all()) . " forms in record after api creation\n");

           $formId = $newForm["id"];

           /*
            * testing FSField
            * */

           $fsField = new FSField();

           print("\nGetting all fields for the created form\n");
           print_r($allFields = $fsField->all($formId));

           print_r("\nAdding a new field to the created form");
           $param = ["field_type" => "text", "label" => "Dev API Created Field"];
           print_r($field = $fsField->newField($formId, $param));

           $fieldId = $field["id"];

           print("\nDetails of created field \n");
           print_r($fieldDetail = $fsField->get($fieldId));

           print_r("\nUpdating created field " . $fieldDetail["label"]);

           $param = ["field_type" => "text", "label" => "Dev API Updated"];
           print_r($fsField->update($fieldId, $param));

           print("\nDetails of updated field");
           print_r($fsField->get($fieldId));


           print("\nGetting details for form " . $newForm["name"] . "\n");
           print_r($detail = $fsForm->get($formId));

           print_r("\nUpdating the details - name \n");
           print_r($fsForm->update($formId, ["name" => $detail["name"] . " updated by API"]));

           print("\nGetting details for form after update\n");
           print_r($fsForm->get($formId));

           /*
            * Testing FSSubmission
            * */

           $fsSubmission = new FSSubmission();

           print("\nMaking a Submission to the Created Form\n");
           $data = [
               "field_" . $fieldId => "Demo Organization",
           ];
           print_r($fsSubmission->newSubmission($formId, $data));

           print("\nCounting all Submissions to the Form\n");
           $allSubmissions = $fsSubmission->all($formId);
           print("\nThere are " . count($allSubmissions) . " submissions");

           print("\nDetails of a Single Submission\n");
           print_r($fsSubmission->get($allSubmissions["submissions"][0]["id"]));

           print("\nUpdating a Submission\n");
           $data = [
               "field_" . $fieldId => "Demo Organization Updated",
           ];
           print_r($fsSubmission->update($allSubmissions["submissions"][0]["id"], $data));


           /*
            * Deleting Operations
            * */

           print("\nDeleting API Submitted Submission\n");
           print_r($fsSubmission->delete($allSubmissions["submissions"][0]["id"]));

           print("\nDeleting API Created field\n");
           print_r($fsField->delete($fieldId));

           print("\nDeleting API created form\n");
           print_r($fsForm->delete($formId));

       }catch (RequestException $e) {
           print_r($e->getResponse()->getBody());
       }

    }

}