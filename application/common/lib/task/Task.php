<?php
/**
 * task 异步任务
 * Created by PhpStorm.
 * User: joe
 * Date: 22/06/2018
 * Time: 6:46 PM
 */

namespace app\common\lib\task;
use app\common\lib\ali\Sms;
use app\common\lib\redis\Predis;
use app\common\lib\Redis;

class Task
{

    /**
     * 验证码 异步发送
     * @param $data
     */
    public function sendSms($data)
    {
        try{
            $response = Sms::sendSms($data['phone'],$data['code']);
        }catch(\Exception $e){
            return false;
        }

        if($response->code == "OK"){
            Predis::getInstance()->set(Redis::smsKey($data['phone']),$data['code'],config('redis.out_time'));
        }else{
            return false;
        }

        return true;
    }
}