<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">表单</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>商品相册</span></div>
        管理<span style="color:red;font-size:16px;"><?php echo ($goods_info["goods_name"]); ?></span>的相册
        <li style="border: 1px solid gray;margin-bottom: 20px;">
        <?php if($pic_list == array() ): ?><h2>空,请先添加图片</h2>
        <?php else: ?>
        <?php if(is_array($pic_list)): foreach($pic_list as $key=>$ov): ?><span>
            <img src="<?php echo (ltrim($ov["pic_mid"],'.')); ?>" width="200" />
            <a href="javascript:void(0)" class='delPic' data="<?php echo ($ov["pic_id"]); ?>">[-]</a>
            </span><?php endforeach; endif; endif; ?>
        </li>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="goods_id" value='<?php echo ($goods_info["goods_id"]); ?>' />
            <ul class="forminfo">
                <li>
                    <label>商品图片[<a href="javascript:;" class="add">+</a>]</label>
                    <input name="goods_pic[]" type="file" />
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="button" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
$(function(){
    $('#btnSubmit').on('click',function(){
        $('form').submit();
    });
});
$('.add').click(function(){
    /*var li="<li><label>商品图片[<a href='javascript:;' class='del'>-</a>]</label><input name='goods_pic[]' type='file' /></li>"*/
    var li='<li><label>商品图片[<a href="javascript:;" class="del">-</a>]</label><input name="goods_pic[]" type="file" /></li>';
    $('.forminfo>li').first().append(li);
})
$('.del').live('click',function(){
   $(this).parent().parent().remove();
})
$('.delPic').click(function(){
    if(confirm("确认删除吗")){
        var pic_id=$(this).attr('data');
        var a=$(this);
        $.post("<?php echo U('delPic');?>",{'pic_id':pic_id},function(msg){
            if(msg==1){
                a.parent().fadeOut();
            }else{
                alert('删除失败');
            }
        })
    }
    
    
})
</script>
</html>