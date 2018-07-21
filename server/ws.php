<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 22/06/2018
 * Time: 4:34 PM
 */

class Ws
{
    const HOST = "0.0.0.0";
    const PORT = 9503;
    public $ws = null;

    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);
        $this->ws->set([
            'enable_static_handler' => true,
            'document_root'         => "/Users/joe/Documents/study/php/swoole/thinkphp/public/static/",
            'worker_num'            => 5,
            'task_worker_num'       => 5,
        ]);
        $this->ws->on("open",[$this,'onOpen']);
        $this->ws->on("message",[$this,'onMessage']);
        $this->ws->on("workerstart",[$this,'onWorkerStart']);
        $this->ws->on("request",[$this,'onRequest']);
        $this->ws->on("task",[$this,'onTask']);
        $this->ws->on("finish",[$this,'onFinish']);
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
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

        $_FILES = [];
        if(isset($request->files)){
            foreach ($request->files as $k => $v){
                $_GET[$k] = $v;
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

        $_POST['ws_server'] = $this->ws;
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

    public function onOpen()
    {

    }

    public function onMessage()
    {

    }

    public function onFinish()
    {

    }

    public function onClose()
    {

    }

}

new Ws();