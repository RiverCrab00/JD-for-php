<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1><?php echo ($a); echo ($b); ?></h1>
<h1><?php echo U('accept?id='.$a.'&p='.$b);?></h1>
<a href="<?php echo U('accept?id='.$a.'&p='.$b;?>">连接</a>
</body>
</html>