<?php
return array(
	// //定义url模式
	'URL_MODEL'=>2,
	// //开启trace
	// 'SHOW_PAGE_TRACE'=>true,
	// //修改默认配置
	// 'DEFAULT_MODULE'=>'Admin',
	// 'DEFAULT_CONTROLLER'=>'User',
	// 'DEFAULT_ACTION'=>'show',
	'TMPL_PARSE_STRING'=>array(
		'__ADMIN__'=>'/Public/Admin',
		'__HOME__'=>'/Public/Home',
		'__COMMON__'=>'/Public/Common',
	),
	//设置I方法的
	'DEFAULT_FILTER'=>'filterXSS',

	'DB_TYPE'   =>  'mysql',     // 数据库类型
	'DB_HOST'   =>  'localhost', // 服务器地址
	'DB_NAME'   =>  'itshop',          // 数据库名
	'DB_USER'   =>  'root',      // 用户名
	'DB_PWD'    =>  'root',          // 密码
	'DB_PORT'   =>  '3306',        // 端口
	'DB_PREFIX' =>  'sp_',    // 数据库表前缀
	//'DB_PARAMS' =>  array(), // 数据库连接参数    
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 
);