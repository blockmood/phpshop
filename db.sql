USE php34;
SET NAMES utf8;


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


/****************** 商品表 ******************/

#商品分类表
CREATE TABLE IF NOT EXISTS php34_category
(
	id smallint unsigned not null auto_increment,
	cat_name varchar(30) not null comment '分类名称',
	parent_id smallint unsigned not null default '0' comment '上级分类的ID 0:顶级分类',
	primary key(id) 
)engine=MyISAM default charset=utf8;

#商品类型表
DROP TABLE IF EXISTS php34_type;
CREATE TABLE php34_type(
	id tinyint unsigned not null auto_increment,
	type_name varchar(30) not null comment '类型名称',
	primary key(id)
)engine=MyISAM default charset=utf8 comment'商品类型表';

#商品属性表
DROP TABLE IF EXISTS php34_attribute;
CREATE TABLE php34_attribute(
	id mediumint unsigned not null auto_increment,
	attr_name varchar(30) not null comment '属性名称',
	attr_type tinyint unsigned not null default '0' comment '属性的类型 0:唯一  1:可选' ,
	attr_option_values varchar(150) not null default '' comment '属性的可选值',
	type_id tinyint unsigned not null comment '所在类型的ID',
	primary key(id),
	key type_id(type_id)
)engine=MyISAM default charset=utf8 comment'商品属性表';

#商品相册表
DROP TABLE IF EXISTS php34_goods_pris;
CREATE TABLE IF NOT EXISTS php34_goods_pris
(
	id mediumint unsigned not null auto_increment,
	pic varchar(150) not null comment '图片',
	sm_pic varchar(150) not null comment '缩略图',
	goods_id mediumint unsigned not null comment '商品id',
	primary key(id),
	key goods_id(goods_id)
)engine=MyISAM default charset=utf8 comment '商品相册表';


#商品属性中间表
DROP TABLE IF EXISTS php34_goods_attr;
CREATE TABLE php34_attribute(
	id int unsigned not null auto_increment,
	goods_id mediumint unsigned not null comment '商品id',
	attr_id mediumint unsigned not null comment '属性id',
	attr_value varchar(150) not null comment '属性值',
	attr_price decimal(10,2) not null default '0.00' comment '属性的价格',
	primary key(id),
	key goods_id(goods_id),
	key attr_id(attr_id)
)engine=MyISAM default charset=utf8 comment'商品属性中间表';

#商品属库存量
DROP TABLE IF EXISTS php34_goods_attr;
CREATE TABLE php34_attribute(
	id int unsigned not null auto_increment,
	goods_id mediumint unsigned not null comment '商品id',
	goods_number int unsigned not null comment '库存量',
	goods_attr_id varchar(150) not null comment '商品属性id列表',
	primary key(id),
	key goods_id(goods_id)
)engine=MyISAM default charset=utf8 comment'商品属库存量';


#商品表
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


/****************** 会员管理 ******************/

#会员级别表
DROP TABLE IF EXISTS php34_member_level;
CREATE TABLE php34_member_level(
	id mediumint unsigned not null auto_increment,
	level_name varchar(30) not null comment '级别名称',
	bottom_num int unsigned not null comment '积分下限',
	top_num int unsigned not null comment '积分上限',
	primary key(id)
)engine=MyISAM default charset=utf8 comment'会员级别表';

#会员价格表
DROP TABLE IF EXISTS php34_member_price;
CREATE TABLE IF NOT EXISTS php34_member_price
(
	goods_id mediumint unsigned not null comment '商品的id',
	level_id mediumint unsigned not null comment '级别id',
	price decimal(10,2) not null comment '级别价格',
	key goods_id(goods_id),
	key level_id(level_id)
)engine=MyISAM default charset=utf8;

