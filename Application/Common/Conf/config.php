<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'php34',
	'DB_USER'=>'root',
	'DB_PWD'=>'root',
	'DB_PREFIX'=>'php34_',
	'DB_CHARSET'=>'utf8',
	'DB_PORT'=>'3306',

	/****** 图片相关配置 ********/
	'IMG_maxSize' => '3M',
	'IMG_exit' => array('jpg', 'gif', 'png', 'jpeg'),
	'IMG_rootPath' =>'./Uploads/',

	/****** 修改过滤机制 ********/
	'DEFAULT_FILTER'   =>  'trim,removeXSS',

	/****** md5加密 ************/
	'md5_key' => 'trds@!#sdrtrfd',
);