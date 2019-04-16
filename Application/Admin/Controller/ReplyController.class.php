<?php
namespace Admin\Controller;

use Think\Controller;

class ReplyController extends CommonController
{
    // 查看回复
    public function index()
    {
        $pid = $_GET['pid'];

        $replys = M('bbs_reply')->where("pid=$pid")->select();
        $user = M('bbs_user')->getField('uid,uname');

        $this->assign('replys',$replys);
        $this->assign('user',$user);
        $this->display();
    }

    public function edit()
    {
        $rid = $_GET['rid'];
        $replys = M('bbs_reply')->find($rid);
        // echo '<pre>';
        // print_r($replys);
        
        $this->assign('replys',$replys);
        $this->display();
    }

    public function del()
    {
        $rid = $_GET['rid'];
        $reply = M('bbs_reply');
        $replys = $reply->find($rid);
        $pid = $replys['pid'];
        $row = $reply->delete($rid);
        
        if($row) {
            $this->success('删除成功',"/index.php?m=admin&c=reply&a=index&pid=$pid");
        } else {
            $this->error('删除失败');
        }
    }
}