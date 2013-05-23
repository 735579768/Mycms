<?php
//分页类****************
//使用方法
//***********$page=new mypage($arr,3,5); 初始化分页对象，参数为要分页的 (1)记录数组，(2)要显视的页码，(3)每个页面显视的记录数
//***********$page->cur_page_data;      初始化对象后可真接使用，这个变量就是你要显视的那一页的数据
//***********$page->getmypageinfo();	返回分页类中的各个分页信息，为一个数组
class MyPage{
	public $total_arr;//总记录数组
	public $cur_page_data;//返回的当前页的数组
	public $page_num;//分成的总页数
	public $page_size;//每页的记录数
	public $total_size;//总记录数
	public $page;//当前的页码
function __construct($total_arr,$page=1,$page_size=10) {
		$this->total_arr=$total_arr;
		$this->total_size=count($total_arr);
		$this->page_size=$page_size;
		$this->page_num=$this->getPageNum();
		$this->page=$this->getpage($page);
		$this->cur_pagedata();
}
//返回分成的总页数
private function getPageNum(){
	return ((int)ceil($this->total_size/$this->page_size));
	}
//判断传第过来的页码是否合格
private function getpage($page){
	if($page<1){return	1;}elseif($page>$this->page_num){return $this->page_num;}else{return $page;}
	}
//取出指定的数据
public function cur_pagedata(){
   $this->cur_page_data=array_slice($this->total_arr,($this->page-1)*$this->page_size,$this->page_size);
	return $this->cur_page_data;
}
//返回对类初始化后的信息
public function getmypageinfo(){
	$mypageinfo=array(
	"total_size"=>$this->total_size,
	"total_arr"=>$this->total_arr,
	"cur_page_data"=>$this->cur_page_data,
	"page_num"=>$this->page_num,
	"page_size"=>$this->page_size,
	"page"=>$this->page
	);
	return $mypageinfo;
	}
public function getpagetool(){
	$router=App::getObject('Router');
	$pagetool="<style>.pagetool td{ margin:0px 5px;}</style><table width='450' class='pagetool' border='0' align='center' style='border:none;display:block; margin:10px auto;' cellpadding='3' cellspacing='3'>
  <tbody><tr>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/1'>首页</a></td>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/".(($this->page)-1)."'>上一页</a></td> 
    <td>当前第".$this->page."页</td>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/".(($this->page)+1)."'>下一页</a></td>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/".$this->page_num."'>尾页</a></td>
   <td>共".$this->page_num."页，".$this->page_size."个/页，共有".$this->total_size."个记录</td>
  </tr>
</tbody></table>";
return $pagetool;
	}
}

?>