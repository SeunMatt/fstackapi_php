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
        //first try to read access_token from the env
        $access_token = getenv("access_token");
        if($access_token) {
            return [
                "access_token" => $access_token,
                "base_url" => "https://www.formstack.com/api/v2/"
                ];
        }
        else if(function_exists("config")) {

            return [
                "access_token" => config("formstack.access_token"),
                "base_url" => config("formstack.base_url")
            ];
        }
        else if(!file_exists(realpath("./formstack.php")) ) {
            throw new \Exception("ERROR: config file [formstack.php] not found in package root's dir. 
            \nFile is expected here in this dir:
            ". realpath ( "."));
        }
        return include realpath("./formstack.php");
    }

}