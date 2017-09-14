<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>网页标题</title>
	<meta name="keywords" content="关键字列表" />
	<meta name="description" content="网页描述" />
	<link rel="stylesheet" type="text/css" href="" />
	<style type="text/css"></style>
	<script type="text/javascript"></script>
</head>
<body>

	<?php echo (C("URL_MODEL")); ?><br>
	<?php echo (C("DEFAULT_MODULE")); ?><br>
	<?php echo (CONTROLLER_NAME); ?><br>
	<?php echo (PHP_VERSION); ?><br>
	<?php echo ($_GET['id']); ?><br>
	<?php echo ($_GET['name']); ?><br>
	<?php echo ($_SERVER['SCRIPT_NAME']); ?><br>
	<?php echo (date('Y-m-d H-i-s',$str)); ?>
</body>
</html>