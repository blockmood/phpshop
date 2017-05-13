<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<script src="/shop/Public/datepicker/jquery-1.7.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/shop/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<body>
<form name="main_form" method="POST" action="/shop/index.php/Admin/Goods/add" enctype="multipart/form-data">
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

<a href="<?php echo U('lst') ?>">列表页</a>

</body>
</html>

<script type="text/javascript">
	UE.getEditor('sub_goods_name', {
		"initialFrameWidth" : "100%",
		"initialFrameHeight" : 280,
		"maximumWords" : 150,
		// "toolbars" : btn_basic
	});


	//ajax
	$("form").eq(0).submit(function(){
		$.ajax({
			type:"post",
			url:"/shop/index.php/Admin/Goods/add",
			data:$( this ).serialize(),
			dataType:"json",
			success:function(data){
				//判断添加是否成功
				if(data.status == 1){
					location.href = data.url;
				}else{
					alert(data.info);
				}
			}
		})

		return false;
	});


</script>