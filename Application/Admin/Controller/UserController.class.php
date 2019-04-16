<?php
namespace Admin\Controller;

use Think\Controller;
use \Think\Page;
use \Think\Upload;
use \Think\Image;
use \Think\Exception;

class UserController extends CommonController
{
	// 上传图片的名字
	private $filename;

    //显示表单
	public function create()
	{

		$this->display();
	}

	//接收表单数据,保存到数据库
	public function save()
	{
		// echo '<pre>';
		// print_r($_POST);
		// die;
		
		// 判断密码是否为空
		if(empty($_POST['upwd']) && empty($_POST['repwd']))
		{
			$this->error('密码不能为空');
		}
		
		// 判断两次密码是否相同
		if($_POST['upwd'] !== $_POST['repwd'])
		{
			$this->error('两次的密码不一致');
		}

		$data = $_POST;
		$data['create_at'] = time();
		$data['upwd'] = password_hash($data['upwd'],PASSWORD_DEFAULT);
		// print_r($data);
		// die;
		
		// 文件上传处理
		if($_FILES['uface']['error'] === 0){
			// 上传文件
			$data['uface'] = $this->doUp();

			// 生成缩略图
			$this->doSm();

			// 删除原头像
			// unlink() 
		}
		try{
			$file = $_FILES['uface'];
			if($file['error'] == 4){
				throw new Exception('',250);
			}
		}catch(Exception $e){
				if($e->getCode() == 250){
				$data['uface'] = '';
			}
		}
		
		// $data['uface'] = $this->doUP();

		// // 生成缩略图
		// $this->doSm();
 

		$row = M('bbs_user')->add($data);

		if($row){
			$this->success('添加成功','/index.php?m=admin&c=user&a=index');
		} else {
			$this->error('添加失败');
		}
		
	}

	//显示数据
	public function index()
	{
		// 定义一个空的条件数组
		$condition = [];

		// 判断有没有性别条件	select * from bbs_user where sex='$_GET['uname']';
		if(!empty($_GET['sex'])){
			$condition['sex'] = ['eq',"{$_GET['sex']}"];
			// echo '<pre>';
			// print_r($condition);
			// die;
		}

		// 判断有没有姓名条件	select * from bbs_user where uname like %$_GET['uname']%;
		if(!empty($_GET['uname'])){
			$condition['uname'] = ['like',"%{$_GET['uname']}%"];
		}

		// 实例化一个表对象
		$User = M('bbs_user');

		// 查询满足要求的总记录数
		$n = $User->where($condition)-> count();

		// 实例化分页类 传入总记录数,每页显示3条记录
		$Page = new Page($n,3);

		//分页显示输出
		$html_page = $Page->show(); 

		// var_dump($html_page);
		// die;

		// 获取数据
		$users = $User->where($condition)
					 ->limit($Page->firstRow,$Page->listRows)
					 ->select();
		// echo '<pre>';
		// print_r($users);
		// die;
		
		foreach($users as $k=>$v)
		{
			$arr = explode('/',$v['uface']);
			$arr[3] = 'sm_'.$arr[3];
			$str = implode('/',$arr);
			$users[$k]['uface'] = $str;
		}
		// echo $arr;
		// print_r($users);
		// die;
		// 显示数据
		$this->assign('html_page',$html_page);
		$this->assign('users',$users);
		$this->display();
	}

	//删除一条记录
	public function del()
	{
		$uid = $_GET['uid'];

		$row = M('bbs_user')->delete($uid);

		if($row){
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}

	//修改表单页面
	public function edit()
	{
		$uid = $_GET['uid'];
		$user = M('bbs_user')->find($uid);

		$user['uface'] = getSm($user['uface']);
		
		$this->assign('user',$user);
		
		$this->display();
	}

	//保存修改的数据
	public function update()
	{
		$Users = M('bbs_user');
		$uid = $_GET['uid'];
		$data = $_POST;
		
		// 上传文件
		if($_FILES['uface']['error'] !== 4){
			// 上传文件
			$data['uface'] = $this->doUp();

			// 生成缩略图
			$this->doSm();

			// 删除原头像
			// unlink() 
		}

		try{
			$file = $_FILES['uface'];
			if($file['error'] == 4){
				throw new Exception('',250);
			}
		}catch(Exception $e){
				if($e->getCode() == 250){
				// echo '接收到异常,准备处理';
				// die;
				$user = $Users->find($uid);
				$data['uface'] = $user['uface'];

				// echo '<pre>';
				// print_r($user);
				// print_r($data);
				// die;
			}
		}
		
		$row = $Users->where("uid=$uid")->save($data);

		if($row){
			$this->success('修改成功','./index.php?m=admin&c=user&a=index');
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
		$image = new Image(Image::IMAGE_GD,$this->filename);	//	GD库
		//	按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg 
		// 缩略图的名称
		$thumb_name = getSm($this->filename);
		$image->thumb(120,	120)->save($thumb_name);
	}





}