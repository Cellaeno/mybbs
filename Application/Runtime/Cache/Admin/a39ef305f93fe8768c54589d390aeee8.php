<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>『豪情』后台管理</title>
    <link href="Public/Admin/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>修改密码</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="/index.php?m=admin&c=login&a=updatepwd" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="uname" value="<?= $user['uname'] ?>" id="user" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="upwd">原密码：</label>
                        <input type="password" name="upwd" value="" autofocus id="pwd" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">新密码：</label>
                        <input type="password" name="newpwd" value="" autofocus id="pwd" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">确认密码：</label>
                        <input type="password" name="repwd" value="" id="pwd" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="http://www.mycodes.net/" target="_blank">返回首页</a> &copy; 2014 Powered by <a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
</div>
</body>
</html>