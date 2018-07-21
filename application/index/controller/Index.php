<?php
namespace app\index\controller;
use app\common\lib\ali\Sms;
class Index
{
    public function index()
    {
        return "";
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name."\n";
    }

    public function sms()
    {
        $phone = '15074150968';
        $code  = '1234';
        try{
            Sms::sendSms($phone,$code);
        }catch (\Exception $e){
            print_r("error");
        }
        return "ok";
    }
}
