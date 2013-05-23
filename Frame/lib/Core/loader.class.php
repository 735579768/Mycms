<?php
/**
*设置自动加载类的目录
*spl_autoload_register(array('loader','auto_load_class'));//设置自动加载class的目录
*/
class loader
{
	private static $cls_gz=array(//加载类的规则
							0=>'classname.php',
							1=>'classname.class.php',
							2=>'Action.classname.class.php',
							3=>'classname.Action.class.php',
							4=>'classname.Model.class.php',
							5=>'Model.classname.class.php'
					);
	public static $auto_dirs = array(//保存已经实例化的对象
							0=>'./'
							);
	
    private function __construct() 
    {
	}
	public  static function auto_load_class($classname){
			$gl=array('Action','Model');
			if(!in_array($classname,$gl)){//检查类名字中是否有action model有的话就去掉
			$classname=str_replace($gl,'',$classname);
			}
			$flg=false;//查找标志
			foreach(self::$cls_gz as $a){
				if($flg)break;	
				$clsname=str_replace('classname',$classname,$a);//从规则中组合文件名字
				foreach(self::$auto_dirs as $b){
					if(substr($b,strlen($b)-1)!='/')$b=$b.'/';
					$class_path=$b.$clsname;
					if(file_exists($class_path)){
					include_once $class_path;
					$flg=true;
					break;
					}
					}
				
				}
				if(!$flg)echo "<b style=\"color:red;\">没有找到类$classname<B>";
	}
}
?>