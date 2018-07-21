<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\common\lib\redis\Predis;
use app\common\lib\Redis;
use app\common\lib\Util;
use think\facade\Session;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $phoneNum = intval($_GET['phone_num']);
        $code     = intval($_GET['code']);
        if(empty($phoneNum)||empty($code)){
            return Util::show(config('code.error'),"phone or code is error");
        }

        $redisCode = Predis::getInstance()->get(Redis::smsKey($phoneNum));

        if($redisCode == $code){
            $data = [
                'user'    =>  $phoneNum,
                'srckey'  =>  md5(Redis::userkey($phoneNum)),
                'time'    =>  time(),
                'isLogin' =>  true,
            ];
            Predis::getInstance()->set(Redis::userkey($phoneNum),$data);
            Session::set("user",$data);
            return Util::show(config('code.success'),'ok',$data);
        }else{
            return Util::show(config('code.error'),'error');
        }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
