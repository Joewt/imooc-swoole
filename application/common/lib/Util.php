<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 21/06/2018
 * Time: 11:52 PM
 */
namespace app\common\lib;

class Util
{

    /**
     * API 输出格式
     * @param $status
     * @param string $message
     * @param array $data
     */
    public static function show($status, $message='',$data=[])
    {
        $result = [
            'status'    =>  $status,
            'message'   =>  $message,
            'data'      =>  $data
        ];
        echo json_encode($result);
    }
}