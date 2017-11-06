<?php
namespace App;

define('ROOTPATH', realpath(__DIR__ . '/../'));

require_once ROOTPATH . '/vendor/workerman/workerman/Autoloader.php';
require_once ROOTPATH . '/vendor/autoload.php';
require_once ROOTPATH . '/App/Autoloader.php';
require_once ROOTPATH . '/App/FileMonitor.php';
@include_once ROOTPATH . '/Config/env.php';

use Workerman\Worker;
use \Workerman\Connection\AsyncTcpConnection;
use Protobuf\Garuda\Type;
use Protobuf\Garuda\Register;
use App\Business\BaseBusiness;
use App\Business\BusinessFactory;
use Protobuf\Garuda\MsgFormat;
use Protobuf\Garuda\MsgType;
use App\Business\WsJson;
use \Workerman\Lib\Timer;
use \Workerman\MySQL\Connection;
use App\PubFunction;
use App\Authentication;

if (@!defined(APP_MODE))
{
	define('APP_MODE', 'pro');
}

$configure = Configure::getKey();

$worker = new Worker();

$worker->count = $configure['proxy']['count'];
$worker->name =  $configure['proxy']['name'];
$worker->user =  $configure['proxy']['user'];
$worker->group = $configure['proxy']['group'];
Worker::$daemonize = $configure['im']['daemonize'];

Worker::$logFile = PubFunction::getLogFileDir('proxy', 'syslog');

Worker::$stdoutFile = PubFunction::getLogFileDir('proxy', 'log');

$clientIm = null;
$wsConnection = null;
$redis = null;
$db = null;
$maxMsgVersion = 0;
//[$ip, $port, $m1, $token, $key]
$authInfo = [];
//系统发送im id
$systemSenderId = $configure['im']['systemSenderId'];

$worker->onWorkerStart = function($worker)
{
	global $wsConnection, $db, $redis, $configure, $authInfo;
	//按照日期切割日志
	Timer::add(3600, array(__NAMESPACE__ . '\PubFunction','splitLogFile'), ['proxy']);
	//获取im的token
	$authInfo = Authentication::getAuthInfo();
	$redis = PubFunction::getRedisInstance();
	//与后面的web服务端建立通道
	$wsConnection = new AsyncTcpConnection('ws://'.$configure['gateway']['lvsIp']);
	$wsConnection->onConnect = function($wsConnection)
	{
		PubFunction::printLog(['connect'=>'websocket connect']);
		//给websocket发送验证
		PubFunction::sendAuthToWs();
		//心跳 给websocket发送ping
		Timer::add(60, function()use ($wsConnection)
		{
			PubFunction::sendPingToWs(); 
		});
		//测试websocket
//		Timer::add(5, function()use ($wsConnection)
//		{
//			$wsJson = new WsJson(['type'=>10, 'mFormat'=>0, 'countryCode'=>'CN', 'language'=>'zh-CN', 'content'=>'hello', 'sId'=>5011142]);
//			$wsJson->sendToWs();
//		});
		//IM服务建立通道
		global $clientIm, $authInfo, $configure;
		if (PubFunction::isProduct())
		{
			$clientIm = new AsyncTcpConnection('Protobuf://'.$configure['proxy']['listen']);
		}
		else
		{
			$clientIm = new AsyncTcpConnection('Protobuf://'.$authInfo['ip'].':'.$authInfo['port']);
		}
		$clientIm->onConnect = function($clientIm)
		{
			PubFunction::printLog(['connect'=>'protobuf connect']);
			global $systemSenderId;
			$loginBusiness = BusinessFactory::getInstanceByParams(Type::REGISTER);
			$loginBusiness->sendToIM();
			//心跳 发送ping
			Timer::add(60, function()use ($clientIm, $systemSenderId)
			{
				$pingBusiness = BusinessFactory::getInstanceByParams(Type::PING);
				$pingBusiness->sendToIM(); 
			});
		};
		//IM推送消息
		$clientIm->onMessage = function($clientIm, $buffer)
		{
			$business = BusinessFactory::getInstanceByMessage($buffer);
			//给websocket通道
			$business->receiveFromIM();
		};
		$clientIm->onClose = function($clientIm)
		{
			PubFunction::printLog(['close'=>'protobuf close']);
			$clientIm->reConnect(5);
		};
		$clientIm->onError = function($clientIm, $code, $msg)
		{
			PubFunction::printLog(['Protobuf errorcode'=>$code, 'Protobuf errormsg'=>$msg]);
		};
		$clientIm->connect();
	};
	$wsConnection->onMessage = function($wsConnection, $data)
	{
		WsJson::receiveFromWs($data);
	};
	$wsConnection->onClose = function($wsConnection)
	{
		PubFunction::printLog(['close'=>'websocket close']);
		$wsConnection->reConnect(5);
	};
	$wsConnection->onError = function($wsConnection, $code, $msg)
	{
		PubFunction::printLog(['websocket errorcode'=>$code, 'websocket errormsg'=>$msg]);
	};
	$wsConnection->connect();
};

$worker->onConnect = function ($connection)
{
};

$worker->onMessage = function ($connection, $data)
{
};

$worker->onClose = function ($connection)
{
};
// 运行worker
Worker::runAll();
