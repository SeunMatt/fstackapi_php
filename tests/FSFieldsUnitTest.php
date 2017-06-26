<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 26/06/2017
 * Time: 02:18 PM
 */

namespace Tests;


use FormStack\FSField;

class FSFieldsUnitTest extends \PHPUnit_Framework_TestCase {

    public function tField_whenAll_givenFormId_thenFormFields() {
        $fsField = new FSField();
        print_r($fsField->all("2709240"));
    }

    public function tField_whenGet_thenFieldDetails() {
        $fsField = new FSField();
        print_r($fsField->get("53017115"));
    }

    public function tField_whenNewField_thenResult() {
        $fsField = new FSField();
        $param = ["field_type" => "text", "label" => "Dev API"];
        print_r($fsField->newField("2709240", $param));
    }

    public function tField_whenUpdate_thenUpdatedResult() {
        $fsField = new FSField();
        $param = ["field_type" => "text", "label" => "Dev API Updated"];
        print_r($fsField->newField("2709240", $param));
    }

    public function tField_whenDeleteField_givenFieldId_thenResult() {
        $fsField = new FSField();
        print_r($fsField->delete("53843399"));
    }


}
