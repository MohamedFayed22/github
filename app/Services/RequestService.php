<?php

namespace App\Services;

class RequestService
{

    public function getDataFromApi($url)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        
         $response->getStatusCode(); // 200
         $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        return  json_decode($response->getBody()); // '{"id": 1420053, "name": "guzzle", ...}'
        
        // // Send an asynchronous request.
        // $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
        // $promise = $client->sendAsync($request)->then(function ($response) {
        //     echo 'I completed! ' . $response->getBody();
        // });
        
        // $promise->wait();
    }
}