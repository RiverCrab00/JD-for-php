<?php
namespace Home\Model;
use Think\Model;
class MemberModel extends Model{
	protected $pk='mem_id';
	protected $fields=array(
		'mem_id','mem_name','mem_password','mem_addtime'
	);
	protected $_map=array(
		'name'=>'mem_name',
		'password'=>'mem_password',
		);
	protected $_validate=array(
		array('mem_name','require','管理员名字不能为空',1,'regex',3),
		array('mem_password','password','密码必须是6-12位字母数字下划线组合',1,'regex',3),
		array('confirm','mem_password','两次密码不一致',1,'confirm',3)
	);
	protected $_auto=array(
		array('mem_addtime','time','function'),
	);
}