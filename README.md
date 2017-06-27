fstackapi_php
=============
This is a convenient PHP wrapper for Formstack's REST API v2. 
Compatible with Laravel.

**Remember to star and watch for changes**

Installation
============

From Github repo
----------------
Add this to your composer.json file and the run `composer update`

```json
    "require": {
        "seunmatt/fstackapi_php": "dev-master"
    },
    "repositories": [
            {
                "type": "git",
                "url": "https://github.com/SeunMatt/fstackapi_php.git"
            }
    ]
```

From Packagist
--------------
It is not yet on packagist - coming very soon

Laravel
-------
After installing the dependency. 
Add the service provider in config/app.php

 ```php
    FormStack\Providers\FSServiceProvider::class,
```

Run `php artisan vendor:publish` to publish the config file.
The config file is `formstack.php` and will be in the laravel config folder.
Set your access_token in the config file and proceed.

Usage
=====

The package is built around FormStack REST API (v2), 
thus it is organized in a very simple and flexible way to use.
It has different classes that models the elements of Formstack API.


API Response
------------

Every API Response is decoded into an assoc array and returned from
the caller. The responses are RAW API Response from Formstack; this facilitates flexibility and easy usage.

Configuration
-------------
The configuration file is formstack.php and permits setting:
the `access_token` and `base_url` that is used by the classes to communicate with the API.

if you clone the repo or are using it outside of laravel, 


Exceptions
-----------
You can wrap the method calls in a `try...catch` block to catch:
- `GuzzleHttp\Exception\RequestException`
- `FSExceptions\FSException`
- `FSExceptions\TokenNotSetException`

Tests for Devs
--------------
`PHPUnit` is used for testing and the test files are located in tests dir.
If you fork/clone the repo and will like to run the tests. 
 
First create a dev-formstack.php at the root dir with the following content
 
 ```php
<?php
 namespace Config;
 
 return [
 
     "access_token"=> "your-formstack-application-access-token",
     "base_url" => "https://www.formstack.com/api/v2/"

 ];
 
 ?>
 ```
 
Since, It is from this file that the `ConfigHelper` will read the config token from by default.

Alternatively, you can pass the token and base_url variable to the constructor during instantiation.
You will have to manually modify the test code to achieve this:

```php
$token = "your-formstack-app-access-token";
$baseUrl = "https://www.formstack.com/api/v2/";

$fsForm = new FSForm($token, $baseUrl);
$fsField = new FSField($token, $baseUrl);
$fsSubmision = new FSSubmission($token, $baseUrl);
$fsFolder = new FSFolder($token, $baseUrl);
```

Run the following command from the root dir to run the tests.

```
"./vendor/bin/phpunit"
```


FormStack Client
----------------
`FSClient` is the superclass for all other classes in the package.

It has a constructor that accepts optional parameters: 
$token - The API Access token from Formstack dashboard,
$baseUrl - The baseUrl of the formstack api. Default is "https://www.formstack.com/api/v2/"
$xmlResponseType - a boolean indicating the response type to expect from the API. Default is `false`

Other API Objects - Forms, Submissions, Fields, Webhooks, have classes that modelled them. Those classes
 extends FSClient class and have the same constructor.
 
So you can instantiate the FSForm class this way:

```php
$fsForm = new FSForm($token);

//if you have set the access_token and base_url variable in the config file
//you can just do this:

$fsForm = new FSForm();

``` 

Same applies to other classes


FormStack Form
--------------
 
 The FormStack Form is modelled by the `FSForm.php` class that has methods for 
 accessing and manipulating forms via the API.
 
 For example:
 ```php
$fsForm = new FSForm();

//get all available forms
$fsForm->all();

//get details of a form
$resp = $fsForm->get($formId);

//create a new form
//$param is an array of options/properties for the form
//it must have a "name" key else, FSException will be thrown
$param = ["name" => "Demo Form"];
$resp1 = $fsForm->create($param);


//to update the details of a form
$resp2 = $fsForm->update($formId, $param);

//to delete a form
$resp3 = $fsForm->delete($formId);

```


FormStack Submissions
---------------------
The FormStack Submission is modelled by the `FSSubmission.php` class that has methods for 
 accessing and manipulating forms via the API.
 
 ```php
//create an instance
$fsSubmission = new FSSubmission();

//to get all submisions for a Form call this method
//it takes an optional parameter of $query which is an assoc array of constraints 
//that can be applied to the query.
$resp = $fsSubmission->all($formId);


//to submit a new data to a particular form use
$resp = $fsSubmission->newSubmission($formId, $data);

```


Reference
=========
- Formstack API v2 docs: [https://developers.formstack.com/docs/api-overview](https://developers.formstack.com/docs/api-overview)
 
 
Contributors
============
Seun Matt: on twitter [@SeunMatt2](https://twitter.com/SeunMatt2/)

Contributing
============
just create a PR with your update.
**Remember to Star this repo and watch it for changes. Thank you**
 
LICENSE
=======
MIT