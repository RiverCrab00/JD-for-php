<?php //判断cookie购物车中是否有数据
namespace Think\Cart\Driver;
class CookieCart{
	private $cart;
	function __construct(){
		$this->cart=cookie('cart');
		//判断从cookie中读取的数据是否为空
		if(empty($this->cart)){
			//如果为空,说明购物车中还没有任何数据,将购物车实例定义为空数组
			$this->cart=array();
		}else{
			$this->cart=unserialize($this->cart);
		}
	}
	function addCart($goods_info){
		//将$goods_info写入cookie,新的cart_id就是已知数组的长度
		$length=count($this->cart);
		//将长度作为新单元的cart_id添加到goods_info中
		$goods_info['cart_id']=$length;
		$result=array_push($this->cart,$goods_info);
		$this->saveData();
		return $result-$length;
	}
	function saveData(){
		cookie('cart',serialize($this->cart));
		return 1;
	}
	function getPriceNumber(){
		foreach ($this->cart as $value) {
			$sum+=$value['cart_num'];
			$goods_price=D('Goods')->field('goods_price')->find($value['cart_goodsid']);
			$price+=$goods_price['goods_price']*$value['cart_num'];
		}
		return array('number'=>$sum,'price'=>$price);
	}
	function getCartList(){
		$res=$this->cart;
		foreach ($res as $key => $value) {
			$temp_goods=D('Goods')->find($value['cart_goodsid']);
			$res[$key]['goods_small_logo']=$temp_goods['goods_small_logo'];
			$res[$key]['goods_price']=$temp_goods['goods_price'];
			$res[$key]['goods_name']=$temp_goods['goods_name'];
			$res[$key]['total_price']=$temp_goods['goods_price']*$value['cart_num'];
		}
		return $res;
	}
	function delCart($cart_id){
		$length=count($this->cart);
		unset($this->cart[$cart_id]);
		$tmp=array();
		$i=0;
		foreach($this->cart as $value){
			$value['cart_id']=$i;
			$tmp[$i]=$value;
			$i++;
		}
		$this->cart=$tmp;
		$length1=count($this->cart);
		$this->saveData();
		return $length-$length1;
	}
	function modifyCart($cart_info){
		$cart_id=$cart_info['cart_id'];
		$cart_num=$cart_info['cart_num'];
		$this->cart[$cart_id]['cart_num']=$cart_num;
		return $this->saveData();
	}
}