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
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>属性名称</label>
                    <input name="cate_name" placeholder="请输入属性名称" type="text" class="dfinput" />
                </li>
                <li>
                    <label>父类别</label>
                    <select name="cate_pid" class="dfinput">
                        <option value="0">--请选择--</option>
                        <?php if(is_array($cate_list)): foreach($cate_list as $key=>$vo): ?><option value="<?php echo ($vo["cate_id"]); ?>">
                            <?php echo (str_repeat('&emsp;',$vo["level"])); echo ($vo["cate_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <i></i>
                </li>
                <li>
                    <label>单/多选属性</label>
                    <cite>
                    <input type="radio" name="attr_sel" value="0" checked="checked">唯一&emsp;
                    <input type="radio" name="attr_sel" value="1">单选
                    </cite>
                </li>
                <li>
                    <label>值录入方式</label>
                    <cite>
                    <input type="radio" name="attr_write" value="0" checked="checked">手动录入&emsp;
                    <input type="radio" name="attr_write" value="1">从下方选择
                    </cite>
                </li>
                <li>
                    <label>可选值</label>
                    <textarea name="attr_vals" placeholder="请输入可选值，多个值之间请使用英文“,”分隔开" class="textinput"></textarea>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" rows='5' cols='20' type="button" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
//jQuery代码
$(function(){
    //给btnsubmit绑定点击事件
    $('#btnSubmit').on('click',function(){
        //表单提交
        $('form').submit();
    });

});
</script>
</html>