<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="/Public/Common/Ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/Public/Common/Ueditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Common/Ueditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Common/Ueditor/umeditor.min.js"></script>
    <script type="text/javascript" src="/Public/Common/Ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
	<textarea id='content'style='width: 500px;height: 300px'></textarea>
</body>
<script type="text/javascript">
var um=UM.getEditor('content');
</script>
</html>