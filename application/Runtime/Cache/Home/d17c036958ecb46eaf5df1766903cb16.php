<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/cart.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">

	<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/Home/cart/js/cart.js"></script>
	<!-- <script type="text/javascript" src="/Public/Home/js/cart1.js"></script> -->
	
</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<?php if(session('memid') == null ): ?><li>您好，欢迎来到京西！[<a href="<?php echo U('Member/login');?>">登录</a>] &emsp;[<a href="<?php echo U('Member/register');?>">免费注册</a>] </li>
				<?php else: ?>
					<li>您好<?php echo (session('memname')); ?>欢迎来到京西&emsp;[<a href="<?php echo U('Member/logout');?>">退出</a>] </li><?php endif; ?>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="<?php echo U('Index/index');?>"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr">
				<ul>
					<li class="cur">1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	

	

	
	<div style="clear:both;"></div>
	<script type="text/javascript" src="/Public/Home/js/cart2.js"></script>

	<link rel="stylesheet" href="/Public/Home/style/fillin.css" type="text/css">
	
	<div style="clear:both;"></div>
	<!-- 主体部分 start -->
	<form action="<?php echo U('flow3');?>" method="post">
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>

		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
				<div class="address_info">
					<p> <input type="radio" name="order_cgnid" value='1' checked='checked' />王超平  13555555555 北京 昌平区 西三旗 建材城西路金燕龙办公楼一层
					</p>
					<p> <input type="radio" name="order_cgnid" value='2' />韩顺平  135587948555 北京 昌平区 西三旗 建材城西路金燕龙办公楼一层
					</p>
				</div>

				<div class="address_select none">
					<ul>
						<li class="cur">
							<input type="radio" name="address" checked="checked" />王超平 北京市 昌平区 建材城西路金燕龙办公楼一层 13555555555 
							<a href="">设为默认地址</a>
							<a href="">编辑</a>
							<a href="">删除</a>
						</li>
						<li>
							<input type="radio" name="address"  />王超平 湖北省 武汉市  武昌 关山光谷软件园1号201 13333333333
							<a href="">设为默认地址</a>
							<a href="">编辑</a>
							<a href="">删除</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- 收货人信息  end-->

			<!-- 配送方式 start -->
			<div class="delivery">
				<h3>送货方式 </h3>
				<div class="delivery_info">
					<p><input type="radio" name="order_shfs" value="顺丰" checked="checked" />顺丰</p>
					<p><input type="radio" name="order_shfs" value="中通" />中通</p>
					<p><input type="radio" name="order_shfs" value="韵达" />韵达</p>
				</div>			
			</div> 
			<!-- 配送方式 end --> 

			<!-- 支付方式  start-->
			<div class="pay">
				<h3>支付方式 </h3>
				<div class="pay_info">
	<table> 
		<tr class="cur">
			<td class="col1"><input type="radio" name="order_pay" value="支付宝" checked="checked" />支付宝</td>
			<td class="col2">阿里集团的在线支付方式</td>
		</tr>
		<tr>
			<td class="col1"><input type="radio" name="order_pay" value="微信支付" />微信支付</td>
			<td class="col2">腾讯极端的在线支付方式</td>
		</tr>
		<tr>
			<td class="col1"><input type="radio" name="order_pay" value="银行卡" />银行卡</td>
			<td class="col2">使用银联卡支付</td>
		</tr>
	</table>
				</div>

				
			</div>
			<!-- 支付方式  end-->

			<!-- 发票信息 start-->
			<div class="receipt">
				<h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
				<div class="receipt_info">
					<p>个人发票</p>
					<p>内容：明细</p>
				</div>

				<div class="receipt_select none">
					
<ul>
	<li>
		<label for="">发票抬头：</label>
		<input type="radio" name="order_fp_type" value="个人" checked="checked" class="personal" />个人
		<input type="radio" name="order_fp_type" value="单位" class="company"/>单位
		<input type="text" name="order_fp_company" class="txt company_input" disabled="disabled" />
	</li>
	<li>
		<label for="">发票内容：</label>
		<input type="radio" name="order_fp_content" value="明细" checked="checked" />明细
		<input type="radio" name="order_fp_content" value="办公用品" />办公用品
		<input type="radio" name="order_fp_content" value="体育休闲" />体育休闲
		<input type="radio" name="order_fp_content" value="耗材" />耗材
	</li>
</ul>						
					
				</div>
			</div>
			<!-- 发票信息 end-->

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col2">规格</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>	
					</thead>
					<tbody>
					<?php if(is_array($cart_list)): foreach($cart_list as $key=>$vo): ?><tr>
							<td class="col1"><a href=""><img src="<?php echo (ltrim($vo["goods_small_logo"],'.')); ?>" alt="" /></a>  <strong><a href=""><?php echo ($vo["goods_name"]); ?></a></strong></td>
							<td class="col2"> <p><?php echo ($vo["cart_attr"]); ?></p> </td>
							<td class="col3">￥<?php echo ($vo["goods_price"]); ?></td>
							<td class="col4"><?php echo ($vo["cart_num"]); ?></td>
							<td class="col5"><span>￥<?php echo ($vo["total_price"]); ?></span></td>
						</tr>
					</tbody><?php endforeach; endif; ?>
					<tfoot>
						<tr>
							<td colspan="5">
								<ul>
									<li>
										<span><?php echo ($total_num); ?> 件商品，总商品金额：</span>
										<em>￥<?php echo ($total_price); ?></em>
									</li>
									<li>
										<span>返现：</span>
										<em>-￥00.00</em>
									</li>
									<li>
										<span>运费：</span>
										<em>￥00.00</em>
									</li>
									<li>
										<span>应付总额：</span>
										<em>￥<?php echo ($total_price); ?></em>
									</li>
								</ul>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- 商品清单 end -->
		
		</div>

		<div class="fillin_ft">
			<a href="javascript:void(0)" id='submit'><span>提交订单</span></a>
			<p>应付总额：<strong>￥<?php echo ($total_price); ?>元</strong></p>
			
		</div>
	</div>
	</form>
	<!-- 主体部分 end -->
	<div style="clear:both;"></div>
	<script>
		$('#submit').click(function(){
			$('form').submit();
		})
	</script>

<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
</html>