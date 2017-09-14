<?php
namespace Test\Controller;
use Think\Controller;
class ImageController extends Controller{
	function water_test(){
		$img=new \Think\Image();
		$img->open('./Uploads/acg.jpg');
		$img->water('./Uploads/bbt.png',6);
		$img->save('./Uploads/acg_water.jpg');
	}
	function thumb_test(){
		$img=new \Think\Image();
		$img->open('./Uploads/2.jpg');
		$width=$img->width();
		$height=$img->height();
		$img->thumb($width/2,$height/2);
		$img->save("./Uploads/2_thumb.jpg");
	}
	function crop_test(){
		$img=new \Think\Image();
		$img->open("./Uploads/2.jpg");
		$img->crop(200,300);
		$img->save('./Uploads/2_crop.jpg');
	}
}