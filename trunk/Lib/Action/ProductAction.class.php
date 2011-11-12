<?php

	class ProductAction extends Action{
	
		//产品信息显示
		public function index(){
		
			$Book = M("Book");
			
			$product['book_id']=isset($_GET['product'])?$_GET['product']:0;
			
			if($product['book_id']==0){
			
				$this->error();
			}
			
			// 当前页数据查询
			$list = $Book->where($product)->find();
			
			// 赋值赋值
			
			$message=$this->show($product);
			
			$this->assign('list', $list);
			
			$this->assign('message',$message);

			$this->display('index');
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
		public function show(){
			
			$mess; 
			
			$product['book_id']=isset($_GET['product'])?$_GET['product']:0;
			
			$Message=M('leave_message_book');//message  对书本的评论
			
			$message=$Message->where($product)->select();
			
			$User=M('user');//用户信息
			
			foreach($message as $vo){
				
			 $userId['user_id']=$vo['user_id'];//获取评论会员id
				
				$user=$User->where($userId)->select();
			
				$vo['user_id']=$user[0]['user_name'];
				
				$mess[]=$vo;
			}
			return $mess;
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
		
		public function error(){
		echo __URL__;
			header('Location: __URL__');
			
			break;
		}
		
	}

?>