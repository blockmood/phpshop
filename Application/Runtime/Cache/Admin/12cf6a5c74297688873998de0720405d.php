<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<!-- 搜索 -->
<form method="get" action="">
	商品名称:<input type="text" name="gn"><br/>
	价    格:从<input type="text" name="start_price">到<input type="text" name="end_price"><br/>
	是否上架:<input type="radio" name="is_on_sale" value="-1" checked="checked">全部
			 <input type="radio" name="is_on_sale" value="1">是	
			 <input type="radio" name="is_on_sale" value="0">否<br/>
	是否删除:<input type="radio" name="is_delete" value="-1" checked="checked">全部
			 <input type="radio" name="is_delete" value="1">是	
			 <input type="radio" name="is_delete" value="0">否<br/>
	排序:	 <input type="radio" name="odby" value="time_asc" checked="checked">根据添加时间升序
			 <input type="radio" name="odby" value="time_desc">根据添加时间降序
			 <input type="radio" name="odby" value="price_asc">根据价格升序
			 <input type="radio" name="odby" value="price_desc">根据价格降序<br/>
	<input type="submit" value="搜索">	

</form>

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