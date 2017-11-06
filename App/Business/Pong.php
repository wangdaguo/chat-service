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
use Protobuf\Garuda\MsgType;
use App\PubFunction;

class Pong extends BaseBusiness 
{
	protected function __construct()
	{
		parent::__construct();
		$this->type = Type::PONG;
		$this->mFormat = MsgFormat::TEXT;
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	//此方法不会用到
	public static function createByMessage($message)
	{
		$self = new self();
		$self->msgVersion = $message->getMsgVersion();
		$self->mType = $message->getMType();
		$self->appkey = $message->getAppkey();
		$self->sId = $message->getSId();
		$self->rId = $message->getRId();
		$self->msgid = $message->getMsgid();
		$self->multilang = $message->getMultilang();
		$self->cc = $message->getCc();
		$self->body = null;
		return $self;
	}

	public function generateBody() 
	{
		return null;
	}

	public function receiveFromIM()
	{
		return true;
	}


}

