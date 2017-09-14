<?php
namespace Test\Controller;
use Think\Controller;
class StudentController extends Controller{
	protected $_auto=array(
		array('saddtime','getDateTime',1,'callback'),
	);
	function getDatetime(){
		return date('Y-m-d H:i:s');
	}
	public function select(){
		$stu=D('Student');
		$res=$stu->field('name')->where('age>30')->select();
		dump($res);
	}
}