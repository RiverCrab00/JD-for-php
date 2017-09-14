<?php
namespace Test\Model;
use Think\Model;
class StudentModel extends Model{
	/*protected $pk='sno';
	protected $fields=array(
		'sno','sname','sage','ssex','sdept','saddtime','username','password','repassword','email'
	);
	protected $_auto=array(
		array('saddtime','getDateTime',1,'callback')
	);
	function getDateTime(){
		return date("Y-m-d H-i-s");
	}
	protected $_map=array(
		'name'=>'sname',
		'age'=>'sage',
		'sex'=>'ssex',
		'dept'=>'sdept'
	);*/
	/*protected $_validate=array(
		array('username','require','用户名不能为空!'),
		array('username','username',"用户名长度6~12位",1,'regex',3),
		array('password','require','密码不能为空!'),
		array('password','password',"长度8~20位",1,'regex',3),
		array('repassword','password',"密码不一致",1,'confirm',3),
		array('email','email',"邮箱格式错误",1,'regex',3)
	);*/
}
