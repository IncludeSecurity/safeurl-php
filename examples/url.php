<?php
/*
 * url.php
 *
 * Using SafeURL\Url to only valid a URL
 */
require '../vendor/autoload.php';

use fin1te\SafeURL\Options;
use fin1te\SafeURL\Url;

try {
    $safeUrl = Url::validateUrl('http://google.com', new Options());
} catch (Exception $e) {
    //Handle exception
}
