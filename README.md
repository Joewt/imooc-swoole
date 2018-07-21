## 慕课网Swoole入门到实战

> 高性能直播赛事平台  

### 框架

框架: ThinkPHP5.1  
网络通信引擎: Swoole  

### 安装  

composer 安装ThinkPHP5.1

```
composer create-project topthink/think  tp5  --prefer-dist

```

Swoole 安装  
[Swoole简易安装教程](https://joewt.com/2018/04/13/swoole-install/)  


### 运行

打开server下的http.php,需要更改静态文件根目录为自己的目录,然后运行如下命令

```
$ php http.php
```



项目目录(精简)

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─module_name        模块目录
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  │
│  ├─command.php        命令行定义文件
│  ├─common.php         公共函数文件
│  └─tags.php           应用行为扩展定义文件
│
├─config                应用配置目录
│  ├─app.php            应用配置
│  ├─code.php           返回的错误吗
│  ├─database.php       数据库配置
│  ├─redis.php          Redis配置
│  ├─session.php        Session配置
│  ├─template.php       模板引擎配置
│  └─trace.php          Trace配置
│
├─route                 路由定义目录
│  ├─route.php          路由定义
│  └─...                更多
│
├─public                WEB目录（对外访问目录）
|  ├─static             前端目录
│  ├─index.php          入口文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─composer.json         composer 定义文件
├─think                 命令行入口文件
~~~


### 进度

登录模块  
* [使TP5完美支持Swoole](https://joewt.com/2018/06/20/thinkphpMeetsSwoole/)
* 短信验证(Swoole task任务)
* 登录实现

赛事直播
