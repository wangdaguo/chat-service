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

class BusinessFactory
{
	public static function getInstanceByParams($type, $params=[])
	{
		$business = null;
		switch ($type)
		{
		case Type::REGISTER: 
			$business = Login::createByParams($params);
			break;
		case Type::PING: 
			$business = Ping::createByParams($params);
			break;
		case Type::ACK:
			$business = Ack::createByParams($params);
			break;
		case Type::SERVICE_CHAT:
			$business = ContentFormatFactory::createByParams($params);
			break;
		case Type::SERVER_NOTICE:
			$business = PushVersionsBusiness::createByParams($params);
			break;
		case Type::PULL_ACT:
			$business = OfflineReqBusiness::createByParams($params);
			break;
		default:
			$business = NullBusiness::createByParams($params);
		}
		return $business;
	}

	public static function getInstanceByMessage($message)
	{
		$business = null;
		switch ($message->getType())
		{
		case Type::REGISTER: 
			$business = Login::createByMessage($message);
			break;
		case Type::PING: 
			$business = Ping::createByMessage($message);
			break;
		case Type::PONG: 
			$business = Pong::createByMessage($message);
			break;
		case Type::ACK:
			$business = Ack::createByMessage($message);
			break;
		case Type::SYS_NOTICE:
			$business = ContentFormatFactory::createByMessage($message);
			break;
		case Type::SERVER_NOTICE:
			$business = PushVersionsBusiness::createByMessage($message);
			break;
		case Type::PULL_ACT:
			$business = OfflineResBusiness::createByMessage($message);
			break;
		default:
			$business = NullBusiness::createByMessage($message);
		}
		return $business;
	}

	public static function getSendToImBusinessType($type, $mFormat, $mType) 
	{
		$score = $type * 100000 + $mFormat * 1000 + $mType;			
		$businessType = 'NullBusiness';
		if ($socre >= 100000 && $score < 200000)
		{
			$businessType = 'Login';
		}
		else if ($socre >= 200000 && $score < 300000)
		{
			$businessType = 'Ping';
		}
		else if ($socre >= 400000 && $score < 500000)
		{
			$businessType = 'Ack';
		}
		else if ($socre >= 900000 && $score < 901000)
		{
			$businessType = 'MsgTextBusiness';
		}
		else if ($socre >= 902000 && $score < 903000)
		{
			$businessType = 'MsgPicBusiness';
		}
		else if ($socre >= 1200000)
		{
			if ($mType == MsgType::PULL_VERSION)
			{
				$businessType = 'PullVersionsBusiness';
			}
			else if ($mType == MsgType::PULL_OFFLINE_MSG) 
			{
				$businessType = 'OfflineReqBusiness';
			}
		}
		return $businessType;
	}

	public static function getReceiveIMBuisnessType($message)
	{
		$score = $message->getType() * 100000 + $message->getMFormat() * 1000 + $message->getMType();			
		$businessType = 'NullBusiness';
		if ($socre >= 100000 && $score < 200000)
		{
			$businessType = 'Login';
		}
		else if ($socre >= 300000 && $score < 400000)
		{
			$businessType = 'Pong';
		}
		else if ($socre >= 400000 && $score < 500000)
		{
			$businessType = 'Ack';
		}
		else if ($socre >= 600000 && $score < 700000)
		{
			$businessType = 'PushVersionsBusiness';
		}
		else if ($socre >= 1000000 && $score < 1001000)
		{
			$businessType = 'ContentFormatFactory';
		}
		else if ($socre >= 1002000 && $score < 1003000)
		{
			$businessType = 'ContentFormatFactory';
		}
		else if ($socre >= 1200000)
		{
			if ($mType == MsgType::PULL_VERSION)
			{
				$businessType = 'PushVersionsBusiness';
			}
			else if ($mType == MsgType::PULL_OFFLINE_MSG) 
			{
				$businessType = 'OfflineResBusiness';
			}
		}
		return $businessType;
	}

}
