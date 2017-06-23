fstackapi_php
=============
This is a PHP wrapper for formstack's REST API v2. Compatible with Laravel.

Installation
============
It is not yet on packagist. So first, add this to your composer.json file.
If the section doesn't exist yet, you can create it.

```json
"require" : {
	"seunmatt/fstackapi_php": "dev-master"
},
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/SeunMatt/fstackapi_php"
        }
	]
```


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