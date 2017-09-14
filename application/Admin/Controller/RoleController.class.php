<?php
namespace Admin\Controller;
//use \Think\Controller;
class RoleController extends CommonController{
	function roleList(){
		$role_model=D('Role');
		$role_list=$role_model->select();
		$this->assign('role_list',$role_list);
		$this->display();
	}
	function distribute(){
		if(IS_POST){
			$role_id=I('post.role_id');
			$ids=I('post.ids');
			$ids=implode(',',$ids);
			$auth_list=D('auth')->where("auth_id in ($ids)")->select();
			$role_auth_path='';
			foreach($auth_list as $value){
				if($value['auth_c']!=''){
					$role_auth_path.= $value['auth_c'].'-'.$value['auth_a'].',';
				}
			}
			$role_auth_path=rtrim($role_auth_path,',');
			$save_data=array(
				'role_id'=>$role_id,
				'role_auth_ids'=>$ids,
				'role_auth_path'=>$role_auth_path,
			);
			$role_model=D('Role');
			if($role_model->save($save_data)){
				$this->success('分配权限成功',U('roleList'));
			}else{
				$this->error('分配权限失败',U('roleList'));
			}
		}else{
			$id=I('get.id');
			$role_model=D('Role');
			$role_info=$role_model->where('role_id='.$id)->find();
			$this->assign('role_info',$role_info);
			$auth_model=D('Auth');
			$authA=$auth_model->where('auth_pid=0')->select();
			$authB=$auth_model->where('auth_pid!=0')->select();
			$this->assign('authA',$authA);
			$this->assign('authB',$authB);
			$this->display();
		}
	}
}