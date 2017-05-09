<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/shop/Public/datepicker/jquery-ui-1.9.2.custom.min.css">
	<script src="/shop/Public/datepicker/jquery-1.7.2.min.js"></script>
	<script src="/shop/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
</head>
<body>

<!-- 搜索 -->
<form method="get" action="">
	<input type="hidden" name="p" value="1">
	商品名称:<input type="text" name="goods_name" value="<?php echo I('get.goods_name') ?>"><br/>
	价    格:从<input type="text" name="start_price" value="<?php  echo I('get.start_price')?>">到<input type="text" name="end_price" value="<?php echo I('get.end_price') ?>"><br/>
	时    间:从<input type="text" name="start_addtime" id="st" value="<?php  echo I('get.start_addtime')?>">到<input type="text" id="stl" name="end_addtime" value="<?php echo I('get.end_addtime') ?>"><br/>
	是否上架:<input type="radio" name="is_on_sale" value="-1"/ <?php if(I('get.is_on_sale',-1) == -1) echo 'checked="checked"' ?> />dd
			 <input type="radio" name="is_on_sale" value="1" <?php if(I('get.is_on_sale',-1) == 1) echo 'checked="checked"' ?> />是	
			 <input type="radio" name="is_on_sale" value="0" <?php if(I('get.is_on_sale',-1) == 0) echo 'checked="checked"' ?> />否<br/>
	是否删除:<input type="radio" name="is_delete" value="-1" <?php if(I('get.is_delete',-1) == -1) echo 'checked="checked"' ?> />全部
			 <input type="radio" name="is_delete" value="1" <?php if(I('get.is_delete',-1) == 1) echo 'checked="checked"' ?> />是	
			 <input type="radio" name="is_delete" value="0" <?php if(I('get.is_delete',-1) == 0) echo 'checked="checked"' ?> />否<br/>
	排序:	 <input onclick="parentNode.submit();" type="radio" name="order" value="id_asc" <?php if(I('get.order',id_asc) == 'id_asc') echo 'checked="checked"' ?> />根据ID升序
			 <input onclick="parentNode.submit();" type="radio" name="order" value="id_desc" <?php if(I('get.order') == 'id_desc') echo 'checked="checked"' ?> />根据ID降序
			 <input onclick="parentNode.submit();" type="radio" name="order" value="price_asc" <?php if(I('get.order') == 'price_asc') echo 'checked="checked"' ?> />根据价格升序
			 <input onclick="parentNode.submit();" type="radio" name="order" value="price_desc" <?php if(I('get.order') == 'price_desc') echo 'checked="checked"' ?> />根据价格降序<br/>
	<input type="submit" value="搜索">	

</form>
<a href="<?php echo U('add') ?>">添加新商品</a>
	<table width="100%" cellpadding="5" cellspacing="5" border="1">
		<tr>
			<th>id</th>
			<th>商品名称</th>
			<th>logo</th>
			<th>价格</th>
			<th>描述</th>
			<th>是否上架</th>
			<th>是否删除</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
		<?php foreach($data as $k=>$v): ?>
		<tr>
			<td><?php echo ($v["id"]); ?></td>
			<td><?php echo ($v["goods_name"]); ?></td>
			<td><img src="/shop/Uploads/<?php echo ($v["sm_logo"]); ?>"></td>
			<td><?php echo ($v["price"]); ?></td>
			<td><?php echo ($v["goods_desc"]); ?></td>
			<td><?php echo $v['is_on_sale'] == 1 ? '上架' :'下架' ?></td>
			<td><?php echo $v['is_delete'] == 1 ? '已删除' :'未删除' ?></td>
			<td><?php echo date('Y-m-d',$v['addtime']) ?></td>
			<td>修改  删除</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="9"><?php echo ($page); ?></td>
		</tr>
	</table>
</body>
</html>
<script type="text/javascript">
	$("#st").datepicker({ dateFormat: "yy-mm-dd" });
	$("#stl").datepicker({ dateFormat: "yy-mm-dd" });
</script>