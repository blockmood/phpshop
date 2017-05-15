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

<div class="form-div">
    <form method="get" action="">
    <input type="hidden" name="p" value="1">
    商品名称:<input type="text" name="goods_name" value="<?php echo I('get.goods_name') ?>"><br/>
    价  &nbsp;&nbsp;  格:从<input type="text" name="start_price" value="<?php  echo I('get.start_price')?>">到<input type="text" name="end_price" value="<?php echo I('get.end_price') ?>"><br/>

    时  &nbsp;&nbsp;  间:从<input type="text" name="start_addtime" id="st" value="<?php  echo I('get.start_addtime')?>">到<input type="text" id="stl" name="end_addtime" value="<?php echo I('get.end_addtime') ?>"><br/>
    是否上架:<input type="radio" name="is_on_sale" value="-1"/ <?php if(I('get.is_on_sale',-1) == -1) echo 'checked="checked"' ?> />全部

             <input type="radio" name="is_on_sale" value="1" <?php if(I('get.is_on_sale',-1) == 1) echo 'checked="checked"' ?> />是  
             <input type="radio" name="is_on_sale" value="0" <?php if(I('get.is_on_sale',-1) == 0) echo 'checked="checked"' ?> />否<br/>
    是否删除:<input type="radio" name="is_delete" value="-1" <?php if(I('get.is_delete',-1) == -1) echo 'checked="checked"' ?> />全部
             <input type="radio" name="is_delete" value="1" <?php if(I('get.is_delete',-1) == 1) echo 'checked="checked"' ?> />是    
             <input type="radio" name="is_delete" value="0" <?php if(I('get.is_delete',-1) == 0) echo 'checked="checked"' ?> />否<br/>
    排序方式:<input onclick="parentNode.submit();" type="radio" name="order" value="id_asc" <?php if(I('get.order',id_asc) == 'id_asc') echo 'checked="checked"' ?> />根据ID升序
             <input onclick="parentNode.submit();" type="radio" name="order" value="id_desc" <?php if(I('get.order') == 'id_desc') echo 'checked="checked"' ?> />根据ID降序
             <input onclick="parentNode.submit();" type="radio" name="order" value="price_asc" <?php if(I('get.order') == 'price_asc') echo 'checked="checked"' ?> />根据价格升序
             <input onclick="parentNode.submit();" type="radio" name="order" value="price_desc" <?php if(I('get.order') == 'price_desc') echo 'checked="checked"' ?> />根据价格降序<br/>
    <input type="submit" value="搜索">    

</form>
</div>
<style>
    .img{
        width: 60px;
        height: 60px;
        display: inline;;
        margin:0 auto;
        margin-top: 4px;
    }
    .num{
        display: block;
        width: 19px;
        height: 19px;
        line-height: 20px;
        text-align: center;
        float: left;
        border:1px solid #ccc;
        margin-left: 5px;
    }
    .current{
        float: left;
         width: 19px;
        height: 19px;
        line-height: 20px;
        text-align: center;
        color: red;
        border:1px solid red;
        margin-left: 5px;
    }
    .prev,.next{
        float: left;
        display: inline;
        width: 30px;
        height: 19px;
        line-height: 20px;
        margin-left: 5px;
        /*padding-top: 5px;*/
    }
    .prev{
        margin-right: 5px;
    }
</style>
<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
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
            <tr style="text-align: center;">
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["goods_name"]); ?></td>
                <td><?php showImg($v['sm_logo'],50) ?></td>
                <td><?php echo ($v["price"]); ?></td>
                <td><?php echo ($v["goods_desc"]); ?></td>
                <td><?php echo $v['is_on_sale'] == 1 ? '上架' :'下架' ?></td>
                <td><?php echo $v['is_delete'] == 1 ? '已删除' :'未删除' ?></td>
                <td><?php echo date('Y-m-d',$v['addtime']) ?></td>
                <td>
                <a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p'),1) ?>">修改</a> 
                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p',1)) ?>" onclick="return confirm('确定要删除吗？')" >删除</a></td>
            </tr>
            <?php endforeach; ?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo ($page); ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
</form>


</body>
</html>
<script type="text/javascript">
    $("#st").datepicker({ dateFormat: "yy-mm-dd" });
    $("#stl").datepicker({ dateFormat: "yy-mm-dd" });
</script>

<div id="footer">
版权所有
</div>