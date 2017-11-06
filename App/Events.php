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

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
use App\PubFunction;
use App\Conversation;
use App\Manager;
use App\Statistic;
use App\Constant;
use App\Configure;
use App\GlobalVariable;
use \Workerman\Lib\Timer;
use \Workerman\MySQL\Connection;
use \Workerman\Worker;


/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
	/**
	 * 
	 */
	public static function onWorkerStart($worker) {
		global $configure;

		//redis
		global $redis;
		$redis = PubFunction::getRedisInstance();
		//db 
		global $db;
		$db = PubFunction::createConnection();

		global $upUserCountryAdminCountry, $upUserLanguageAdminLanguage;
		global $adminCountryUpUserCountry, $adminLanguageUpUserLanguage;
		
		GlobalVariable::getRegionConfig();

		if ($worker->id == 0)
		{
			//每两分钟入库一次
			Timer::add(60, function()
			{
				PubFunction::loadData();
			});
			//每10个小时执行一次
			Timer::add(36000, function()
			{
				$dir = PubFunction::SQL_PATH.'/'.date('Y-m-d', strtotime('-1 day'));
				PubFunction::delDir($dir);
			});
			
			//热更新
			Timer::add(2, array(__NAMESPACE__ . '\App\PubFunction','checkFilesChange'));
		}
		//按照日期切割日志
		Timer::add(3600, array(__NAMESPACE__ . '\App\PubFunction','splitLogFile'));
	}
	
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id) {
        // 向当前client_id发送数据 
        Gateway::sendToClient($client_id, PubFunction::sendMessage(Constant::ERROR_CODE_NEED_AUTH));
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message) {
   	
	   	$messageData = json_decode($message, true);
	   	
	   	if (json_last_error() != JSON_ERROR_NONE)
	   	{
	   		Gateway::sendToClient($client_id, PubFunction::sendMessage(Constant::ERROR_CODE_PARSE_FAILED));
	   	}
	   	
	   	if (empty($messageData['flag']))
	   	{
	   		Gateway::sendToClient($client_id, PubFunction::sendMessage(Constant::ERROR_CODE_NEED_PARAM));
	   	}
 	   	var_dump('======receive msg =====', $messageData);
   		switch ($messageData['flag'])
   		{
   			case \App\Constant::FLAG_CONVERSATION:
	   			list($errCode, $data) = (new Conversation($messageData))->getResult($client_id);
	   			break;
   			case \App\Constant::FLAG_MANAGER:
	   			list($errCode, $data) = (new Manager($messageData))->getResult($client_id);
	   			break;
   			case \App\Constant::FLAG_STATISTIC:
	   			list($errCode, $data) = (new Statistic($messageData))->getResult($client_id);
	   			break;
   			default:
   				list($errCode, $data) = [Constant::ERROR_CODE_PARAM_ERROR];
   				
   		}
    	//	var_dump("========result========", $errCode, $data);
   		$data['operation'] = $messageData['operation'];
		if ($messageData['operation'] == Constant::OPERATION_AUTHORIZATION || $messageData['flag'] != Constant::FLAG_MANAGER)
		{
			Gateway::sendToClient($client_id, PubFunction::sendMessage($errCode, $data));
		}
	   	
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id) {
// 		$beginTime = $_SESSION['beginTime'];
		GlobalVariable::opsLogout();
   }
   
   public static function onWorkerReload() {
   		var_dump("reloading=======");
   }
   
   public static function onWorkerStop()
   {
   	
   }
   
}
