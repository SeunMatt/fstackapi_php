<?php
/**
 * Created by PhpStorm.
 * User: smatt
 * Date: 22/06/2017
 * Time: 04:05 PM
 */
namespace Config;

return [

    "access_token" => env("FORMSTACK_ACCESS_TOKEN", null),
    "base_url" => env("FORMSTACK_BASE_URL", "https://www.formstack.com/api/v2/")

];

?>