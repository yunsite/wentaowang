<?php
			
	class data{
			
			public $db_name;
			
			function __construct($db_name){
				
				$this->db_name=$db_name;
				
				$this->db($this->db_name);
				
				$this->selete();
				
			}
			
			private function db($db_name){
		
				$link=mysql_connect("localhost","root","") or die(mysql_error());
				
				$query=mysql_select_db($db_name,$link) or die (mysql_error());
				
				mysql_query("SET NAMES 'UTF8'");
	
			}
			
		function  dataNum(){
		
			$sql="SELETE * FROM wt_url WHILE cy=0";
		
			$result=mysql_query($sql);
			
			$num=mysql_num_rows($result);
		
			return $num;
		}
		
		function url(){
		
			for($i=1;$i<=$num;$i++){
			
				
			}
		
		}
	
		//抓取书名
		private function data_data($content,$url,$t){
		//print_r($content);
			//截取书名
			preg_match_all("/<h1>(.*?)<\/h1>/is",$content,$Arraytitle);
			$Arraytitle[1][0]=iconv("GB2312","UTF-8",$Arraytitle[1][0]);
			$data['book_name']=$Arraytitle[1][0];
			//截取定价
			preg_match_all("/<pclass=\"price_m\">(.*?)<span>/",$content,$Arraytitle);
			preg_match("/[0-9]+.[0-9]+/", $Arraytitle[1][0],$Arraytitle);
			$data['pricing']=$Arraytitle[0];
			
			//截取作者and出版社
			preg_match_all("/order=sort_xtime_desc\"target=\"_blank\">(.*?)<\/a>/is",$content,$Arraytitle);
			$Arraytitle[1][0]=iconv("GB2312","UTF-8",$Arraytitle[1][0]);
			if($Arraytitle[1][2]){
				$Array=$Arraytitle[1][2];
				$Array_tran=$Arraytitle[1][1];
			}else{
				$Array=$Arraytitle[1][1];
			}
			$Arraytitle[1][1]=iconv("GB2312","UTF-8",$Array);
			$data['translator']=iconv("GB2312","UTF-8",$Array_tran);
			$data['author']=$Arraytitle[1][0];
			$data['press']=$Arraytitle[1][1];
			
			//截取翻译人员

			
			//截取图书页数isbn
			preg_match_all("/<\/span><span>(.*?)<\/span>/is",$content,$Arraytitle);
			preg_match("/[0-9]+.[0-9]+/", $Arraytitle[1][0],$Arraytitle1);
			$data['pages']=$Arraytitle1[0];
			preg_match("/[0-9]+/", $Arraytitle[1][2],$Arraytitle2);
			$data['isbn']=$Arraytitle2[0];
			//截取出版时间
			preg_match_all("/<\/a><\/p><p>(.*?)<\/p><ulclass=\"clearfix\">/is",$content,$Arraytitle);
			preg_match("/[0-9]+-[0-9]+-[0-9]/", $Arraytitle[1][0],$Arraytitle);
			$data['timeline']=$Arraytitle[0];
			
			//截取字数
			preg_match_all("/<\/span><span>(.*?)<\/span><\/li><li>/is",$content,$Arraytitle);
			preg_match_all("/<span>(.*?)<\/span>/is",$Arraytitle[0][0],$Arraytitle);
			preg_match("/[0-9]+/is", $Arraytitle[1][1],$Arraytitle);
			$data['number']=$Arraytitle[0];
			//截取图片
			preg_match_all("/name=\"__bigpic_pub\"><imgsrc=\"(.*?)\"alt=\"\"\/>/is",$content,$Arraytitle);
			$ImageUrl=$Arraytitle[1][0];
			$data['pic_name']=$this->get_pic_file($ImageUrl);
			
			//截取内容简介
			$url=$this->url_plot($url);
			$content=$this->resolution($url);
			@$data['plot_summary']=$this->plot($content);
			@$data['class_id']=$t;
		//	var_dump($data);
			$this->sql($data);
		}
		
		//得到图片并把并将其保留在指定的位置
		function get_pic_file($url){
			$reg_tag = '/.*\/(.*?)$/'; 
			srand((double)microtime()*1000000);
			$number=rand(100000,999999);
			$ret = preg_match_all($reg_tag,$url,$t_pic_name);
			$pic_name = './'.$number.$t_pic_name[1][0];
			//产生随机数
			$img_read_fd=fopen($url,"r");
			$img_write_fd=fopen("public/images/".$pic_name,"w");//创建文件
			$img_content="";
			 while(!feof($img_read_fd)){ 
				$img_content .= fread($img_read_fd,1024); 
			}
			fwrite($img_write_fd,$img_content); 
			fclose($img_read_fd); 
			fclose($img_write_fd); 
			return $number.$t_pic_name[1][0];
		}
	//内容简介
		function url_plot($url){
			
			preg_match_all("/=+[0-9]+/",$url,$url);
			$url=$url[0][0];
			$url="http://product.dangdang.com/callback.php?type=detail&product_id".$url;
			return $url;
		}
		
		function plot($content){
			$content=$this->myjson($content);
		//	echo $content;
			preg_match_all("/<divclass=\"customize\"id=\"content_text\">(.*?)<\/div>/is",$content,$Arraytitle);
			
			$plot_summary=$Arraytitle[1][0];
			$plot_summary = str_replace("　","",$plot_summary);
			$plot_summary = str_replace("n","",$plot_summary);
			return $plot_summary;
		}
		
		//转码
		function myjson($code)
		{
			if(is_array($code))
			{
				foreach($code as $key=>$val)
				{
				$code[$key] = $this->urlencodeAry($code);
				}
				return $code;
			}else{
				return $this->urlencodeAry($code);
			}
		}
		
		  function urlencodeAry($code){
		
			$code = json_encode($code);

			$code=preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);

			return	 str_replace('\\','',$code);
		}
	
	}
		ini_set('max_execution_time', '360000000*28');
	    $db=new data("wentaowang");
	   
?>