<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: IMConstant.proto

namespace Protobuf\Garuda;

/**
 * <pre>
 *结果码
 * </pre>
 *
 * Protobuf enum <code>protobuf.Garuda.ResultCode</code>
 */
class ResultCode
{
    /**
     * <pre>
     *默认，成功
     * </pre>
     *
     * <code>SUCCESS = 0;</code>
     */
    const SUCCESS = 0;
    /**
     * <pre>
     * 报文验证错误
     * </pre>
     *
     * <code>ERROR_MSG = 1;</code>
     */
    const ERROR_MSG = 1;
    /**
     * <pre>
     *其他错误
     * </pre>
     *
     * <code>ERROR_OTHERS = 2;</code>
     */
    const ERROR_OTHERS = 2;
    /**
     * <pre>
     * 缺失参数
     * </pre>
     *
     * <code>ERROR_LOSE_PARAMETER = 3;</code>
     */
    const ERROR_LOSE_PARAMETER = 3;
    /**
     * <pre>
     * 用户token失效
     * </pre>
     *
     * <code>USER_TOKEN_INVALID = 4;</code>
     */
    const USER_TOKEN_INVALID = 4;
    /**
     * <pre>
     * 用户不存在
     * </pre>
     *
     * <code>FAIL_USER_NOT_EXIST = 5;</code>
     */
    const FAIL_USER_NOT_EXIST = 5;
    /**
     * <pre>
     * 认证token失效
     * </pre>
     *
     * <code>AUTH_TOKEN_INVALID = 6;</code>
     */
    const AUTH_TOKEN_INVALID = 6;
    /**
     * <pre>
     *m1错误
     * </pre>
     *
     * <code>ERROR_M1 = 7;</code>
     */
    const ERROR_M1 = 7;
}
