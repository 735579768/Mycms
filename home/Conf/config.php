<?php
/*
*在这里写你的项目配置*
这个数组将被加载到config这个类的静态成员app_conf中
*/
return array(
//加载自定义的函数库
    'autoload_path' =>array(
							APP_ROOT.'/Common',
							APP_ROOT.'/Lang'
							),//自定义自动加载目录
	//模板引擎设置
	'tpl'=>array(
			'ex'=>'.html',
			'caching'=>true,
			'clear_cache'=>true,//在开发的时候打开，可以及时更新
			'cache_lifetime'=>1 //单位为秒(如果填写-1为永不过
	),
	'output_encode'=>false,
	'taglib_begin'=>'<{',
	'taglib_end'=>'}>',
	// 添加数据库配置信息
	'db_type'   => 'access', // 数据库类型
	'db_host'   => 'localhost', // 服务器地址
	'db_name'   => APP_ROOT.'/conf/db.mdb', // 数据库名
	'db_user'   => 'root', // 用户名
	'db_pwd'    => '', // 密码
	'db_port'   => 3306, // 端口
	'db_prefix' => 'uu_', // 数据库表前
	//'db_dsn' => 'mysql://root@localhost:3306/thinkphp'

);
?>