<?php
namespace Home\Controller;

use Think\Controller;

class PostController extends Controller
{
    public function index()
    {
        $cid = $_GET['cid'];
        $posts = M('bbs_post')->where("cid=$cid and is_display=1")->order('is_top desc,updated_at desc')->select();
        $uid = getID($posts,'uid');

        if($uid != NULL) {
            $users = M('bbs_user')->where("uid in ($uid)")->select();
            $users = array_column($users,'uname','uid');
        }
        
        // echo '<pre>';
        // print_r($posts);
        // print_r($users);
        // die;
        $this->assign('posts',$posts);
        $this->assign('users',$users);
        $this->assign('cid',$cid);
        $this->display();
    }

    public function fatie()
    {
        // 前台验证用户登录
        $this->is_Login();

        $cid = $_GET['cid'];
        $cates = M('bbs_cate')->select();
        // echo '<pre>';

        $this->assign('cid',$cid);
        $this->assign('cates',$cates);
        $this->display();
    }

    public function save()
    {
        $data = $_POST;
        
        $data['created_at'] = time();
        $data['uid'] = $_SESSION['userinfo']['uid'];
        $cid = $data['cid'];
        // echo '<pre>';
        // print_r($data);
        // die;
        
        $row = M('bbs_post')->add($data);
        if($row) {
            $this->success('发帖成功!',"/index.php?m=home&c=post&a=index&cid=$cid");
        } else {
            $this->error('发帖失败');
        }

    }

    // 前台验证用户登录
        public function is_Login()
        {
            if(empty($_SESSION['flag'])) {
               $this->error('请先登录...');
            }
        }
}