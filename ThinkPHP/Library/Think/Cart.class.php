<?php
namespace Think;
class Cart{
	private $cart;
	function __construct(){
		if(session('?memid')){
			$class='MysqlCart';
		}else{
			$class='CookieCart';
		}
		$class="Think\\Cart\\Driver\\".$class;
		$this->cart=new $class();
	}
	public function addCart($goods_info){
		return $this->cart->addCart($goods_info);
	}
	public function modifyCart($cart_info){
		return $this->cart->modifyCart($cart_info);
	}
	public function delCart($cart_id){
		return $this->cart->delCart($cart_id);
	}
	function getPriceNumber(){
		return $this->cart->getPriceNumber();
	}
	function getCartList(){
		return $this->cart->getCartList();
	}
	function delAll(){
		return $this->cart->delAll();
	}
}