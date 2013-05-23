<?php
class DbBiao
{
	public $field=array();
	public $id;
	public $rs_arr;
	public $sql;
	private $rs;
	private $conn;
	private $biao;
	private $error=0;
/*
*@param $biao  这个是数据库中的表
*@param $tj    过滤条件格式为json格式如 {'id':1,'a':2}  
*@param $yh     这个参数，各个条件之间的关系，默认为'and',在$tj不为空的时候才有效果，
*/
 function __construct($biao) 
    {
		$this->biao=$biao;
		$this->conn=Dbconn::getinstance()->getconn();
		$this->sql="select * from $biao";	
		$this->query($this->sql);
	}
function getbyid($id){
return	$this->getrsarr('select * from '.$this->biao.' where id='.$id);
	}
function __deconstruct(){
	$this->rs=null;
	$this->conn=null;
	}
/*
*@param $tj查询的条件格式为json格式如 {'id':1,'a':2}
*
*
*/
function select($keys_values='',$yh='and'){
	if($keys_values!=''){
		if(!is_array($keys_values)){
			$keys_values=json_decode(str_replace("'","\"",$keys_values));
			}
			$str='';
			foreach($keys_values as $keys=>$a){
			$str.=" $yh $keys='$a'";
			}
			$str=substr($str,@strpos($keys_values,$str)+1+strlen($yh));
			$this->sql="select * from ".$this->biao." where ".$str;
	}elseif($this->id!=''){
			$this->sql="select * from ".$this->biao." where id=".$this->id;
				}else{
			$this->sql=	"select * from ".$this->biao;
					}
		return	$this->query();
	}
/*
*@param 更新的键和值，如{'id':1,'a':2}，用之前要把本实例的id赋值
*
*
*/
function update($keys_values='',$id=''){
	if($id!='')$this->id=$id;
	if($keys_values==''){
		if($this->field['id']!='')$this->id=$this->field['id'];
		$keys_values=$this->field;
	}else{
		if(!is_array($keys_values)){
		$keys_values=json_decode(str_replace("'","\"",$keys_values));
		}
	}
	$str="";
	foreach($keys_values as $key=>$value){
		$str.=",".sql_filt($key)."='".sql_filt($value)."'";
		}
	$str=substr($str,1);
	if($this->id!=null){
	$this->sql="update ".$this->biao." set ".$str." where id='".$this->id."'";
	$this->query($this->sql);
	$this->field=array();
	return $this->state();
		}else{
			throw new MyException("请设置要更新的数据的id值：更新表".$this->biao."时出错！");
		}
	}
function insert($keys_values=''){
	if($keys_values==''){
		$keys_values=$this->field;
	}else{
		if(!is_array($keys_values)){
		$keys_values=json_decode(str_replace("'","\"",$keys_values));
		}
	}
	$keys='';
	$values='';
	foreach($keys_values as $key=>$value){
		$keys.=','.sql_filt($key);
		$values.=',\''.sql_filt($value).'\'';
		}
	$keys=substr($keys,1);
	$values=substr($values,1);
	$this->sql="insert into ".$this->biao."($keys) values($values)";
	$this->query($this->sql);
	return $this->state();
	}
function delete($id='',$tj=''){
	if($id!=''){
	$this->sql="delete from ".$this->biao." where id=".$id;
	}elseif($tj!=''){
	$this->sql="delete from ".$this->biao." where ".$tj;
	}elseif($this->id!=''){
	$this->sql="delete from ".$this->biao." where id=".$this->id;		
		}
	$this->query($this->sql);
	return $this->state();
	}

function query($sql=''){
	$this->sql=($sql=='')?$this->sql:$sql;
	//echo $this->sql."<br>";
	$dbtype=getObjByReg('config')->app_conf['db_type'];
	if($dbtype=='mysql'){
	$this->rs=mysql_query($this->sql,$this->conn);
			if(!$this->rs){
			$this->error=1;
			 throw new MyException("sql:".$this->sql."执行错误：".mysql_error());
			}
	}elseif($dbtype=='access'){
		//echo $this->sql."<br>";
		$this->rs=$this->conn->execute($this->sql);
			if(substr($this->sql,0,11)=='insert into') return true;
			if(substr($this->sql,0,6)=='delete') return true;
			if(substr($this->sql,0,6)=='update') return true;
			}
	return $this->getrsarr();

}
/*
*功能：自动将记录集转为一个数组，私有，外部不可直接调用 
*
*/
private function getrsarr($sql=''){

	if($sql!='')$this->sql=$sql;
	if($this->rs==null){
	$this->query($this->sql);
	}
	$this->rs_arr=array();
	$dbtype=getObjByReg('config')->app_conf['db_type'];
	if($dbtype=='mysql'){	
	while($a=mysql_fetch_array($this->rs)){
		$this->rs_arr[]=$a;
	}
	}elseif($dbtype=='access'){
		
		while(!$this->rs->eof){//把每一条记录输到一个数组中使键和值对应
			$tem_arr=array();
			foreach($this->rs->fields as $a){
				$tem_arr[$a->name]=$a->value;
				//echo $a->name.'---'.$a->value.'<br>';
				}

			$this->rs_arr[]=$tem_arr;
			$this->rs->movenext;
		}
	}
					
	return $this->rs_arr;
	}
private function  state(){
	if($this->error==0){
		return true;
		}else{
		$this->error=0;
		return false;	
			}
	}

}

?>