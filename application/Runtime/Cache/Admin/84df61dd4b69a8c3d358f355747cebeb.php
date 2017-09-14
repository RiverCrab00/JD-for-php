<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".click").click(function() {
            $(".tip").fadeIn(200);
        });

        $(".tiptop a").click(function() {
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function() {
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function() {
            $(".tip").fadeOut(100);
        });

    });
    </script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">数据表</a></li>
            <li><a href="#">基本内容</a></li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><span><img src="/Public/Admin/images/t01.png" /></span>添加</li>
                <li><span><img src="/Public/Admin/images/t02.png" /></span>修改</li>
                <li><span><img src="/Public/Admin/images/t03.png" /></span>删除</li>
                <li><span><img src="/Public/Admin/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>编号</th>
                    <th>商品名称</th>
                    <th>商品价格</th>
                    <th>库存数量</th>
                    <th>开售时间</th>
                    <th>商品图片</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($goods_list)): foreach($goods_list as $key=>$ov): ?><tr>
                    <td>
                        <input name="" type="checkbox" value="" />
                    </td>
                    <td><?php echo ($ov["goods_id"]); ?></td>
                    <td><?php echo ($ov["goods_name"]); ?></td>
                    <td><?php echo ($ov["goods_price"]); ?></td>
                    <td><?php echo ($ov["goods_num"]); ?></td>
                    <td><?php echo (date('Y-m-d H-i-s',$ov["goods_saletime"])); ?></td>
                    <td><img src="<?php echo (ltrim($ov["goods_small_logo"],'.')); ?>"></td>
                    <td><a href="<?php echo U('photos','id='.$ov[goods_id]);?>" class="tablelink">相册管理</a> <a href="<?php echo U('delGoods','id='.$ov[goods_id]);?>" class="tablelink" onclick="return confirm('确认删除吗')"> 删除</a></td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div class="pagin">
            <?php echo ($show); ?>
        </div>
        <div class="tip">
            <div class="tiptop"><span>提示信息</span>
                <a></a>
            </div>
            <div class="tipinfo">
                <span><img src="images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button" class="sure" value="确定" />&nbsp;
                <input name="" type="button" class="cancel" value="取消" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
        $('li:contains("添加")').click(function(){
            location.href="<?php echo U('addGoods');?>";
        })
    </script>
</body>

</html>