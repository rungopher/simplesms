<?php namespace Rungopher\SimpleSms\Messages;

class SimpleSmsDeliveryReceipt {

	private $messageSid;
	private $status;

	public function __construct($messageSid, $status) {
		$this->messageSid = $messageSid;
		$this->status = $status;
	}

	public function getMessageSid() {
		return $this->messageSid;
	}

	public function getStatus() {
		return $this->status;
	}

	public function wasDelivered() {
		return $this->status == "delivered";
	}

	public function failed() {
		return !$this->wasDelivered();
	}

	public static function fromRequestBody($body) {
		parse_str($body, $data);

		return new static($data['MessageSid'], $data['Status']);
	}
}