<?php
namespace App;
use \GatewayWorker\Lib\Gateway;

class GlobalVariable 
{
	public static function getRegionConfig()
	{
		global $db, $upUserCountryAdminCountry, $upUserLanguageAdminLanguage;
		global $adminCountryUpUserCountry, $adminLanguageUpUserLanguage;
		
		$regionConfig = $db->query("select * from IM_region"); 
		foreach ($regionConfig as $region)
		{
			$countryArr = explode(',', $region['countrys']);
			foreach ($countryArr as $country)
			{
				$upUserCountryAdminCountry[$country] = $region['region'];
				$adminCountryUpUserCountry[$region['region']][] = $country;
			}
			
			$languageArr = explode(',', $region['languages']);
			foreach ($languageArr as $language)
			{
				$upUserLanguageAdminLanguage[$language] = $region['region'];
				$adminLanguageUpUserLanguage[$region['region']][] = $language;
			}
			
		}
		return true;
	}

	//分配给客服	
	public static function allocationSeat($uid, $country, $language) 
	{
		global $redis, $upUserCountryAdminCountry, $upUserLanguageAdminLanguage;
		//先到已经分配的坐席里找，看当前用户是否已经分配过
		$adminId = $redis->hGet('IM:uidAdminIdArr', $uid);
// 		var_dump('adminId:', $adminId);
		if (empty($adminId) && $redis->sAdd('IM:uidAllocationSeat', $uid))
		{
			//如果当前无坐席，直接返回无客服
			$adminIdStatusArr = $redis->zRangeByScore('IM:adminIdStatusArr', Constant::ADMIN_STATUS_ONLINE, Constant::ADMIN_STATUS_ONLINE);
// 			var_dump('adminIdStatusArr:', $adminIdStatusArr);
			if (count($adminIdStatusArr) == 0)
			{
				$redis->srem('IM:uidAllocationSeat', $uid);
				return 0;
			}
			//如果有对应国家按照国家分配
			$opsRegion = '';
			if (isset($upUserCountryAdminCountry[$country]))
			{
				$opsRegion = $upUserCountryAdminCountry[$country];
			}
			//如果没有有对应国家按照语言分配
			else
			{
				$opsRegion = isset($upUserLanguageAdminLanguage[$language]) ? $upUserLanguageAdminLanguage[$language] : 'VN';
			}
			//没有分配过先看当前用户对应的客服的国家是否有客服在线
			$adminId = self::allocationSeatByCountry($uid, $opsRegion, $adminIdStatusArr);
			if ($adminId == 0)
			{
				//最后没有随机分配给中国客服
				$adminId = self::allocationSeatByCountry($uid, 'CN', $adminIdStatusArr);
			}
			$redis->multi()->sAdd('IM:adminIdUidArr:' . $adminId, $uid)
			->hSet('IM:uidAdminIdArr', $uid, $adminId)
			->srem('IM:uidAllocationSeat', $uid)
			->exec();
		}
		return intval($adminId);
	}

	private static function allocationSeatByCountry($uid, $country, $adminIdStatusArr)
	{
		global $redis;
		$adminIdsCountryArr = $redis->sMembers('IM:countryAdminIdArr:' . $country);
		// 		var_dump('adminIdsCountryArr:', $adminIdsCountryArr);
		$adminIdsCountryArr = array_intersect($adminIdsCountryArr, $adminIdStatusArr);

		if (count($adminIdsCountryArr) > 0)
		{
			//TODO 平均分配策略
			$adminArrayKey = array_rand($adminIdsCountryArr);
			return $adminIdsCountryArr[$adminArrayKey];
		}
		return  0;
	}
	
	//把客服人员添加到对应的数组里
	public static function fillOpsUidToCountry($adminId, $country) 
	{
		global $redis;
		$redis->ping();
		$redis->multi()->sAdd('IM:countryAdminIdArr:' . $country, $adminId)
			->zAdd('IM:adminIdStatusArr' , Constant::ADMIN_STATUS_ONLINE, $adminId)
			->exec();
	}

	//把保持状态的客服人员添加到数组里
	public static function changeOpsStatus($status)
	{
		global $redis;
		$adminId = intval($_SESSION['adminId']);
		if ($adminId <= 0){
			return ;
		}
		$redis->zAdd('IM:adminIdStatusArr', $status, $adminId);

	}

	public static function opsLogout($adminId = null)
	{
		global $redis;
		if (! isset($adminId))
		{
			$adminId = intval($_SESSION['adminId']);
			if ($adminId <= 0){
				return ;
			}
			$country = $_SESSION['country'];
		}

		$uids = $redis->sMembers('IM:adminIdUidArr:' . $adminId);
		$pipeline = $redis->multi();
		foreach ($uids as $uid)
		{
			$pipeline->hDel('IM:uidAdminIdArr', $uid);
		}
		$pipeline->del('IM:adminIdUidArr:' . $adminId);
		$pipeline->zRem('IM:adminIdStatusArr' , $adminId);
		$pipeline->exec();
		
		if (isset($country))
		{
			$redis->multi()->sRem('IM:countryAdminIdArr:' . $country, $adminId)
			->exec();
		}
		return;
	}
	
	public static function getCountrysStatistic(Array $countrys)
	{
		global $redis;
		$data = [];
		foreach ($countrys as $countryCode)
		{
			$adminIdArr = $redis->sMembers('IM:countryAdminIdArr:' . $countryCode);
			foreach ($adminIdArr as $adminId)
			{
				$data[$countryCode][$adminId] = $redis->scard('IM:adminIdUidArr:' . $adminId);
			}
		}
		return $data;
	}
	

}
