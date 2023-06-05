<?php

namespace  Nicholasmt\ZoomWebhook;

class ZoomWebhook
{
    static function VerifyHeader() 
    {
        $Zoom_Secret_Token = env('ZOOM_SECRET_TOKEN');

        $message = 'v0:'.$request->header('x-zm-request-timestamp').':'.$request->getContent();
        $hash = hash_hmac('sha256', $message, $Zoom_Secret_Token);
        $signature = "v0={$hash}";
        $verified = hash_equals($request->header('x-zm-signature'), $signature);
        return $verified;
        
    }
    static function ValidateUrl() 
    {
            $Zoom_Secret_Token = env('ZOOM_SECRET_TOKEN');
            $zoomData = json_decode($request->getContent(), true);
            $zoomSecret = $Zoom_Secret_Token;  
            $zoomPlainToken = $zoomData['payload']['plainToken'];
            $hash = hash_hmac('sha256', $zoomPlainToken, $zoomSecret);
            $reponseData['plainToken'] = $zoomPlainToken;
            $reponseData['encryptedToken'] = $hash;
            return response()->json($reponseData);
        
    }
}