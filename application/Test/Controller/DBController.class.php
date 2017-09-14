<?php
namespace Test\Controller;
use Think\Controller;
class DBController extends Controller{
	function index(){
		$m_obj=M('Student');
		$d_obj=D('student');
		dump($m_obj);
	}
	function add(){
		$student_model=D('Student');
		$arr=array(
			//'sno'=>10001,
			'sname'=>'李华',
			'sage'=>25,
			'ssex'=>'女',
		);
		echo $student_model->add($arr);
	}
	function save(){
		$student_model=D('Student');
		$arr=array(
			'sno'=>10001,
			'sname'=>'小王'
		);
		$student_model->save($arr);
		echo $student_model->getlastsql();
	}
	function select(){
		$student_model=D('Student');
		/*$result=$student_model->find(10001);
		dump($result);*/
		$result=$student_model->select();
		dump($result);
	}
	function delete(){
		$student_model=D('Student');
		dump($student_model->delete(10001));
	}
	function order(){
		$student_model=D('Student');
		$result=$student_model->where('ssex="女"')->order('sno desc')->select();
	dump($result);
	}
	function join_test(){
		$student=D('Student')
		->alias('s')
		->filed('s.sname,d.dname')
		->join("left join tp_dept d on s.dept=d.did")
		->select();
		dump($result);
	}
}