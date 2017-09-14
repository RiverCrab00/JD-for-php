<?php
namespace Admin\Controller;
//use Think\Controller;
class MainController extends CommonController{
	public function index(){
		$this->display();
	}
	public function main(){
		$this->display();
	}
	public function left(){
		$role_id=session('roleid');
		$role_model=D('Role');
		$role_info=$role_model->field('role_auth_ids')->find($role_id);
		$role_auth_ids=$role_info['role_auth_ids'];
		$auth_model=D('Auth');
		$authA=$auth_model->where("auth_id in ($role_auth_ids) and auth_pid=0 and auth_show=1")->select();
		$authB=$auth_model->where("auth_id in ($role_auth_ids) and  auth_pid!=0 and auth_show=1")->select();
		$this->assign('authA',$authA);
		$this->assign('authB',$authB);
		$this->display();
	}
	public function top(){
		$this->display();
	}
}