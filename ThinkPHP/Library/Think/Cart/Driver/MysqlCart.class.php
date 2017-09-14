<?php
namespace Think\Cart\Driver;
class MysqlCart{
	private $cart;
	private $memid;
	function __construct(){
		$this->cart=D('Cart');
		$this->memid=session('memid');
	}
	function addCart($goods_info){
		$goods_info['cart_memid']=$this->memid;
		return $add_res= $this->cart->add($goods_info);
	}
	function delCart($cart_id){
		return $del_res=$this->cart->delete($cart_id);
	}
	function getPriceNumber(){
		//1获取总数量
		$sum=$this->cart->where('cart_memid='.$this->memid)->sum('cart_num');
		//2.计算总价格,联合goods表和cart表查询
		$info=$this->cart->alias('c')
		->field('g.goods_price,c.cart_num')
		->join('left join sp_goods g on c.cart_goodsid=g.goods_id')
		->where('c.cart_memid='.$this->memid)
		->select();
		foreach($info as $value){
			$price+=$value['cart_num']*$value['goods_price'];
		}
		return array('number'=>$sum,'price'=>$price);
	}
	function getCartList(){
		$cart_list=$this->cart->alias('c')
		->field('c.cart_id,g.goods_id,g.goods_name,g.goods_small_logo,g.goods_price,c.cart_num,c.cart_attr,c.cart_num*g.goods_price total_price')
		->join('left join sp_goods g on c.cart_goodsid=g.goods_id')
		->where('cart_memid='.$this->memid)
		->select();
		return $cart_list;
	}
	function modifyCart($cart_info){
		return $this->cart->save($cart_info);
	}
	function delAll(){
		return $this->cart->where("cart_memid=$this->memid")->delete();
	}
}