<?php
//创建一个自定义的异常类
class Action extends Smarty{
	protected $params=array();//这个参数接收url中的参数在调用之前已经被传值
	function __construct(){
		//定义模板目录
		$tpldir=APP_ROOT.'/tpl/'.App::getObject('Router')->getController().'/';
		if(!is_dir($tpldir))$tpldir=APP_ROOT.'/tpl/index/';
		$this->template_dir = $tpldir;
		$this->compile_dir = FRAME_ROOT.'/RunTime/templates_c/';
		$this->config_dir = FRAME_ROOT.'/RunTime/configs/';
		$this->cache_dir = FRAME_ROOT.'/RunTime/cache/';
		$this->left_delimiter = '<{';
		$this->right_delimiter = '}>';
		$this->compile_check=false;
		$this->caching = getObjByReg('config')->app_conf['tpl']['caching']; //开启缓存 0、FALSE代表关闭|非0数字、TRUE代表开启
		$this->cache_lifetime = getObjByReg('config')->app_conf['tpl']['cache_lifetime']; //单位为秒(如果填写-1为永不过期)
		//清除smarty的缓存，为啦及时更新
		if(getObjByReg('config')->app_conf['tpl']['clear_cache'])delcache();
		  //把url中的参数传给控制器的父类，以共子类调用
		$this->params=App::getObject('Router')->getparams();
		$this->initTpl();
		}
function setParams($param){
	$this->params=$param;
	}
private function initTpl(){
	$this->assign('page',getObjByReg('config')->Lang['page']);//初始化网页共用数据	
	$this->assign('tpl_root',TPL_ROOT);
	}
public function show($tpl=''){
	$con_ac=explode('/',$tpl);
	//别的模块模板的判断
	if(count($con_ac)==2){
	//定义模板目录
	$this->template_dir =APP_ROOT.'/tpl/'.$con_ac[0].'/';
	$tpl=$con_ac[1].Config::$app_conf['tpl']['ex'];
		}elseif(count($con_ac)==1 && $tpl!=''){
		$tpl=$tpl.Config::$app_conf['tpl']['ex'];
		}else{
	//取当前的控制器，和操作
	$obj=app::getObject('Router');
	//$controler=$obj->getController();
	//取当前模块操作
	$tpl=$obj->getAction().getObjByReg('config')->app_conf['tpl']['ex'];		
			}
	/*switch(count($con_ac)){
		case 2:
		break;
		case 1:
		break;
		default:
		}*/
	//echo $this->template_dir;
	//echo $tpl;
	parent::display($tpl);
	}
	}



?>