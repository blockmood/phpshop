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
    <form name="main_form" method="POST" action="/shop/index.php/Role/edit/id/6.html" enctype="multipart/form-data" >
    	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">角色名称：</td>
                <td>
                    <input  type="text" name="role_name" value="<?php echo $data['role_name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">权限列表：</td>
                <td>
                    <?php foreach($priData as $k => $v) : if(strpos(','.$pri_id.',', ','.$v['id'].',') !== FALSE) $check = 'checked="checked"'; else $check = ''; ?>
                    <?php echo str_repeat('-',8*$v[level]) ?>
                        <input <?php echo ($check); ?> level="<?php echo ($v["level"]); ?>" type="checkbox" name="pri_id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["pri_name"]); ?><br/>
                    <?php endforeach; ?>
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

$(':submit').on('click',function(){
    var num =3;
    $(this).attr('disabled','disabled');
    var _that = $(this);
    setInterval(function(){
      _that.val('还剩'+num+'秒提交');
      if(num-- == 0){
        $('form').eq(0).submit();
      }
    },1000)
})

// 为所有的选择框绑定点击事件
$(":checkbox").click(function(){
    // 先取出当前权限的level值是多少
    var cur_level = $(this).attr("level");
    // 判断是选中还是取消
    if($(this).attr("checked"))
    {
        var tmplevel = cur_level; // 给一个临时的变量后面要进行减操作
        // 先取出这个复选框所有前面的复选框
        var allprev = $(this).prevAll(":checkbox");
        // 循环每一个前面的复选框判断是不是上级的
        $(allprev).each(function(k,v){
            // 判断是不是上级的权限
            if($(v).attr("level") < tmplevel)
            {
                tmplevel--; // 再向上提一级
                $(v).attr("checked", "checked");
            }
        });
        // 所有子权限也选中
        // 先取出这个复选框所有前面的复选框
        var allprev = $(this).nextAll(":checkbox");
        // 循环每一个前面的复选框判断是不是上级的
        $(allprev).each(function(k,v){
            // 判断是不是上级的权限
            if($(v).attr("level") > cur_level)
                $(v).attr("checked", "checked");
            else
                return false;   // 遇到一个平级的权限就停止循环后面的不用再判断了
        });
    }
    else
    {
        // 先取出这个复选框所有前面的复选框
        var allprev = $(this).nextAll(":checkbox");
        // 循环每一个前面的复选框判断是不是上级的
        $(allprev).each(function(k,v){
            // 判断是不是上级的权限
            if($(v).attr("level") > cur_level)
                $(v).removeAttr("checked");
            else
                return false;   // 遇到一个平级的权限就停止循环后面的不用再判断了
        });
    }
});
</script>

<div id="footer">
版权所有
</div>
<script type="text/javascript" charset="utf-8" src="/shop/Public/Admin/js/tran.js"></script>