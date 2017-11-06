<?php
namespace App\Business;

use Protobuf\Garuda\MsgText;
use Protobuf\Garuda\MsgPic;
use Protobuf\Garuda\MsgFormat;
use Protobuf\Garuda\Register;
use Protobuf\Garuda\Type;
use Protobuf\Garuda\MsgType;
use App\PubFunction;

class ContentFormatFactory extends BaseBusiness 
{
	protected function __construct($params=[])
	{
		parent::__construct($params);
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	public static function createByParams($params=[])
	{
		global $configure;
		$self = new self();
		$self->type = Type::SERVICE_CHAT;
		$self->mType = MsgType::NORMAL_MSG;
		$self->mFormat = $params['mFormat'];
		$self->rId = empty($params['rId']) ? 0 : $params['rId'];
		$self->sId = empty($params['sId']) ? 0 : $params['sId'];
		$self->msgid = PubFunction::getMsgId($self->rId, $self->type, $self->mType, $self->mFormat, $self->time);
		$self->msgVersion = empty($params['msgVersion']) ? 0 : $params['msgVersion'];
		$self->version = !isset($params['version']) ? $configure['im']['version'] : $params['version'];
		$self->multilang = empty($params['multilang']) ? $configure['im']['language'] : $params['multilang'];
		$self->cc = !isset($params['cc']) ?  $configure['im']['country'] : $params['cc'];
		$self->body = self::createMsgText($params);
		switch ($params['mFormat'])
		{
		case MsgFormat::TEXT: 
			$self->body = self::createMsgText($params);
			break;
		case MsgFormat::PIC: 
			$self->body = self::createMsgPic($params);
			break;
		}
		return $self;
	}

	public static function createByMessage($message, $isPull=true) 
	{
		global $authInfo;
		$self = new self();
		$self->type = $message->getType();
		$self->mType = $message->getMType();
		$self->mFormat = $message->getMFormat();
		$self->sId = $message->getSId();
		$self->rId = $message->getRId();
		$self->msgVersion = $message->getMsgVersion();
		$self->msgid = empty($message->getMsgid()) ? PubFunction::getMsgId($self->rId, $self->type, $self->mType, $self->mFormat, $self->time) : $message->getMsgid();
		$self->version = $message->getVersion();
		$self->multilang = $message->getMultilang();
		$self->cc = $message->getCc();
		$self->receiveTime = $message->getReceiveTime();
		switch ($message->getMFormat())
		{
		case MsgFormat::TEXT: 
			$msgText = new MsgText();
			$msgText->mergeFromString($message->getBody());
			$self->body = $msgText; 
			break;
		case MsgFormat::PIC: 
			$msgPic = new MsgPic();
			$msgPic->mergeFromString($message->getBody());
			$self->body = $msgPic;
			break;
		}
		if ($isPull)
		{
			$self->pullOfflineMsg();
		}
		PubFunction::printLog(['type'=>$self->type, 'content'=>$self->body->getContent()]);
		return $self;
	}

	public function sendAckMessage()
	{
		$ack = Ack::createByParams(['msgVersion'=>$this->msgVersion, 'sId'=>$this->sId, 'mFormat'=>MsgFormat::TEXT, 'mType'=>MsgType::USER_MSG_ACK_2S, 'appKey'=>$this->appkey]);	
		$ack->sendToIM();
		return ;
	}

	public function pullOfflineMsg()
	{
		$currentMsgVersion = PubFunction::getMaxMsgVersion();
		if ($currentMsgVersion + 1 < $this->msgVersion)
		{
			//拉离线		
			$offlineReqBusiness = BusinessFactory::getInstanceByParams(Type::PULL_ACT, ['startVersion'=>$currentMsgVersion, 'endVersion'=>$this->msgVersion-1]);
			$offlineReqBusiness->sendToIM();
		}
		PubFunction::setMaxMsgVersion($this->msgVersion);
		$this->sendAckMessage();
		return ;
	}

	public function generateBody()
	{
		global $authInfo;
		$bodyStr = $this->body->serializeToString();
		//todo::删掉
		//return $bodyStr;
		return PubFunction::encrypt($bodyStr, $authInfo['key']);
	}

	public static function createMsgText($params)
	{
		$msgText = new MsgText();
		foreach (['content'] as $field)
		{
			if (isset($params[$field]))
			{
				$method = "set$field";
				if (method_exists($msgText, $method))
				{
					$msgText->$method($params[$field]);
				}
			}
		}
		return $msgText;
	}

	public static function createMsgPic($params)
	{
		$msgPic = new MsgPic();
		foreach (['content', 'origUrl', 'thumbFile'] as $field)
		{
			if (isset($params[$field]))
			{
				$method = "set$field";
				if (method_exists($msgPic, $method))
				{
					$msgPic->$method($params[$field]);
				}
			}
		}
		return $msgPic;
	}

	public function receiveFromIM()
	{
		global $wsConnection;
		$res = [];
		foreach (['mType', 'mFormat', 'type', 'rId', 'sId', 'msgVersion', 'msgid', 'receiveTime', 'cc', 'multilang'] as $field)
		{
			$res[$field] = $this->$field;
		}
		foreach (['content', 'origUrl', 'midUrl'] as $field)
		{
			$method = "get$field";
			if (method_exists($this->body, $method))
			{
				$res[$field] = $this->body->$method();
			}
		}
		$wsJson = new WsJson($res);
		$wsJson->sendToWs();
		return true;
	}

}
