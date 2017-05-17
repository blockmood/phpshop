<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>商品管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/shop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/shop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/shop/Public/datepicker/jquery-ui-1.9.2.custom.min.css">
<script src="/shop/Public/datepicker/jquery-1.7.2.min.js"></script>
<script src="/shop/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/lang/zh-cn/zh-cn.js"></script>



</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo $_page_btn_link ?>"><?php echo $_page_btn_name ?></a></span>
    <span class="action-span1"><a href="__GROUP__">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title ?> </span>
    <div style="clear:both"></div>
</h1>


<!-- 页面中的内容 -->

<form name="main_form" method="POST" action="/shop/index.php/Goods/add.html" enctype="multipart/form-data">
	商品名称:<input type="text" name="goods_name" /><br />
	商品价格:<input type="text" name="price" /><br />
	商品logo:<input type="file" name="logo"><br/>
	商品描述:<textarea id="sub_goods_name"  name="goods_desc"></textarea><br />
	是否上架:
	<input type="radio" name="is_on_sale" value="1" checked="checked" />上架
	<input type="radio" name="is_on_sale" value="0" />下架

	<br />
	<input type="submit" value="提交" />
</form>

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

<div id="footer">
版权所有
</div>
<script type="text/javascript" charset="utf-8" src="/shop/Public/Admin/js/tran.js"></script>