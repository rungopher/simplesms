<?php namespace Rungopher\SimpleSms\Messages;

class SimpleSmsInbound {

	private $from;
	private $to;
	private $body;
	private $messageSid;

	public function __construct($from, $to, $body, $messageSid) {
		$this->from = $from;
		$this->to = $to;
		$this->body = $body;
		$this->messageSid = $messageSid;
	}

	public function getFrom() {
		return $this->from;
	}

	public function getTo() {
		return $this->to;
	}

	public function getBody() {
		return $this->body;
	}

	public function getMessageSid() {
		return $this->messageSid;
	}

	public static function fromRequestBody($body) {
		parse_str($body, $data);

		return new static($data['From'], $data['To'], $data['Body'], $data['MessageSid']);
	}
}