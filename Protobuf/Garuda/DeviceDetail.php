<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: IMServerActivity.proto

namespace Protobuf\Garuda;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 *设备详情
 * </pre>
 *
 * Protobuf type <code>protobuf.Garuda.DeviceDetail</code>
 */
class DeviceDetail extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     *操作系统
     * </pre>
     *
     * <code>string os = 1;</code>
     */
    private $os = '';
    /**
     * <pre>
     *设备品牌
     * </pre>
     *
     * <code>string brand = 2;</code>
     */
    private $brand = '';
    /**
     * <pre>
     *设备型号
     * </pre>
     *
     * <code>string model = 3;</code>
     */
    private $model = '';

    public function __construct() {
        \GPBMetadata\IMServerActivity::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     *操作系统
     * </pre>
     *
     * <code>string os = 1;</code>
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * <pre>
     *操作系统
     * </pre>
     *
     * <code>string os = 1;</code>
     */
    public function setOs($var)
    {
        GPBUtil::checkString($var, True);
        $this->os = $var;
    }

    /**
     * <pre>
     *设备品牌
     * </pre>
     *
     * <code>string brand = 2;</code>
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * <pre>
     *设备品牌
     * </pre>
     *
     * <code>string brand = 2;</code>
     */
    public function setBrand($var)
    {
        GPBUtil::checkString($var, True);
        $this->brand = $var;
    }

    /**
     * <pre>
     *设备型号
     * </pre>
     *
     * <code>string model = 3;</code>
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * <pre>
     *设备型号
     * </pre>
     *
     * <code>string model = 3;</code>
     */
    public function setModel($var)
    {
        GPBUtil::checkString($var, True);
        $this->model = $var;
    }

}

