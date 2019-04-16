<?php
namespace Admin\Controller;

use Think\Controller;

class PostController extends CommonController
{
    

    // 查看帖子
    public function index()
    {
        // echo '<pre>';
        // print_r($_POST);



        $posts = M('bbs_post')->select();
        $uid = getID($posts,'uid');
        $cid = getID($posts,'cid');
        if(($uid!=null) && ($cid!=null)) {
            $users = M('bbs_user')->where("uid in ($uid)")->getField('uid,uname');
            $cates = M('bbs_cate')->where("cid in ($cid)")->getField('cid,cname');
        }
        // echo '<pre>';
        // print_r($users);
        // print_r($cates);
        // die;
        
        $this->assign('posts',$posts);
        $this->assign('users',$users);
        $this->assign('cates',$cates);
        $this->display();
    }

    // 删除帖子
    public function del()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->delete($pid);
        if($row) {
            $this->success('删除成功','/index.php?m=admin&c=post&a=index');
        } else {
            $this->error('删除失败');
        }
    }

    // 修改帖子
    public function edit()
    {
        $pid = $_GET['pid'];
        $post = M('bbs_post')->find($pid);

        $this->assign('post',$post);
        $this->display();
        
    }

    public function update()
    {
        // echo '<pre>';
        // print_r($_POST);

        $data = $_POST;
        $pid = $data['pid'];

        $row = M('bbs_post')->where("pid=$pid")->save($data);

        if($row) {
            $this->success('修改成功','/index.php?m=admin&c=post&a=index');
        } else {
            $this->error('修改失败');
        }
    }

    // 置顶
    public function is_top()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->where("pid=$pid")->save(['is_top'=>1]);
        // echo '<pre>';
        // print_r($post);
        
        if($row) {
            redirect('/index.php?m=admin&c=post&a=index');
        }
       
    }

    // 置顶
    public function not_top()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->where("pid=$pid")->save(['is_top'=>0]);
        // echo '<pre>';
        // print_r($post);
        
        if($row) {
            // $this->success('','/index.php?m=admin&c=post&a=index');
            redirect('/index.php?m=admin&c=post&a=index');

        }
       
    }

     // 显示
    public function is_display()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->where("pid=$pid")->save(['is_display'=>1]);
        // echo '<pre>';
        // print_r($post);
        
        if($row) {
            redirect('/index.php?m=admin&c=post&a=index');
        }
       
    }

    // 隐藏
    public function not_display()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->where("pid=$pid")->save(['is_display'=>0]);
        // echo '<pre>';
        // print_r($post);
        
        if($row) {
            // $this->success('','/index.php?m=admin&c=post&a=index');
            redirect('/index.php?m=admin&c=post&a=index');

        }
       
    }

     // 加精
    public function is_jing()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->where("pid=$pid")->save(['is_jing'=>1]);
        // echo '<pre>';
        // print_r($post);
        
        if($row) {
            redirect('/index.php?m=admin&c=post&a=index');
        }
       
    }

    // 取消加精
    public function not_jing()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_post')->where("pid=$pid")->save(['is_jing'=>0]);
        // echo '<pre>';
        // print_r($post);
        
        if($row) {
            // $this->success('','/index.php?m=admin&c=post&a=index');
            redirect('/index.php?m=admin&c=post&a=index');

        }
       
    }

}