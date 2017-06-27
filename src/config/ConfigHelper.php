<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 23/06/2017
 * Time: 02:36 PM
 */

namespace Config;


class ConfigHelper {

    public static function config() {
        if(!file_exists(realpath("./formstack.php")) ) {
            throw new \Exception("ERROR: config file [formstack.php] not found in package root's dir. 
            \nFile is expected here in this dir:
            ". realpath ( "."));
        }
        return include realpath("./formstack.php");
    }

}