<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/shop/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/shop/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script src="/shop/Public/datepicker/jquery-1.7.2.min.js"></script>
</head>
<body style="background: #278296;color:white">
<form method="post" id="a" action="/shop/index.php/Admin/admin/login.html" onsubmit="return validate()">
    <table cellspacing="0" cellpadding="0" style="margin-top:100px" align="center">
        <tr>
            <td>
                <img src="/shop/Public/Admin/Images/login.png" width="178" height="256" border="0" alt="ECSHOP" />
            </td>
            <td style="padding-left: 50px">
                <table>
                    <tr>
                        <td id="info" style="color:red;display: none;font-size: 20px;">11</td>
                    </tr>
                    <tr>
                        <td>管理员姓名：</td>
                        <td>
                            <input type="text" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td>管理员密码：</td>
                        <td>
                            <input type="password" name="password" />
                        </td>
                    </tr>
                    <tr>
                        <td>验证码：</td>
                        <td>
                            <input type="text" name="checkcode" class="capital" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <img src="<?php  echo U('checkcode') ?>" onclick='this.src="<?php  echo U('checkcode') ?>#"+Math.random();' />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="进入管理中心" class="button" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
</body>
<script type="text/javascript">

   $('form').eq(0).submit(function(){
        $.ajax({
            type:'post',
            url: "/shop/index.php/Admin/admin/login.html",
            data:$(this).serialize(),
            dataType:'json',
            success:function(data){
                if(data.status != 0){
                    location.href = '/shop/index.php/Admin/index/index'
                }else{
                    $('#info').show();
                    $('#info').html(data.info);
                }
            }
        })

        return false;
   });

</script>