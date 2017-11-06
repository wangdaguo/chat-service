<?php

namespace App;
use \GatewayWorker\Lib\Gateway;

class Statistic extends Flag
{
	public function __construct($data)
	{
		parent::__construct($data);

	}
	
	public function authorization()
	{
		if ($this->data['token'] != PubFunction::genToken($this->data['sysId']))
		{
			return [Constant::ERROR_CODE_AUTH_FAILED];
		}
	
		$_SESSION['adminId'] = $this->data['sysId'];
		Gateway::bindUid($_SERVER['GATEWAY_CLIENT_ID'], $this->data['sysId']);
	
		return [Constant::ERROR_CODE_OK, [
				'flag'   => Constant::FLAG_STATISTIC,
				'operation'  => Constant::OPERATION_AUTHORIZATION,
				'data'      => [],
		]];
	}
	
	public function message()
	{
		$countrys = $this->data['data']['countrys'];
		if (empty($countrys))
		{
			return [Constant::ERROR_CODE_NEED_PARAM];
		}
		$data['data'] = GlobalVariable::getCountrysStatistic($countrys);
		return [Constant::ERROR_CODE_OK, $data];
	}
	
	protected function checkAdminId()
	{
		return $this->data['sysId'] == Constant::SYSTEM_ADMINID_STATISTIC;
	}
}

