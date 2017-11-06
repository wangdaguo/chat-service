<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
if(!defined('GLOBAL_START')) {
	ini_set('display_errors', 'on');
	define('ROOTPATH', realpath(__DIR__ . '/../'));
	require_once __DIR__ . '/../vendor/autoload.php';
	require_once __DIR__ . '/../App/Autoloader.php';
}

use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use App\Configure;
use App\PubFunction;

@include_once ROOTPATH . '/Config/env.php';

if (@!defined(APP_MODE))
{
	define('APP_MODE', 'pro');
}

$configure = Configure::getKey();
$lanIp = PubFunction::getLocalIp();
if (empty($lanIp))
{
	exit('无法获取本机ip！');
}
// $gatewayCount = count(glob(__DIR__.'/../gateway*'));

list($ip, $port) = explode(':', $configure['gateway']['listen']);
// $port = $port + $gatewayCount * 100;
// gateway 进程，这里使用Text协议，可以用telnet测试
$gateway = new Gateway("websocket://" . $ip . ':' . $port);
// gateway名称，status方便查看
$gateway->name = $configure['gateway']['name'];
// gateway进程数
$gateway->count = $configure['gateway']['count'];
// 本机ip，分布式部署时使用内网ip
$gateway->lanIp = $lanIp;
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
$gateway->startPort = $configure['gateway']['startPort'];
// 服务注册地址
$gateway->registerAddress = $configure['gateway']['registerAddress'];

$gateway::$pidFile = __DIR__ . '/../gateway';
//设置后台运行
Worker::$daemonize = $configure['im']['daemonize'];

// if ($configure['gateway']['isDebug'])
// {
	//$gateway->startPort = $configure['gateway']['startPort'] + $gatewayCount * $configure['gateway']['count'];
// }
// 心跳间隔
// $gateway->pingInterval = 30;
// 不回复次数
// $gateway->pingNotResponseLimit = 3;
// 心跳数据
// $gateway->pingData = '';

$gateway->onWorkerStart = function()
{
	global $globalAdminArr;
};


/* 
// 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
$gateway->onConnect = function($connection)
{
    $connection->onWebSocketConnect = function($connection , $http_header)
    {
        // 可以在这里判断连接来源是否合法，不合法就关掉连接
        // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
        if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
        {
            $connection->close();
        }
        // onWebSocketConnect 里面$_GET $_SERVER是可用的
        // var_dump($_GET, $_SERVER);
    };
}; 
*/
$gateway->onWorkerStop = function ()
{
};


//var_dump(\GatewayWorker\Lib\Gateway::getAllClientSessions());
// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}

