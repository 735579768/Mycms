<?php
/*
*函数功能
*查找一个目录及子目录的文件
*@param $dir 目录名,留空为当前目录
*@param $ex 为查找文件的后缀 默认为.php
*@param $real_path 反回的路径格式，默认为相对，false，为真时返回绝对路径
*/
function getalldirfiles($dir='',$ex='.php',$real_path=false){
	$dir=($dir=='')?'./':"$dir/";
	$arr=array();
	foreach(glob("$dir*") as $a){
		if(is_dir($a)){
			$arr=array_merge($arr,bili($a));
			}else{
				if(substr(strrev($a),0,4)==strrev($ex)){
				$arr[]=str_replace('./','',$a);
				}
				}
		}
	if($real_path){foreach($arr as $key=>$value){$arr[$key]=str_replace('\\','/',realpath($value));}}
	return $arr;
}
/*
*可自动创建目录（多层）PHP写入文件的函数（目录不存在自动建立）
*@param $body 写入的内容
*@param $path 写入的文件路径
*格式如下 writefile("需要写入的内容","cache/1/1/1.txt")
*所有目录不存在自动循环建立。
*writefile('test','keli/keli/keli.txt')
*/
function writeFile($body,$path){    
createDir(dirname($path));     
$handle=fopen($path,'w');     
 fwrite($handle,$body);     
 fclose($handle);    
 return 1;    
    }  
 function createDir($path){     
if (!file_exists($path)){     
createDir(dirname($path));     
mkdir($path,0777);     
}     
}
function sql_filt($str){
	$str=strtolower($str);
	$sqlstr=array('and','execute','update','count','chr','mid','master','truncate','char','declare','select','create','insert','\"','or','=','%20');
	foreach($sqlstr as $a){
		$str=str_replace($a,'',$str);
		}
	return $str;
	}
//简化创建对象的过程
function M($obj){
	return new Dbbiao($obj);
	}
/**
*功能：从系统注册器中取出对象
*@param $key 对象的类名
*返回值：一个对象
*/
function getObjByReg($key){
	$instance=Registry::getinstance();
	return $instance->getObj($key);
	}
/**
*功能：删除
*/
function delcache(){
	$arr=getalldirfiles(FRAME_ROOT.'/RunTime/cache');
	foreach($arr as $a){
		unlink($a);
		}
	$arr=getalldirfiles(FRAME_ROOT.'/RunTime/templates_c');
	foreach($arr as $a){
		unlink($a);
		}
	}
?>