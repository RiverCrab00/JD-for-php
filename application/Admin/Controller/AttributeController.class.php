<?php
namespace Admin\Controller;
//use Think\Controller;
class AttributeController extends CommonController{
	function attrList(){
		$attr_model=D('attribute');
		$attr_list=$attr_model->alias('a')
		->field('a.*,c.cate_name')
		->join("left join sp_cate c on a.attr_cateid=c.cate_id")
		->select();
		$this->assign("attr_list",$attr_list);
		$this->display();
	}
	function addAttr(){	
		if(IS_POST){
			$form_data=D('Attribute')->create();
			$res=D('Attribute')->add($form_data);
			if($res){
				$this->success('添加属性成功',U('attrList'));
			}else{
				$this->error('添加属性失败',U('attrList'));
			}
		}else{
			$cate_model=D('Cate');
			$cate_list=$cate_model->select();
			$this->assign('cate_list',$cate_list);
			$this->display();
		}	
	}
	function getAttr(){
		$cate_id=I('get.cate_id');
		$attr_model=D('Attribute');
		$attr_list=$attr_model->where('attr_cateid='.$cate_id)->select();
		echo json_encode($attr_list);
	}
	function getCate(){
		$cate_id=I('get.cate_id');
		$cate_model=D('Cate');
		$cate_list=$cate_model->where("cate_pid=".$cate_id)->select();
		foreach($cate_list as $value){
			$str.="<option value='{$value["cate_id"]}'>{$value["cate_name"]}</option>";
		}
		echo $str;	
	}
	function delAttr(){
		$attr_id=I('get.attr_id');
		$res=D('Attribute')->delete($attr_id);
		if($res){
			$this->success('删除属性成功',U('attrList'));
		}else{
			$this->error('删除属性失败',U('attrList'));
		}
	}
}