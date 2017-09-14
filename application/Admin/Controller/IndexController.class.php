<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller{
    public function login(){
    	if(IS_POST){
    		$code=I('post.code');
    		$verify=new \Think\Verify();
    		if(!$verify->check($code)){
    			$this->error("您输入的验证码有误,请重新输入",U('login'),3);
    		}
    		$username=I('post.name');
    		$password=I('post.passwd');
    		$manager_model=D('Manager');
    		if($manager_model->checkLogin($username,$password)){
    			$this->success('登陆成功',U('Main/index'),3);
    		}else{
    			$this->error('用户名或密码错误',U('login'),3);
    		}
    	}else{
    		$this->display();
    	}
    }
    public function verify(){
    	$config=array(
    		'useCurve'=>false,
    		'useNoise'=>false,
    		'fontSize'=>18,
    		'fontttf'=>'5.ttf',
            'useImgBg'=>true,
            'imageW'=>0,
            'imageH'=>0,
    	);
    	$verify=new \Think\Verify($config);
    	$verify->entry();
    }
    public function logout(){
        session('[destroy]');
        $this->success('已注销用户',U('login'));
    }
}