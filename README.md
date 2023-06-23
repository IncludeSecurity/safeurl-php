# SafeURL for PHP
### Originally contributed by Jack Whitton [@fin1te](http://github.com/fin1te)

## Overview
SafeURL is a library that aids developers in protecting against a class of vulnerabilities known as [Server Side Request Forgery](http://www.acunetix.com/blog/articles/server-side-request-forgery-vulnerability/). It does this by validating each part of the URL against a configurable white or black list before making an HTTP request. SafeURL is open-source and licensed under MIT.

Note that for mitigating SSRF vulnerabilities, we first recommend routing outbound requests from your infrastructure through a proxy such as [Smokescreen](https://github.com/stripe/smokescreen). Alternately, ensure that all services which can make outbound requests to potentially user-controlled URLs are firewalled from talking to other internal hosts. Application-layer defences such as this library should only be used if those options are not practical. Please see [our blog post](https://blog.includesecurity.com/2023/03/mitigating-ssrf-in-2023/) for further information.

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
$options->addToList('blacklist', 'domain', '([\w\.\-]+\.)?evil.com');
$options->addToList('whitelist', 'scheme', 'ftp');

//This will now throw an InvalidDomainException
$response = SafeURL::execute('http://evil.com', $curlHandle, $options);

//Whilst this will be allowed, and return the response
$response = SafeURL::execute('ftp://example.com', $curlHandle, $options);
```
