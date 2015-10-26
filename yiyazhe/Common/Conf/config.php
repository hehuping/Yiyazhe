<?php
return array (
		
		// '配置项'=>'配置值'
		
		'LAYOUT_ON' => false,
		'URL_MODEL' => '2',           // URL模式
		'SESSION_AUTO_START' => true, // 是否开启session
		'DB_TYPE' => 'mysql',
		'DB_HOST' => 'localhost',     // 服务器地址
		'DB_NAME' => 'yiyazhe',       // 数据库名
		'DB_USER' => 'vps',          // 用户名
		'DB_PWD' => '',               // 密码
		'DB_PORT' => '3306',          // 端口
		'DB_PREFIX' => '',            // 数据库表前缀
		'db_charset' => 'utf8',
		
		// 设置禁止访问的模块列表
		'MODULE_DENY_LIST' => array (
				'Common',
				'Runtime',
				'Api' 
		),
		
		// 设置允许访问的模块
		'MODULE_ALLOW_LIST' => array (
				'Home',
				'Admin'
		),
		
		// 设置默认模块
		'DEFAULT_MODULE' => 'Home',
		
		// 多个伪静态后缀设置 用|分割
        'URL_HTML_SUFFIX' => 'html|shtml|xml|htm' ,
);