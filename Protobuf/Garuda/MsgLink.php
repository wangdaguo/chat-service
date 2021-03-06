<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: MsgContent.proto

namespace Protobuf\Garuda;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 **
 *链接类消息
 *适用于：
 *消息类型：
 *用户类消息：Type = USER_1V1（用户1V1） 、USER_1VN（批量发消息） 、GROUP_CHAT（群聊） 、GROUP_CHAT_VN（群聊里的私聊）
 *系统类消息（且不是多语言 multilang ＝ 0）：Type = SYS_VN（系统通知）、SYS_VG（系统群通知）、SYS_BROADCAST（系统广播）
 *业务类型 MsgType = NORMAL_MSG（一般消息）、以及其他不需要额外业务参数的消息
 *消息格式 MsgFormat = LINK（链接）
 *Message 上行 需传字段：
 *version 消息报文版本
 *appkey  IM分配的appkey
 *msgid   消息ID,用于记录消息唯一标识(例如server端回ACK时,客户端可根据此ID唯一标识),对于消息业务报文此参数为必须
 *sendTime    发送时间(单位:毫秒)
 *type    消息类型，详见 Type 枚举, Constant.Type
 *mType   业务类型，详见 MsgType 枚举，Constant.MsgType
 *mFormat 消息格式，详见 MsgFormat 枚举，Constant.MsgFormat
 *sId 发送者ID
 *rId 接收者ID    用于 ：Type = USER_1V1（用户1V1）
 *gId 组ID    用于 ：GROUP_CHAT（群聊） 、GROUP_CHAT_VN（群聊里的私聊）
 *body 消息报文体
 *rIds    用于：USER_1VN（批量发消息）、GROUP_CHAT_VN（群聊里的私聊）
 *cc  国家码
 *Message 下行 返回的额外字段：
 *receiveTime 接收时间(单位:毫秒)，IM服务器接收时间，只用于下行消息。
 *msgVersion  消息版本号(用户／系统)，IM服务端生成。用于Client与IM进行消息同步。
 *subVersion  子消息（群）版本号，IM服务端生成，用于同步子（群）消息。   用于群消息
 *msgStatus   消息状态：0：正常初始化 1：隐藏，默认为0
 * </pre>
 *
 * Protobuf type <code>Protobuf.Garuda.MsgLink</code>
 */
class MsgLink extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * 消息内容
     * </pre>
     *
     * <code>string content = 1;</code>
     */
    private $content = '';
    /**
     * <pre>
     * 消息的跳转类型,详见 GotoType 枚举，Constant.GotoType
     * </pre>
     *
     * <code>int32 gotoType = 2;</code>
     */
    private $gotoType = 0;
    /**
     * <pre>
     *业务标识，用于业务标识
     * </pre>
     *
     * <code>string bizId = 3;</code>
     */
    private $bizId = '';
    /**
     * <pre>
     *发送群消息时的at操作用户列表
     * </pre>
     *
     * <code>repeated int64 atIds = 4;</code>
     */
    private $atIds;
    /**
     * <pre>
     *发送群消息时，at操作列表是否为群里除发送者外的所有有效成员，0 否 1 是，默认为0
     * </pre>
     *
     * <code>int32 atall = 5;</code>
     */
    private $atall = 0;
    /**
     * <pre>
     *链接名称
     * </pre>
     *
     * <code>string name = 6;</code>
     */
    private $name = '';
    /**
     * <pre>
     *链接url
     * </pre>
     *
     * <code>string url = 7;</code>
     */
    private $url = '';

    public function __construct() {
        \GPBMetadata\MsgContent::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * 消息内容
     * </pre>
     *
     * <code>string content = 1;</code>
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * <pre>
     * 消息内容
     * </pre>
     *
     * <code>string content = 1;</code>
     */
    public function setContent($var)
    {
        GPBUtil::checkString($var, True);
        $this->content = $var;
    }

    /**
     * <pre>
     * 消息的跳转类型,详见 GotoType 枚举，Constant.GotoType
     * </pre>
     *
     * <code>int32 gotoType = 2;</code>
     */
    public function getGotoType()
    {
        return $this->gotoType;
    }

    /**
     * <pre>
     * 消息的跳转类型,详见 GotoType 枚举，Constant.GotoType
     * </pre>
     *
     * <code>int32 gotoType = 2;</code>
     */
    public function setGotoType($var)
    {
        GPBUtil::checkInt32($var);
        $this->gotoType = $var;
    }

    /**
     * <pre>
     *业务标识，用于业务标识
     * </pre>
     *
     * <code>string bizId = 3;</code>
     */
    public function getBizId()
    {
        return $this->bizId;
    }

    /**
     * <pre>
     *业务标识，用于业务标识
     * </pre>
     *
     * <code>string bizId = 3;</code>
     */
    public function setBizId($var)
    {
        GPBUtil::checkString($var, True);
        $this->bizId = $var;
    }

    /**
     * <pre>
     *发送群消息时的at操作用户列表
     * </pre>
     *
     * <code>repeated int64 atIds = 4;</code>
     */
    public function getAtIds()
    {
        return $this->atIds;
    }

    /**
     * <pre>
     *发送群消息时的at操作用户列表
     * </pre>
     *
     * <code>repeated int64 atIds = 4;</code>
     */
    public function setAtIds(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT64);
        $this->atIds = $arr;
    }

    /**
     * <pre>
     *发送群消息时，at操作列表是否为群里除发送者外的所有有效成员，0 否 1 是，默认为0
     * </pre>
     *
     * <code>int32 atall = 5;</code>
     */
    public function getAtall()
    {
        return $this->atall;
    }

    /**
     * <pre>
     *发送群消息时，at操作列表是否为群里除发送者外的所有有效成员，0 否 1 是，默认为0
     * </pre>
     *
     * <code>int32 atall = 5;</code>
     */
    public function setAtall($var)
    {
        GPBUtil::checkInt32($var);
        $this->atall = $var;
    }

    /**
     * <pre>
     *链接名称
     * </pre>
     *
     * <code>string name = 6;</code>
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * <pre>
     *链接名称
     * </pre>
     *
     * <code>string name = 6;</code>
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;
    }

    /**
     * <pre>
     *链接url
     * </pre>
     *
     * <code>string url = 7;</code>
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * <pre>
     *链接url
     * </pre>
     *
     * <code>string url = 7;</code>
     */
    public function setUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->url = $var;
    }

}

