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
        <div class="formtitle"><span>基本信息</span></div>
        <form action="" method="post" enctype="multipart/form-data">
            <ul class="forminfo">
                <li>
                    <label>商品名称</label>
                    <input name="goods_name" placeholder="请输入商品名称" type="text" class="dfinput" /><i>名称不能超过30个字符</i></li>
                <li>
                    <label>商品价格</label>
                    <input name="goods_price" placeholder="请输入商品价格" type="text" class="dfinput" /><i></i></li>
                <li>
                    <label>会员价格</label>
                    <input name="goods_vip_price" placeholder="请输入会员价格" type="text" class="dfinput" /><i></i></li>
                <li>
                    <label>商品数量</label>
                    <input name="goods_num" placeholder="请输入商品数量" type="text" class="dfinput" />
                </li>
                <li>
                    <label>商品重量</label>
                    <input name="goods_weight" placeholder="请输入商品重量" type="text" class="dfinput" />
                </li>
                <li>
                    <label>一级分类:</label>  
                    <select class="dfinput" onchange='getlevel(this,2)'>
                    <option value='0' selected="selected">请选择</option>
                        <?php if(is_array($cate_list)): foreach($cate_list as $key=>$ov): ?><option value="<?php echo ($ov["cate_id"]); ?>"><?php echo ($ov["cate_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li>   
                    <label>二级分类:</label>
                    <select id='level2' class="dfinput" onchange='getlevel(this,3)'>
                        <option value='0'>请选择</option>
                    </select>
                </li>
                <li>   
                    <label>三级分类:</label>
                    <select id='level3' name='goods_cateid' class="dfinput">
                        <option value='0'>请选择</option>
                    </select>
                </li>
                <li>
                    <label>logo上传</label>
                    <input name="goods_logo" type='file' class="dfinput"  />
                </li>
                <li>
                    <label>开售时间</label>
                    <input name="goods_saletime" type='text' class="dfinput"  />
                </li>
                <li>
                    <label>商品状态</label>
                    <input name="goods_isdel" type='radio' value='上架' checked />上架
                    <input name="goods_isdel" type='radio' value='下架' />下架
                </li>
                <li>
                    <label>商品描述</label>
                    <textarea name="goods_introduce" placeholder="请输入商品描述" cols="" rows="" class="textinput"></textarea>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" type="submit" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
   function getlevel(obj,level){
        var cate_id=$(obj).val();
        $.get("<?php echo U('Attribute/getCate');?>",{'cate_id':cate_id},function(data){
            $('#level'+level).html('');
            data="<option>请选择</option>"+data;
            $('#level'+level).html(data);
        })
   }
   $('#level3').change(function(){
    var cate_id=$(this).val();
    var td=$(this);
    var str='';
    $.ajax({
        'url':"<?php echo U('Attribute/getAttr');?>",
        'data':{'cate_id':cate_id},
        'type':'get',
        'cache':false,
        //定义返回值类型, 先用text能够看清楚返回数据的结构
        'dataType':'json',
        'success':function(msg){
            $.each(msg,function(index,el){
                if(el.attr_type=='手填'){
                    str="<li><label>"+el.attr_name+"</label><input class='dfinput' name=''placeholder='请输入"+el.attr_name+"'/></li>";
                }else{
                    var option='';
                    var arr=el.attr_value.split(',');
                    for(var i=0;i<arr.length;i++){
                        option+="<option>"+arr[i]+"</option>";
                    }
                    str="<li><label>"+el.attr_name+"</label><select class='dfinput'><option value='0'>请选择</option>"+option+"</select><i></i></li>";
                }
                td.parent().after(str);
            });
            
        }
    })
   })
</script>
</html>