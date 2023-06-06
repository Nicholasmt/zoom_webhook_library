# <img src="https://st2.zoom.us/static/6.3.12613/image/new/topNav/Zoom_logo.svg">

# Laravel Package Library to verify and validate zoom endpoint webhook url
 
# To get started Run

```
composer require nicholasmt/zoom_webhook

```

Note: if You encounter this or any other error which means you are using the old version of those packages

```console

Your requirements could not be resolved to an installable set of packages.

```

To Resolve simply run
 
```console
 composer update
 
 ```

After successfull composer update then install the package again with 
```console composer require nicholasmt/zoom_webhook ```

Note: if you encounter any error based on poor network during update, 

just backup the vender file, delete and run composer update again with 
```console composer update ```


Configure .env file with below

```console
ZOOM_SECRET_TOKEN="your zoom secret token"

```
Create a controller and require package using

```php

use Nicholasmt\ZoomWebhook\Zoomwebhook;

```
Remember to excetp the route from csrf token verification under App/Http/middleware/VerifyCsrfToken.php 

```php

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
    
    //route url below
      'zoom/webhook',
       
      
     ];
}

```


Create a POST Route for the endpoint url
```php
 Route::post('zoom/webhook', [App\Http\Controllers\ZoomWebhookController::class, 'webhook_handler'])->name('zoom-webhook');
 
```

To Verfiy the request header and Validate according to zoom webhook docs here is the code example using the library.

```php

use Illuminate\Http\Request;
use Nicholasmt\ZoomWebhook\Zoomwebhook;

class ZoomWebhookController 
{
    public function webhook_handler()
    {
        // verify if is actually coming from zoom
        $verify_request_header = Zoomwebhook::VerifyHeader(); 
        if($verify_request_header)
        {
              //validate endpoint url
               $validate = Zoomwebhook::ValidateUrl();
               return $validate;
               
               //Comment out this after succefully validation
               
                //$validate = Zoomwebhook::ValidateUrl();
                 //return $validate;
               
        }
         
    }
}

```
Then after successful validation you will receive zoom events here

```php
        $verify_request_header = Zoomwebhook::VerifyHeader(); 
        if($verify_request_header)
        {
          // trap zoom events here
        }

```
Use NGROK for testing  <a href="https://ngrok.com"> Here </a>, Check out ngrok Docs on how to use.




