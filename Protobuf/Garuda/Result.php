<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: ResultResponse.proto

namespace Protobuf\Garuda;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Protobuf type <code>protobuf.Garuda.Result</code>
 */
class Result extends \Google\Protobuf\Internal\Message
{
    /**
     * <code>.protobuf.Garuda.Code code = 1;</code>
     */
    private $code = 0;
    /**
     * <code>string msg = 2;</code>
     */
    private $msg = '';
    /**
     * <code>.protobuf.Garuda.Any data = 3;</code>
     */
    private $data = null;

    public function __construct() {
        \GPBMetadata\ResultResponse::initOnce();
        parent::__construct();
    }

    /**
     * <code>.protobuf.Garuda.Code code = 1;</code>
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * <code>.protobuf.Garuda.Code code = 1;</code>
     */
    public function setCode($var)
    {
        GPBUtil::checkEnum($var, \Protobuf\Garuda\Code::class);
        $this->code = $var;
    }

    /**
     * <code>string msg = 2;</code>
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * <code>string msg = 2;</code>
     */
    public function setMsg($var)
    {
        GPBUtil::checkString($var, True);
        $this->msg = $var;
    }

    /**
     * <code>.protobuf.Garuda.Any data = 3;</code>
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * <code>.protobuf.Garuda.Any data = 3;</code>
     */
    public function setData(&$var)
    {
        GPBUtil::checkMessage($var, \Protobuf\Garuda\Any::class);
        $this->data = $var;
    }

}

