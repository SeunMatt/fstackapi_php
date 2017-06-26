fstackapi_php
=============
This is a PHP wrapper for formstack's REST API v2. Compatible with Laravel.

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
It is not yet on packagist - coming very soon.


Usage
=====
**Currently this repo is actively under development**

The package is built around FormStack REST API (v2) and 
thus it is organized in a very simple and flexible way to use.

Response
--------
Every API Response is decoded into an assoc array that is then return from
each method.

Exceptions
-----------
You can wrap the method calls in a `try...catch` block to catch:
- `GuzzleHttp\Exception\RequestException`
- `FSExceptions\FSException`
- `FSExceptions\TokenNotSetException`

Configuration
-------------
The configuration file is formstack.php and permits setting:
the `access_token` and `base_url` that is used by the classes to communicate with the API
  
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