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

        <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/index.php?m=admin&c=post&a=index" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">板块:</th>
                            <td>
                                <select name="cid" id="">
                                    <option value="">全部</option>
                                    <?php foreach ($cates as $k=>$cate): ?>
                                    <option value="<?php echo ($k); ?>"><?php echo ($cates[$k]); ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <th width="70">标题:</th>
                            <td><input class="common-text" name="title" value="" id="" type="text"></td>
                            <th width="70">发帖人:</th>
                            <td><input class="common-text" name="uname" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="insert.html"><i class="icon-font"></i>新增作品</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>编号</th>
                            <th>标题</th>
                            <!-- <th>内容</th> -->
                            <th>版主</th>
                            <th>板块</th>
                            <th>回复/查看</th>
                            <th>发布时间</th>
                            <th>最后回复时间</th>
                            <th>操作</th>
                        </tr>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td class="tc"><input name="id[]" value="58" type="checkbox"></td>
                            <td><?php echo ($post['pid']); ?></td>
                            <td><?php echo ($post['title']); ?></td>
                            <!-- <td><?php echo ($post['content']); ?></td> -->
                            <td><?php echo ($users[$post['uid']]); ?></td>
                            <td><?php echo ($cates[$post['cid']]); ?></td>
                            <td><?php echo ($post['rep_cnt']); ?>/<?php echo ($post['rep_cnt']); ?></td>
                            <td><?= date('Y-m-d H:i:s',$post['created_at']) ?></td>
                            <td><?= date('Y-m-d H:i:s',$post['updated_at']) ?></td>
                            <td>
                                <a href="/index.php?m=admin&c=post&a=edit&pid=<?=$post['pid']?>">修改 | </a>
                                <a href="/index.php?m=admin&c=post&a=del&pid=<?=$post['pid']?>">删除 | </a>

                                <?php if ($post['is_jing']): ?>
                                    <a href="/index.php?m=admin&c=post&a=not_jing&pid=<?=$post['pid']?>">加精 | </a>
                                <?php else: ?>
                                    <a href="/index.php?m=admin&c=post&a=is_jing&pid=<?=$post['pid']?>">取消加精 | </a>
                                <?php endif ?>

                                <?php if ($post['is_top']): ?>
                                    <a href="/index.php?m=admin&c=post&a=not_top&pid=<?=$post['pid']?>">取消置顶 | </a>
                                <?php else: ?>
                                    <a href="/index.php?m=admin&c=post&a=is_top&pid=<?=$post['pid']?>">置顶 | </a>
                                <?php endif ?>

                                <?php if ($post['is_display']): ?>
                                    <a href="/index.php?m=admin&c=post&a=not_display&pid=<?=$post['pid']?>">隐藏 | </a>
                                <?php else: ?>
                                    <a href="/index.php?m=admin&c=post&a=is_display&pid=<?=$post['pid']?>">显示 | </a>
                                <?php endif ?>

                                <a href="/index.php?m=admin&c=reply&a=index&pid=<?=$post['pid']?>">查看回复</a>
                            </td>
                        </tr>
                    <?php endforeach ?>                       
                    </table>
                    <div class="list-page"> 2 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->

</div>
</body>
</html>