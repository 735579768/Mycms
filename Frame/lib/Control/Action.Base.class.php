<?php
/*
当项目中没有对应的控制器时默认会调用这个框架的控制器
*/
class ActionBase extends Action{
function index(){
	echo "<div style='margin:50px auto;width:500px; height:100px; font-size:24px; font-weight:blod; text-align:center;'>这个是框架中的默认控制器输出的<br>项目".APP_NAME."创建成功</div>";
	$this->tpl->assign('page_title',"测试");
	$this->tpl->display('index.html');
	}
}
?>