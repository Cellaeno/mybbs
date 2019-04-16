<?php
namespace Admin\Controller;

use Think\Controller;
use \Think\Page;

class CateController extends CommonController
{
    
    // 创建板块
    public function create()
    {
        $parts = M('bbs_part')->select();
        $users = M('bbs_user')->select();
        // echo '<pre>';
        // print_r($parts);
        // die;
        $this->assign('parts',$parts);
        $this->assign('users',$users);
        $this->display();
    }

    public function save()
    {
        $data = $_POST;
        // echo '<pre>';
        // print_r($data);
        // die;
        $row = M('bbs_cate')->add($data);
        if($row){
            $this->success('添加板块成功','/index.php?m=admin&c=cate&a=index');
        } else {
            $this->error('添加板块失败');
        }
    }

    // 查看板块
    public function index()
    {
        $Part = M('bbs_part');
        $User = M('bbs_user');
        //搜索
        $condition=[];

        if(!empty($_POST['pid'])){
            $condition['pid'] = ['eq',$_POST['pid']];
        }

        if(!empty($_POST['cname'])){
            $condition['cname'] = ['like','%'.$_POST['cname'].'%'];
        }

        // 分页显示
        $cates = $this->page_show($condition,'bbs_cate');

        // 得到小范围id和名称
        $pid = $this->getID($cates,'pid');
        $uid = $this->getID($cates,'uid');

        if((!empty($pid)) || (!empty($uid)))
        {
            $parts = $Part->where("pid in ($pid)")->select();
            $parts = array_column($parts,'pname','pid');
            // die;

            $users = $User->where("uid in ($uid)")->select();
            $users = array_column($users,'uname','uid');
        }
        
        // print_r($users);
        // print_r($parts);
        // die;

        // 查询时显示所有数据
        $part_all = $Part->select();

        $this->assign('cates',$cates);
        $this->assign('parts',$parts);
        $this->assign('users',$users);
        $this->assign('part_all',$part_all);
        $this->assign('page',$this->html_page);
        $this->display();
    }

    // 删除板块
    public function del()
    {
        $row = M('bbs_cate')->delete($_GET['cid']);
        if($row){
            $this->success('删除成功','/index.php?m=admin&c=cate&a=index');
        } else {
            $this->error('删除失败');
        }
    }

    // 修改板块
    public function edit()
    {
        $cates = M('bbs_cate')->find($_GET['cid']);
        $parts = M('bbs_part')->select();
        $users = M('bbs_user')->select();

        $this->assign('cates',$cates);
        $this->assign('parts',$parts);
        $this->assign('users',$users);
        $this->display();
       // echo '<pre>';
       // print_r($cates);
       // die;
    }

    public function update()
    {
        $cid = $_GET['cid'];
        // echo $cid;
        // die;
        $row = M('bbs_cate')->where("cid=$cid")->save($_POST);
        if($row){
            $this->success('修改成功','/index.php?m=admin&c=cate&a=index');
        } else {
            $this->error('修改失败');
        }
    }

    // 获取id
    private function getID($cates,$id)
    {
        $arr_id=[];

        foreach($cates as $cate){
            $arr_id[] = $cate[$id];
        }

        // 去除重复id
        $arr_id = array_unique($arr_id);
        
        // 得到准确的ID号
        $id = '';
        foreach($arr_id as $ids)
        {
            $id .= $ids.',';
        }

        return $this->id = rtrim($id,',');
    }

    // 分页显示
    private function page_show($condition,$table)
    {

        $User = M($table);  //  实例化User对象
        $count = $User->where($condition)->count();//    查询满足要求的总记录数
        $Page = new Page($count,3);//   实例化分页类  传入总记录数和每页显示的记录数(25)
        $this->html_page = $Page->show();//    分页显示输出
        //   进行分页数据查询    注意limit方法的参数要使用Page类的属性 
        return $User->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();  
    }
}