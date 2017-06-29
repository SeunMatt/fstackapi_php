fstackapi_php
=============
[![Build Status](https://travis-ci.org/SeunMatt/fstackapi_php.svg?branch=master)](https://travis-ci.org/SeunMatt/fstackapi_php)

This is a convenient PHP wrapper for Formstack's REST API v2. 
Compatible with Laravel.

**Remember to star and watch for changes**

Installation
============

`composer require seunmatt/fstackapi_php`

Laravel
-------
After installing the dependency. 
Add the service provider in config/app.php

 ```php
    FormStack\Providers\FSServiceProvider::class,
```

Run `php artisan vendor:publish` to publish the config file.
The config file is `formstack.php` and will be in the laravel config folder.
Set your `access_token` in the config file and proceed.

Usage
=====

The package is built around FormStack REST API (v2), 
thus it is organized in a very simple and flexible way to use.
It has different classes that model the elements of Formstack API.


API Response
------------

Every JSON API Response is decoded into an assoc array and returned to
the caller. 


Configuration
-------------

- If you are using this package in Laravel, just run `php artisan vendor:publish` to publish the config file `formstack.php`.
As usual, it will be located in the config folder.

In the config file, provide your value for `access_token`.  
The `base_url` by default is set to that of API v2.

- If you clone the repo or **are using it outside of laravel** then,
create a formstack.php at the root dir of the package with the following content:
 
 ```php
<?php
 namespace Config;
 
 return [
 
     "access_token"=> "your-formstack-application-access-token",
     "base_url" => "https://www.formstack.com/api/v2/"

 ];
 
 ?>
 ```
  
- Finally, you can put `access_token` in the environment for use. In which case, the default `base_url` will be used.
 
 The `ConfigHelper` class will read the configuration first from the env, then try the Laravel config helper,
 and finally try the config file in root dir of package.


FormStack Object Instantiation
------------------------------

Create an instance of the Formstack object you want to work with and then you can call the methods
on the instance:

```php
//using a no-arg constructor for instatiation
//assumes you have provided your access_token
//and base_url in the config file


$fsForm = new FSForm();

$fsField = new FSField();

$fsSubmision = new FSSubmission();

$fsFolder = new FSFolder();
```


**If you don't want to use the config file,
You can pass the `$token` and `$baseUrl` parameter to the Formstack objects during instantiation:**

```php
//initialization if no config file is provided

$token = "your-formstack-app-access-token";
$baseUrl = "https://www.formstack.com/api/v2/";

$fsForm = new FSForm($token, $baseUrl);

$fsField = new FSField($token, $baseUrl);

$fsSubmision = new FSSubmission($token, $baseUrl);

$fsFolder = new FSFolder($token, $baseUrl);
```


Example
-------

- **Working with forms**

```php
        
        $fsForm = new FSForm();
        
        //get all forms available to the authenticated account
        // API docs - https://developers.formstack.com/docs/form-get
        $allForms = $fsForm->all();
        
        //create a new form
        //see the docs for other params that can be sepcified in $body
        // API docs - https://developers.formstack.com/docs/form-post
        $body = ["name" => "Created by API"];
        $newForm = $fsForm->create($body);
              
        $formId = $newForm["id"];
        
        //Getting details for a single form
        // API Docs - https://developers.formstack.com/docs/form-id-get
        $detail = $fsForm->get($formId);

        //Updating the details of a form
        // API Docs - https://developers.formstack.com/docs/form-id-put
        $updatedForm = $fsForm->update($formId, ["name" => "Updated Form Name"]);
        
        //Deleting a form
        // API Docs - https://developers.formstack.com/docs/form-id-delete
        $response = $fsForm->delete($formId);
```

- **Working with Fields**

```php

        $fsField = new FSField();

        //Getting all fields for a form
        // API Docs - https://developers.formstack.com/docs/form-id-field-get
        $allFields = $fsField->all($formId);

        //Adding a new field to a form
        //API Doc - https://developers.formstack.com/docs/form-id-field-post
        $param = ["field_type" => "text", "label" => "Dev API Created Field"];
        $field = $fsField->newField($formId, $param);

        $fieldId = $field["id"];

        //Details of a field
        //API Doc - https://developers.formstack.com/docs/field-id-get
        $fieldDetail = $fsField->get($fieldId);

        //Updating the details of a field
        //API Doc - https://developers.formstack.com/docs/field-id-put
        $param = ["field_type" => "text", "label" => "Dev API Updated"];
        $updatedField = $fsField->update($fieldId, $param);

        //Deleting API Created field
        //API Doc - https://developers.formstack.com/docs/field-id-delete
        $response = $fsField->delete($fieldId);
```

- **Working with Submissions**

Submitting a form is straightforward but can be tricky.
First get the id for all the fields of the form you want to submit to.
You can do this with the FSField object (as shown above) 
and store the response somewhere you can reference them later.

Then you can proceed to build your data arrray and submit the form as demonstrated below.

```php
    
        $fsSubmission = new FSSubmission();

        //Submitting to a Form
        //note that you must prefix the field id with "field_x"
        //where x is the id of the field.
        //API Doc - https://developers.formstack.com/docs/form-id-submission-post 
        
        $data = [
            "field_0123943" => "Demo Field Value",
        ];
        $response = $fsSubmission->newSubmission($formId, $data);

        //Counting all Submissions to a Form
        //API Doc - https://developers.formstack.com/docs/form-id-submission-get
        
        $allSubmissions = $fsSubmission->all($formId);
       
       
        //Getting Details of a Single Submission entry
        //e.g. $submissionId = $allSubmissions["submissions"][0]["id"];
        //API Doc - https://developers.formstack.com/docs/submission-id-get
         
        $fsSubmission->get($submissionId);

        //Updating a Submission
        //API Doc - https://developers.formstack.com/docs/submission-id-put
        $data = [
            "field_".$fieldId => "Demo Organization Updated",
        ];
        $updatedSubmission = $fsSubmission->update($submissionId, $data);

        //Deleting a Submission
        //API Doc - https://developers.formstack.com/docs/submission-id-delete
        $fsSubmission->delete($submissionId);

```



- **Working with Folders**
    
```php
    
            $fsFolder = new FSFolder();
    
            //All folders for the authenticated user
            //API Doc - https://developers.formstack.com/docs/folder-get
            $allFolders = $fsFolder->all();
    
            //create a new folder
            //API Doc - https://developers.formstack.com/docs/folder-post
            $newFolder = $fsFolder->newFolder("Dev Folder");
    
            //Details of a folder    
            //e.g. $folderId = $newFolder["id"];
            //API Doc - https://developers.formstack.com/docs/folder-id-get
            $folderDetails = $fsFolder->get($folderId);
    
            //Updating a folder details    
            //API Doc - https://developers.formstack.com/docs/folder-id-put
            $updatedFolder = $fsFolder->update($folderId, $newFolderName));
    
            //Deleting a folder
            //API Doc - https://developers.formstack.com/docs/folder-id-delete
            $delResponse = $fsFolder->delete($folderId);

```


Exceptions
-----------
You can wrap the method calls in a `try...catch` block to catch:
- `GuzzleHttp\Exception\RequestException`
- `FSExceptions\FSException`

All exceptions to API calls are caught by `GuzzleHttp\Exception\RequestException`

Tests
-----
`PHPUnit` is used for testing and the test files are located in tests dir.
If you fork/clone the repo and will like to run the tests. 

First, ensure you have set up the config as specified above, then run the 
following command from the root dir of the package to run the tests.

*It will be a good idea to have an `access_token` to an account that has not reach its limit for number of forms creation.*

```
"./vendor/bin/phpunit"
```

API Components Not Covered
--------------------------
- Partial Submissions
- Confirmation Emails
- Notification Emails
- Webhooks


Reference
=========
Formstack API v2 docs: [https://developers.formstack.com/docs/api-overview](https://developers.formstack.com/docs/api-overview)
 
 
Contributors
============
Seun Matt: on twitter [@SeunMatt2](https://twitter.com/SeunMatt2/)

Contributing
============
[READ ABOUT CONTRIBUTING HERE](CONTRIBUTING.md)
 
LICENSE
=======
[MIT](LICENSE)