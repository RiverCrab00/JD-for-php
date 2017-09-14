<?php
namespace Home\Controller;
use Think\Controller;
use Think\Cart;
class CartController extends Controller{
	function aaa(){
		dump(unserialize(cookie('cart')));
	}
	function bbb(){
		dump(session());
	}
	function addCart(){
		//1.接受前台发送的数据
		$goods_info=array(
			'cart_goodsid'=>I('post.goods_id'),
			'cart_num'=>I('post.num'),
			'cart_attr'=>I('post.attr'),
		);
		//2.实例化Cart.class.php
		$cart=new Cart();
		$add_result=$cart->addCart($goods_info);
		if($add_result){
			$pn=$cart->getPriceNumber();
			echo json_encode($pn);
		}else{
			echo 2;
		}
	}
	function delCart(){
		$cart_id=I('post.cart_id');
		$cart=new Cart();
		$del_res=$cart->delCart($cart_id);
		if($del_res){
			echo json_encode($del_res);
		}else{
			echo 0;
		}
	}
	function flow1(){
		$cart=new Cart();
		$cart_list=$cart->getCartList();
		dump($cart_list);
		$this->assign('cart_list',$cart_list);
		$pn=$cart->getPriceNumber();
		$this->assign('price',$pn['price']);
		$this->display();
	}
	function flow2(){
		if(session('?memid')){
			$cart=new Cart();
			$cookieCart=unserialize(cookie('cart'));
			foreach ($cookieCart as $key => $value) {
				$cookie_list[]=array(
					'cart_memid'=>session('memid'),
					'cart_goodsid'=>$value['cart_goodsid'],
					'cart_num'=>$value['cart_num'],
					'cart_attr'=>$value['cart_attr']
				);
			}
			D('cart')->addAll($cookie_list);
			cookie('cart',null);
			$cart_list=$cart->getCartList();
			$this->assign('cart_list',$cart_list);
			$pn=$cart->getPriceNumber();
			$this->assign('total_price',$pn['price']);
			$this->assign('total_num',$pn['number']);
			$this->display();
		}else{
			$ac=array(
				'tc'=>CONTROLLER_NAME,
				'ta'=>ACTION_NAME
			);
			$this->error('请先登录',U('Member/login',$ac));
		}		
	}
	function flow3(){
		$cart=new Cart();
		$pn=$cart->getPriceNumber();
		$order_model=D('Order');
		$form_data=$order_model->create();
		$form_data['order_number']='php59'.date('YmdHis').rand(100000,999999);
		$form_data['order_memid']=session('memid');
		$form_data['order_price']=$pn['price'];
		$form_data['order_addtime']=time();
		$form_data['order_updtime']=time();
		$res=$order_model->add($form_data);
		if($res){
			$cart_list=$cart->getCartList();
			$order_goods=array();
			foreach($cart_list as $key=>$value){
				$order_goods[$key]=array(
					'og_memid'=>session('memid'),
					'og_orderid'=>$res,
					'og_goodsid'=>$value['goods_id'],
					'og_goodsprice'=>$value['goods_price'],
					'og_price'=>$value['total_price'],
					'og_num'=>$value['cart_num'],
					'og_attr'=>$value['cart_attr'],
					'og_goodslogo'=>$value['goods_small_logo'],
				);
			}
			D('OrderGoods')->addAll($order_goods);
			$cart->delAll();
			$this->display();
		}
	}
	function modify(){
		$cart_info=array(
			'cart_id'=>I('post.cart_id'),
			'cart_num'=>I('post.num')
		);
		$cart=new Cart();
		$save_res=$cart->modifyCart($cart_info);
		if($save_res){
			echo 1;
		}else{
			echo 0;
		}
	}
}