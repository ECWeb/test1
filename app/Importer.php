<?php

namespace App;

class Importer
{
    private $customers;
    private $data_provider;

    public function __construct($nationality, $limit)
    {
        $this->customers = [];
        $this->data_provider = 'https://randomuser.me/api/?nat='.$nationality.'&results='.$limit;
    }

    public function fetch() {
        // using curl, not use guzzle facade
        $url = $this->data_provider;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        $this->customers = $response;
        return $this;
    }

    public function get() {
        return $this->customers;
    }
}
