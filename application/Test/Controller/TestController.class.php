<?php
namespace Test\Controller;
use Think\Controller;
class TestController extends Controller{
	public function file(){
		if(IS_POST){
			$config=array(
				'maxSize'=>3000000,
				'exts'=>array('jpg','png','gif'),
				'rootPath'=>'./Uploads/'
			);
			$uploader=new \Think\Upload($config);
			$res=$uploader->upload();
			if(!$res){
				echo $uploader->getError();
			}else{
				dump($res);
			}
		}else{
			$this->display();
		}
		
	}
	public function select(){
		$stu=D('Student');
		//$res=$stu->where('age>30')->select();
		dump($stu);
	}
	public function work2(){
		$this->display();
	}
	public function verify(){
		$config=array(
			'codeSet'
		);
		$verify=new \Think\Verify;
		$verify->entry();
	}
	public function sum_test(){
		//以实现统计每个部门有多少人。
		$user=D('user');
		$res=$user->alias('s')
		->field("d.name,count(*) num")
		->join("left join dept d on s.dept_id=d.id")
		->group('d.name')
		->select();
	}
	public function workOk(){
		$stu=D('student');
		$form_data=$stu->create();
		if(!$form_data){
			echo $stu->getError();
		}else{
			dump($form_data);
		}
		
	}
	public function form_test(){
		$this->display();
	}
	public function addOK(){
		$stu=D('Student');
		$form_data=$stu->create();
		dump($form_data);
	}
	public function user(){
		if(IS_POST){
			$id=I('post.id');
			$user=D('user');
			$data['status']=0;
			$res=$user->where("id={$id}")->save($data);
			if($res){
				$this->success('删除成功', U(user));
			}else{
				$this->error("删除失败");
			}
		}else{
			$user=D('user');
			$pageno=I('get.p');
			$pagesize=5;
			$res=$user->page($pageno,$pagesize)->select();
			$count=$user->count();
			$page=new \Think\Page($count,$pagesize);
			$show=$page->show();
			$this->assign("user",$res);
			$this->assign("show",$show);
			$this->display();	
		}

	}
}