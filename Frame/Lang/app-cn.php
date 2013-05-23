<?php
return array(
	'app_descr'=>"项目根目录，在这里面布局你的网站内容\nCommon,include,lib目录会自动加载处理。\nCommon中建议放公用函数，会自动加载进项目。\nlib目录放用到的各种控制器类，建议每个功能模板用一个类,",
	
	'common_function'=>"<?php\n/*公共基础函数文件\n*/\n?>",
	
	'app_conf'=>"<?php\n/*\n*在这里写你的项目配置*\n这个数组将被加载到config这个类的静态成员app_conf中\n*/\nreturn array(\n//加载自定义的函数库\n    'autoload_path' =>array(\n							APP_ROOT.'/Common',\n							APP_ROOT.'/include'\n							),//自定义自动加载目录\n	//模板引擎设置\n	'tpl'=>array(\n			'ex'=>'.html',\n			'caching'=>true,\n			'clear_cache'=>true,//在开发的时候打开，可以及时更新\n			'cache_lifetime'=>1 //单位为秒(如果填写-1为永不过\n	),\n	\n	'output_encode'=>false,\n	'taglib_begin'=>'<{',\n	'taglib_end'=>'}>',\n	// 添加数据库配置信息\n	'db_type'   => 'access', // 数据库类型\n	'db_host'   => 'localhost', // 服务器地址\n	'db_name'   => APP_ROOT.'/conf/db.mdb', // 数据库名\n	'db_user'   => 'root', // 用户名\n	'db_pwd'    => '', // 密码\n	'db_port'   => 3306, // 端口\n	'db_prefix' => 'uu_', // 数据库表前\n	//'db_dsn' => 'mysql://root@localhost:3306/thinkphp'\n\n);\n?>",
	
	'tpl_test'=>"<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n<html xmlns='http://www.w3.org/1999/xhtml'>\n<head>\n<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n<title>项目首页</title>\n</head>\n<body>\n<div style='font-size:24px;font-weight:bold;'>项目首页创建成功</div>\n</body>\n</html>",
	
	'ActionIndex'=>"<?php\nclass ActionIndex extends Action{\n	public function index(){\n		echo \"<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n<html xmlns='http://www.w3.org/1999/xhtml'>\n<head>\n<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head>\n<body>\n<div style='font-size:24px;font-weight:bold;'>项目\".APP_NAME.\"创建成功！,\n</div>\n</body>\n</html>\";\n		\$a=M('content');\n		\n		//插入数据\n		//\$a->field['name']='test';\n		//\$a->insert();\n		//\$a->insert(\"{'name':'赵克立','six':'男'}\");\n		//\$a->insert(array('name'=>'888','six'=>'男'));\n		\n		\$a->id=1;\n		//查询数据\n		var_dump(\$a->select());\n		\n		//更新数据\n		//\$a->field['name']='赵克立';\n		//\$a->update();\n		//\$a->update(\"{'name':'赵克立','six':'男'}\");\n		//\$a->update(array('name'=>'888','six'=>'男'));\n		//删除数据\n		//\$a->delete();\n	\n		//\$b=new MyPage(\$a->rs_arr,1,1);\n		//var_dump(\$b->cur_pagedata());\n		//var_dump(\$b->getmypageinfo());\n		//调用本操作的默认首页\n		//var_dump(\$this);\n		\$this->show();\n		//去调用广告模块的首页\n		//\$this->show('ad/index');\n		//去调用广告模块增加模板\n		//this->show('ad/add');\n		}\n	}\n\n?>",
	
	'applang'=>"<?php\n/*\n*项目的语言文件\n*\n*/\nreturn array(\n	'page'=>array(\n		'title'=>'框架测试成功',\n	),\n);\n?>",
);
?>