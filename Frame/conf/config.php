<?php
/*
*在这里写你的项目配置*
这个数组将被加载到config这个类的静态成员frame_conf中
*/
return array(
	'gzip'=>true,
	//自定义自动加载目录
    'autoload_path' =>array(
							FRAME_ROOT."\Extends"
							),
	//自动加载类目录
	'auto_dir'=>array(
		0=>FRAME_ROOT.'/lib/Core/',
		1=>FRAME_ROOT.'/lib/control/',
		2=>FRAME_ROOT.'/lib/Model/',
		4=>APP_ROOT.'/lib/control/',
		5=>APP_ROOT.'/lib/Model/',	
		6=>FRAME_ROOT.'/Extends/',		
	),
	//加载类的规则
	'cls_gz'=>array(
		0=>'classname.php',
		1=>'classname.class.php',
		2=>'Action.classname.class.php',
		3=>'classname.Action.class.php',
		4=>'classname.Model.class.php',
		5=>'Model.classname.class.php'
		),
	'debug'=>true
	

);
?>