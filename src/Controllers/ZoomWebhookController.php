<?php

namespace Nicholasmt\ZoomWebhook\Controllers;

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
           // validate endpoint url
           $validate = Zoomwebhook::ValidateUrl();
           return $validate;

            // check events url here

        } 

       
    }
}
