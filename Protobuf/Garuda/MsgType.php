<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: IMConstant.proto

namespace Protobuf\Garuda;

/**
 * <pre>
 * 业务类型，决定消息内容
 * </pre>
 *
 * Protobuf enum <code>protobuf.Garuda.MsgType</code>
 */
class MsgType
{
    /**
     * <pre>
     *默认 无
     * </pre>
     *
     * <code>NULL = 0;</code>
     */
    const NULL = 0;
    /**
     * <pre>
     *消息ACK下行，用于 Type= ACK，无 body ，客户端根据 msgid 来判断属于那个消息的ACK。
     * </pre>
     *
     * <code>MSG_ACK_2C = 1;</code>
     */
    const MSG_ACK_2C = 1;
    /**
     * <pre>
     *消息ACK上行，用于 Type= ACK，无 body，需要客户端额外传入 appkey 、sid（ack消息的发送者）、msgVersion 。 IM根据这三个参数确定ACK记录。
     *用户消息ACK
     * </pre>
     *
     * <code>USER_MSG_ACK_2S = 2;</code>
     */
    const USER_MSG_ACK_2S = 2;
    /**
     * <pre>
     *系统广播消息ACK
     * </pre>
     *
     * <code>SYS_MSG_ACK_2S = 3;</code>
     */
    const SYS_MSG_ACK_2S = 3;
    /**
     * <pre>
     *登出ACK下行，用于 Type= ACK，无 body
     * </pre>
     *
     * <code>OUT_ACK = 4;</code>
     */
    const OUT_ACK = 4;
    /**
     * <pre>
     *IM检测出用户多端登录，踢出用户的上一次活跃链接，客户端做相应处理。用于TYPE=SERVER_NOTICE，无 body
     * </pre>
     *
     * <code>INVALID_CONNECT = 32;</code>
     */
    const INVALID_CONNECT = 32;
    /**
     * <pre>
     *用户session、认证信息失效， 需要重新获取认证信息。用于TYPE=SERVER_NOTICE，无 body
     * </pre>
     *
     * <code>MUST_RELOGIN = 33;</code>
     */
    const MUST_RELOGIN = 33;
    /**
     * <pre>
     * 不允许发送上行报文。用于TYPE=SERVER_NOTICE，无 body
     * </pre>
     *
     * <code>NO_REQUEST = 34;</code>
     */
    const NO_REQUEST = 34;
    /**
     * <pre>
     * 消息版本（包括用户消息（单聊、群聊、系统通知）、系统广播消息）。用于TYPE=SERVER_NOTICE，body 为 ServerActivity.MsgVersions
     * </pre>
     *
     * <code>PUSH_VERSION = 35;</code>
     */
    const PUSH_VERSION = 35;
    /**
     * <pre>
     *IM服务端的校验，客户端不需要此消息，消息长度超出限制。用于TYPE=SERVER_NOTICE，无 body。用于消息的下行反馈
     * </pre>
     *
     * <code>OUT_OF_SIZE = 36;</code>
     */
    const OUT_OF_SIZE = 36;
    /**
     * <pre>
     *拉取消息版本(用于 Type = PULL_ACT )
     * </pre>
     *
     * <code>PULL_VERSION = 80;</code>
     */
    const PULL_VERSION = 80;
    /**
     * <pre>
     *拉取用户离线消息(用于 Type = PULL_ACT )
     * </pre>
     *
     * <code>PULL_OFFLINE_MSG = 81;</code>
     */
    const PULL_OFFLINE_MSG = 81;
    /**
     * <pre>
     *拉取群的消息(用于 Type = PULL_ACT )
     * </pre>
     *
     * <code>PULL_GROUP_MSG = 82;</code>
     */
    const PULL_GROUP_MSG = 82;
    /**
     * <pre>
     *拉取系统广播的消息(用于 Type = PULL_ACT )
     * </pre>
     *
     * <code>PULL_SYS_MSG = 83;</code>
     */
    const PULL_SYS_MSG = 83;
    /**
     * <pre>
     *拉取最近的消息
     * </pre>
     *
     * <code>PULL_RECENT_MSG = 84;</code>
     */
    const PULL_RECENT_MSG = 84;
    /**
     * <pre>
     * 一般消息(用于TYPE中消息类别标识为 USER_MESSAGE,SYS_MESSAGE)
     * </pre>
     *
     * <code>NORMAL_MSG = 256;</code>
     */
    const NORMAL_MSG = 256;
    /**
     * <pre>
     *用户申请好友提示 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>FRIEND_APPLY = 257;</code>
     */
    const FRIEND_APPLY = 257;
    /**
     * <pre>
     *互相关注成功 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>FRIEND_VALID = 258;</code>
     */
    const FRIEND_VALID = 258;
    /**
     * <pre>
     *好友关系失效 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>FRIEND_INVALID = 259;</code>
     */
    const FRIEND_INVALID = 259;
    /**
     * <pre>
     *动态更新 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>DYNAMIC_UPDATE = 260;</code>
     */
    const DYNAMIC_UPDATE = 260;
    /**
     * <pre>
     *动态评论通知 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>DYNAMIC_COMMENT_NOTICE = 261;</code>
     */
    const DYNAMIC_COMMENT_NOTICE = 261;
    /**
     * <pre>
     *动态点赞通知 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>DYNAMIC_LIKE_NOTICE = 262;</code>
     */
    const DYNAMIC_LIKE_NOTICE = 262;
    /**
     * <pre>
     *动态审核未通过 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>DYNAMIC_UNREVIEW_NOTICE = 263;</code>
     */
    const DYNAMIC_UNREVIEW_NOTICE = 263;
    /**
     * <pre>
     *动态列表计算完成 (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>DYNAMIC_CALCULATE_COMPLETE_NOTICE = 264;</code>
     */
    const DYNAMIC_CALCULATE_COMPLETE_NOTICE = 264;
    /**
     * <pre>
     *邀请入群对被邀请人的通知，文案为 "XXX 邀请你加入了本群"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_INVITE_TO_INVITEE = 265;</code>
     */
    const GROUP_NOTICE_INVITE_TO_INVITEE = 265;
    /**
     * <pre>
     *邀请入群对其他人的通知，提示文案为 "XXX 邀请 XXX 加入了本群"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_INVITE_TO_OTHERS = 266;</code>
     */
    const GROUP_NOTICE_INVITE_TO_OTHERS = 266;
    /**
     * <pre>
     *邀请入群通知，等待被邀请人确认   (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_INVITE_TO_CONFIRM = 267;</code>
     */
    const GROUP_NOTICE_INVITE_TO_CONFIRM = 267;
    /**
     * <pre>
     *邀请入群对邀请人的通知，文案为 "你邀请XXX 加入了本群"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_INVITE_TO_INVITER = 268;</code>
     */
    const GROUP_NOTICE_INVITE_TO_INVITER = 268;
    /**
     * <pre>
     *邀请入群通知，邀请人等待确认，文案为 "XXX（被邀请人）开启了群聊确认功能，在用户确认后提示邀请结果"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_INVITE_WAIT_CONFIRM = 290;</code>
     */
    const GROUP_NOTICE_INVITE_WAIT_CONFIRM = 290;
    /**
     * <pre>
     *踢人动作对被踢用户的通知，文案为 "你已经被XXX（操作者）移出了群 XXXXX"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_QUIT_TO_KICKED = 269;</code>
     */
    const GROUP_NOTICE_QUIT_TO_KICKED = 269;
    /**
     * <pre>
     *踢人动作对踢人用户的通知，文案为 "XXX（被操作者）已经成功移出群聊"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_QUIT_TO_KICKER = 270;</code>
     */
    const GROUP_NOTICE_QUIT_TO_KICKER = 270;
    /**
     * <pre>
     *用户退出对其它用户的通知，无文案   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_QUIT_TO_OTHERS = 271;</code>
     */
    const GROUP_NOTICE_QUIT_TO_OTHERS = 271;
    /**
     * <pre>
     *用户退出对自己的通知，无文案   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_QUIT_TO_SELF = 289;</code>
     */
    const GROUP_NOTICE_QUIT_TO_SELF = 289;
    /**
     * <pre>
     *群主变更对新群主的通知，文案为 "你已经成为新的群主"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_OWNERCHANGE_TO_NEW = 272;</code>
     */
    const GROUP_NOTICE_OWNERCHANGE_TO_NEW = 272;
    /**
     * <pre>
     *群主变更对群内其它用户的通知，文案为 "XXX（原群主）以将群主权限转移至XXX（新群主）"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_OWNERCHANGE_TO_OTHERS = 273;</code>
     */
    const GROUP_NOTICE_OWNERCHANGE_TO_OTHERS = 273;
    /**
     * <pre>
     *群主主动解散群聊通知，文案为 "群XXXX已经被群主解散"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_DISMISS = 274;</code>
     */
    const GROUP_NOTICE_DISMISS = 274;
    /**
     * <pre>
     *群聊人数小于3人，群聊自动解散通知，文案为 "群XXXX因人数小于3人已经自动被系统解散"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_AUTO_DISMISS = 275;</code>
     */
    const GROUP_NOTICE_AUTO_DISMISS = 275;
    /**
     * <pre>
     *群名称修改通知，文案为 "群名称已被 XXX 修改为 XXX"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_MODIFY_NAME = 276;</code>
     */
    const GROUP_NOTICE_MODIFY_NAME = 276;
    /**
     * <pre>
     *设定管理员对要设定的目标的通知，文案为 "你被群主设定为管理员"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_ADMIN_SETTING_TO_TARGET = 277;</code>
     */
    const GROUP_NOTICE_ADMIN_SETTING_TO_TARGET = 277;
    /**
     * <pre>
     *设定管理员对其它用户的通知，文案为 "XXX 被群主设定为管理员"   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_ADMIN_SETTING_TO_OTHERS = 278;</code>
     */
    const GROUP_NOTICE_ADMIN_SETTING_TO_OTHERS = 278;
    /**
     * <pre>
     *解除管理员对要设定的目标的通知，文案为 ""   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_ADMIN_RELIEVE_TO_TARGET = 279;</code>
     */
    const GROUP_NOTICE_ADMIN_RELIEVE_TO_TARGET = 279;
    /**
     * <pre>
     *解除管理员对其它用户的通知，无文案   (用于TYPE = GROUP_NOTICE)
     * </pre>
     *
     * <code>GROUP_NOTICE_ADMIN_RELIEVE_TO_OTHERS = 280;</code>
     */
    const GROUP_NOTICE_ADMIN_RELIEVE_TO_OTHERS = 280;
    /**
     * <pre>
     *启用VIP客服通知给用户  (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>ACTIVATE_VIP_CUSTOMER_SERVICE_TO_USER = 281;</code>
     */
    const ACTIVATE_VIP_CUSTOMER_SERVICE_TO_USER = 281;
    /**
     * <pre>
     *更换VIP客服  (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>CHANGE_VIP_CUSTOMER_SERVICE = 282;</code>
     */
    const CHANGE_VIP_CUSTOMER_SERVICE = 282;
    /**
     * <pre>
     *关闭VIP客服  (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>CLOSE_VIP_CUSTOMER_SERVICE_TO_USER = 283;</code>
     */
    const CLOSE_VIP_CUSTOMER_SERVICE_TO_USER = 283;
    /**
     * <pre>
     *重新开启VIP客服  (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>REACTIVATE_VIP_CUSTOMER_SERVICE = 284;</code>
     */
    const REACTIVATE_VIP_CUSTOMER_SERVICE = 284;
    /**
     * <pre>
     *启用VIP客服通知给VIP客服  (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>ACTIVATE_VIP_CUSTOMER_SERVICE_TO_CS = 285;</code>
     */
    const ACTIVATE_VIP_CUSTOMER_SERVICE_TO_CS = 285;
    /**
     * <pre>
     *关闭VIP客服通知给VIP客服  (用于TYPE = SYS_NOTICE)
     * </pre>
     *
     * <code>CLOSE_VIP_CUSTOMER_SERVICE_TO_CS = 287;</code>
     */
    const CLOSE_VIP_CUSTOMER_SERVICE_TO_CS = 287;
    /**
     * <pre>
     *仅客户端用，用户创建群成功
     * </pre>
     *
     * <code>GROUP_NOTICE_CREATE_SUCCESS = 288;</code>
     */
    const GROUP_NOTICE_CREATE_SUCCESS = 288;
}

