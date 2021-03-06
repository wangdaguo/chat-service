<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: IMPresenceAuth.proto

namespace Protobuf\Garuda;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 **
 *Client 需要调用该认证服务，进行认证并获取Connector的服务器信息（ip、port），用于后续 Client 调用 connector 发起注册。
 *关键点：
 *1.Client应优先采用返回的ip、port来连接connector，并发起注册动作，如果该ip、port失败，
 *则采取addrs 备用地址列表来发起连接，且不要顺序的尝试addrs列表，应该采取随机的方式，避免IM服务端负载不均衡。
 *2.安全策略：Client在认证成功后，得到 authToken 、expires、m1。expires表示authToken、m1的超时时间，单位是秒，
 *在有效的时间内，Client端重复调用认证服务，得到的authToken、m1是相同的。authToken和m1在Client发起注册动作的时候需要传给IM服务端。
 *同时Client需要用authToken解密m1得到对称秘钥，解密算法与chatroom一样，首先需要把authToken调整成长度为32的字节数组，超出时末尾截取，不足时末尾补充0，
 *然后用调整后的authToken作为解密key，采用 “AES/ECB/PKCS5Padding” 算法解密m1得到对称秘钥，Client需要保存该对称密钥，用于后面对用户发送的聊天消息进行对称加密。
 * </pre>
 *
 * Protobuf type <code>protobuf.Garuda.AuthRequest</code>
 */
class AuthRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     *IM分配的appkey
     * </pre>
     *
     * <code>string appkey = 1;</code>
     */
    private $appkey = '';
    /**
     * <pre>
     *IM分配的app secret
     * </pre>
     *
     * <code>string appSecret = 2;</code>
     */
    private $appSecret = '';
    /**
     * <pre>
     *用户标识
     * </pre>
     *
     * <code>int64 uId = 3;</code>
     */
    private $uId = 0;
    /**
     * <pre>
     *用户 token
     * </pre>
     *
     * <code>string userToken = 4;</code>
     */
    private $userToken = '';
    /**
     * <pre>
     * 终端类型，详见 TermType 枚举, IMConstant.TermType
     * </pre>
     *
     * <code>int32 termType = 5;</code>
     */
    private $termType = 0;

    public function __construct() {
        \GPBMetadata\IMPresenceAuth::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     *IM分配的appkey
     * </pre>
     *
     * <code>string appkey = 1;</code>
     */
    public function getAppkey()
    {
        return $this->appkey;
    }

    /**
     * <pre>
     *IM分配的appkey
     * </pre>
     *
     * <code>string appkey = 1;</code>
     */
    public function setAppkey($var)
    {
        GPBUtil::checkString($var, True);
        $this->appkey = $var;
    }

    /**
     * <pre>
     *IM分配的app secret
     * </pre>
     *
     * <code>string appSecret = 2;</code>
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * <pre>
     *IM分配的app secret
     * </pre>
     *
     * <code>string appSecret = 2;</code>
     */
    public function setAppSecret($var)
    {
        GPBUtil::checkString($var, True);
        $this->appSecret = $var;
    }

    /**
     * <pre>
     *用户标识
     * </pre>
     *
     * <code>int64 uId = 3;</code>
     */
    public function getUId()
    {
        return $this->uId;
    }

    /**
     * <pre>
     *用户标识
     * </pre>
     *
     * <code>int64 uId = 3;</code>
     */
    public function setUId($var)
    {
        GPBUtil::checkInt64($var);
        $this->uId = $var;
    }

    /**
     * <pre>
     *用户 token
     * </pre>
     *
     * <code>string userToken = 4;</code>
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * <pre>
     *用户 token
     * </pre>
     *
     * <code>string userToken = 4;</code>
     */
    public function setUserToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->userToken = $var;
    }

    /**
     * <pre>
     * 终端类型，详见 TermType 枚举, IMConstant.TermType
     * </pre>
     *
     * <code>int32 termType = 5;</code>
     */
    public function getTermType()
    {
        return $this->termType;
    }

    /**
     * <pre>
     * 终端类型，详见 TermType 枚举, IMConstant.TermType
     * </pre>
     *
     * <code>int32 termType = 5;</code>
     */
    public function setTermType($var)
    {
        GPBUtil::checkInt32($var);
        $this->termType = $var;
    }

}

