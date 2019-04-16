<?php
namespace Admin\Controller;

use Think\Controller;
use \Think\Verify;

class LoginController extends Controller
{
    
    // 修改密码
    // 登录界面
    public function login()
    {
        $this->display();
    }

    // 验证登录
    public function dologin()
    {
        // echo '<pre>';
        // print_r($_POST);

        // 判断密码是否为空
        if(empty($_POST['upwd']))
        {
            $this->error('密码不能为空');
        }

        // 验证账号密码是否匹配
        $uname = $_POST['uname'];
        
        $user = M('bbs_user')->where("uname='$uname'")->find();
        // print_r($data);
        // die;

        $uid = $user['uid'];
  
        $verify = new Verify();
        $code = $verify->check($_POST['code']);
        if(!$code) {
            $this->error('验证码错误');
        }
        

        if($user && password_verify($_POST['upwd'],$user['upwd']))
        {
            // 保存当前登录成功的用户信息 
            $_SESSION['userinfo'] = $user;
            // 是否登录 true 登录成功    false 未登录
            $_SESSION['flag'] = true;
            $this->success('登录成功',"./index.php?m=admin&c=index&a=index");
        } else {
            $this->error('账号或密码错误');
        }

    }

    // 修改密码的界面
    public function edit()
    {
        $uid = $_SESSION['userinfo']['uid'];
        $user = M('bbs_user')->find($uid);
        // echo '<pre>';
        // print_r($user);
        // die;
        $this->assign('user',$user);
        // die;
        $this->display();
    }

    // 验证密码并更新
    public function updatepwd()
    {
        $data = $_POST;
        $uid = $_SESSION['userinfo']['uid'];
        $user = M('bbs_user')->find($uid);
        
        // 判断密码是否为空
        if(empty($_POST['upwd']) && empty($_POST['repwd']) && empty($_POST['newpwd']))
        {
            $this->error('密码不能为空');
        }

        // 判断原密码是否正确
        if(!password_verify($_POST['upwd'],$user['upwd'])) {
            $this->error('原密码错误');
        }
        
        // 判断两次密码是否相同
        if($_POST['newpwd'] !== $_POST['repwd'])
        {
            $this->error('两次的密码不一致');
        }

        // 密码加密
        $data['upwd'] = password_hash($data['newpwd'],PASSWORD_DEFAULT);

        // 更新密码
        $row = M('bbs_user')->where("uid=$uid")->save($data);
        
        if($row){
            $this->success('修改密码成功,请重新登录...','./index.php?m=admin&c=login&a=login');
        } else {
            $this->error('修改失败');
        }
    }

    // 退出登录
    public function logout()
    {
        if($_SESSION['flag'] == true) {
            $_SESSION['userinfo'] = NULL;
            $_SESSION['flag'] = false;
        }

        $this->success('成功退出...','/index.php?m=admin&c=login&a=login');
    }

    // 验证码
    public function code()
    {
        $config = array( 
        'fontSize' => 16, // 验证码字体大小             
        'length' => 4, // 验证码位数
        'useNoise' => false, // 关闭验证码杂点
        'imageW' => 120, //图片宽度
        'imageH' => 35,  //图片高度
        'bg' => array(200,200,200)
        ); 
        $Verify = new Verify($config);
        $img = $Verify->entry();
    }
}

    