<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<body>
<form method="POST" action="/shop/index.php/Admin/Goods/add.html" enctype="multipart/form-data">
	商品名称:<input type="text" name="goods_name" /><br />
	商品价格:<input type="text" name="price" /><br />
	商品描述:<textarea id="sub_goods_name"  name="goods_desc"></textarea><br />
	商品logo:<input type="file" name="logo"><br/>
	是否上架:
	<input type="radio" name="is_on_sale" value="1" checked="checked" />上架
	<input type="radio" name="is_on_sale" value="0" />下架

	<br />
	<input type="submit" value="提交" />
</form>
<<<<<<< HEAD
<a href="<?php echo U('lst') ?>">列表页</a>
=======
<a href="<?php echo U('lst') ?>">列表</a>
>>>>>>> 59b3f13f6c190f0a46817c0b59ccbcb3cfb39737
</body>
</html>

<script type="text/javascript">
	UE.getEditor('sub_goods_name', {
		"initialFrameWidth" : "100%",
		"initialFrameHeight" : 280,
		"maximumWords" : 150,
		// "toolbars" : btn_basic
	});
</script>