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

class Ack extends BaseBusiness 
{
	protected function __construct()
	{
		parent::__construct();
		$this->type = Type::ACK;
		$this->mFormat = MsgFormat::TEXT;
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	public static function createByParams($params=[])
	{
		$self = new self();
		global $configure;
		$self->mType = empty($params['mType']) ? MsgType::USER_MSG_ACK_2S : $params['mType'];
		$self->version = !isset($params['version']) ? $configure['im']['version'] : $params['version'];
		$self->msgVersion = !isset($params['msgVersion']) ? 0 : $params['msgVersion'];
		$self->multilang = empty($params['multilang']) ? $configure['im']['language'] : $params['multilang'];
		$self->cc = empty($params['cc']) ?  $configure['im']['country']: $params['cc'];
		$self->rId = empty($params['rId']) ? 0 : $params['rId'];
		$self->sId = empty($params['sId']) ? 0 : $params['sId'];
		$self->appkey = empty($params['appkey']) ? $configure['im']['appKey'] : $params['appkey'];
		$self->msgid = empty($params['msgid']) ? PubFunction::getMsgId($self->rId, $self->type, $self->mType, $self->mFormat, $self->time) : $params['msgid'];
		$self->body = null;
		return $self;
	}

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

	//todo::接收IM返回的ACK
	public function receiveFromIM()
	{
		return true;
	}

}

