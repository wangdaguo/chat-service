<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: ResultResponse.proto

namespace Protobuf\Garuda;

/**
 * Protobuf enum <code>protobuf.Garuda.Code</code>
 */
class Code
{
    /**
     * <pre>
     *0x000000---0x000FFF 为正确码
     *0x001000---max为错误码
     * </pre>
     *
     * <code>DEFAULT = 0;</code>
     */
//     const DEFAULT = 0;
    /**
     * <pre>
     *接口成功返回数据
     * </pre>
     *
     * <code>SC_SUCCESS = 1;</code>
     */
    const SC_SUCCESS = 1;
    /**
     * <pre>
     *第三方已绑定
     * </pre>
     *
     * <code>SC_THIRD_PARTY_ALREADY_BIND = 256;</code>
     */
    const SC_THIRD_PARTY_ALREADY_BIND = 256;
    /**
     * <pre>
     *三方检查用户未注册
     * </pre>
     *
     * <code>SC_THIRD_CHECK_USER_NOT_REGISTER = 257;</code>
     */
    const SC_THIRD_CHECK_USER_NOT_REGISTER = 257;
    /**
     * <pre>
     *需要绑定手机
     * </pre>
     *
     * <code>SC_NEED_BIND_PHONE = 258;</code>
     */
    const SC_NEED_BIND_PHONE = 258;
    /**
     * <pre>
     * 客户端请求参数无效
     * </pre>
     *
     * <code>SC_PARAMETER_INVALID = 4096;</code>
     */
    const SC_PARAMETER_INVALID = 4096;
    /**
     * <pre>
     *无权限(超级管理员)
     * </pre>
     *
     * <code>SC_ADMIN_NO_PERMISSION = 4352;</code>
     */
    const SC_ADMIN_NO_PERMISSION = 4352;
    /**
     * <pre>
     * 用户token不匹配
     * </pre>
     *
     * <code>SC_ACCOUTN_USER_TOKEN_NOTMATCH = 8192;</code>
     */
    const SC_ACCOUTN_USER_TOKEN_NOTMATCH = 8192;
    /**
     * <pre>
     *已在其它设备登陆
     * </pre>
     *
     * <code>SC_LOGINED_IN_OTHER_DEVICE = 8193;</code>
     */
    const SC_LOGINED_IN_OTHER_DEVICE = 8193;
    /**
     * <pre>
     * 检查是否有效的大陆手机号码
     * </pre>
     *
     * <code>SC_SMS_VERIFY_CODE_NOMOBILE = 4097;</code>
     */
    const SC_SMS_VERIFY_CODE_NOMOBILE = 4097;
    /**
     * <pre>
     * 移动手机号码发送失败
     * </pre>
     *
     * <code>SC_SMS_VERIFY_CODE_FAIL = 4098;</code>
     */
    const SC_SMS_VERIFY_CODE_FAIL = 4098;
    /**
     * <pre>
     *验证码不匹配
     * </pre>
     *
     * <code>SC_SMS_VERIFY_CODE_NOTMATCH = 4099;</code>
     */
    const SC_SMS_VERIFY_CODE_NOTMATCH = 4099;
    /**
     * <pre>
     * 手机已经注册
     * </pre>
     *
     * <code>SC_ACCOUNT_MOBILE_PHONE_REPETITION = 4100;</code>
     */
    const SC_ACCOUNT_MOBILE_PHONE_REPETITION = 4100;
    /**
     * <pre>
     * 手机已经绑定其它手机号
     * </pre>
     *
     * <code>SC_ACCOUNT_MOBILE_PHONE_ALLREADY_BIND = 4101;</code>
     */
    const SC_ACCOUNT_MOBILE_PHONE_ALLREADY_BIND = 4101;
    /**
     * <pre>
     *用户名被禁止
     * </pre>
     *
     * <code>SC_ACCOUTN_USER_NAME_FORBIDDEN = 4102;</code>
     */
    const SC_ACCOUTN_USER_NAME_FORBIDDEN = 4102;
    /**
     * <pre>
     *三方验证失败
     * </pre>
     *
     * <code>SC_ACCOUTN_THIRD_CHECK_FAIL = 4103;</code>
     */
    const SC_ACCOUTN_THIRD_CHECK_FAIL = 4103;
    /**
     * <pre>
     *用户名过长
     * </pre>
     *
     * <code>SC_ACCOUNT_USER_NAME_OVER_LONG = 4104;</code>
     */
    const SC_ACCOUNT_USER_NAME_OVER_LONG = 4104;
    /**
     * <pre>
     *直播号过长
     * </pre>
     *
     * <code>SC_ACCOUNT_LIVE_CODE_OVER_LONG = 4105;</code>
     */
    const SC_ACCOUNT_LIVE_CODE_OVER_LONG = 4105;
    /**
     * <pre>
     *直播号支持数字、字母及下划线组合，不支持纯数字，不可重复
     * </pre>
     *
     * <code>SC_ACCOUNT_LIVE_CODE_NOT_STANDARD = 4112;</code>
     */
    const SC_ACCOUNT_LIVE_CODE_NOT_STANDARD = 4112;
    /**
     * <pre>
     *直播号已存在
     * </pre>
     *
     * <code>SC_ACCOUNT_LIVE_CODE_EXIST = 4113;</code>
     */
    const SC_ACCOUNT_LIVE_CODE_EXIST = 4113;
    /**
     * <pre>
     *直播号更新失败
     * </pre>
     *
     * <code>SC_ACCOUNT_LIVE_UPDATE_FAIL = 4114;</code>
     */
    const SC_ACCOUNT_LIVE_UPDATE_FAIL = 4114;
    /**
     * <pre>
     *密码错误
     * </pre>
     *
     * <code>SC_ACCOUNT_PASSWORD_ERROR = 4115;</code>
     */
    const SC_ACCOUNT_PASSWORD_ERROR = 4115;
    /**
     * <pre>
     *用户不存在
     * </pre>
     *
     * <code>SC_ACCOUNT_USER_NOT_EXIST = 4116;</code>
     */
    const SC_ACCOUNT_USER_NOT_EXIST = 4116;
    /**
     * <pre>
     *直播号过短，至少5位
     * </pre>
     *
     * <code>SC_ACCOUNT_LIVE_CODE_TOO_SHORT = 4117;</code>
     */
    const SC_ACCOUNT_LIVE_CODE_TOO_SHORT = 4117;
    /**
     * <pre>
     *签名过长
     * </pre>
     *
     * <code>SC_ACCOUNT_SIGNATURE_OVER_LONG = 4118;</code>
     */
    const SC_ACCOUNT_SIGNATURE_OVER_LONG = 4118;
    /**
     * <pre>
     *用户被禁止登陆
     * </pre>
     *
     * <code>SC_ACCOUTN_USER_FORBIDDEN = 4119;</code>
     */
    const SC_ACCOUTN_USER_FORBIDDEN = 4119;
    /**
     * <pre>
     *无此二维码或已超时
     * </pre>
     *
     * <code>SC_ACCOUNT_RANDOM_NOTEXIST = 4120;</code>
     */
    const SC_ACCOUNT_RANDOM_NOTEXIST = 4120;
    /**
     * <pre>
     *未扫描二维码
     * </pre>
     *
     * <code>SC_ACCOUNT_RANDOM_NOTSCAN = 4121;</code>
     */
    const SC_ACCOUNT_RANDOM_NOTSCAN = 4121;
    /**
     * <pre>
     *已扫描二维码
     * </pre>
     *
     * <code>SC_ACCOUNT_RANDOM_SCANNED = 4128;</code>
     */
    const SC_ACCOUNT_RANDOM_SCANNED = 4128;
    /**
     * <pre>
     *直播号码只能修改一次
     * </pre>
     *
     * <code>SC_ACCOUNT_LIVE_CODE_NOLY_MODIFY_ONCE = 4129;</code>
     */
    const SC_ACCOUNT_LIVE_CODE_NOLY_MODIFY_ONCE = 4129;
    /**
     * <pre>
     *用户名或密码错误
     * </pre>
     *
     * <code>SC_ACCOUNT_USER_OR_PASSWORD_ERROR = 4130;</code>
     */
    const SC_ACCOUNT_USER_OR_PASSWORD_ERROR = 4130;
    /**
     * <pre>
     *邮箱验证次数超过每天限制
     * </pre>
     *
     * <code>SC_EMAIL_SEND_OVER_LIMIT = 4131;</code>
     */
    const SC_EMAIL_SEND_OVER_LIMIT = 4131;
    /**
     * <pre>
     *验证信息已失效
     * </pre>
     *
     * <code>SC_EMAIL_VERIFY_INVALID = 4132;</code>
     */
    const SC_EMAIL_VERIFY_INVALID = 4132;
    /**
     * <pre>
     *未验证邮箱
     * </pre>
     *
     * <code>SC_EMAIL_NOT_VERIFY = 4133;</code>
     */
    const SC_EMAIL_NOT_VERIFY = 4133;
    /**
     * <pre>
     *需要注册才能访问
     * </pre>
     *
     * <code>SC_NEED_REGISTER = 4134;</code>
     */
    const SC_NEED_REGISTER = 4134;
    /**
     * <pre>
     *输入内容包含敏感词
     * </pre>
     *
     * <code>SC_SENSITIVE_CONTENT = 4609;</code>
     */
    const SC_SENSITIVE_CONTENT = 4609;
    /**
     * <pre>
     *礼物不存在
     * </pre>
     *
     * <code>SC_MALL_GIFT_NOT_EXIST = 12289;</code>
     */
    const SC_MALL_GIFT_NOT_EXIST = 12289;
    /**
     * <pre>
     *交易号重复
     * </pre>
     *
     * <code>SC_MALL_TRANSACTION_REPEATED = 12290;</code>
     */
    const SC_MALL_TRANSACTION_REPEATED = 12290;
    /**
     * <pre>
     *钻石余额不足
     * </pre>
     *
     * <code>SC_MALL_MONEY_NOT_ENOUGH = 12291;</code>
     */
    const SC_MALL_MONEY_NOT_ENOUGH = 12291;
    /**
     * <pre>
     *交易不存在/交易失败
     * </pre>
     *
     * <code>SC_MALL_TRANSACTION_NOT_EXIST = 12292;</code>
     */
    const SC_MALL_TRANSACTION_NOT_EXIST = 12292;
    /**
     * <pre>
     *该商品不存在/不可购买
     * </pre>
     *
     * <code>SC_MALL_PRODUCT_NOT_AVAILABLE = 12293;</code>
     */
    const SC_MALL_PRODUCT_NOT_AVAILABLE = 12293;
    /**
     * <pre>
     *订单不存在
     * </pre>
     *
     * <code>SC_MALL_ORDER_NOT_EXIST = 12294;</code>
     */
    const SC_MALL_ORDER_NOT_EXIST = 12294;
    /**
     * <pre>
     *下单失败
     * </pre>
     *
     * <code>SC_MALL_UNIFIED_ORDER_FAIL = 12295;</code>
     */
    const SC_MALL_UNIFIED_ORDER_FAIL = 12295;
    /**
     * <pre>
     *支付结果为：支付失败或未支付
     * </pre>
     *
     * <code>SC_MALL_PAY_FAIL = 12296;</code>
     */
    const SC_MALL_PAY_FAIL = 12296;
    /**
     * <pre>
     *查询失败，稍后重试
     * </pre>
     *
     * <code>SC_MALL_PAY_QUERY_FAIL = 12297;</code>
     */
    const SC_MALL_PAY_QUERY_FAIL = 12297;
    /**
     * <pre>
     *IAP验证失败
     * </pre>
     *
     * <code>SC_MALL_IAP_VALIDATE_FAIL = 12298;</code>
     */
    const SC_MALL_IAP_VALIDATE_FAIL = 12298;
    /**
     * <pre>
     *有未完成订单
     * </pre>
     *
     * <code>SC_MALL_ORDER_EXIST_NOT_FINISHED = 12299;</code>
     */
    const SC_MALL_ORDER_EXIST_NOT_FINISHED = 12299;
    /**
     * <pre>
     *提现需要绑定微信
     * </pre>
     *
     * <code>SC_MALL_NOT_BIND_WECHAT = 12300;</code>
     */
    const SC_MALL_NOT_BIND_WECHAT = 12300;
    /**
     * <pre>
     *超过每日提现次数
     * </pre>
     *
     * <code>SC_MALL_EXCEED_WITHDRAW_TIMES = 12301;</code>
     */
    const SC_MALL_EXCEED_WITHDRAW_TIMES = 12301;
    /**
     * <pre>
     *超过每日提现额度
     * </pre>
     *
     * <code>SC_MALL_EXCEED_WITHDRAW_QUOTA = 12302;</code>
     */
    const SC_MALL_EXCEED_WITHDRAW_QUOTA = 12302;
    /**
     * <pre>
     *提现失败
     * </pre>
     *
     * <code>SC_MALL_WITHDRAW_FAIL = 12303;</code>
     */
    const SC_MALL_WITHDRAW_FAIL = 12303;
    /**
     * <pre>
     *小于单次提现最小值
     * </pre>
     *
     * <code>SC_MALL_WITHDRAW_LESS_THAN_MIN = 12304;</code>
     */
    const SC_MALL_WITHDRAW_LESS_THAN_MIN = 12304;
    /**
     * <pre>
     *大于单次提现最大值
     * </pre>
     *
     * <code>SC_MALL_WITHDRAW_GREATER_THAN_MAX = 12305;</code>
     */
    const SC_MALL_WITHDRAW_GREATER_THAN_MAX = 12305;
    /**
     * <pre>
     *超过频率限制，1分钟只能提现1次
     * </pre>
     *
     * <code>SC_MALL_WITHDRAW_FREQ_LIMIT = 12306;</code>
     */
    const SC_MALL_WITHDRAW_FREQ_LIMIT = 12306;
    /**
     * <pre>
     *该微信账号今日领取红包个数超过限制
     * </pre>
     *
     * <code>SC_MALL_WITHDRAW_SENDNUM_LIMIT = 12307;</code>
     */
    const SC_MALL_WITHDRAW_SENDNUM_LIMIT = 12307;
    /**
     * <pre>
     *提现需要绑定PayPal邮箱账号
     * </pre>
     *
     * <code>SC_MALL_NOT_BIND_PAYPAL = 12308;</code>
     */
    const SC_MALL_NOT_BIND_PAYPAL = 12308;
    /**
     * <pre>
     *Google支付验证失败
     * </pre>
     *
     * <code>SC_MALL_IAB_VALIDATE_FAIL = 12309;</code>
     */
    const SC_MALL_IAB_VALIDATE_FAIL = 12309;
    /**
     * <pre>
     *购买守护U钻过低
     * </pre>
     *
     * <code>SC_MALL_BUY_GUARD_DIAMOND_LOW = 12310;</code>
     */
    const SC_MALL_BUY_GUARD_DIAMOND_LOW = 12310;
    /**
     * <pre>
     *主播端不支持Google语音翻译
     * </pre>
     *
     * <code>SC_MALL_TRANSLATE_NOT_SUPPORT = 12311;</code>
     */
    const SC_MALL_TRANSLATE_NOT_SUPPORT = 12311;
    /**
     * <pre>
     *Google语音翻译已关闭
     * </pre>
     *
     * <code>SC_MALL_TRANSLATE_CLOSED = 12312;</code>
     */
    const SC_MALL_TRANSLATE_CLOSED = 12312;
    /**
     * <pre>
     *vip礼物赠送限制
     * </pre>
     *
     * <code>SC_MALL_GIFT_SEND_VIP_LIMIT = 12313;</code>
     */
    const SC_MALL_GIFT_SEND_VIP_LIMIT = 12313;
    /**
     * <pre>
     *直播间不接收此礼物
     * </pre>
     *
     * <code>SC_MALL_GIFT_NOT_ALLOW = 12320;</code>
     */
    const SC_MALL_GIFT_NOT_ALLOW = 12320;
    /**
     * <pre>
     *送礼物，需要先充值
     * </pre>
     *
     * <code>SC_MALL_GIFT_NEED_RECHARGE = 12321;</code>
     */
    const SC_MALL_GIFT_NEED_RECHARGE = 12321;
    /**
     * <pre>
     *已经是好友
     * </pre>
     *
     * <code>SC_CONTACT_ALREADY_FRIEND = 16385;</code>
     */
    const SC_CONTACT_ALREADY_FRIEND = 16385;
    /**
     * <pre>
     *直播房间不存在
     * </pre>
     *
     * <code>SC_LIVE_ROOM_NOT_EXIST = 20481;</code>
     */
    const SC_LIVE_ROOM_NOT_EXIST = 20481;
    /**
     * <pre>
     *直播房间已关闭
     * </pre>
     *
     * <code>SC_LIVE_ROOM_DISABLED = 20482;</code>
     */
    const SC_LIVE_ROOM_DISABLED = 20482;
    /**
     * <pre>
     *用户无创建直播房间权限
     * </pre>
     *
     * <code>SC_LIVE_ROOM_NO_PERMISSION = 20483;</code>
     */
    const SC_LIVE_ROOM_NO_PERMISSION = 20483;
    /**
     * <pre>
     *用户等级不够，无法创建直播房间
     * </pre>
     *
     * <code>SC_LIVE_ROOM_USER_GRADE_NOT_ENOUGH = 20484;</code>
     */
    const SC_LIVE_ROOM_USER_GRADE_NOT_ENOUGH = 20484;
    /**
     * <pre>
     *特殊时期，非白名单用户，无法创建直播房间
     * </pre>
     *
     * <code>SC_LIVE_ROOM_SPECIAL_NOT_CREATE = 20485;</code>
     */
    const SC_LIVE_ROOM_SPECIAL_NOT_CREATE = 20485;
    /**
     * <pre>
     *直播房间禁言失败(超级管理员)
     * </pre>
     *
     * <code>SC_LIVE_ROOM_ADMIN_SHUTUP_FAIL = 20486;</code>
     */
    const SC_LIVE_ROOM_ADMIN_SHUTUP_FAIL = 20486;
    /**
     * <pre>
     *直播房间解禁言失败(超级管理员)
     * </pre>
     *
     * <code>SC_LIVE_ROOM_ADMIN_LIFTED_FAIL = 20487;</code>
     */
    const SC_LIVE_ROOM_ADMIN_LIFTED_FAIL = 20487;
    /**
     * <pre>
     *直播房间禁言/解禁用户错误(超级管理员)
     * </pre>
     *
     * <code>SC_LIVE_ROOM_ADMIN_SHUTUP_UIDS_ERROR = 20488;</code>
     */
    const SC_LIVE_ROOM_ADMIN_SHUTUP_UIDS_ERROR = 20488;
    /**
     * <pre>
     *主播没有手机认证
     * </pre>
     *
     * <code>SC_LIVE_ROOM_NO_TEL_AUTH = 20489;</code>
     */
    const SC_LIVE_ROOM_NO_TEL_AUTH = 20489;
    /**
     * <pre>
     *用户被强制T出房间，无权限进入
     * </pre>
     *
     * <code>SC_LIVE_ROOM_FORCED_OUT = 20490;</code>
     */
    const SC_LIVE_ROOM_FORCED_OUT = 20490;
    /**
     * <pre>
     *用户所在地区因政策原因不能观看
     * </pre>
     *
     * <code>SC_LIVE_ROOM_POLICY_DISABLED = 20491;</code>
     */
    const SC_LIVE_ROOM_POLICY_DISABLED = 20491;
    /**
     * <pre>
     *直播房间roomId与uid不匹配
     * </pre>
     *
     * <code>SC_LIVE_ROOM_RID_UID_NOTMATCH = 20492;</code>
     */
    const SC_LIVE_ROOM_RID_UID_NOTMATCH = 20492;
    /**
     * <pre>
     *主播没有实名认证
     * </pre>
     *
     * <code>SC_LIVE_ROOM_NO_REALNAME_AUTH = 20496;</code>
     */
    const SC_LIVE_ROOM_NO_REALNAME_AUTH = 20496;
    /**
     * <pre>
     *观众不在连麦名单中
     * </pre>
     *
     * <code>SC_LIVE_ROOM_NOT_IN_MULTILIVE = 20497;</code>
     */
    const SC_LIVE_ROOM_NOT_IN_MULTILIVE = 20497;
    /**
     * <pre>
     *付费失败
     * </pre>
     *
     * <code>SC_LIVE_ROOM_PAY_FAILED = 20498;</code>
     */
    const SC_LIVE_ROOM_PAY_FAILED = 20498;
    /**
     * <pre>
     *房间不能连麦
     * </pre>
     *
     * <code>SC_LIVE_ROOM_CANNOT_MULTILIVE = 20499;</code>
     */
    const SC_LIVE_ROOM_CANNOT_MULTILIVE = 20499;
    /**
     * <pre>
     *房间连麦人数达到上限
     * </pre>
     *
     * <code>SC_LIVE_ROOM_MULTILIVE_MEMBERS_LIMIT = 20500;</code>
     */
    const SC_LIVE_ROOM_MULTILIVE_MEMBERS_LIMIT = 20500;
    /**
     * <pre>
     *生成连麦房间失败
     * </pre>
     *
     * <code>SC_LIVE_ROOM_MULTILIVE_CREATE_MEETINGROOM_FAILED = 20501;</code>
     */
    const SC_LIVE_ROOM_MULTILIVE_CREATE_MEETINGROOM_FAILED = 20501;
    /**
     * <pre>
     *本次连麦结束
     * </pre>
     *
     * <code>SC_LIVE_ROOM_MULTILIVE_FINISH = 20502;</code>
     */
    const SC_LIVE_ROOM_MULTILIVE_FINISH = 20502;
    /**
     * <pre>
     *领取U钻活动已经结束
     * </pre>
     *
     * <code>SC_ACTIVITY_SEND_DIAMOND_TIME_END = 24577;</code>
     */
    const SC_ACTIVITY_SEND_DIAMOND_TIME_END = 24577;
    /**
     * <pre>
     *钻石已经领取完
     * </pre>
     *
     * <code>SC_ACTIVITY_SEND_DIAMOND_OVER_LIMIT = 24578;</code>
     */
    const SC_ACTIVITY_SEND_DIAMOND_OVER_LIMIT = 24578;
    /**
     * <pre>
     *已经领过钻石啦
     * </pre>
     *
     * <code>SC_ACTIVITY_SEND_DIAMOND_ALREADY = 24579;</code>
     */
    const SC_ACTIVITY_SEND_DIAMOND_ALREADY = 24579;
    /**
     * <pre>
     *未充值
     * </pre>
     *
     * <code>SC_ACTIVITY_NO_RECHARGE = 24580;</code>
     */
    const SC_ACTIVITY_NO_RECHARGE = 24580;
    /**
     * <pre>
     *不符合活动条件
     * </pre>
     *
     * <code>SC_ACTIVITY_NOT_CONDITIONS = 24581;</code>
     */
    const SC_ACTIVITY_NOT_CONDITIONS = 24581;
    /**
     * <pre>
     *系统异常
     * </pre>
     *
     * <code>SC_SYSTEM_ERROR = 16777215;</code>
     */
    const SC_SYSTEM_ERROR = 16777215;
    /**
     * <pre>
     *芝麻信用认证绑定成功
     * </pre>
     *
     * <code>SC_ZMXY_AUTH_BIND_SUCCESS = 28673;</code>
     */
    const SC_ZMXY_AUTH_BIND_SUCCESS = 28673;
    /**
     * <pre>
     *芝麻信用认证 输入的信息已经被用过
     * </pre>
     *
     * <code>SC_ZMXY_AUTH_HAS_BEEN_USEED = 28674;</code>
     */
    const SC_ZMXY_AUTH_HAS_BEEN_USEED = 28674;
    /**
     * <pre>
     *用户已经实名认证
     * </pre>
     *
     * <code>SC_ZMXY_AUTH_HAS_BIND = 28675;</code>
     */
    const SC_ZMXY_AUTH_HAS_BIND = 28675;
    /**
     * <pre>
     *芝麻认证失败
     * </pre>
     *
     * <code>SC_ZMXY_AUTH_ERROR = 28676;</code>
     */
    const SC_ZMXY_AUTH_ERROR = 28676;
    /**
     * <pre>
     *红包过期
     * </pre>
     *
     * <code>SC_REDPACKET_OVERDUE_ERROR = 32769;</code>
     */
    const SC_REDPACKET_OVERDUE_ERROR = 32769;
    /**
     * <pre>
     *红包发完
     * </pre>
     *
     * <code>SC_REDPACKET_DISTRIBUTED_ERROR = 32770;</code>
     */
    const SC_REDPACKET_DISTRIBUTED_ERROR = 32770;
    /**
     * <pre>
     *重复抢红包
     * </pre>
     *
     * <code>SC_REDPACKET_REPEAT_ERROR = 32771;</code>
     */
    const SC_REDPACKET_REPEAT_ERROR = 32771;
    /**
     * <pre>
     *不拥有该权限
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_NOT_ALLOW = 36865;</code>
     */
    const SC_PERMISSIONUSE_NOT_ALLOW = 36865;
    /**
     * <pre>
     *权限等级不足
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_LOW_PERMISSION = 36866;</code>
     */
    const SC_PERMISSIONUSE_LOW_PERMISSION = 36866;
    /**
     * <pre>
     *超过“每天每个房间权限的限制次数”
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_OVER_ROOMMAX = 36867;</code>
     */
    const SC_PERMISSIONUSE_OVER_ROOMMAX = 36867;
    /**
     * <pre>
     *超过“每天累计使用权限的限制次数”
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_OVER_DAYMAX = 36868;</code>
     */
    const SC_PERMISSIONUSE_OVER_DAYMAX = 36868;
    /**
     * <pre>
     *增加标签，检查超过数量限制：
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_OVER_ADD_LIMIT = 36869;</code>
     */
    const SC_PERMISSIONUSE_OVER_ADD_LIMIT = 36869;
    /**
     * <pre>
     *特权执行失败：
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_ERROR = 36870;</code>
     */
    const SC_PERMISSIONUSE_ERROR = 36870;
    /**
     * <pre>
     *特权执行重复：
     * </pre>
     *
     * <code>SC_PERMISSIONUSE_REPEAT_ERROR = 36871;</code>
     */
    const SC_PERMISSIONUSE_REPEAT_ERROR = 36871;
    /**
     * <pre>
     *重复兑换
     * </pre>
     *
     * <code>SC_ACTIVITY_EXCHANGE_REPEATED = 65537;</code>
     */
    const SC_ACTIVITY_EXCHANGE_REPEATED = 65537;
    /**
     * <pre>
     *活动积分不足
     * </pre>
     *
     * <code>SC_ACTIVITY_POINT_NOT_ENOUGH = 65538;</code>
     */
    const SC_ACTIVITY_POINT_NOT_ENOUGH = 65538;
    /**
     * <pre>
     *交易号重复
     * </pre>
     *
     * <code>SC_PACK_TRANSACTION_REPEATED = 69633;</code>
     */
    const SC_PACK_TRANSACTION_REPEATED = 69633;
    /**
     * <pre>
     *背包礼物不存在
     * </pre>
     *
     * <code>SC_PACK_GIFT_NOT_AVAILABLE = 69634;</code>
     */
    const SC_PACK_GIFT_NOT_AVAILABLE = 69634;
    /**
     * <pre>
     *背包格子已过期
     * </pre>
     *
     * <code>SC_PACK_GIFT_EXPIRE = 69635;</code>
     */
    const SC_PACK_GIFT_EXPIRE = 69635;
    /**
     * <pre>
     *交易号不存在
     * </pre>
     *
     * <code>SC_PACK_TRANSACTION_NOT_EXIST = 69636;</code>
     */
    const SC_PACK_TRANSACTION_NOT_EXIST = 69636;
    /**
     * <pre>
     *背包无空间
     * </pre>
     *
     * <code>SC_PACK_FULL = 69637;</code>
     */
    const SC_PACK_FULL = 69637;
    /**
     * <pre>
     *动态评论限制
     * </pre>
     *
     * <code>SC_DYNAMIC_COMMENT_FREQUENCY_LIMITED = 73729;</code>
     */
    const SC_DYNAMIC_COMMENT_FREQUENCY_LIMITED = 73729;
    /**
     * <pre>
     *动态评论字数限制
     * </pre>
     *
     * <code>SC_DYNAMIC_COMMENT_WORDS_OVER_LONG = 73730;</code>
     */
    const SC_DYNAMIC_COMMENT_WORDS_OVER_LONG = 73730;
    /**
     * <pre>
     *动态被删除或不存在
     * </pre>
     *
     * <code>SC_DYNAMIC_NOT_EXIST_OR_DELETED = 73731;</code>
     */
    const SC_DYNAMIC_NOT_EXIST_OR_DELETED = 73731;
    /**
     * <pre>
     *没有权限
     * </pre>
     *
     * <code>SC_DYNAMIC_HAS_NO_RIGHT = 73732;</code>
     */
    const SC_DYNAMIC_HAS_NO_RIGHT = 73732;
    /**
     * <pre>
     *今日已签到
     * </pre>
     *
     * <code>SC_CHECKIN_ALREADY = 77825;</code>
     */
    const SC_CHECKIN_ALREADY = 77825;
}

