<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>假删除</title>
</head>
<body>
	<h1>hello world</h1>
	<form action="<?php echo U(user);?>" method="post"> 
	<table border='1px'>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>addate</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($user)): foreach($user as $k=>$ov): if($ov["status"] == 1): ?><tr>
			<td><?php echo ($ov["id"]); ?></td>
			<td><?php echo ($ov["name"]); ?></td>
			<td><?php echo (date("Y-m-d H-i-s",$ov["addate"])); ?></td>
			<td>开启</td> 
			<td><input type='hidden' name='id' value="<?php echo ($ov["id"]); ?>"><input type='submit' value="删除用户"></td>
		</tr><?php endif; endforeach; endif; ?>

	</table>
	<div><?php echo ($show); ?></div>
	</form>
</body>
</html>