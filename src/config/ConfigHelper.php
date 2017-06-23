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
        return include "\"../../dev-formstack.php\"";
    }

}