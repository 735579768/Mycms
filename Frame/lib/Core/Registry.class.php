<?php
class Registry
{
	public static $instance;	//保存注册器的唯一实例对象
	private  $_objs = array();//保存已经实例化的对象
    private function __construct() 
    {
	}
	/**
	*功能：用这个函数实例化注册器的唯一实例
	*/
  public static function getinstance() 
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }
	/**
	*功能：向注册器里添加组件
	*@param $obj 要注册的对象或对象名字 可以自动识别
	*返回值：注册的对象
	*/
  public  function regObj($obj){
	  $keyname='';
	  if(is_object($obj)){
		   $keyname=get_class($obj);
	  }else{
		  $keyname=$obj;
		  }
    $keyname=strtolower($keyname);
	if (!isset($this->_objs[$keyname])){
			if(is_object($obj)){
				$this->_objs[$keyname]=$obj;
			}else{
		   	    $this->_objs[$keyname]= new $keyname();		
				}
  	  }
    return $this->_objs[$keyname];
   }
   /**
   *功能：批量注册组件
   *@param $objarr要注册的对象或名字数组 可以自动识别
   *返回值：return true
   */
   public function regObjArr($objarr){
	   $keyname='';
	   foreach($objarr as $obj){
				  if(is_object($obj)){
					   $keyname=get_class($obj);
				  }else{
					  $keyname=$obj;
					  }
				$keyname=strtolower($keyname);
				//如果对象没有注册
				if (!isset($this->_objs[$keyname])){
						if(is_object($obj)){
							$this->_objs[$keyname]=$obj;
						}else{
							$this->_objs[$keyname]= new $keyname();		
							}
				  }
		   }
		   return true;
	   }
	 /**
	  *功能：取出注册器中的对象
	  *@param $objname 注册对象的名字，如果值对象不存在时会尝试注册对象
	  *返回值：已经注册的对象
	  */
 	public  function getObj($objname){
		return $this->regObj($objname);
	  }
	  /**
	  *功能：返回注册器中已经注册的所有组件
	  */
	  public function get_objs_arr(){
		  return $this->_objs;
		  }
   /**
    *阻止用户复制对象实例
	*/ 
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
?>