<?php
namespace app\index\controller;
use app\common\lib\ali\Sms;
use app\common\lib\Util;
use app\common\lib\Redis;
class Send
{
    public function index()
    {
        //$phoneNum = request()->get('phone_num',0,'intval');
        $phoneNum = intval($_GET['phone_num']);
        if(empty($phoneNum)){
            return Util::show(config('code.error'),'error');
        }
        $code = rand(1000,9999);

        $taskData = [
            'method'  => 'sendSms',
            'data'    => [
                'phone'   => $phoneNum,
                'code'    => $code,
            ],

        ];

        $_POST['http_server']->task($taskData);
        return Util::show(config('code.success'),'ok');


        /*if($response->Code == "OK") {
            $redis = new \Swoole\Coroutine\Redis();
            $redis->connect(config('redis.host'),config('redis.port'));
            $redis->set(Redis::smsKey($phoneNum),$code,config('redis.out_time'));
            //这里使用异步redis更好
            return Util::show(config('code.success','success'));
        }else{

            return Util::show(config('code.error','验证码发送失败'));
        }

        */
    }
}
