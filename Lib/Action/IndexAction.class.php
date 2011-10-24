<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
    /**
    +----------------------------------------------------------
    * 显示数据
    +----------------------------------------------------------
    *
	public function index(){
		$User	= M("User");
        // 按照id排序显示前6条记录
		$list	=	$User->order('id desc')->limit(6)->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	 /**
    +----------------------------------------------------------
    *插入数据 
    +----------------------------------------------------------
    */

	public function insert(){
	//	header("Content-Type:text/html; charset=utf-8");
		$User=M("User");
	//	$data=array();
		$data["user_name"]=$_POST['user_name'];
		
		$data["email"]=$_POST['email'];
	
		$data["password"]=md5($_POST['password']);
		
		
			if($User->add($data)){
				echo"添加成功";
			}else{
			var_dump($data);
			header("Content-Type:text/html; charset=utf-8");
			exit($User->getError().' [ <A HREF="javascript:history.back()">返 回</A> ]');
		}
	}
	//注册
	public function NewUser(){
	
		$this->display();
	}
	
	
	//登陆
	public function login(){
		$this->display();
	}
	
	//导入验证码文件
	public function verify() 
    {
	//	$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify();
    }
	
	//检查数据库
	public function checkName(){
	
		if($_POST['username'] == 'luwentaona@live.cn'){
			$this->success('用户名正确~');
		}else{
			$this->error('用户名错误！');
		}
	}
	//检查登陆
	public function checkLogin(){
		
	$data['email']=$_POST['email'];
		
	$data['password']=$_POST['password'];
		
	$User=M(User);
		 
	$juage=$User->where($data)->select();
	

		if ($juage){
			
			Session::set("email",$data['email']);
		
			Session::set("user_id",$juage[0]['user_id']);
			
			Session::set("password",$data['password']);
		
			if($_SESSION['verify'] != md5($_POST['verify'])){
			
				$this->ajaxReturn('','验证码错误！',0);
				
			}else{
				$this->ajaxReturn('','用户名正确'.$_SESSION['user_id'].$_SESSION['email'],1);
			}
		}else{
			$this->ajaxReturn('','用户不存在！',0);
		}	
	}
	//显示分类
	public function ShowClass(){
	
		$Class=M('classify_book');
		
		$list=$Class->where('class_father="0"')->select();
	
		$this->assign('list',$list);
		
		$this->display();
	
	}
    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */


}
?>