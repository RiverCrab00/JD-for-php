<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	function _initialize(){
		$ac=CONTROLLER_NAME.'-'.ACTION_NAME;
		$this->assign('ac',$ac);
		$cateA=array();
		$cateB=array();
		$cateC=array();
		$cate_list=getTree(D('cate')->select());
		foreach ($cate_list as $value) {
			if($value['level']==0){
				$cateA[]=$value;
			}elseif ($value['level']==1) {
				$cateB[]=$value;
			}elseif ($value['level']==2) {
				$cateC[]=$value;
			}
		}
		$cart=new \Think\Cart();
		$cart_header=$cart->getCartList();
		$this->assign('cart_header',$cart_header);
		$this->assign('cateA',$cateA);
		$this->assign('cateB',$cateB);
		$this->assign('cateC',$cateC);
	}
}