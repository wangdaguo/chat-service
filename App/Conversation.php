<?php

namespace App;

use \GatewayWorker\Lib\Gateway;
use Protobuf\Garuda\MsgType;
/**
 * 处理web client
 * @author yuanchangjun
 *
 */
class Conversation extends Flag
{
	public function __construct($data)
	{
		parent::__construct($data);
		
	}
	
	public function authorization()
	{
		if ($this->data['token'] != PubFunction::genToken($this->data['adminId']))
		{
			return [Constant::ERROR_CODE_AUTH_FAILED];
		}
	
		$_SESSION['adminId'] = $this->data['adminId'];
		$_SESSION['country'] = $this->data['data']['country'];
		$_SESSION['language'] = $this->data['data']['language'];
		
		Gateway::bindUid($_SERVER['GATEWAY_CLIENT_ID'], $this->data['adminId']);
		
		//初始化客服信息
		GlobalVariable::fillOpsUidToCountry($this->data['adminId'], $this->data['data']['country']);
		
		return [Constant::ERROR_CODE_OK, [
				'beginTime' => time(),
				'unreadMessageNumber' => PubFunction::getUnreadMessageNumber($this->data['data']['country'])
		]];
	}
	
	/**
	 * 聊天消息
	 * 接受web client数据，格式化数据后发给 im proxy
	 * @return number[]
	 */
	public function message()
	{
		global $globalAdmins;
		if (! Gateway::isUidOnline(\App\Constant::SYSTEM_ADMINID_MANAGER) )
		{
			return [Constant::ERROR_CODE_IM_CLOSED];
		}
		
		$content = [
					'flag'        => Constant::FLAG_MANAGER,
					'operation'   => Constant::OPERATION_SEND_MESSAGE,
					'uid'         => $this->data['uid'],
					'receiveTime' => $this->data['data']['receiveTime'],
					'data'        => $this->data['data'],
		];
		//发送im proxy server
		Gateway::sendToUid(\App\Constant::SYSTEM_ADMINID_MANAGER, PubFunction::sendMessage(Constant::ERROR_CODE_OK, $content));
		$msgid = PubFunction::getMsgId($this->data['uid'], $this->data['data']['type'], MsgType::NORMAL_MSG, $this->data['data']['mFormat'], time());
		PubFunction::writeFile($msgid, $this->data['data']['msgVersion'], $this->data['uid'], $this->data['adminId'], PubFunction::DIRECT_TO_IM, $this->data['data']['content'], $_SESSION['country'], $_SESSION['language'], floor(microtime(true) * 1000), $this->data['data']['url']);

		return [Constant::ERROR_CODE_OK];
	}
	/**
	 * 修改状态
	 */
	public function online()
	{
		GlobalVariable::changeOpsStatus($this->data['data']['adminStatus']);
	}
	
	protected function checkAdminId()
	{
		return $this->data['adminId'] >= Constant::SYSTEM_ADMINID_CONVERSATION_MIN;
	}
	/**
	 * 用户历史消息
	 */
	public function history()
	{
		global $db;
		$sql  = 'select * from ' . PubFunction::getIMTable($this->data['uid']) ;
		$sql .= ' WHERE uid=' . $this->data['uid'] .  ' AND sendTime < ' . $this->data['data']['sendTime'];
		$sql .= ' ORDER BY sendTime DESC, id DESC LIMIT 0, ' . $this->data['data']['pageSize'];
		$result = $db->query($sql);
		return [Constant::ERROR_CODE_OK, ['data' => $result]];
	}
	/**
	 * 未读消息
	 */
	public function unread()
	{
		global $db;
		$country = $_SESSION['country'];
		$adminId = $_SESSION['adminId'];
		
		$unreadNum = PubFunction::getUnreadMessageNumber($country);
		$result = ['data' => [], 'unreadMessageNumber' => 0];
		if ($unreadNum > 0)
		{
			
			$records = PubFunction::getUnreadMessageList($country);
			$result['data'] = $records;
			$result['unreadMessageNumber'] = $unreadNum - Constant::PAGESIZE >= 0 ? $unreadNum - Constant::PAGESIZE : 0;
			if (!empty($records))
			{
				foreach ($records as $record)
				{
					$updateSql = "UPDATE IM_" . $record['t'] . " SET adminId = $adminId WHERE id = " . $record['id'];
					$db->query($updateSql);
				}
			}
		}
		
		return [Constant::ERROR_CODE_OK,  $result];
	}
}

