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
use Protobuf\Garuda\PushVersions;
use Protobuf\Garuda\MsgType;
use App\PubFunction;

class PushVersionsBusiness extends BaseBusiness 
{
	protected function __construct()
	{
		parent::__construct();
		$this->type = Type::SERVER_NOTICE;
		$this->mFormat = MsgFormat::TEXT;
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	//此方法用不到
	public static function createByParams($params=[])
	{
		global $configure;
		$self = new self();
		$self->type = !isset($params['type']) ? Type::SERVER_NOTICE : $params['type'];
		$self->mType = MsgType::PULL_VERSION;
		$self->version = !isset($params['version']) ? $configure['im']['version'] : $params['version'];
		$self->msgVersion = !isset($params['msgVersion']) ? PubFunction::getMaxMsgVersion() : $params['msgVersion'];
		$self->multilang = empty($params['multilang']) ? $configure['im']['language'] : $params['multilang'];
		$self->cc = empty($params['cc']) ?  $configure['im']['country']: $params['cc'];
		$self->rId = empty($params['rId']) ? 0 : $params['rId'];
		$self->sId = empty($params['sId']) ? 0 : $params['sId'];
		$self->appkey = empty($params['appkey']) ? $configure['im']['appKey'] : $params['appkey'];
		$self->msgid = empty($params['msgid']) ? PubFunction::getMsgId($self->rId, $self->type, $self->mType, $self->mFormat, $self->time) : $params['msgid'];
		$self->body = self::createPushVersions($params);
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

		$pushVersions = new PushVersions();
		$pushVersions->mergeFromString($message->getBody());
		$self->body = $pushVersions;
		return $self;
	}

	public static function createPushVersions($params)
	{
		$pushVersions = new PushVersions();
		foreach (['usercv', 'usize'] as $field)
		{
			if (isset($params[$field]))
			{
				$method = "set$field";
				if (method_exists($pushVersions, $method))
				{
					$pushVersions->$method($params[$field]);
				}
			}
		}
		return $pushVersions;
	}

	public function generateBody() 
	{
		global $authInfo;
		$bodyStr = $this->body->serializeToString();
		return PubFunction::encrypt($bodyStr, $authInfo['key']);
	}

	//拉取离线消息
	public function receiveFromIM()
	{
		if ($this->mType == MsgType::MUST_RELOGIN)
		{
			PubFunction::stopWorker();
			return;
		}
		$currentMsgVersion = PubFunction::getMaxMsgVersion();
		$userlv = $this->body->getUsercv();
		$usize = $this->body->getUsize();
		//拉取消息
		if ($currentMsgVersion < $userlv)
		{
			$offlineReqBusiness = BusinessFactory::getInstanceByParams(Type::PULL_ACT, ['startVersion'=>$currentMsgVersion, 'endVersion'=>$userlv]);
			$offlineReqBusiness->sendToIM();
		}
		return true;
	}

}

