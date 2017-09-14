<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller{
	function login(){
		if(IS_POST){
			$code=I('post.code');
            
    		$verify=new \Think\Verify();
    		if(!$verify->check($code)){
    			$this->error("您输入的验证码有误,请重新输入",U('login'),3);
    		}
			$name=I('post.username');
			$pass=md5(I('post.password'));
			$mem_info=D('Member')->where("mem_name='$name'")->find();
			if($pass==$mem_info['mem_password']){
				session('memid',$mem_info['mem_id']);
				session('memname',$mem_info['mem_name']);
				$tc=I('get.tc','Index');
				$ta=I('get.ta','index');
				$this->success('登陆成功',U($tc.'/'.$ta));
			}else{
				$this->error('密码错误');
			}
		}else{
			$this->display();
		}		
	}
    function captcha(){
        $code=I('get.code');
        $config=array(
                'reset'=>false,
            );
        $verify=new \Think\Verify($config);
        if($verify->check($code)){
            echo 1;        
        }else{
            echo 0;
        }
    }
	function logout(){
		session('[destroy]');
		$this->success('已注销用户',U('login'));
	}
	public function verify(){
    	$config=array(
    		'useCurve'=>false,
    		'useNoise'=>false,
    		'fontSize'=>20,
    		'fontttf'=>'6.ttf',
    		'length'=>4,
            'useImgBg'=>true,
            'imageW'=>0,
            'imageH'=>0,
    	);
    	$verify=new \Think\Verify($config);
    	$verify->entry();
    }
	function register(){
		if(IS_POST){
			$code=I('post.code');
    		$verify=new \Think\Verify();
    		if(!$verify->check($code)){
    			$this->error("您输入的验证码有误,请重新输入");
    		}
    		$mem_model=D('Member');
    		$form_data=$mem_model->create();
    		if(!$form_data){
    			echo $mem_model->getError();
    		}else{
    			$form_data['mem_password']=md5($form_data['mem_password']);
    			$res=$mem_model->add($form_data);
    			if($res){
    				$this->success("注册成功",U('login'));
    			}else{
    				$this->error('注册失败');
    			}
    		} 		
		}else{
			$this->display();	
		}
	}
}