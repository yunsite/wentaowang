<?php

class AjaxAction extends Action{

	public function login(){
		$this->display();
	}
	
	public function checkName(){
	
		if($_POST['username'] == 'admin'){
			$this->success('用户名正确~');
		}else{
			$this->error('用户名错误！');
		}
	}
	
	public function checkLogin(){
	
		if ($_POST['username'] == 'admin'){
		
		if($_SESSION['verify'] != md5($_POST['verify'])) {
			$this->ajaxReturn('','验证码错误！',0);;
		}else{
			$this->ajaxReturn($_POST['username'],'用户名正确~',1);
		}
		}else{
			$this->ajaxReturn('','用户名错误！',0);
		}
		
		
	}
	//导入验证码文件
	public function verify() 
    {
	//	$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify();
    }
		
	
}

?>