<?php
namespace Admin\Controller;

use Think\Controller;

class PartController extends CommonController
{
    
    // 创建分区
    public function create()
    {
        // getSm(11);
        $this->display();

    }

    public function save()
    {
        // echo '<pre>';
        // print_r($_POST);
        // die;
        $row = M('bbs_part')->add($_POST);
        if($row){
            $this->success('创建成功','/index.php?m=admin&c=part&a=index');
        } else {
            $this->error('创建失败');
        }
    }

    // 查看分区
    public function index()
    {
        $parts = M('bbs_part')->select();

        $this->assign('parts',$parts);
        $this->display();
    }

    // 删除分区
    public function del()
    {
        $pid = $_GET['pid'];
        $row = M('bbs_part')->delete($pid);
        if($row){
            $this->success('删除成功','/index.php?m=admin&c=part&a=index');
        } else {
            $this->error('删除失败');
        }
    }

    // 修改分区
    public function edit()
    {
        $pid = $_GET['pid'];
        $part = M('bbs_part')->find($pid);

        $this->assign('part',$part);
        $this->display();
    }

    public function update()
    {
        $pid = $_GET['pid'];
        $data = $_POST;

        $row = M('bbs_part')->where("pid=$pid")->save($data);
        if($row){
            $this->success('修改成功','/index.php?m=admin&c=part&a=index');
        } else {
            $this->error('修改失败');
        }
    }

}