<?php
namespace App;

require_once __DIR__ . '/../Protobuf/Autoloader.php';
use Protobuf\Garuda\AuthRequest;
use Protobuf\Garuda\AuthResponse;
use Protobuf\Garuda\Result;
use Protobuf\Garuda\TermType;

class Authentication
{
	public static function getAuthInfo()
	{
		$configure = Configure::getKey();

		$request = new AuthRequest();
		$request->setAppkey($configure['im']['appKey']);
		$request->setAppSecret($configure['im']['appSecret']);
		$request->setUId($configure['im']['systemSenderId']);
		$request->setUserToken($configure['im']['userToken']);
		$request->setTermType(TermType::NONE);
		$data = $request->serializeToString();

		// var_dump(unpack("c*", $data));
		$ch = curl_init($configure['im']['authUrl']);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-protobuf',
			'Content-Length: ' . strlen($data))
		);
		$response = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);

		$resultResponse = new Result();
		$resultResponse->mergeFromString($response);
		$result =  $resultResponse->getData()->getValue();
		$authResponse = new AuthResponse();
		$authResponse->mergeFromString($result);

		$m1 = $authResponse->getM1();
		$token = $authResponse->getAuthToken();
		$ip = $authResponse->getIp();
		$port = $authResponse->getPort();
		$aResult = $authResponse->getAResult();

		$key = PubFunction::decrypt($m1, $token);
		$byteToken = unpack("c*", $key);
		$byteToken = array_pad($byteToken, 32, 0);
		array_unshift($byteToken, 'c*');
		$key = call_user_func_array('pack', $byteToken);
		//var_dump($ip, $port, $m1, $token);
		return ['ip'=>$ip, 'port'=>$port, 'm1'=>$m1, 'token'=>$token, 'key'=>$key];
	}	

}

