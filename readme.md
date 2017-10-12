# Rungopher SimpleSMS PHP Library

![Rungopher](https://www.rungopher.com/images/logo.png)

This library provides an easy way to interact with the [Rungopher SimpleSms API](https://www.rungopher.com/simple.html).

## Installation
Distributed via [packagist](https://packagist.org/packages/rungopher/simplesms). The suggested installation method is via [composer](https://getcomposer.org/):

``` shell
composer require "rungopher/simplesms:~1.0.0"
```


## Usage
### Sending an SMS:

*Note: This example uses cURL which requires the [cURL PHP Extension](http://php.net/manual/en/book.curl.php). To use a custom requester see* ***Using a Custom Requester*** *below.*

``` php
use Rungopher\SimpleSms\CurlRequester;
use Rungopher\SimpleSms\SimpleSmsClient;

$requester = new CurlRequester();
$client = new SimpleSmsClient($requester, "username", "password", "from");

try {
	$response = $client->sendSms("to", "message");
} catch(SimpleSmsErrorException $e) {
	log($e->getMessage());
}
```
**Error:** `SimpleSmsErrorException` is thrown containing the error message.

**Success:** `$client->sendSms()` returns an instance of **SimpleSmsOutbound** which has the following methods:


| Method          | Response Field |
| --------------- | -------------- |
| getFrom()       | from           |
| getTo()         | to             |
| getBody()       | body           |
| getMessageSid() | sid            |
| getStatus()     | status         | 
	
	
	
### Receiving a Delivery Receipt:
``` php
use Rungopher\SimpleSms\Messages\SimpleSmsDeliveryReceipt;

$deliveryReceipt = SimpleSmsDeliveryReceipt::fromRequestBody($requestBody);
```


**SimpleSmsDeliveryReceipt:**

| Method          | Response Field |
| --------------- | -------------- |
| getMessageSid() | MessageSid     |
| getStatus()     | Status         |
| wasDelivered()  | NA             |
| failed()        | NA             |


### Receiving an Inbound SMS:
``` php
use Rungopher\SimpleSms\Messages\SimpleSmsInbound;

$inboundSms = SimpleSmsInbound::fromRequestBody($requestBody);

```

**SimpleSmsInbound:**

| Method          | Response Field |
| --------------- | -------------- |
| getFrom()       | From           |
| getTo()         | To             |
| getBody()       | Body           |
| getMessageSid() | MessageSid     |


## Using a Custom Requester
A custom requester must implement `RequesterInterface`:

``` php
/**
returns: SimpleSmsResponse
*/
public function newRequest(SimpleSmsRequest $request);
```

**SimpleSmsRequest:**

| Method          | Returns               |
| --------------- | --------------------- |
| getBody()       | The request body.     |
| getUrl()        | The request url.      |
| getPort()       | The request port.     |
| getUsername()   | The request username. |
| getPassword()   | The request password. |


**SimpleSmsResponse:**

| Property          | Description                   |
| ----------------- | ----------------------------- |
| statusCode        | The request http status code. |
| response          | The request response body.    |

``` php
return new SimpleSmsResponse($statusCode, $response);
```


