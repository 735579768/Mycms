<?php
//��ҳ��****************
//ʹ�÷���
//***********$page=new mypage($arr,3,5); ��ʼ����ҳ���󣬲���ΪҪ��ҳ�� (1)��¼���飬(2)Ҫ���ӵ�ҳ�룬(3)ÿ��ҳ�����ӵļ�¼��
//***********$page->cur_page_data;      ��ʼ�����������ʹ�ã��������������Ҫ���ӵ���һҳ������
//***********$page->getmypageinfo();	���ط�ҳ���еĸ�����ҳ��Ϣ��Ϊһ������
class MyPage{
	public $total_arr;//�ܼ�¼����
	public $cur_page_data;//���صĵ�ǰҳ������
	public $page_num;//�ֳɵ���ҳ��
	public $page_size;//ÿҳ�ļ�¼��
	public $total_size;//�ܼ�¼��
	public $page;//��ǰ��ҳ��
function __construct($total_arr,$page=1,$page_size=10) {
		$this->total_arr=$total_arr;
		$this->total_size=count($total_arr);
		$this->page_size=$page_size;
		$this->page_num=$this->getPageNum();
		$this->page=$this->getpage($page);
		$this->cur_pagedata();
}
//���طֳɵ���ҳ��
private function getPageNum(){
	return ((int)ceil($this->total_size/$this->page_size));
	}
//�жϴ��ڹ�����ҳ���Ƿ�ϸ�
private function getpage($page){
	if($page<1){return	1;}elseif($page>$this->page_num){return $this->page_num;}else{return $page;}
	}
//ȡ��ָ��������
public function cur_pagedata(){
   $this->cur_page_data=array_slice($this->total_arr,($this->page-1)*$this->page_size,$this->page_size);
	return $this->cur_page_data;
}
//���ض����ʼ�������Ϣ
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
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/1'>��ҳ</a></td>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/".(($this->page)-1)."'>��һҳ</a></td> 
    <td>��ǰ��".$this->page."ҳ</td>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/".(($this->page)+1)."'>��һҳ</a></td>
    <td><a class='viewa' href='?".$router->getController()."/".$router->getAction()."/page/".$this->page_num."'>βҳ</a></td>
   <td>��".$this->page_num."ҳ��".$this->page_size."��/ҳ������".$this->total_size."����¼</td>
  </tr>
</tbody></table>";
return $pagetool;
	}
}

?>