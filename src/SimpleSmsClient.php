<?php namespace Rungopher\SimpleSms;

use Rungopher\SimpleSms\SimpleSmsRequest;
use Rungopher\SimpleSms\Requesters\RequesterInterface;
use Rungopher\SimpleSms\Messages\SimpleSmsOutbound;

class SimpleSmsClient {

	const SIMPLE_SMS_URL = "https://sms.rungopher.com/Messages";
	const SIMPLE_SMS_PORT = 5679;

	private $requester;
	private $request;

	private $sender;

	public function __construct(RequesterInterface $requester, $username, $password, $sender) {
		$this->requester = $requester;
		$this->sender = $sender;

		$request = new SimpleSmsRequest(
			self::SIMPLE_SMS_URL, self::SIMPLE_SMS_PORT, $username, $password
		);

		$this->request = $request;
	}

	public function sendSms($to, $message) {
		$this->request->setBody($this->sender, $to, $message);
		
		$response = $this->requester->newRequest($this->request);

		if ($response->getStatusCode() >= 400) {
        	throw new SimpleSmsErrorException($response->getResponse());
        }

		return SimpleSmsOutbound::fromJson($response->getResponse());  
	}
}