<?php
/*
 * options.php
 *
 * Using SafeURL with custom options
 */
require '../vendor/autoload.php';

use fin1te\SafeURL\SafeURL;
use fin1te\SafeURL\Options;

try {
    $curlHandle = curl_init();

    $options = new Options();
    //Completely clear the whitelist
    $options->setList('whitelist', []);
    //Completely clear the blacklist
    $options->setList('blacklist', []);
    //Set the domain whitelist only
    $options->setList('whitelist', ['google.com', 'youtube.com'], 'domain');

    $result = SafeURL::execute('http://www.youtube.com', $curlHandle);
} catch (Exception $e) {
    //Handle exception
}
