<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $cates = M('bbs_cate')->select();
        $parts = M('bbs_part')->select();

        $uid = $this->getID($cates,'uid');
        // echo $uid;
        // die;

        $users = M('bbs_user')->where("uid in ($uid)")->select();
        $users = array_column($users,'uname','uid');

        $parts = array_column($parts,null,'pid');

        foreach ($cates as $cate) {
            $parts[$cate['pid']]['sub'][] = $cate;
        }
        
        // echo '<pre>';
        // print_r($users);
        // die;
        $this->assign('parts',$parts);
        $this->assign('users',$users);
        $this->display();
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
}