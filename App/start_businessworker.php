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

@include_once ROOTPATH . '/Config/env.php';

if (@!defined(APP_MODE))
{
	define('APP_MODE', 'pro');
}

$redis = null;
$db = null;
$monitor_dir = realpath(ROOTPATH . '/App/');
$last_mtime = time();
$configure = Configure::getKey();
// bussinessWorker 进程
$worker = new BusinessWorker();
// worker名称
$worker->name = $configure['businessworker']['name'];
// bussinessWorker进程数量
$worker->count = $configure['businessworker']['count'];
// 服务注册地址
$worker->registerAddress = $configure['businessworker']['registerAddress'];
$worker->reloadable = true;
$worker::$pidFile = __DIR__ . '/../worker';

$logFile = $configure['businessworker']['logDir'] . '/syslog_' . date('Ymd') . '.log';
Worker::$logFile = substr($logFile, 0, 1) == '/' ? $logFile : ROOTPATH . '/' . $logFile;

$stdoutFile = $configure['businessworker']['logDir'] . '/log_' . date('Ymd') . '.log';
Worker::$stdoutFile = substr($stdoutFile, 0, 1) == '/' ? $stdoutFile : ROOTPATH . '/' . $stdoutFile;

//设置后台运行
Worker::$daemonize = $configure['im']['daemonize'];
// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}


