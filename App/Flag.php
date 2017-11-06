<?php

namespace App;

use \GatewayWorker\Lib\Gateway;

class Flag
{
	public $data;
	
	protected function __construct($data)
	{
		$this->data = $data;
	}
	
	
	/**
	 * 
	 * @param unknown $client_id
	 * @return [$errCode, $data]
	 */
	public function getResult($client_id)
	{
		if (empty($this->data) || empty($this->data['operation']))
		{
			return [Constant::ERROR_CODE_NEED_PARAM];
		}
		
		if ($this->data['operation'] != Constant::OPERATION_AUTHORIZATION && ! isset($_SESSION['adminId']) )
		{
			return [Constant::ERROR_CODE_NEED_AUTH];
		}
		if (! $this->checkAdminId())
		{
			return [Constant::ERROR_CODE_INVALID_USER];
		}
		
		$method = Constant::getMethod($this->data['operation']);
		if (empty($method) || (! is_callable(array($this, $method))) )
		{
			return [Constant::ERROR_CODE_PARAM_ERROR];
		}
		
		return $this->$method();
		
	}
	
	public function ping()
	{
		return [Constant::ERROR_CODE_OK];
	}
	
}

