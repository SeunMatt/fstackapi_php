<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 26/06/2017
 * Time: 04:33 PM
 */

namespace Tests;

use FormStack\FSFolder;

class FSFolderUnitTest extends \PHPUnit_Framework_TestCase {

    public function testFolder_whenNewFolderMethods_givenRequiredParams_thenPrintAPIResponse() {

        $fsFolder = new FSFolder();

        print_r("All folders\n");

        print_r("there are ". count($fsFolder->all()). " folders\n");

        print_r("creating a new folder\n");

        print_r($newFolder = $fsFolder->newFolder("Dev Folder"));

        print_r("Details of new folder created\n");

        print_r($fsFolder->get($newFolder["id"]));

        print_r("Updating folder details\n");

        print_r($fsFolder->update($newFolder["id"], "Dev Folder Updated"));

        print_r("Details of updated folder created\n");

        print_r($fsFolder->get($newFolder["id"]));

        print_r("Deleting folder\n");

        print_r($fsFolder->delete($newFolder["id"]));
    }


}
