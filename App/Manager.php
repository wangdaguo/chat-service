<?php

namespace App;
use \GatewayWorker\Lib\Gateway;

class Manager extends Flag
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
				'flag'   => Constant::FLAG_MANAGER,
				'operation'  => Constant::OPERATION_AUTHORIZATION,
				'data'      => [],
		]];
	}
	
	public function message()
	{
		//分配坐席
		switch ($this->data['data']['type'])
		{
			case Constant::IM_TYPE_USER_1V1:
				
				if (empty($this->data['sysId']) || empty($this->data['uid']))
				{
					return [Constant::ERROR_CODE_PARAM_ERROR];
				}
				for ($i = 0; $i< 3; $i++)
				{
					$adminId = GlobalVariable::allocationSeat($this->data['uid'], $this->data['data']['country'], $this->data['data']['language']);
					if ($adminId > 0)
					{
						if (! Gateway::isUidOnline($adminId))
						{
							GlobalVariable::opsLogout($adminId);
						}
						else 
						{
							break;
						}
					}
					sleep(1);
				}
				PubFunction::writeFile($this->data['data']['msgid'], $this->data['data']['msgVersion'], $this->data['uid'], $adminId, PubFunction::DIRECT_TO_ADMIN, $this->data['data']['content'], $this->data['data']['country'], $this->data['data']['language'], $this->data['data']['receiveTime'], $this->data['data']['url']);
				
				if ($adminId <=0)
				{
					return [Constant::ERROR_CODE_NO_ADMINID];
				}
				
				//发送web
				$content = [
						'flag'        => Constant::FLAG_CONVERSATION,
						'operation'   => Constant::OPERATION_SEND_MESSAGE,
						'uid'         => $this->data['uid'],
						'data'        => $this->data['data'],
						
				];
				//TODO 入库
				Gateway::sendToUid($adminId, PubFunction::sendMessage(Constant::ERROR_CODE_OK, $content));
				
				return [Constant::ERROR_CODE_OK];
				break;
			default:
				return [Constant::ERROR_CODE_PARAM_ERROR];
		}
	}

	protected function checkAdminId()
	{
		return $this->data['sysId'] == Constant::SYSTEM_ADMINID_MANAGER;
	}
}

