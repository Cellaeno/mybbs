<?php
namespace Home\Controller;

use Think\Controller;

class ReplyController extends Controller
{
    public function create()
    {
        $pid = $_GET['pid'];
        $Post = M('bbs_post');
        $users = M('bbs_user')->select();
        $posts = $Post->find($pid);
        $replys = M('bbs_reply')->where("pid=$pid")->select();
        $Post->where("pid=$pid")->setInc('view_cnt',1);

        $user = array_column($users,null,'uid');
        // echo '<pre>';
        // print_r($user);
        // die;

        $this->assign('posts',$posts);
        $this->assign('user',$user);
        $this->assign('replys',$replys);
        $this->display();
    }

    public function save()
    {
        $this->is_Login();

        $pid = $_POST['pid'];
        $data = $_POST;
        $data['created_at'] = time();
        $data['uid'] = $_SESSION['userinfo']['uid'];
        // echo '<pre>';
        // print_r($data);
        // die;
        
        $row = M('bbs_reply')->add($data);

        if($row) {
            M('bbs_post')->where("pid=$pid")->setInc('rep_cnt',1);
            M('bbs_post')->where("pid=$pid")->save(['updated_at'=>time()]);
            $this->success('回复成功');
        } else {
            $this->error('回复失败');
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