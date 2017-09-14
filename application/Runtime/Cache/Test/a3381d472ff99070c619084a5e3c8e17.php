<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="<?php echo U('addOk');?>" method="post">
	sname:<input type="text" name="name" /><br>
	sage: <input type="text" name="age" /><br>
	ssex: <input type="text" name="sex" /><br>
	sdept: <input type="text" name="dept"><br>
	<input type="submit" value="提交">
</form>
</body>
</html>