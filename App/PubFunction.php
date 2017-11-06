<?php
namespace App;

use Workerman\MySQL\Connection;
use Workerman\Worker;

class PubFunction
{
	const SQL_PATH = ROOTPATH.'/Sql';

	const DIRECT_TO_ADMIN = 1;
	const DIRECT_TO_IM = 2;

	const WRITE_FILE = 1;
	const READ_FILE = 2;

	const MAX_MSG_VERSION_KEY = 'max_msg_version';

	public static function encrypt($input, $key) 
	{
		$size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
		$input = self::pkcs5_pad($input, $size);
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$data = mcrypt_generic($td, $input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		//$data = base64_encode($data);
		return $data;
	}

	private static function pkcs5_pad ($text, $blocksize) 
	{
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	public static function decrypt($sStr, $sKey) 
	{
		$decrypted= mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128,
			$sKey,
			//base64_decode($sStr),
			$sStr,
			MCRYPT_MODE_ECB
		);

		$dec_s = strlen($decrypted);
		$padding = ord($decrypted[$dec_s-1]);
		$decrypted = substr($decrypted, 0, -$padding);
		return $decrypted;
	}
	
	public static function sendMessage($errCode, $data = [])
	{
		$result = [
				'errcode' => $errCode,
				'errmsg'  => Constant::getMessage($errCode),
		];
		if (!empty($data))
		{
			$result['data'] = $data;
		}
		return json_encode($result);
	}

	public static function getMsgId($uid, $type, $mType, $mFormat, $time) 
	{
		return base64_encode($uid.'_'.$type.'_'.$mType.'_'.$mFormat.'_'.$time.'_'.uniqid());
	}

	public static function getIMTable($upUid)
	{
		return 'IM_'.$upUid % 100;
	}

	public static function createConnection()
	{
		global $configure;
		return new Connection($configure['mysql']['host'], $configure['mysql']['port'], $configure['mysql']['user'], $configure['mysql']['password'], $configure['mysql']['db_name']);
	}
	
	public static function getRedisInstance()
	{
		global $redis, $configure;
		$redis = new \Redis();
		$redis->pconnect($configure['redis']['host'], $configure['redis']['port']);
		if (!empty($configure['redis']['password']))
		{
			$redis->auth($configure['redis']['password']);
		}
		return $redis;
	}

	public static function writeFile($msgid, $msgVersion, $uid, $adminId, $direction, $content, $country, $language, $sendTime, $url='', $name='')
	{
		$filePath = self::getSqlFilePath();			
		$content = str_replace(PHP_EOL, '',$content); 
		$url = str_replace(PHP_EOL, '',$url); 
		$name = str_replace(PHP_EOL, '',$name); 
		$sql = '('.$uid.','.$adminId.','.$direction.',"'.$msgid.'","'.$msgVersion.'","'.$content.'","'.$url.'","'.$name.'","'.$country.'","'.$language.'",'.$sendTime.')'.PHP_EOL;
		file_put_contents($filePath, $sql, LOCK_EX | FILE_APPEND);
		return true;
	}

	// sql/2017-06-05/18-30.csv || sql/2017-06-05/18-35.csv
	private static function getSqlFilePath($action=self::WRITE_FILE)
	{
		$dirName = self::SQL_PATH.'/'.date('Y-m-d');
		if (!file_exists($dirName))
		{
	 		mkdir($dirName, 0777, true);
		}
		$fileName = $action == self::WRITE_FILE ? date('H-i') : date('H-i', time()-60);
		$filePath = $dirName.'/'.$fileName.'.csv';
		return $filePath;
	}

	public static function loadData()
	{
		global $db;	
		$filePath = self::getSqlFilePath(self::READ_FILE);
		if (!file_exists($filePath))
		{
			return ;
		}
		$content = file_get_contents($filePath);
		if (empty($content))
		{
			return ;
		}
		$arr = explode(PHP_EOL, substr($content, 0, -1));
		$insertSqls = [];
		foreach ($arr as $a)
		{
			$uid = (int)substr(trim($a), 1, strpos(trim($a), ',')-1);
			if (empty($uid))
			{
				return;
			}
			$insertSqls[self::getIMTable($uid)] = isset($insertSqls[self::getIMTable($uid)]) ? $insertSqls[self::getIMTable($uid)].','.$a : 'insert ignore into '.self::getIMTable($uid).' (`uid`, `adminId`, `direction`, `msgId`, `msgVersion`, `content`, `url`, `name`,`country`, `language`, `sendTime`) VALUES'.$a; 
		}
		$db->beginTrans();
		try
		{
			foreach ($insertSqls as $sql)
			{
				if (false == empty($sql))
				{
					$db->query($sql);
				}
			}
			$db->commitTrans();
		}
		catch(\Exception $e)
		{
			$db->rollBackTrans();
		}
		return true;
	}

	public static function delDir($dir) 
	{
		if (!file_exists($dir))
		{
			return ;
		}
		//先删除目录下的文件：
		$dh=opendir($dir);
		while ($file=readdir($dh))
		{
			if($file!="." && $file!="..")
			{
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath))
				{
					unlink($fullpath);
				}
				else
				{
					deldir($fullpath);
				}
			}
		}
		closedir($dh);
		//删除当前文件夹：
		if(rmdir($dir))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function genToken($adminId) 
	{
		return md5(Constant::PRIVATE_KEY . $adminId);
	}

	public static function sendAuthToWs()
	{
		global $wsConnection;
		$res = [
			'flag' => Constant::FLAG_MANAGER,	
			'operation' => Constant::OPERATION_AUTHORIZATION,	
			'sysId' => Constant::SYSTEM_ADMINID_MANAGER,	
			'data' => [],	
			'token' => self::genToken(Constant::SYSTEM_ADMINID_MANAGER),	
		]; 
		$wsConnection->send(json_encode($res));
	}

	public static function sendPingToWs()
	{
		global $wsConnection;
		$res = [
			'flag' => Constant::FLAG_MANAGER,	
			'operation' => Constant::OPERATION_PING,	
			'sysId' => Constant::SYSTEM_ADMINID_MANAGER,	
			'data' => [],	
			'token' => self::genToken(Constant::SYSTEM_ADMINID_MANAGER),	
		]; 
		$wsConnection->send(json_encode($res));
	}

	public static function parseWsJson($json) 
	{
		global $systemSenderId;
		$res = json_decode($json, true);
		if (isset($res['errcode']) && $res['errcode'])
		{
			return [];
		}
		if ($res['data']['operation'] == Constant::OPERATION_AUTHORIZATION)
		{
			return [];
		}
		return [
			'operation' => $res['data']['operation'],		
			'sId' => $systemSenderId,		
			'rId' => $res['data']['uid'],		
			'type' => $res['data']['data']['type'],		
			'content' => $res['data']['data']['content'],		
			'origUrl' => $res['data']['data']['url'],		
			'thumbFile' => isset($res['data']['data']['thumbFile']) ? base64_decode($res['data']['data']['thumbFile']) : '',		
			'name' => $res['data']['data']['name'],		
			'mFormat' => $res['data']['data']['mFormat'],		
			'msgVersion' => self::getMaxMsgVersion(),		
		]; 	
	}

	public static function getMaxMsgVersion()
	{
		global $maxMsgVersion, $redis;
		if ($maxMsgVersion)
		{
			return $maxMsgVersion;
		}
		$maxMsgVersion = (int)$redis->get(self::MAX_MSG_VERSION_KEY);
		if (!$maxMsgVersion)
		{
			$redis->set(self::MAX_MSG_VERSION_KEY, $maxMsgVersion);
		}
		return $maxMsgVersion;
	}

	public static function setMaxMsgVersion($msgVersion)
	{
		global $maxMsgVersion, $redis;
		if (!$msgVersion)
		{
			return ;
		}
		$maxMsgVersion = $msgVersion;
		$redis->set(self::MAX_MSG_VERSION_KEY, $maxMsgVersion);
		return true;
	}
	public static function checkFilesChange()
	{
		global $monitor_dir, $last_mtime;
		// recursive traversal directory
		$dir_iterator = new \RecursiveDirectoryIterator($monitor_dir);
		$iterator = new \RecursiveIteratorIterator($dir_iterator);
		foreach ($iterator as $file)
		{
			// only check php files
			if(pathinfo($file, PATHINFO_EXTENSION) != 'php')
			{
				continue;
			}
			$whiteMenuFile = ['Constant.php','Conversation.php','GlobalVariable.php',
						'Manager.php', 'Flag.php', 'PubFunction.php', 'Statistic.php', 'Events.php'
			];
			if (! in_array($file->getFilename(), $whiteMenuFile))
			{
				continue;
			}
			// check mtime
			if($last_mtime < $file->getMTime())
			{
				echo $file." update and reload\n";
				// send SIGUSR1 signal to master process for reload
				posix_kill(posix_getppid(), SIGUSR1);
				$last_mtime = $file->getMTime();
				break;
			}
		}
	}

	public static function printLog($params=[])
	{
		if (empty($params))
		{
			return;
		}
		print_r("\n===============".date('Y-m-d H:i:s')."===============\n");
		foreach ($params as $key => $val)
		{
			var_dump($key.': '.$val);
		}
		return;
	}

	public static function getLocalIp()
	{
		if (self::isProduct())
		{
			exec('curl -s http://169.254.169.254/latest/meta-data/local-ipv4', $out);
			return isset($out[0]) ? $out[0] : '';
		}
		return '127.0.0.1';
	}

	public static function getLogFileDir($sys, $logName) 
	{
		global $configure;
		$stdoutFile = $configure[$sys]['logDir'].'/'.$logName.'_'.date('Ymd').'.log';
		return substr($stdoutFile, 0, 1) == '/' ? $stdoutFile : ROOTPATH . '/' . $stdoutFile;
	}

	public static function stopWorker()
	{	
		Worker::stopAll();
		return true;
	}

	public static function isProduct()
	{
		return APP_MODE == 'pro';
	}

	public static function isStage()
	{
		return APP_MODE == 'stage';
	}

	public static function isDev()
	{
		return APP_MODE == 'dev';
	}
	
	public static function getUnreadMessageNumber($region)
	{
		global $db;
		
		$countrySqlWhere = self::getCountrySqlWhere($region);
		$sql = "SELECT SUM(num) num FROM ( ";
		$tableArr = [];
		for ($i = 0; $i< 100; $i++)
		{
			$tableArr[] = "SELECT count(*) num FROM IM_$i WHERE  $countrySqlWhere AND  adminId = 0 ";
		}
		$sql .=	join(' UNION ALL ', $tableArr);
		$sql .= ") im";
		
		$result = $db->query($sql);
		return intval($result[0]['num']);
	}
	
	public static function getUnreadMessageList($region)
	{
		global $db;
	
		$countrySqlWhere = self::getCountrySqlWhere($region);
		$sql = "SELECT * FROM ( ";
		$tableArr = [];
		for ($i = 0; $i< 100; $i++)
		{
			$tableArr[] = "SELECT *, $i t FROM IM_$i WHERE  $countrySqlWhere AND  adminId = 0 ";
		}
		$sql .=	join(' UNION ALL ', $tableArr);
		$sql .= ") im ORDER BY sendTime DESC, id DESC LIMIT " . Constant::PAGESIZE;
	
		return $db->query($sql);
	}
	
	public static function getCountrySqlWhere($region)
	{
		global $adminCountryUpUserCountry, $adminLanguageUpUserLanguage;
		$countrys = isset($adminCountryUpUserCountry[$region]) ?  $adminCountryUpUserCountry[$region] : [];
		$languages = isset($adminLanguageUpUserLanguage[$region]) ?  $adminLanguageUpUserLanguage[$region] : [];
		
		$countrySqlWhere = '';
		if ($region == 'VN')
		{
			$countryArray = [];
			foreach ($adminCountryUpUserCountry as $regionCode => $countryCodeArray)
			{
				if ($regionCode == $region)
				{
					continue;
				}
				$countryArray += $countryCodeArray;
			}
				
			$languageArray = [];
			foreach ($adminLanguageUpUserLanguage as $regionCode => $languageCodeArray)
			{
				if ($regionCode == $region)
				{
					continue;
				}
				$languageArray += $languageCodeArray;
			}
				
			$countrySqlWhere = " (country NOT IN ('" . join("','", $countryArray).  "') AND language NOT IN ('" . join("','", $languageArray) . "') ) ";
		}
		else
		{
			$countrySqlWhere = " (country IN ('" . join("','", $countrys).  "') OR language IN ('" . join("','", $languages) . "') ) ";
		}
		return $countrySqlWhere;
	}
	
	public static function splitLogFile($name='businessworker')
	{
		if (date('H') == '00')
		{
			global $configure;
			$stdoutFile = $configure[$name]['logDir'] . '/log_' . date('Ymd') . '.log';
			Worker::$stdoutFile = substr($stdoutFile, 0, 1) == '/' ? $stdoutFile : ROOTPATH . '/' . $stdoutFile;
			Worker::resetStd();
		}
	}

}


