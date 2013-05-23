<?php
class ActionAd extends Action{
	
	public function index(){
		var_dump($this->params);
		echo "这个是项目中的默认方法";
	//var_dump(APP::getobject('Dbconn'));
	$a=M("content");
	//$a->select("{'id':2}");
	//$a->field['id']=115;
	//$a->update("{'bm_id':'88','tpl':'form.html'}");
	//$a->field['tpl']="88888888888888888888";
	//$a->insert();
	//$a->delete('1');
	//var_dump(json_decode("{'a':1,'b':2}"));
	//var_dump(Config::$config);
	$b=new MyPage($a->rs_arr,1,1);
	var_dump($b->cur_pagedata());
	var_dump($b->getmypageinfo());
		$this->display('ad.html');
		}
	}
?>