<?php 
namespace Admin\Model;
use Think\Model;
class ManagerModel extends Model{
	protected $pk='manager_id';
	protected $fields=array(
		'manager_id','manager_name','manager_passwd',
		'manager_salt','manager_status','manager_ctime',
		'manager_login'
		);
	protected $_map=array(
		'name'=>'manager_name',
		'passwd'=>'manager_passwd',
		'status'=>'manager_status'
	);
	protected $_validate=array(
		array('manager_name','require','管理员名字不能为空',1,'regex',3),
		array('manager_passwd','password','密码必须是6-12位字母数字下划线组合',1,'regex',3),
		array('re-passwd','manager_passwd','两次密码不一致',1,'confirm',3),
		array('manager_status','checkStatus','用户状态不正确',1,'callback',3),
	);
	function checkStatus($status){
		$arr=array('启用','禁用');
		if(in_array($status,$arr)){
			return true;
		}else{
			return false;
		}
	}
	protected $_auto=array(
		array('manager_salt','makeSalt',1,'function'),
		array('manager_ctime','time',1,'function'),
		array('manager_login','time',1,'function'),
		//自动调用function.php中的salt函数对其加密
	);
	//因为管理员状态只有在当前模型使用,所有就在当前模型定义方法即可
	
	function checkLogin($username,$password){
		$info=$this->where("manager_name='$username'")->find();
		if(empty($info)){
			return false;
		}
		if($info['manager_status']!='启用'){
			return false;
		}
		$password=salt($password,$info['manager_salt']);
		if($info['manager_passwd']==$password){
			$arr=array(
				'manager_id'=>$info['manager_id'],
				'manager_login'=>time()
			);
			$this->save($arr);

			session('id',$info['manager_id']);
			session('name',$info['manager_name']);
			session('roleid',$info['manager_roleid']);
			return true;
		}else{
			return false;
		}
	}
}


?>