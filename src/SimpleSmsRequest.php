<?php namespace Rungopher\SimpleSms;

class SimpleSmsRequest {

	private $url;
	private $port;
	private $username;
	private $password;

	private $body;

	public function __construct($url, $port, $username, $password) {
		$this->url = $url;
		$this->port = $port;
		$this->username = $username;
		$this->password = $password;
	}

	public function setBody($sender, $recipient, $message) {
		$this->body = [
			'From' => $sender,
			'To' => $recipient,
			'Body' => $message
		];
	}

	public function getBody() {
		return http_build_query($this->body);
	}

	public function getUrl() {
		return $this->url;
	}

	public function getPort() {
		return $this->port;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}
}