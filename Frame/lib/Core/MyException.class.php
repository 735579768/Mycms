<?php
//创建一个自定义的异常类
class MyException extends Exception{
	public static $err;
	public function __construct($str=''){
		if($str!='')$this->appError($str);
		}
	public static function appError($str){
		self::$err.="<li style='margin-top:5px;'>".$str.'</li>';
		}
	public function getErrorMsg($str=''){
		$this->formatErrorMessage($str);
		}
	private function formatErrorMessage($str=''){
		$style="position:absolute; padding:10px 20px; font-size:12px; border:solid 1px #6cc; overflow:auto; left:0px; bottom:0px; height:200px; background:#FFF;";
		//$errorMsg = "<div style='".$style."'>Error on line: ".$this->getLine()." <br>in file: ".$this->getFile()."<br><b style='color:red;'>ErrorString: ".$this->getMessage()."</b></div>"; 
		if($str!='')$this->appError($str);
		echo "<br><div style='".$style."'><ul style='margin:0px;padding:0px;'>".self::$err."</ul></div>";
	}
	}
?>