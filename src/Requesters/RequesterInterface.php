<?php namespace Rungopher\SimpleSms\Requesters;

use Rungopher\SimpleSms\SimpleSmsRequest;

interface RequesterInterface {
	public function newRequest(SimpleSmsRequest $request);
}