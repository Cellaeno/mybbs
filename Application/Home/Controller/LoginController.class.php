<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function register()
    {
        $this->display();
    }

    public function save()
    {
        $data = $_POST;
        // echo '<pre>';
        // print_r($data);
        // die;
        // 判断密码用户名是否为空
        if(empty($_POST['uname'])) {
            $this->error('用户名不能为空!');
        }
        if(empty($_POST['upwd']) && empty($_POST['repwd'])) {
            $this->error('密码不能为空!');
        }
        // 判断两次密码是否相同
        if($_POST['upwd'] != $_POST['repwd']) {
            $this->error('两次的密码不一致!');
        }
        // 判断手机号是否符合要求
        $ptn = '/^1[345678]\d{9}$/';
        $result = preg_match($ptn,$_POST['tel']);
        // var_dump($result);
        // die;
        
        if(!$result) {
            $this->error('手机号码不符合要求');
        }
        $data['auth'] = 3;
        $data['create_at'] = time();
        $data['upwd'] = password_hash($data['upwd'],PASSWORD_DEFAULT);
        // echo '<pre>';
        // print_r($data);
        // die;
        $row = M('bbs_user')->add($data);
        if($row) {
            $this->success('注册成功!','/index.php?m=home&c=index&a=index');
        } else {
            $this->error('注册失败!');
        }
    }

    public function dologin()
    {
        $data = $_POST;
        // echo '<pre>';
        // print_r($data);
        // die;
        
        if(empty($_POST['uname'])) {
            $this->error('用户名不能为空!');
        }
        if(empty($_POST['upwd'])) {
            $this->error('密码不能为空!');
        }

        $uname = $_POST['uname'];

        $user = M('bbs_user')->where("uname='$uname'")->find();
        // echo '<pre>';
        // print_r($user);
        // die;
        if($user && password_verify($_POST['upwd'],$user['upwd']))
        {
            $_SESSION['userinfo'] = $user;
            $_SESSION['flag'] = true;
            // echo '<pre>';
            // print_r($_SESSION);
            // die;
            $this->success('登录成功','/index.php?m=home&c=index&a=index');
        } else {
            $this->success('账号或密码错误');
        }

    }

    public function logout()
    {
        $_SESSION['userinfo'] = null;
        $_SESSION['flag'] = false;

        $this->success('成功退出...','/index.php?m=home&c=index&a=index');
    }
    
}