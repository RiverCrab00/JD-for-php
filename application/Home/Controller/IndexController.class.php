<?php
namespace Home\Controller;
class IndexController extends CommonController {
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$goods_id=I('get.goods_id');
    	$goods_info=D('Goods')->find($goods_id);
    	$this->assign('goods_info',$goods_info);
    	$attr_list=D('attribute')->alias('a')
    	->field('a.attr_name,ga.ga_attrvals')
    	->join("left join sp_goodsattr ga on a.attr_id=ga.ga_attrid")
    	->where("ga.ga_goodsid=$goods_id")
    	->select();
    	$this->assign('attr_list',$attr_list);
        $pic_list=D('goodspic')->where('pic_goodsid='.$goods_id)->select();
        $this->assign('pic_list',$pic_list);
        $attr_select=D('attribute')->alias('a')
        ->field('attr_name,ga_attrvals')
        ->join('left join sp_goodsattr g on g.ga_attrid=a.attr_id')
        ->where("g.ga_goodsid={$goods_id} and a.attr_type='单选'")
        ->select();
        foreach($attr_select as $key=>$value){
           $attr_select[$key]['ga_attrvals']=explode(',',$value['ga_attrvals']);
        }
        $this->assign('attr_select',$attr_select);
    	$this->display();
    }
    public function goodsList(){    	
    	$this->display();
    }
    public function search(){
    	$key=I('get.name');
    	$goods_list=D('Goods')->where("goods_name like '%{$key}%' or goods_keyword like '%{$key}%' or goods_description like '%{$key}%'")->select();
    	$this->assign('goods_list',$goods_list);
    	$this->display('goodsList');
    }
   	public function getGoodsBycateid(){
   		$level=I('get.level');
    	$cate_id=I('get.cate_id');
    	if($level==2){
    		$sql="select *from sp_goods where goods_cateid={$cate_id}";
    	}elseif ($level==1) {
    		$sql="select *from sp_goods where goods_cateid in(
				select cate_id from sp_cate where cate_pid={$cate_id}
    		)";
    	}elseif($level==0){
    		$sql="select *from sp_goods where goods_cateid in(
				select cate_id from sp_cate where cate_pid in(
					select cate_id from sp_cate where cate_pid={$cate_id}
				)
    		)";
    	}
    	$goods_list=D()->query($sql);
    	$this->assign('goods_list',$goods_list);
    	$this->display('goodsList');
   	}
}