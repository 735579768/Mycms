<?php
class Dbconn
{
	
	private $conn;
    // 保存类实例在此属性中
    private static $instance;
       // 构造方法声明为private，防止直接创建对象
    private function __construct() 
    {
		//$dbconf_arr=include APP_ROOT.'/config/config.php';
		$this->conn(getObjByReg('config')->app_conf['db_type']);
	}
	private function __deconstruct(){
		
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
    // 阻止用户复制对象实例
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
	private function conn($db_type='mysql'){
		//$this->$conn=mysql_connect($dbconf_arr['db_host'],$dbconf_arr['db_user'],$dbconf_arr['db_pwd'])
		//																			or die("数据库连接失败！". mysql_error());
		$db_type=strtolower($db_type);				
		switch($db_type){
			case "mysql":
					$this->conn=mysql_connect(Config::$app_conf['db_host'],Config::$app_conf['db_user'],Config::$app_conf['db_pwd']) or die("数据库连接失败！". mysql_error());
					mysql_select_db(Config::$app_conf['db_name'],$this->conn)
							or die("数据库'".Config::$app_conf['db_name']."'选择失败！". mysql_error());
					mysql_query("set names utf8");
					break;
			case "access":
			//把数据库名处理后创建
			$name=getObjByReg('config')->app_conf['db_name'];
			$dir=dirname($name);
			$dataname=$dir.'/#'.md5(str_replace('.mdb','',basename($name))).'#.mdb';
			$this->conn = new com("ADODB.Connection", NULL, 65001) or die("ADO连接失败！");  
			$connstr="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=".$dataname;"uid='';pwd=''";
			//如果access数据库文件不存在，就新建数据库并，建默认表content
			if(!file_exists($dataname)){
				if(copy(FRAME_ROOT.'/conf/data.mdb',$dataname)){	
				$sql="Create TABLE [content]([id]COUNTER NOT NULL, [name] TEXT(200), [six] TEXT(200), [comment] TEXT(200),  [date] DATETIME,[code] TEXT(200))";
			$this->conn->Open($connstr);
			$this->conn->execute($sql);	
			$sql="insert into content(name) values('access数据库测试数据')";
			$this->conn->execute($sql);	
					}
			//die('数据库文件不存在：'.Config::$app_conf['db_name']);
				//"Create TABLE [content]"
			
			}else{
			$this->conn->Open($connstr);
				}
					break;
			}													

		}
public function getconn(){
	return $this->conn;
	}
}

?>