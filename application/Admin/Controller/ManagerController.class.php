<?php 
namespace Admin\Controller;
//use Think\Controller;
class ManagerController extends CommonController{
	function managerList(){
		$pagerno=I('get.p');
		$pagesize=5;
		$manager_model=D('Manager');
		$manager_list=$manager_model->alias('m')
		->join('left join sp_role r on m.manager_roleid=r.role_id')
		->page($pagerno,$pagesize)->select();
		$count=$manager_model->count();
		$page=new \Think\Page($count,$pagesize);
		$show=$page->show();
		$this->assign('manager_list',$manager_list);
		$this->assign('show',$show);
		$this->display();
	}
	function addManager(){
		$this->display();
	}
	function addOK(){
		$manager_model=D('Manager');
		//1 设置当前为插入操作,2 设置当前为修改操作
		$form_data=$manager_model->create('',1);
		if(!$form_data){
			echo $manager_model->getError();
		}else{
			$form_data['manager_passwd']=
			salt($form_data['manager_passwd'],$form_data['manager_salt']);
			if($manager_model->add($form_data)){
				$this->success('添加管理员成功',U('managerList'),3);
			}else{
				$this->error('添加管理员失败',U('managerList'),3);
			}
		}
	}
}



 ?>