<?php
class Timer { 
		private $StartTime = 0;//程序运行开始时间 
		private $StopTime = 0;//程序运行结束时间 
		private $TimeSpent = 0;//程序运行花费时间           
		private static $instance;// 保存类实例在此属性中
	private function __construct(){
		$this->start();
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
	function start(){//程序运行开始 
		$this->StartTime = microtime(); 
		} 
		function stop(){//程序运行结束 
		$this->StopTime = microtime(); 
	} 
	function spent(){//程序运行花费的时间 
		if ($this->TimeSpent) { 
		return $this->TimeSpent; 
		} else { 
		list($StartMicro, $StartSecond) = explode(" ", $this->StartTime); 
		list($StopMicro, $StopSecond) = explode(" ", $this->StopTime); 
		$start = doubleval($StartMicro) + $StartSecond; 
		$stop = doubleval($StopMicro) + $StopSecond; 
		$this->TimeSpent = $stop - $start; 
		return substr($this->TimeSpent,0,8)."秒";//返回获取到的程序运行时间差 
		} 
	} 
     // 阻止用户复制对象实例
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
} 
?>