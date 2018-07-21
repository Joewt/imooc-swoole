<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 22/06/2018
 * Time: 8:42 AM
 */

namespace app\common\lib;

class Redis
{
    /**
     * 验证码 redis key 前缀
     * @var string
     */
    public static $pre = "sms_";

    /**
     * 用户user 前缀
     * @var string
     */
    public static $userpre = "user_";

    /**
     * 存储验证码 redis key
     * @param $phone
     * @return string
     */
    public static function smsKey($phone)
    {
        return self::$pre.$phone;
    }

    /**
     * 用户key
     * @param $phone
     * @return string
     */
    public static function userkey($phone)
    {
        return self::$userpre.$phone;
    }
}