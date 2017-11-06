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
	
	require_once __DIR__ . '/../vendor/autoload.php';
	require_once __DIR__ . '/../App/Autoloader.php';
}
use \Workerman\Worker;
use \GatewayWorker\Register;
use App\Configure;

@include_once ROOTPATH . '/Config/env.php';

if (@!defined(APP_MODE))
{
	define('APP_MODE', 'pro');
}

$configure = Configure::getKey();
// register 服务必须是text协议
$register = new Register('text://'.$configure['register']['listen']);
//设置后台运行
Worker::$daemonize = $configure['im']['daemonize'];

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}

