<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 22/06/2018
 * Time: 4:34 PM
 */



class Http
{
    const HOST = "0.0.0.0";
    const PORT = 9504;
    public $http = null;

    public function __construct()
    {
        $this->http = new swoole_http_server(self::HOST,self::PORT);
        $this->http->set([
            'enable_static_handler' => true,
            'document_root'         => "/Users/joe/Documents/study/php/swoole/thinkphp/public/static/live",
            'worker_num'            => 5,
            'task_worker_num'       => 5,
        ]);
        $this->http->on("workerstart",[$this,'onWorkerStart']);
        $this->http->on("request",[$this,'onRequest']);
        $this->http->on("task",[$this,'onTask']);
        $this->http->on("finish",[$this,'onFinish']);
        $this->http->on('close',[$this,'onClose']);
        $this->http->start();
    }

    /**
     * workerstart回调
     * @param $server
     * @param $worker_id
     */
    public function onWorkerStart($server,$worker_id)
    {
        define('APP_PATH', __DIR__ . '/../application/');
        require __DIR__ . '/../thinkphp/start.php';
    }

    /**
     * request回调
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response)
    {
        $_SERVER = [];
        if(isset($request->server)){
            foreach($request->server as $k => $v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        if(isset($request->server)){
            foreach($request->server as $k => $v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        $_GET = [];
        if(isset($request->get)){
            foreach ($request->get as $k => $v){
                $_GET[$k] = $v;
            }
        }

        $_POST = [];
        if(isset($request->post)){
            foreach ($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }
        //传递http server
        $_POST['http_server'] = $this->http;
        ob_start();
        try {
            think\Container::get('app', [defined('APP_PATH') ? APP_PATH : ''])
                ->run()
                ->send();
        }catch(\Exception $e){
            print_r($e);
        }

        $res = ob_get_contents();
        ob_end_clean();
        $response->end($res);
    }

    public function onTask($serv,$taskId,$workerId,$data)
    {

        $obj = new app\common\lib\task\Task;

        $method = $data['method'];
        $flag = $obj->$method($data['data']);

        return $flag;

    }

    public function onFinish()
    {

    }

    public function onClose()
    {

    }

}

new Http();