<?php namespace Rungopher\SimpleSms\Messages;

class SimpleSmsOutbound {

	private $from;
	private $to;
	private $body;
	private $messageSid;
	private $status;

	public function __construct($from, $to, $body, $messageSid, $status) {
		$this->from = $from;
		$this->to = $to;
		$this->body = $body;
		$this->messageSid = $messageSid;
		$this->status = $status;
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

	public function getStatus() {
		return $this->status;
	}

	public static function fromJson($json) {
		$data = json_decode($json);

		return new static($data->from, $data->to, $data->body, $data->sid, $data->status);
	}
}