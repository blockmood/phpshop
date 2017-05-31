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

<div class="main-div">
    <form name="main_form" method="POST" action="/shop/index.php/Admin/admin/add.html" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">账号：</td>
                <td>
                    <input  type="text" name="username" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">密码：</td>
                <td>
                    <input type="password" size="25" name="password" />
                </td>
            </tr>
            <tr>
                <td class="label">确认密码：</td>
                <td>
                    <input type="password" size="25" name="cpassword" />
                </td>
            </tr>
            <tr>
                <td class="label">所属角色</td>
                <td>
                    <?php foreach($roleData as $k=>$v) : ?>
                    <input  type="checkbox" name="role_id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["role_name"]); ?>
                <?php  endforeach ?> 
                </td>
            </tr>
            <tr>
                <td class="label">是否启用 1:启用 0 禁用：</td>
                <td>
                	<input type="radio" name="is_use" value="1" checked="checked" />启用 
                	<input type="radio" name="is_use" value="0"  />禁用 
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
</script>

<div id="footer">
版权所有
</div>
<script type="text/javascript" charset="utf-8" src="/shop/Public/Admin/js/tran.js"></script>