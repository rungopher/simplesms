<?php namespace Rungopher\SimpleSms\Requesters;

use Rungopher\SimpleSms\Requesters\RequesterInterface;
use Rungopher\SimpleSms\SimpleSmsRequest;
use Rungopher\SimpleSms\SimpleSmsErrorException;
use Rungopher\SimpleSms\SimpleSmsResponse;

class CurlRequester implements RequesterInterface {

	private $curl;

	public function __construct() {
		$this->curl = curl_init();
	}

	public function newRequest(SimpleSmsRequest $request) {

		curl_setopt_array($this->curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $request->getUrl(),
			CURLOPT_PORT => $request->getPort(),
			CURLOPT_USERPWD => "{$request->getUsername()}:{$request->getPassword()}",
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $request->getBody(),
			CURLOPT_SSL_VERIFYPEER => FALSE
		));

		$response = curl_exec($this->curl);
		if (curl_errno($this->curl)) {
			throw new SimpleSmsErrorException("Couldn't send request: " . curl_error($this->curl));
		}

		$statusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
		curl_close($this->curl);

		return new SimpleSmsResponse($statusCode, $response);       
	}
}