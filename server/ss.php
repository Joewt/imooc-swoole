<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 22/07/2018
 * Time: 11:04 PM
 */

define('APP_PATH', __DIR__ . '/../application/');
require __DIR__ . '/../thinkphp/start.php';

\app\common\lib\redis\Predis::getInstance()->smembessssr(config('redis.live_redis_key'));