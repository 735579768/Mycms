<?php
//创建一个自定义的异常类
class Config{
	public  $config=array();//这个参数接收url中的参数在调用之前已经被传值
	public  $frame_conf;//框架中的配置
	public  $app_conf;//项目中的配置
	public  $Lang;//语言文件
    // 保存类实例在此属性中
private static $instance;
       // 构造方法声明为private，防止直接创建对象
private function	__construct(){
		$this->init();

		//去初始化配置
		
		}
    // singleton 方法
public static function getinstance() 
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }
    // 阻止用户复制对象实例
public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
public function init(){
	if(!file_exists(APP_ROOT)) $this->create();		
		$this->app_conf=include(APP_ROOT.'/conf/config.php');
		$this->frame_conf=include(FRAME_ROOT.'/conf/config.php');
		$this->Lang=include(APP_ROOT.'/Lang/zh-cn.php');
		$this->config['frame']=$this->frame_conf;
		$this->config['app']=$this->app_conf;
			$filepatharr=array();
			//把框架和项目要自动加载的目录整合
			$autodir=array_merge($this->frame_conf['autoload_path'],$this->app_conf['autoload_path']);
			//取要自动加载的目录，并遍历出里面的文件
			foreach($autodir as $path){
				$filepatharr=array_merge($filepatharr,getalldirfiles($path));
				}
			//包含需要的文件
			foreach($filepatharr as $a){
				include_once $a;
				}
			
	}
private function create(){
				createDir(APP_ROOT);
				createDir(APP_ROOT.'/Conf');
				createDir(APP_ROOT.'/Common');
				createDir(APP_ROOT.'/Lang');
				createDir(APP_ROOT.'/lib/control');
				createDir(APP_ROOT.'/lib/model');
				createDir(APP_ROOT.'/tpl');	
				createDir(APP_ROOT.'/tpl/index');
				createDir(APP_ROOT.'/tpl/public');	
				$app_lang=include(FRAME_ROOT.'/lang/app-cn.php');
				writeFile($app_lang['applang'],APP_ROOT.'/Lang/zh-cn.php');
				writeFile($app_lang['ActionIndex'],APP_ROOT.'/lib/control/Action.Index.class.php');
				writeFile($app_lang['tpl_test'],APP_ROOT.'/tpl/index/index.html');
				writeFile($app_lang['app_descr'],APP_ROOT.'/readme.txt');
				writeFile($app_lang['app_conf'],APP_ROOT.'/conf/config.php');
				writeFile($app_lang['common_function'],APP_ROOT.'/Common/Function.php');
	
	}
	}
?>