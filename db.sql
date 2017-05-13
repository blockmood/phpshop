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




DROP TABLE IF EXISTS php34_admin;
CREATE TABLE php34_admin(
	id tinyint unsigned not null auto_increment,
	username varchar(30) not null comment '账号',
	password char(32) not null comment '密码',
	is_use tinyint unsigned not null default '1' comment '是否启用 1:启用 0 禁用',
	primary key(id) 
)engine=MyISAM default charset=utf8;

INSERT INTO php34_admin VALUES(1,'root','902046d5b1a5c0b4cd9cb149f8276962',1);










