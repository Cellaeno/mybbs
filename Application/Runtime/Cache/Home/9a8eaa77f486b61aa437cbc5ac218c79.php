<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>这是一个神奇的网站</title>
  <meta name="keywords" content="论坛,PHP">
  <meta name="description" content="最大的社区网站">
  <meta http-equiv="X-UA-Compatible" content="IE=8">
  <link rel="stylesheet" type="text/css" href="./Public/Home/css/style_1_common.css?gQK" /> 
  <link rel="stylesheet" type="text/css" href="./Public/Home/css/style_1_forum_viewthread.css?gQK" /> 
  <link rel="stylesheet" type="text/css" href="./Public/Home/css/layout.css">
  <link rel="stylesheet" type="text/css" href="./Public/Home/css/css.css">
</head>
<body>
<!--网页顶部start-->
  <div id="top">
    <div id="top_main">
      <span class="top_content_left">设为主页</span>
      <span class="top_content_left">收藏本站</span>
      <span class="top_content_right">切换到宽版</span>
    </div>
  </div>
<!--网页顶部end-->
 
  <!--网页主体部分start-->
  <div id="main">
  
    <!--网页顶部广告部分start-->
    <div id="banner"></div>
    <!--网页顶部广告部分end-->
    
    <!--网页头部start-->
    <div id="header">
    
      <!--logo、登陆部分start-->
      <div id="logo_login">
      
      <!--logo部分start-->
      <div id="logo"></div>
      <!--logo部分end-->
        
      <!--登陆部分start-->
      <div id="login">
        <form action="/index.php?m=home&c=login&a=dologin" method="post">
        <?php if (empty($_SESSION['flag'])): ?>
          <table>
            <tr>
              <td>
              <label>帐号</label>
              </td>
              <td>
              <input type="text" name="uname" />
              </td>
              <td width="80px">
              <label><input type="checkbox" name="remember" />自动登录</label>
              </td>
              <td>
              找回密码
              </td>
            </tr>
            <tr>
              <td>
              <label>密码</label>
              </td>
              <td>
              <input type="password" name="upwd" />
              </td>
              <td>
              <input type="submit" value="立即登录" />
              </td>
              <td>
              <a href="/index.php?m=home&c=login&a=register">立即注册</a>
              </td>
            </tr>
          </table>
        <?php else: ?>
          <span style="display:block;float:right;margin-right:10px;margin-top:40px;font-size:14px;">
            <span>当前用户: 
                <a href="/index.php?m=home&c=user&a=personal&uid=<?= $_SESSION['userinfo']['uid'] ?>" style="font-size:16px;margin-right:10px;font-weight:bold;"> <?= $_SESSION['userinfo']['uname'] ?>
                </a>
            </span>
            <?php if ($_SESSION['userinfo']['auth'] < 3): ?>
              <a href="/index.php?m=admin&c=login&a=login"> 登录后台 </a>
            <?php endif ?>
            <a href="/index.php?m=home&c=login&a=logout"> 退出 </a>
          </span>
        <?php endif ?> 
        </form>
      </div>
      <!--登陆部分end-->
      
      </div>
      <!--logo、登陆部分end-->
      
      <!--菜单部分start-->
      <div id="menu">
      <ul>
        <li><a href="#">论坛</a></li>
        <li class="line"></li>
        <li><a href="">论坛</a></li>
        <li class="line"></li>
        <li><a href="">论坛</a></li>
        <li class="line"></li>
        <li><a href="">论坛</a></li>
        <li class="line"></li>
      </ul>
      </div>
      <!--菜单部分end-->
      
      <!--搜索部分start-->
      <div id="search">
        <table cellpadding="0" cellspacing="0">
          <tr>
          <td class="search_ico"></td>
          <td class="search_input">
            <input type="text" name="search" x-webkit-speech speech placeholder="请输入搜索内容" />
          </td>
          <td class="search_select">
            <a href="">帖子</a>
            <span class="select"></span>
          </td>
          <td class="search_btn">
            <button>搜索</button>
          </td>
          <td class="search_hot">
            <div>
            <strong>热搜:</strong>
            <a href="">交友</a>
            <a href="">教育</a>
            <a href="">幽默</a>
            <a href="">搞笑</a>
            <a href="">房产</a>
            <a href="">购物</a>
            <a href="">二手</a>
            <a href="">衣服</a>
            <a href="">鞋子</a>
            <a href="">帮助</a>
            <a href="">折扣</a>
            <a href="">电影</a>
            </div>
          </td>
          </tr>
        </table>
      </div>
      <!--搜索部分end-->
      
      <!--小提示部分start-->
      <div id="tip">
      
        <!--路径部分start-->
        <div id="path">
          <a href="" class="index"></a>
          <em></em>
          <a href="" class="path_menu">论坛</a>
        </div>
        <!--路径部分end-->
        
        <!--统计部分start-->
        <div id="count">
          今日: <em>1520</em>
          <span class="pipe">|</span>
          昨日: <em>1520</em>
          <span class="pipe">|</span>
          帖子: <em>1520</em>
          <span class="pipe">|</span>
          会员: <em>1520</em>
          <span class="pipe">|</span>
          欢迎新会员: <em><a href="">1520</a></em>
        </div>
        <!--统计部分end-->
        
      </div>
      <!--小提示部分end-->
      
    </div>
    <!--网页头部end-->
    <!--内容部分start-->
    <div class="content">           
        <form action="/index.php?m=home&c=post&a=save&cid=<?= $cid ?>" method="post">
            <table height="60">
                <tr>
                    <td><label>所属板块:</label></td>
                    <td>
                        <select name="cid" id="">
                        <?php foreach ($cates as $cate): ?>
                            <option value="<?php echo ($cate['cid']); ?>" <?php if($cate['cid'] == $cid){echo 'selected';} ?> > <?= $cate['cname'] ?> </option>
                        <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>标题:</label></td>
                    <td><input type="text" name="title" size="50"></td>
                </tr>
                <tr>
                    <td><label>内容：</label></td>
                    <td><textarea name="content" rows="12" cols="80"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="发贴" style="width:100px;height:30px;"></td>
                </tr>
                
            </table>
        </form>
            
    </div>
    <!--内容部分end-->