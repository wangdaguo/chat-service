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
use Protobuf\Garuda\OfflineRes;
use Protobuf\Garuda\MsgType;
use App\PubFunction;

class OfflineResBusiness extends BaseBusiness 
{
	protected function __construct()
	{
		parent::__construct();
		$this->type = Type::PULL_ACT;
		$this->mFormat = MsgFormat::TEXT;
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	//此方法不会被使用，因为此业务为下发消息
	public static function createByParams($params=[])
	{
		global $configure;
		$self = new self();
		$self->type = !isset($params['type']) ? Type::PULL_ACT : $params['type'];
		$self->mType = MsgType::PULL_OFFLINE_MSG;
		$self->version = !isset($params['version']) ? $configure['im']['version'] : $params['version'];
		$self->msgVersion = !isset($params['msgVersion']) ? PubFunction::getMaxMsgVersion() : $params['msgVersion'];
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
		$self->type = $message->getType();
		$self->mType = $message->getMType();
		$self->mFormat = $message->getMFormat();
		$self->appkey = $message->getAppkey();
		$self->sId = $message->getSId();
		$self->rId = $message->getRId();
		$self->msgid = $message->getMsgid();
		$self->multilang = $message->getMultilang();
		$self->cc = $message->getCc();

		$offlineRes = new OfflineRes();
		$offlineRes->mergeFromString($message->getBody());
		$self->body = $offlineRes;
		return $self;
	}

	public function generateBody() 
	{
		return null;
	}

	//获取离线消息
	public function receiveFromIM()
	{
		global $wsConnection;
		$messageList = $this->body->getOfflineMsg();
		if (empty($messageList))
		{
			return true;
		}
		foreach ($messageList as $message)
		{
			//拉离线
			$business = ContentFormatFactory::createByMessage($message, false);
			$business->receiveFromIM();
		}
		//同步版本号
		PubFunction::setMaxMsgVersion($this->msgVersion);
		//发送ack
		$ack = Ack::createByParams(['msgVersion'=>$this->msgVersion, 'sId'=>$this->sId, 'mFormat'=>MsgFormat::TEXT, 'mType'=>MsgType::USER_MSG_ACK_2S, 'appKey'=>$this->appkey]);	
		$ack->sendToIM();
		return true;
	}

}

