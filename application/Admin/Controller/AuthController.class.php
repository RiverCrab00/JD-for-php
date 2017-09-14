<?php
namespace Admin\Controller;
//use \Think\Controller;
class AuthController extends CommonController{
	function addAuth(){
		$auth_model=D('Auth');
		if(IS_POST){
			$form_data=$auth_model->create();
			$res=$auth_model->add($form_data);
			if($res){
				$this->success("添加成功",U('authList'));
			}else{
				$this->error("添加失败");
			}
		}else{
			$auth_list=$auth_model->where('auth_pid=0')->select();
			$this->assign('auth_list',$auth_list);
			$this->display();
		}
		
	}
	function authList(){
		$auth_model=D('Auth');
		$auth_list=getAuthTree($auth_model->select());
		$this->assign('auth_list',$auth_list);
		$this->display();
	}
}