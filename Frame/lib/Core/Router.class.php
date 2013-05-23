<?php
/*
*url路由器类
*从url中取出控制器和操作，并把参数整理成一个数组放到，Action总控制器中
*/
class Router
{
  private $route;
  private $controller;
  private $action;
  private $params;
    // 保存类实例在此属性中
    private static $instance;
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
  private function __construct()
  {
    $path = array_keys($_GET);
    if (!isset($path[0])){//如果从url中没有控制器参数，则设置一个默认的参数
			//判断项目中是否有默认的控制器Action.index.class.php
			if(class_exists('ActionIndex')){
				$path[0]="Index/index";//这个是项目中默认的控制器
				}else{
			   $path[0] = "base/index";//默认调用框架中的控制器base和它的方法index
					}
        
    }
    $route= $path[0];
	$route=(substr($route,0,1)=='/')?substr($route,1):$route;
	$a=strlen($route);
	$route=((substr($route,$a-1))=='/')?substr($route,0,$a-1):$route;
	$this->route = $route;
    $routeParts = explode( "/",$route);//分离控制器和方法
    $this->controller=$routeParts[0];//取url中的控制器
    $this->action=isset($routeParts[1])? $routeParts[1]:"index";//取url中的操作方法，如果没有就用默认方法index
    array_shift($routeParts);//从数组中弹出控制器和方法
    array_shift($routeParts);
	$tem=array();
	for($i=0;$i<count($routeParts);$i++){//把url中get传过来的参数整合成一个数组
	$tem[$routeParts[$i]]=$routeParts[++$i];
	}
	//下面把post过来的数据也取出来
	foreach($_REQUEST as $key=>$value){
		if(!in_array($key,$tem)){
		$tem[$key]=$value;
		}
		}
    $this->params=$tem;

  }
  public function getAction() {
    if (empty($this->action)) $this->action="index";//如果操作方法是空就设为index
    return $this->action;
  }
  public function getController()  {
    return $this->controller;
  }
  public function getParams()  {
    return $this->params;
  }
}
?>