<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: IMMsgContent.proto

namespace Protobuf\Garuda;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 **
 *特殊的消息实体：群通知
 *用于 type 为 GROUP_CHAT（群通知）
 *mType 为：
 *GROUP_NOTICE_INVITE_TO_INVITEE（邀请入群对被邀请人的通知，文案为 "XXX 邀请你加入了本群"）
 *GROUP_NOTICE_INVITE_TO_OTHERS（邀请入群对其他人的通知，提示文案为 "XXX 邀请 XXX 加入了本群"）
 *GROUP_NOTICE_QUIT_TO_KICKED（踢人动作对被踢用户的通知，文案为 "你已经被XXX（操作者）移出了群 XXXXX"）
 *GROUP_NOTICE_QUIT_TO_KICKER（踢人动作对踢人用户的通知，文案为 "XXX（被操作者）已经成功移出群聊"）
 *GROUP_NOTICE_QUIT_TO_OTHERS（用户退出对其它用户的通知，无文案）
 *GROUP_NOTICE_OWNERCHANGE_TO_NEW（群主变更对新群主的通知，文案为 "你已经成为新的群主"）
 *GROUP_NOTICE_OWNERCHANGE_TO_OTHERS（群主变更对群内其它用户的通知，文案为 "XXX（原群主）以将群主权限转移至XXX（新群主）"）
 *GROUP_NOTICE_DISMISS（群主主动解散群聊通知，文案为 "群XXXX已经被群主解散"）
 *GROUP_NOTICE_AUTO_DISMISS（群聊人数小于3人，群聊自动解散通知，文案为 "群XXXX因人数小于3人已经自动被系统解散"）
 *GROUP_NOTICE_MODIFY_NAME（群名称修改通知，文案为 "群名称已被 XXX 修改为 XXX"）
 *GROUP_NOTICE_ADMIN_SETTING_TO_TARGET（设定管理员对要设定的目标的通知，文案为 "你被群主设定为管理员"）
 *GROUP_NOTICE_ADMIN_SETTING_TO_OTHERS（设定管理员对其它用户的通知，文案为 "XXX 被群主设定为管理员"）
 *GROUP_NOTICE_ADMIN_RELIEVE_TO_TARGET（解除管理员对要设定的目标的通知，文案为 ""）
 *GROUP_NOTICE_ADMIN_RELIEVE_TO_OTHERS（解除管理员对其它用户的通知，无文案）
 * </pre>
 *
 * Protobuf type <code>protobuf.Garuda.GroupNotice</code>
 */
class GroupNotice extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     **
     *通知的源操作用户：
     *邀请入群的邀请者
     *用户被踢出群的踢人者
     *退群的用户
     *群主变更的原群主
     *修改群名称的操作者
     * </pre>
     *
     * <code>int64 suid = 1;</code>
     */
    private $suid = 0;
    /**
     * <pre>
     *suid 的用户名称
     * </pre>
     *
     * <code>string sname = 2;</code>
     */
    private $sname = '';
    /**
     * <pre>
     **
     *通知的源目标用户：
     *邀请入群的被邀请者
     *用户被踢出群的被踢者
     *群主变更的新群主
     *被设定／解除管理员的目标用户
     * </pre>
     *
     * <code>repeated int64 tuid = 3;</code>
     */
    private $tuid;
    /**
     * <pre>
     *tuid 的用户名称
     * </pre>
     *
     * <code>repeated string tname = 4;</code>
     */
    private $tname;
    /**
     * <pre>
     **
     *群名称
     * </pre>
     *
     * <code>string gname = 5;</code>
     */
    private $gname = '';
    /**
     * <pre>
     **
     *附加内容，
     * </pre>
     *
     * <code>string content = 6;</code>
     */
    private $content = '';

    public function __construct() {
        \GPBMetadata\IMMsgContent::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     **
     *通知的源操作用户：
     *邀请入群的邀请者
     *用户被踢出群的踢人者
     *退群的用户
     *群主变更的原群主
     *修改群名称的操作者
     * </pre>
     *
     * <code>int64 suid = 1;</code>
     */
    public function getSuid()
    {
        return $this->suid;
    }

    /**
     * <pre>
     **
     *通知的源操作用户：
     *邀请入群的邀请者
     *用户被踢出群的踢人者
     *退群的用户
     *群主变更的原群主
     *修改群名称的操作者
     * </pre>
     *
     * <code>int64 suid = 1;</code>
     */
    public function setSuid($var)
    {
        GPBUtil::checkInt64($var);
        $this->suid = $var;
    }

    /**
     * <pre>
     *suid 的用户名称
     * </pre>
     *
     * <code>string sname = 2;</code>
     */
    public function getSname()
    {
        return $this->sname;
    }

    /**
     * <pre>
     *suid 的用户名称
     * </pre>
     *
     * <code>string sname = 2;</code>
     */
    public function setSname($var)
    {
        GPBUtil::checkString($var, True);
        $this->sname = $var;
    }

    /**
     * <pre>
     **
     *通知的源目标用户：
     *邀请入群的被邀请者
     *用户被踢出群的被踢者
     *群主变更的新群主
     *被设定／解除管理员的目标用户
     * </pre>
     *
     * <code>repeated int64 tuid = 3;</code>
     */
    public function getTuid()
    {
        return $this->tuid;
    }

    /**
     * <pre>
     **
     *通知的源目标用户：
     *邀请入群的被邀请者
     *用户被踢出群的被踢者
     *群主变更的新群主
     *被设定／解除管理员的目标用户
     * </pre>
     *
     * <code>repeated int64 tuid = 3;</code>
     */
    public function setTuid(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT64);
        $this->tuid = $arr;
    }

    /**
     * <pre>
     *tuid 的用户名称
     * </pre>
     *
     * <code>repeated string tname = 4;</code>
     */
    public function getTname()
    {
        return $this->tname;
    }

    /**
     * <pre>
     *tuid 的用户名称
     * </pre>
     *
     * <code>repeated string tname = 4;</code>
     */
    public function setTname(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->tname = $arr;
    }

    /**
     * <pre>
     **
     *群名称
     * </pre>
     *
     * <code>string gname = 5;</code>
     */
    public function getGname()
    {
        return $this->gname;
    }

    /**
     * <pre>
     **
     *群名称
     * </pre>
     *
     * <code>string gname = 5;</code>
     */
    public function setGname($var)
    {
        GPBUtil::checkString($var, True);
        $this->gname = $var;
    }

    /**
     * <pre>
     **
     *附加内容，
     * </pre>
     *
     * <code>string content = 6;</code>
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * <pre>
     **
     *附加内容，
     * </pre>
     *
     * <code>string content = 6;</code>
     */
    public function setContent($var)
    {
        GPBUtil::checkString($var, True);
        $this->content = $var;
    }

}

