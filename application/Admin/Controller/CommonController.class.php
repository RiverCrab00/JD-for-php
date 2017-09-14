<?php
namespace Admin\Controller;
use \Think\Controller;
class CommonController extends Controller{
	function _initialize(){
		if(!session('?id')){
			$this->error('您尚未登陆,请登录后访问',U('Index/login'));
		}else{
			$now_path=CONTROLLER_NAME.'-'.ACTION_NAME;
			$role_id=session('roleid');
			$role_info=D('Role')->field("role_auth_path")->find($role_id);
			$role_auth_path=$role_info['role_auth_path'];
			$role_auth_path.=',Main-index,Main-left,Main-main,Main-top';
			$role_auth_path=explode(',',$role_auth_path);
			/*if(!in_array($now_path,$role_auth_path)){
				$this->error('您无权访问该模块',U('Index/login'),3);
			}*/
		}
	}
}