<?php
/*
 * default.php
 *
 * Using SafeURL with it's default options
 */
require '../vendor/autoload.php';

use fin1te\SafeURL\SafeURL;

try {
    $curlHandle = curl_init();
    $result = SafeURL::execute('https://fin1te.net', $curlHandle);
} catch (Exception $e) {
    //Handle exception
}
