<?php
//1.ʵ������
//$zip=new zipclass();//��Ҫ���ർ�뵽��ǰ����
//2.����ѹ�����ѹ��Ŀ¼
//$zip->set_path(".");//ѹ����ǰĿ¼���ѹ����ǰĿ¼·������Ϊ"."
//3.����ѹ���ļ������ѹ�ļ���
//$zip->set_filename("frame.zip");//�ļ�������.zip��ʽ
//4.ѹ�����ѹ
//$zip->zip();//ѹ��
//$zip->unzip();//��ѹ
//5.����
//ѹ��ʱ����ļ��Ѿ����ڻ��Զ�ɾ����������ѹ����
//$zip->type=false;//��������ѹ��ʱ����ļ��Ѿ������򲻻���������ѹ����

class phpzip{
private $path;
private $filename;
public $type=true;
//���캯��
public function __construct(){}
//����ѹ�����ѹĿ¼
public function set_path($path){
if(!file_exists($path) || !is_dir($path)){die("ָ����Ŀ¼[$path]������");}
else{$this->path=$path;}
}
//����ѹ���ļ������ѹ�ļ���
public function set_filename($filename){
if(strtolower(end(explode(".",$filename)))!="zip"){die("�ļ�������.zip��ʽ");}
else{$this->filename=$filename;}
}
//��ȡ�ļ�
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
//ѹ��
public function zip(){
if(file_exists($this->filename)){
if($this->type){@unlink($this->filename);}
else{die("�ļ�[{$this->filename}]�Ѿ�������");}
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
//��ѹ
function unzip(){
$zip=new ziparchive();
if($zip->open($this->filename)===true){
$zip->extractto($this->path);
$zip->close();
}
}
}
?>
