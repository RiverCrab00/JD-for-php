<?php 
namespace Admin\Model;
use \Think\Model;
class GoodsModel extends Model{
	protected $_auto=array(
		array('goods_addtime','time',1,'function'),
		array('goods_updtime','time',1,'function'),
		array('goods_saletime','strtotime',1,'function'),
	);
}
