<?php

namespace App;

class Constant
{
	const ERROR_CODE_OK = 0;
	
	const ERROR_CODE_NEED_AUTH = 1;
	
	const ERROR_CODE_PARSE_FAILED = 2;
	
	const ERROR_CODE_NEED_PARAM = 3;
	
	const ERROR_CODE_AUTH_FAILED = 4;
	
	const ERROR_CODE_PARAM_ERROR = 5;
	
	const ERROR_CODE_INVALID_USER = 6;
	
	const ERROR_CODE_IM_CLOSED = 7;
	
	const ERROR_CODE_NO_ADMINID = 8;
	
	private static $errorMsg = [
		self::ERROR_CODE_OK          => 'SUCCESS',
		self::ERROR_CODE_NEED_AUTH   => 'require authorization',
		self::ERROR_CODE_PARSE_FAILED => 'parse error',
		self::ERROR_CODE_NEED_PARAM => 'lack of params',
		self::ERROR_CODE_AUTH_FAILED => 'auth failed, please try again',
		self::ERROR_CODE_PARAM_ERROR => 'one of params is error',
		self::ERROR_CODE_INVALID_USER => 'user invalid',
		self::ERROR_CODE_IM_CLOSED => 'im proxy server closed',
		self::ERROR_CODE_NO_ADMINID => 'no adminid',	
	];
	
	public static function getMessage($errorCode) {
		return self::$errorMsg[$errorCode];
	}
	
	const FLAG_CONVERSATION = 1;
	const FLAG_MANAGER = 2;
	const FLAG_STATISTIC = 3;
	
	const OPERATION_AUTHORIZATION = 1;
	const OPERATION_SEND_MESSAGE = 2;
	const OPERATION_CHANGE_ONLINE = 3;
	const OPERATION_HISTORY_MESSAGE = 4;
	const OPERATION_PING = 5;
	const OPERATION_UNREAD_MESSAGE = 6;
	
	const SYSTEM_ADMINID_MANAGER = -1;
	const SYSTEM_ADMINID_STATISTIC = -2;
	const SYSTEM_ADMINID_CONVERSATION_MIN = 1;
	
	const IM_TYPE_USER_1V1 = 10;
	const IM_MFORMAT_TEXT = 0;
	
	const ADMIN_STATUS_ONLINE = 1;
	const ADMIN_STATUS_HOLD = 2;
	const ADMIN_STATUS_OFFLINE = 3;
	
	const PAGESIZE = 30;
	
	
	private static $method = [
			self::OPERATION_AUTHORIZATION         => 'authorization',
			self::OPERATION_SEND_MESSAGE          => 'message',
			self::OPERATION_CHANGE_ONLINE         => 'online',
			self::OPERATION_HISTORY_MESSAGE       => 'history',
			self::OPERATION_PING 				  => 'ping',
			self::OPERATION_UNREAD_MESSAGE        => 'unread',
	];
	
	public static function getMethod($operation) {
		return self::$method[$operation];
	}
	
	const PRIVATE_KEY = 'upliveChatService';
	
	
	
	
}

