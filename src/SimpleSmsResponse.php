<?php namespace Rungopher\SimpleSms;

class SimpleSmsResponse {

	private $statusCode;
	private $response;

	public function __construct($statusCode, $response) {
		$this->statusCode = $statusCode;
		$this->response = $response;
	}

	public function getStatusCode() {
		return $this->statusCode;
	}

	public function getResponse() {
		return $this->response;
	}

}