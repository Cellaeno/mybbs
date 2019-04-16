<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;
use Think\Upload;
use Think\Image;

class UserController extends Controller
{
    public function personal()
    {
        $uid = $_GET['uid'];
        $user = M('bbs_user')->find($uid);
        // echo '<pre>';
        // print_r($user);
        // die;
        
        $this->assign('user',$user);
        $this->display();
    }

    public function save()
    {
        $uid = $_GET['uid'];
        $users = M('bbs_user');
        $user = $users->find($uid);

        $data = $_POST;

        // 头像处理
        if($_FILES['uface']['error'] == 0)
        {
            $filename = $this->doUp();
            $this->doSm();
            $data['uface'] = $filename;
        } 

        try {
            if($_FILES['uface']['error'] == 4) {
                throw new Exception('未上传文件',250);
            }
        } catch (Exception $e) {
            if($e->getCode() == 250) {
                // echo '测试';
                // die;
                $data['uface'] = $user['uface'];
            }
        }
        // echo '<pre>';
        // print_r($data);
        // die;

        $row = $users->where("uid=$uid")->save($data);
        if($row) {
            $this->success('修改成功','/index.php?m=home&c=index&a=index');
        } else {
            $this->error('修改失败');
        }

    }


    private function doUp()
    {
        // 实例化上传类
        $upload = new Upload();
        // 设置附件上传大小
        $upload->maxSize = 3145728;
        // 设置附件上传类型
        $upload->exts = array('jpg','gif','png','jpeg');
        // 设置附件上传根目录
        $upload->rootPath = './';
        // 设置附件上传(子)目录
        $upload->savePath = 'Public/Upload/';
        
        // 上传文件
        $info = $upload->upload();

        $this->filename = $info['uface']['savepath'].$info['uface']['savename'];

        if(!$info) {
            // 上传错误提示错误信息
            $this->error($upload->getError());
        }
        
        // 返回图片的名称
        return $this->filename;
    }

    // 生成缩略图
    private function doSm()
    {
        $image = new Image(Image::IMAGE_GD,$this->filename);    //  GD库
        //  按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg 
        // 缩略图的名称
        $thumb_name = getSm($this->filename);
        $image->thumb(100,  100)->save($thumb_name);
    }
}