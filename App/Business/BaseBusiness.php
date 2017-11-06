<?php
namespace App\Business;

use Protobuf\Garuda\GMessage;
use Protobuf\Garuda\Type;
use Protobuf\Garuda\MsgFormat;
use Protobuf\Garuda\Register;
use Protobuf\Garuda\TermType;
use Protobuf\Garuda\UserInfo;
use Protobuf\Garuda\MsgText;
use Protobuf\Garuda\GotoType;
use App\Business\Login;

abstract class BaseBusiness 
{
	const DEFAULT_VALUE = 1;  
		
	public $uid;	
	public $version;	
	public $msgVersion;	
	public $type;
	public $mType;
	public $time;
	public $cc;
	public $multilang;
	public $username;
	public $appkey;
	public $appName;
	public $userToken;
	public $body;
	public $mFormat;
	public $origUrl;
	public $midUrl;
	public $rId;
	public $sId;
	public $msgid;
	public $receiveTime;

	public abstract function generateBody(); 

	//接收从IM返回的信息，一般是再发送给websocket
	public abstract function receiveFromIM(); 

	protected function __construct()
	{
		global $configure;
		$this->version = $configure['im']['version'];
		$this->appkey = $configure['im']['appKey'];	
		$this->appName = $configure['im']['appName'];	
		$this->uid = $configure['im']['systemSenderId']; 
		$this->cc = $configure['im']['country']; 
		$this->multilang = $configure['im']['language']; 
		$this->username = $configure['im']['username']; 
		$this->userToken = $configure['im']['userToken']; 
	}

	public function sendToIM()
	{
		global $clientIm;
		$clientIm->send($this->getSendMessage());
		return true;
	}
	
	public function getSendMessage()
	{
		$requestMessage = new GMessage();
		$requestMessage->setVersion($this->version);
		$requestMessage->setMsgVersion($this->msgVersion);
		$requestMessage->setAppkey($this->appkey);
		$requestMessage->setMsgid($this->msgid);
		$requestMessage->setSendTime($this->time);
		$requestMessage->setType($this->type);
		$requestMessage->setMType($this->mType);
		$requestMessage->setSId($this->uid);
		$requestMessage->setRId($this->rId);
		$requestMessage->setCc($this->cc);
		$requestMessage->setMFormat($this->mFormat);
		$requestMessage->setTermType(TermType::NONE);
		$requestMessage->setBody($this->generateBody());
		return $requestMessage;
	}
	
}

