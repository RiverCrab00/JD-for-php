<?php 
function filterXSS($string){
    //相对index.php入口文件，引入HTMLPurifier.auto.php核心文件
    require_once './Public/Common/htmlpurifier/HTMLPurifier.auto.php';
    // 生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();
    // 以下就是配置：
    $cfg -> set('Core.Encoding', 'UTF-8');
    // 设置允许使用的HTML标签
    $cfg -> set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,p[style],span[style],img[width|height|alt|src]');
    // 设置允许出现的CSS样式属性
    $cfg -> set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
    // 设置a标签上是否允许使用target="_blank"
    $cfg -> set('HTML.TargetBlank', TRUE);
    // 使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);
    // 过滤字符串
    return $obj -> purify($string);
}
function makeSalt(){
	$salt='';
	$length=rand(4,8);
	for($i=0;$i<$length;$i++){
		$tmp=rand(1,3);
		switch($tmp){
			case 1:
			$salt.=sprintf('%c',rand(48,57));
			break;
			case 2:
			$salt.=sprintf('%c',rand(97,122));
			break;
			case 3:
			$salt.=sprintf('%c',rand(65,90));
			break;
		}
	}
	return $salt;
}
function salt($passwd,$salt){
	$salt=md5($salt);
	$salt=substr($salt,10,10);
	$salt=md5($salt);
	$salt=substr($salt,19,9);
	return md5($passwd.$salt);
}
function getAuthTree($arrs,$pid=0,$level=0){
	static $result=array();
	foreach($arrs as $value){
		if($value['auth_pid']==$pid){
			$value['level']=$level;
			$result[]=$value;
			getAuthTree($arrs,$value['auth_id'],$level+1);
		}
	}
	return $result;
}
function getTree($arrs,$pid=0,$level=0){
	static $result=array();
	foreach($arrs as $value){
		if($value['cate_pid']==$pid){
			$value['level']=$level;
			$result[]=$value;
			getTree($arrs,$value['cate_id'],$level+1);
		}
	}
	return $result;
}







 ?>