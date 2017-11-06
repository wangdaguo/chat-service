<?php
namespace Protocols;

use Protobuf\Garuda\GMessage;
use Google\Protobuf\Internal\OutputStream;
use Google\Protobuf\Internal\InputStream;
use Google\Protobuf\Internal\GPBWire;

require_once ROOTPATH . '/vendor/workerman/workerman/Autoloader.php';
require_once ROOTPATH . '/App/Autoloader.php';

class Protobuf 
{
    /**
     * 检查包的完整性
     * 如果能够得到包长，则返回包的在buffer中的长度，否则返回0继续等待数据
     * 如果协议有问题，则可以返回false，当前客户端连接会因此断开
     * @param string $buffer
     * @return int
     */
    public static function input($buffer)
    {
		return strlen($buffer);
//		$requestMessage = new GMessage();
//		$inputStream = new InputStream($buffer);
//		$totalLen = 0;
//		$inputStream->readVarint32($totalLen);
//		if ($totalLen+1 > $len)
//		{
//			return 0;
//		}
//		return $len;
    }

    /**
     * 打包，当向客户端发送数据的时候会自动调用
     * @param string $buffer
     * @return string
     */
    public static function encode($buffer)
    {
        // 把PB文件的长度加入到PB头
		$bodyLen = $buffer->byteSize();	
		$headerLen = GPBWire::varint32Size($bodyLen);
		$output = new OutputStream($bodyLen+$headerLen);
		$output->writeVarint32($bodyLen);
		$buffer->serializeToStream($output);
		return $output->getData();
    }

    /**
     * 解包，当接收到的数据字节数等于input返回的值（大于0的值）自动调用
     * 并传递给onMessage回调函数的$data参数
     * @param string $buffer
     * @return GMessage 
     */
    public static function decode($buffer)
    {
		//$arr = unpack("c*", $buffer);
		//error_log(print_r($arr,true)."\n", 3, '/tmp/myerror.log');
		$requestMessage = new GMessage();
		$requestMessage->mergeFromString($buffer);
		return $requestMessage;
	}
}
