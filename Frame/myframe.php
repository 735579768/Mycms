<?php
error_reporting(E_ALL);
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');//初始化北京时间
ob_start('ob_gzhandler');//开启gzip压缩


define ('CUR_PATH','http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');
define ('FRAME_ROOT',str_replace('\\','/',dirname(__FILE__)));//框架根目录
define('APP_NAME','home');//项目根目录名称
define('APP_ROOT',str_replace('\\','/',dirname(dirname(__FILE__)).'\\'.APP_NAME));
define('SITE_ROOT',dirname(dirname(__FILE__)));
define('TPL_ROOT',CUR_PATH.APP_NAME.'/tpl/public/');


//加载框架目录common  公用函数库
$pathname=FRAME_ROOT."\Common";
$filename=glob($pathname."\\"."*");
foreach($filename as $fn){if(!is_dir($fn)){include_once $fn;}}

//加载自动加载类
include FRAME_ROOT.'/lib/Core/loader.class.php';
$frame_conf=include FRAME_ROOT.'/conf/config.php';
loader::$auto_dirs=$frame_conf['auto_dir'];//设置自动加载目录
spl_autoload_register(array('loader','auto_load_class'));//设置自动加载class的目录



//返回一个注册器实例
$reg=Registry::getinstance();
//加入注册器中
$reg->regObjArr(array(
					Timer::getinstance(),//程序计时器开始计时
					Config::getinstance(),//加载系统配置类
					Router::getinstance(),//加载路由类
					));
//实例化一个应用程序类 传入参数为一个注册器


try{
	$app=App::getinstance($reg);
}catch(MyException $e){	
$e->getErrorMsg();
//不处理异常，继续抛出
//throw new Myexception();
}

?>