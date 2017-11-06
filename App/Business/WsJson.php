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
use App\Constant;

class WsJson 
{
	const MANAGEMENT = 2;

	const AUTH = 1;
	const SEND_CONTENT = 2;

	public $rId;
	public $sId;
	public $mFormat;
	public $mType;
	public $type;
	public $content;
	public $origUrl;
	public $thumbFile;
	public $msgVersion;
	public $msgid;
	public $cc;
	public $multilang;
	public $receiveTime;

	//此属性不用给im
	public $operation;

	public function __construct($params)
	{
		$this->mType = MsgType::NORMAL_MSG;
		$this->msgVersion = PubFunction::getMaxMsgVersion();
		foreach (['type', 'mFormat', 'content', 'origUrl', 'thumbFile', 'msgid', 'sId', 'rId', 'cc', 'multilang', 'receiveTime', 'operation'] as $field)
		{
			if (isset($params[$field]))
			{
				$this->$field = $params[$field];
			}
		}
		return $this;
	}

	public function getAttributes()
	{
		$res = [];
		foreach (['mFormat', 'mType', 'type', 'content', 'origUrl', 'thumbFile', 'msgVersion', 'msgid', 'sId', 'rId', 'cc', 'multilang', 'receiveTime'] as $field)
		{
			$res[$field] = $this->$field;
		}
		return $res;
	}

	public function sendToIM()
	{
		if (empty($this->type))
		{
			return null;
		}
		$business = BusinessFactory::getInstanceByParams($this->type, $this->getAttributes());
		$business->sendToIM();
	}

	public static function receiveFromWs($json)
	{
		PubFunction::printLog(['json'=>$json]);
		$data = PubFunction::parseWsJson($json);
		if (empty($data))
		{
			return false;
		}
		$self = new self($data);
		$method = Constant::getMethod($self->operation);
		$self->$method();
		return true;
	}

	private function message()
	{
		$this->sendToIM();
		return true;
	}

	private function authorization()
	{
		return true;
	}

	public function sendToWs($operation=Constant::OPERATION_SEND_MESSAGE)
	{
		global $wsConnection;
		$data = [
			'type'=>$this->type,	
			'content'=>$this->content,	
			'url'=>$this->origUrl,	
			'mFormat'=>$this->mFormat,	
			'msgVersion'=>$this->msgVersion,	
			'msgid' =>$this->msgid,	
			'receiveTime'=>$this->receiveTime,	
			'country'=> $this->cc, 
			'language'=> $this->multilang, 
		];
		$res = [
			'flag'=>Constant::FLAG_MANAGER, 
			'operation'=>$operation, 
			'uid'=> $this->sId, 
			'adminId'=>0, 
			'sysId'=>Constant::SYSTEM_ADMINID_MANAGER, 
			'token'=>PubFunction::genToken(Constant::SYSTEM_ADMINID_MANAGER), 
			'data'=>$data
		];
		$wsConnection->send(json_encode($res));
		return true;
	}

}

