<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 02:18 PM
 */

namespace Tests;

use FormStack\FSSubmission;
use PHPUnit\Framework\TestCase;

class FSFormSubmissionUnitTest extends TestCase {

    public function testSubmission_givenId_whenAll_thenResponseData() {
        $fsSubmission = new FSSubmission();
        print("\nthere are " . count($fsSubmission->all("2709240")) . " submissions");
    }

    public function testSubmission_givenIdAndQuery_whenAll_thenResponseData() {
        $fsSubmission = new FSSubmission();
        print("\nthere are " . count($fsSubmission->all("2709240", ["per_page" => 2])) . " submissions matched");
    }

    public function testSubmission_givenIdAndData_whenNewSubmission_thenResponseData() {
        $fsSubmission = new FSSubmission();
        $id = "2709240";
        $data = [
            "field_53017115" => "Demo Organization",
            "field_53017113" => "Dev Geek"
        ];
        print_r($fsSubmission->newSubmission($id, $fsSubmission));
    }
}
