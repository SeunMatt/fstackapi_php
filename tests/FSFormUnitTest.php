<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 02:11 PM
 */

namespace Tests;


use FormStack\FSForm;
use PHPUnit\Framework\TestCase;

class FSFormUnitTest extends TestCase{

    public function testForm_whenGetAllForms_thenResponseData() {
        $fsForm = new FSForm();
        print("there are " . count($fsForm->all()) . " forms in record");
    }

    public function testForm_givenId_whenGet_thenResponseData() {
        $fsForm = new FSForm();
        print_r($fsForm->get("2709240"));
    }

    public function testForm_givenData_whenCreate_thenResponseData() {
        $fsForm = new FSForm();
        print_r($fsForm->create(["name" => "Created by API"]));
    }



}