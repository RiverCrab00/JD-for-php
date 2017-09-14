<?php
namespace Admin\Controller;
//use Think\Controller;
class GoodsController extends CommonController{
	function goodsList(){
		$pageno=I('get.p',1);
		$pagesize=5;
		$pagestart=($pageno-1)*$pagesize;
		$goods_model=D('Goods');
		$goods_list=$goods_model->limit($pagestart,$pagesize)->select();
		$count=$goods_model->count();
		$page=new \Think\Page($count,$pagesize);
		$show=$page->show();
		$this->assign('show',$show);
		$this->assign('goods_list',$goods_list);
		$this->display();
	}
	function delGoods(){
		$goods_id=I('get.id');
		$goods_model=D('Goods');
		$goods_info=$goods_model->find($goods_id);
		$res=$goods_model->delete($goods_id);
		if($res){
			$pic_info=D('Goodspic')->where("pic_goodsid=".$goods_id)->select();
			D('Goodspic')->where("pic_goodsid=".$goods_id)->delete();
			foreach ($pic_info as $value) {
				unlink($value['pic_ori']);
				unlink($value['pic_big']);
				unlink($value['pic_mid']);
				unlink($value['pic_sma']);
			}
			unlink($goods_info['goods_logo']);
			unlink($goods_info['goods_small_logo']);
			$this->success('删除成功',U('goodsList'));
		}else{
			$this->error('删除失败',U('goodsList'));
		}
	}
	function photos(){
		if(IS_POST){
			$goods_id=I('post.goods_id');
			$config=C('UPLOAD_IMG');
			$uploader=new \Think\Upload($config);
			$upload_res=$uploader->upload();
			if($upload_res){
				$pic_model=D('Goodspic');
				$pic_res=$pic_model->insertPic($upload_res,$goods_id);
				if($pic_res){
					$this->success("批量添加成功",U('photos','id='.$goods_id));
				}else{
					$this->error("批量添加失败",U('photos','id='.$goods_id));
				}
			}else{
				echo $uploader->getError();
			}			
		}else{
			$goods_id=I('get.id');
			$goods_model=D('Goods');
			$pic_info=D('goodspic')->where("pic_goodsid=".$goods_id)->select();
			$goods_info=$goods_model->find($goods_id);
			$this->assign('goods_info',$goods_info);
			$this->assign('pic_list',$pic_info);
			$this->display();
		}	
	}
	function delPic(){
		$id=I('pic_id');
		$pic_model=D('goodspic');
		$info=$pic_model->find($id);
		$res=$pic_model->delete($id);
		if($res){
			unlink($info['pic_ori']);
			unlink($info['pic_big']);
			unlink($info['pic_mid']);
			unlink($info['pic_sma']);
			echo 1;
		}else{
			echo 0;
		}
	}
	function addGoods(){
		$logo_path='';
		$small_logo_path='';
		if(IS_POST){
			if($_FILES['goods_logo']['error']==0){
				$config=array(
					'maxSize'=>3000000,
					'exts'=>array('jpg','png','gif'),
					'rootPath'=>'./Uploads/'
				);
				$uploader=new \Think\Upload($config);
				$res=$uploader->upload();
				if(!$res){
					echo $uploader->getError();
				}else{
					//拼接logo路径
					$logo_path=$config['rootPath'].$res['goods_logo']['savepath'].$res['goods_logo']['savename'];
					$img=new \Think\Image();
					$img->open($logo_path);
					$img->thumb(200,200);
					$small_logo_path=$config['rootPath'].$res['goods_logo']['savepath'].'thumb_'.$res['goods_logo']['savename'];
					$img->save($small_logo_path);
				}				
			}
			$goods_model=D('Goods');
			$form_data=$goods_model->create();
			$form_data['goods_logo']=$logo_path;
			$form_data['goods_small_logo']=$small_logo_path;
			$res=$goods_model->add($form_data);
			if($res){
				$attr_model=D('goodsattr');
				$vals=I('post.vals');
				$arr=array();
				foreach($vals as $key=>$value){
					$arr[]=array(
						'ga_goodsid'=>$res,
						'ga_attrid'=>$key,
						'ga_attrvals'=>implode(',',$value)
					);
				}
				
				$attr_model->addAll($arr);
				$this->success('添加成功',U('goodsList'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$cate_model=D('cate');
			$cate_list=$cate_model->where("cate_pid=0")->select();
			$this->assign('cate_list',$cate_list);
			$this->display();
		}
		
	}
}