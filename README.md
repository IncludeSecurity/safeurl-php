# SafeURL for PHP
### Originally contributed by Jack Whitton [@fin1te](http://github.com/fin1te)

## Overview
SafeURL is a library that aids developers in protecting against a class of vulnerabilities known as [Server Side Request Forgery](http://www.acunetix.com/blog/articles/server-side-request-forgery-vulnerability/). It does this by validating each part of the URL against a configurable white or black list before making an HTTP request. S
afeURL is open-source and licensed under MIT.

## Installation
Clone this repository and import it into your project.

## Implementation
SafeURL intends to be a wrapper replacement for the `curl_exec()` method from [libcurl](http://php.net/manual/en/function.curl-exec.php) in PHP. It can simply be replaced with `SafeURL::execute()` wrapped in a `try {} catch {}` block.

  ```php
    try {
        $url = $_GET['url']; // User controlled input

        $curlHandle = curl_init();
        //Your usual cURL options
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (SafeURL)');

        //Execute using SafeURL
        $response = SafeURL::execute($url, $curlHandle);
    } catch (Exception $e) {
        //URL wasn't safe
    }
  ```

## Configuration
Options such as white and black lists can be modified. For example:

```php
//Create an Options object
$options = new Options();
//Works with regex
$options->addToList('blacklist', 'domain', '(.*)\.evil\.com');
$options->addToList('whitelist', 'scheme', 'ftp');

//This will now throw an InvalidDomainException
$response = SafeURL::execute('http://evil.com', $curlHandle, $options);

//Whilst this will be allowed, and return the response
$response = SafeURL::execute('ftp://example.com', $curlHandle, $options);
```
