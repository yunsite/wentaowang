<?php

	class ProductAction extends Action{
	
		//产品信息显示
		public function index(){
		
			$Book = M("Book");
			
			$product['book_id']=isset($_GET['product'])?$_GET['product']:0;
		
			// 当前页数据查询
			$list = $Book->where($product)->find();
			
			// 赋值赋值
			
			$message=$this->show($product);
			
			$this->assign('message',$message);
			
			$this->assign('list', $list);

			$this->display();
		}
		
		// 添加标签
		public function tag(){
			
		
		}
		
		// read 想看 正在看 看过
		public function WantRead(){
			
			
		
		}
		
		//add 添加留言
		public function Madd(){
		
			$Message=M('leave_message_book');
			
			$data['user_id']='1';
			
			$data['book_id']='1';
			
			$data['message']=$_POST['message'];
			
			var_dump($data);
			
			$juage=$Message->add($data);
			
			if(!$juage){
			
			var_dump($data);
			
			header("Content-Type:text/html; charset=utf-8");
			
			exit($Message->getError().' [ <A HREF="javascript:history.back()">返 回</A> ]');
		}
		
		}
		
		// reply 回复留言
		public function reply(){
		
			
		
		}
		
		//Mshow 显示留言
		public function show($product){
		
			$Message=M('leave_message_book');
			
			$message=$Message->where($product)->select();
			
			return $message;
			
		}
		//Tadd 添加标签
		public function Tadd(){
		
			
			
		
		}
		//Tshow 显示标签
		public function Tshow(){
		
		
		}
		
		//appraise 对留言的 顶 踩
		public function appraise(){
		
			
		
		}
		
		//导入验证码文件
		public function verify() 
		{
		
			import("ORG.Util.Image");
			Image::buildImageVerify();
		}
		//验证
		public function juage(){
		
			
		
		}
		//收藏书籍
		public function collect(){
		
			$data['user_id'] = $_SESSION['user_id'];
		
		//	$Collect = M['Collect'];
			
	//		$Collect->add($data);
		
		}
		
	}

?>