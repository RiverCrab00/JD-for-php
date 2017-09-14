<?php
namespace Admin\Controller;
//use Think\Controller;
class CateController extends CommonController{
	function modify(){
		$cate_model=D('Cate');
		$form_data=$cate_model->create();
		$res=$cate_model->where("cate_id=".$form_data['cate_id'])->save($form_data);
		if($res){
				$this->success('修改分类成功',U('catelist'),3);
			}else{
				$this->error('修改分类失败',U('catelist'),3);
			}

	}
	function editCate(){
		$cate_id=I('get.id');
		$cate_model=D('Cate');
		$cate_info=$cate_model->find($cate_id);
		$cate_list=$cate_model->select();
		$cate_list=getTree($cate_list);
		$this->assign('cate_info',$cate_info);
		$this->assign('cate_list',$cate_list);
		$this->display();
	}
	function delCate(){
		$cate_id=I('get.id');
		$cate_model=D('Cate');
		$res=$cate_model->where("cate_pid=".$cate_id)->find();	
		if(empty($res)){
			$del_result=$cate_model->delete($cate_id);
			if($del_result){
				$this->success('删除分类成功',U('catelist'),3);
			}else{
				$this->error('删除分类失败',U('catelist'),3);
			}
		}else{
			$this->error('请先删除子分类',U('catelist'),3);
		}
		
	}
	function addcate(){
		if(IS_POST){
			$cate_name=I('post.cate_name');
			$cate_pid=I('post.cate_pid');
			$cate_model=D('cate');
			$arr=array(
				'cate_name'=>$cate_name,
				'cate_pid'=>$cate_pid,
			);
			$res=$cate_model->add($arr);
			if($res){
				$this->success('添加分类成功',U("addcate"),3);
			}else{
				$this->error("添加分类失败");
			}
		}else{
			$cate_model=D('Cate');
			$cate_list=getTree($cate_model->select());
			$this->assign('cate_list',$cate_list);
			$this->display();
		}		
	}
	function catelist(){
		$cate_model=D('Cate');
		$cate_list=$cate_model
		->field('c1.cate_name,c1.cate_id,c1.cate_pid,c1.cate_pid,c2.cate_name pname')
		->alias('c1')
		->join('left join sp_cate c2 on c1.cate_pid=c2.cate_id')
		->select();	
		$cate_list=getTree($cate_list);
		$this->assign('cate_list',$cate_list);
		$this->display();
	}
}