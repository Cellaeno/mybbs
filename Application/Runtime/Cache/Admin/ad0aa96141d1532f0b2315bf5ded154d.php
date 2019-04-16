<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/> -->
    <script type="text/javascript" src="/Public/Admin/js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="http://www.mycodes.net/" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
        <?php
 $uid = $_GET['uid']; ?>
            <ul class="top-info-list clearfix">
                <li><a href="/<?= $_SESSION['userinfo']['uface'] ?>" target="_block"><img src="/<?= getSm($_SESSION['userinfo']['uface']) ?>" alt="" style="height:45px;box-shadow: 0 0 0 1px white;vertical-align: middle;margin-bottom:3px;"></a></li>
                <li><a href="#"><?= $_SESSION['userinfo']['uname'] ?></a></li>
                <li><a href="/index.php?m=admin&c=login&a=edit">修改密码</a></li>
                <li><a href="/index.php?m=admin&c=login&a=logout">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>用户管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=user&a=create"><i class="icon-font">&#xe008;</i>添加用户</a></li>
                        <li><a href="/index.php?m=admin&c=user&a=index"><i class="icon-font">&#xe005;</i>查看用户</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>分区管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=part&a=create"><i class="icon-font">&#xe017;</i>添加分区</a></li>
                        <li><a href="/index.php?m=admin&c=part&a=index"><i class="icon-font">&#xe037;</i>查看分区</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>板块管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=cate&a=create"><i class="icon-font">&#xe017;</i>添加板块</a></li>
                        <li><a href="/index.php?m=admin&c=cate&a=index"><i class="icon-font">&#xe037;</i>查看板块</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>帖子管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=post&a=index"><i class="icon-font">&#xe037;</i>查看帖子</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->

    <!--内容部分start-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="content" style="margin:10px 0 0 10px;">           
            <form action="/index.php?m=admin&c=post&a=update" method="post">
                <input type="hidden" name="pid" value="<?php echo ($post['pid']); ?>">
                <table height="60">
                    <tr>
                        <th><label>标题 : </label></th>
                        <td><input type="text" name="title" size="50" value="<?php echo ($post['title']); ?>"></td>
                    </tr>
                    <tr>
                        <th><label>内容 ： </label></th>
                        <td><textarea name="content" rows="12" cols="80"><?php echo ($post['content']); ?></textarea></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                            <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                        </td>
                    </tr>  
                </table>
            </form>
                
        </div>
        <!--内容部分end-->
    </div>
    

</div>
</body>
</html>