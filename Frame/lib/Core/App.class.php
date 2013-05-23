<?php
class App
{
private static $instance;
private static $App_objects = array();//保存注册器中注册的对象
	/**
	*@param $reg 注册器
	**/
    private function __construct($reg) 
    {
		self::$App_objects=$reg->get_objs_arr();//保存注册器中已经注册的对象
		$this->dispatch(self::$App_objects['router']);//调用对应的控制器类
	}
	/**
	*@param $reg 注册器
	**/
  public static function getinstance($reg) 
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c($reg);
        }
        return self::$instance;
    }
	/**
	*功能：根据路由去调用指定的控制器
	*@param @router 已经注册过的路由类
	*/
  public  function dispatch($router)
  {
    //global $app;
    ob_start();
    $start = microtime(true);//处理计时
    $controller ="Action".$router->getController();//在控制器前面加个前缀，从路由对象中取控制器类
    $action =$router->getAction();//从路由对象中取操作
    $params = $router->getParams();//从路由对象中取参数，注意其中是以key=>value形式提共的
      $app = new $controller();//实例化控制器
	  if(method_exists($controller,$action)){//检查控制器对应的方法是否存在
      $app->$action();
	  }else{
		  if(getObjByReg('config')->config['frame']['debug']){
		  	 Myexception::appError("控制器:'$controller'不存在'$action'这个操作");
		  }else{
			  $app->index();
			  }
		
		  }
		 getObjByReg('timer')->stop(); 
		 Myexception::appError("程序运行时间:".getObjByReg('timer')->spent()); 
      if(isset($start)) throw new MyException("模板处理时间:".(microtime(true)-$start)."秒");
      $output = ob_get_clean();
      echo $output;
   }
  //取app类中已经注册的组件
  public static function getObject($objname){
	  return self::$App_objects[strtolower($objname)];
	  }
     // 阻止用户复制对象实例
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
?>