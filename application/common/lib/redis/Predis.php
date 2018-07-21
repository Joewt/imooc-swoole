<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 22/06/2018
 * Time: 11:18 AM
 */
namespace app\common\lib\redis;

class Predis
{
    public $redis = "";
    /**
     * 定义单例模式的变量
     * @var null
     */
    private static $_instance = null;


    public static function getInstance()
    {
        if(empty(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->redis = new \Redis();
        $result = $this->redis->connect(config('redis.host'),config('redis.port'),config('redis.timeOut'));
        if($result === false){
            throw new \Exception('redis connect error');
        }
    }

    /**
     * redis set操作
     * @param $key
     * @param $value
     * @param int $time
     * @return bool|string
     */
    public function set($key, $value, $time = 0)
    {
        if(!$key){
            return '';
        }
        if(is_array($value)){
            $value = json_encode($value);
        }
        if(!$time){
            return $this->redis->set($key, $value);
        }
        return $this->redis->setex($key, $time, $value);
    }

    /**
     * redis get操作
     * @param $key
     * @return bool|string
     */
    public function get($key)
    {
        if(!$key){
            return '';
        }
        return $this->redis->get($key);
    }
}