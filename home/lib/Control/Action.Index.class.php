<?php
class ActionIndex extends Action{
	
	public function index(){
		echo "";
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n<html xmlns='http://www.w3.org/1999/xhtml'>\n<head>\n<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head>\n<body>\n<div style='font-size:24px;font-weight:bold;'>项目".APP_NAME."创建成功！,\n框架模板测试成功</div>\n</body>\n</html>";
		$a=M('content');
		
		//插入数据
		//$a->field['name']='test';
		//$a->insert();
		//$a->insert("{'name':'赵克立','six':'男'}");
		//$a->insert(array('name'=>'888','six'=>'男'));
		$a->id=1;
		//查询数据
		var_dump($a->select());
		
		//更新数据
		//$a->field['name']='赵克立';
		//$a->update();
		//$a->update("{'name':'赵克立','six':'男'}");
		//$a->update(array('name'=>'888','six'=>'男'));
		//删除数据
		//$a->delete();
	
		//$b=new MyPage($a->rs_arr,1,1);
		//var_dump($b->cur_pagedata());
		//var_dump($b->getmypageinfo());
		var_dump($this);
		$this->display('index.html');
		}
	}

?>