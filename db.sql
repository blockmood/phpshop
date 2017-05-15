USE php34;
SET NAMES utf8;

CREATE TABLE IF NOT EXISTS php34_goods
(
	id mediumint unsigned not null auto_increment,
	goods_name varchar(45) not null comment '商品名称',
	logo varchar(150) not null default '' comment '商品logo',
	sm_logo varchar(150) not null default '' comment '商品缩略图logo',
	price decimal(10,2) not null default '0.00' comment '商品价格',
	goods_desc longtext comment '商品描述',
	is_on_sale tinyint unsigned not null default '1' comment '是否上架：1：上架，0：下架',
	is_delete tinyint unsigned not null default '0' comment '是否已经删除，1：已经删除 0：未删除',
	addtime int unsigned not null comment '添加时间',
	primary key (id),
	key price(price),
	key is_on_sale(is_on_sale),
	key is_delete(is_delete),
	key addtime(addtime)
)engine=MyISAM default charset=utf8;


CREATE TABLE IF NOT EXISTS php34_category
(
	id smallint unsigned not null auto_increment,
	cat_name varchar(30) not null comment '分类名称',
	parent_id smallint unsigned not null default '0' comment '上级分类的ID 0:顶级分类',
	primary key(id) 
)engine=MyISAM default charset=utf8;


/****************** RBAC ******************/
#管理员表
DROP TABLE IF EXISTS php34_admin;
CREATE TABLE php34_admin(
	id tinyint unsigned not null auto_increment,
	username varchar(30) not null comment '账号',
	password char(32) not null comment '密码',
	is_use tinyint unsigned not null default '1' comment '是否启用 1:启用 0 禁用',
	primary key(id) 
)engine=MyISAM default charset=utf8 comment '管理员表';

INSERT INTO php34_admin VALUES(1,'root','902046d5b1a5c0b4cd9cb149f8276962',1);

#多对多关系 管理员角色表
DROP TABLE IF EXISTS php34_admin_role;
CREATE TABLE php34_admin_role(
	admin_id smallint unsigned not null comment '管理员ID',
	role_id smallint unsigned not null comment '角色ID',
	key admin_id(admin_id),
	key role_id(role_id)
)engine=MyISAM default charset=utf8 comment'管理员角色表';


#权限表
DROP TABLE IF EXISTS php34_privilege;
CREATE TABLE php34_privilege(
	id smallint unsigned not null auto_increment,
	pri_name varchar(30) not null comment '权限名称',
	module_name varchar(10) not null comment '模块名称',
	controller_name varchar(10) not null comment '控制器名称',
	action_name varchar(10) not null comment '方法名称',
	parent_id smallint unsigned not null default '0' comment '上级权限ID 0:顶级权限',
	primary key(id) 
)engine=MyISAM default charset=utf8 comment'权限表';

#角色表
DROP TABLE IF EXISTS php34_role;
CREATE TABLE php34_role(
	id smallint unsigned not null auto_increment,
	role_name varchar(30) not null comment '角色名称',
	primary key(id) 
)engine=MyISAM default charset=utf8 comment'角色表';

#多对多关系 角色权限表
DROP TABLE IF EXISTS php34_role_privilege;
CREATE TABLE php34_role_privilege(
	pri_id smallint unsigned not null comment '权限ID',
	role_id smallint unsigned not null comment '角色ID',
	key pri_id(pri_id),
	key role_id(role_id)
)engine=MyISAM default charset=utf8 comment'角色权限表';




