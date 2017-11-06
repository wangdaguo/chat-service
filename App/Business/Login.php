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

class Login extends BaseBusiness 
{
	protected function __construct()
	{
		parent::__construct();
		$this->type = Type::REGISTER;
		$this->mFormat = MsgFormat::TEXT;
		$this->mType = MsgType::NULL;
		$this->time = ceil(microtime(true)*1000);
		return $this;
	}

	public static function createByParams($params=[])
	{
		$self = new self();
		global $authInfo, $configure;
		$self->version = !isset($params['version']) ? $configure['im']['version'] : $params['version'];
		$self->msgVersion = !isset($params['msgVersion']) ? 0 : $params['msgVersion'];
		$self->rId = 0;
		$self->sId = $configure['im']['systemSenderId'];
		$self->msgid = PubFunction::getMsgId($self->rId, $self->type, $self->mType, $self->mFormat, $self->time);

		$userinfo = new UserInfo();
		$userinfo->setUId($self->uid);
		$userinfo->setLang($self->multilang);
		$userinfo->setUserName($self->username);
		$userinfo->setUserGrade(1);
		$userinfo->setUserSex(1);
		$userinfo->setVip(1);
		$userinfo->setUType(1);

		$register = new Register();
		$register->setDeviceid('managment');
		$register->setTermType(TermType::NONE);
		$register->setAppVersion('1.0');
		$register->setAppName('uplive');
		$register->setUserToken($self->userToken);
		$register->setAppVersion($self->version);
		$register->setAppName($self->appName);
		$register->setChannel('management');
		$register->setM1($authInfo['m1']);
		$register->setAuthToken($authInfo['token']);
		$register->setUserInfo($userinfo);
		$self->body = $register;
		return $self;
	}

	public static function createByMessage($message)
	{
		$self = new self();
		$self->mFormat = $message->getType();
		$self->mType = $message->getMType();
		$self->version = $message->getVersion();
		$self->msgVersion = $message->getMsgVersion();
		$self->msgid = $message->getMsgid();
		$self->sId = $message->getSId();
		$self->rId = $message->getRId();
		$self->sendTime = $message->getReceiveTime();
		$register = new Register();
		$register->mergeFromString($message->getBody());
		$self->body = $register;
		return $self;
	}

	public function generateBody() 
	{
		$requestBody = $this->body->serializeToString();
		return $requestBody;
	}

	public function receiveFromIM()
	{
		$rResult = $this->body->getRResult();
		if (!$rResult)
		{
			return true;
		}
		PubFunction::stopWorker();
	}

}

