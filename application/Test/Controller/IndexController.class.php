<?php
namespace Test\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function login(){
    	$this->display('login');
    }
	public function index(){
		$str=time();
		$this->assign('str',$str);
		$this->display();
	}
	public function include_test(){
		$this->display('include');
	}
	public function ueditor(){
		$this->display();
	}
	public function test(){
		$this->assign('a',2);
		$this->assign('b','b');
		$this->display();
	}
	public function accept(){
		$id=I('get.id');
		$p=I('get.p');
		echo $id,$p;
	}
}