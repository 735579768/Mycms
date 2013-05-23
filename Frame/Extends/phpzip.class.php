<?php
//1.实例化类
//$zip=new zipclass();//需要把类导入到当前环境
//2.设置压缩或解压的目录
//$zip->set_path(".");//压缩当前目录或解压到当前目录路径设置为"."
//3.设置压缩文件名或解压文件名
//$zip->set_filename("frame.zip");//文件必须是.zip格式
//4.压缩或解压
//$zip->zip();//压缩
//$zip->unzip();//解压
//5.其他
//压缩时如果文件已经存在会自动删除后再生成压缩包
//$zip->type=false;//此设置在压缩时如果文件已经存在则不会重新生成压缩包

class phpzip{
private $path;
private $filename;
public $type=true;
//构造函数
public function __construct(){}
//设置压缩或解压目录
public function set_path($path){
if(!file_exists($path) || !is_dir($path)){die("指定的目录[$path]不存在");}
else{$this->path=$path;}
}
//设置压缩文件名或解压文件名
public function set_filename($filename){
if(strtolower(end(explode(".",$filename)))!="zip"){die("文件必须是.zip格式");}
else{$this->filename=$filename;}
}
//获取文件
private function get_files($dir,&$files=array()){
$temp=scandir($dir);
foreach($temp as $value){
if($value !="." && $value!=".."){
$make_path=$dir."/".$value;
if(is_dir($make_path)){$this->get_files($make_path,$files);}
$files[]=$make_path;
}
}
}
//压缩
public function zip(){
if(file_exists($this->filename)){
if($this->type){@unlink($this->filename);}
else{die("文件[{$this->filename}]已经存在了");}
}
$files=array();
$this->get_files($this->path,$files);
$zip=new ziparchive();
$res=$zip->open($this->filename,ziparchive::CREATE);
if($res===true){
if(empty($files)){$zip->addemptydir($this->path);}
else{
foreach($files as $value){
if(is_dir($value)){$zip->addemptydir($value);}
else{$zip->addfile($value,$value);}
}
}
$zip->close();
}
}
//解压
function unzip(){
$zip=new ziparchive();
if($zip->open($this->filename)===true){
$zip->extractto($this->path);
$zip->close();
}
}
}
?>
