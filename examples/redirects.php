<?php
/*
 * redirects.php
 *
 * Using SafeURL and following redirects with a limit
 */
require '../vendor/autoload.php';

use fin1te\SafeURL\SafeURL;
use fin1te\SafeURL\Options;

try {
    $curlHandle = curl_init();

    $options = new Options();
    //Follow redirects, but limit to 10
    $options->enableFollowLocation()->setFollowLocationLimit(10);

    $result = SafeURL::execute('http://fin1te.net', $curlHandle);
} catch (Exception $e) {
    //Handle exception
}
