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
use Protobuf\Garuda\PullVersions;
use App\PubFunction;

class Ping extends BaseBusiness 
{
	protected function __construct()
	{
		parent::__construct();
		$this->type = Type::PING;
		$this->mType = MsgType::PULL_VERSION;//MsgType::NULL;
		$this->mFormat = MsgFormat::TEXT;
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	public static function createByParams($params=[])
	{
		$self = new self();
		global $configure;
		$self->version = !isset($params['version']) ? $configure['im']['version'] : $params['version'];
		$self->msgVersion = !isset($params['msgVersion']) ? PubFunction::getMaxMsgVersion() : $params['msgVersion'];
		$self->multilang = empty($params['multilang']) ? $configure['im']['language'] : $params['multilang'];
		$self->cc = empty($params['cc']) ?  $configure['im']['country']: $params['cc'];
		$self->rId = empty($params['rId']) ? 0 : $params['rId'];
		$self->sId = empty($params['sId']) ? $configure['im']['systemSenderId'] : $params['sId'];
		$self->appkey = empty($params['appkey']) ? $configure['im']['appKey'] : $params['appkey'];
		$self->msgid = empty($params['msgid']) ? PubFunction::getMsgId($self->rId, $self->type, $self->mType, $self->mFormat, $self->time) : $params['msgid'];
		$self->body = self::createPullVersions($params);
		return $self;
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
	
	public static function createPullVersions($params)
	{
		$currentMsgVersion = PubFunction::getMaxMsgVersion();
		$pullVersions = new PullVersions();
		$pullVersions->setUserlv($currentMsgVersion);
		foreach (['syslv'] as $field)
		{
			if (isset($params[$field]))
			{
				$method = "set$field";
				if (method_exists($pullVersions, $method))
				{
					$pullVersions->$method($params[$field]);
				}
			}
		}
		return $pullVersions;
	}

	public function generateBody() 
	{
		return null;
	}

	//拉取离线消息
	public function receiveFromIM()
	{
		return true;
	}


}

