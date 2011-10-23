<?php

class  gather {

	public $url;
	private $db_name;
	function __construct(){
	
		$this->db_name='wentaowang';
		
		$this->db($this->db_name);
	}


	//连接数据库
	private function db($db_name){
	
		$link=mysql_connect("localhost","root","") or die(mysql_error());
		
		$query=mysql_select_db($db_name,$link) or die (mysql_error());
		
		mysql_query("SET NAMES 'UTF8'");
	
	}
	//解析url	
	private function resolution($url){
	
		$content=file_get_contents($url);	
		$content = str_replace("\n","",$content);
		$content = str_replace(" ","",$content);
		$content = str_replace("	","",$content);
		$content = trim($content);
		
		return $content;
	}
	//-------url start--------
	//---------小说、文艺、青春、励志成功、管理、工具书、进口书、----------
	 function url_1class($content,$t){
	//	echo $content;
		              
		preg_match_all("/<divclass=\"sub_box_sort\"><ul>(.*?)<\/ul>/is",$content,$Arraytitle);
		$content=$Arraytitle[1][0];	
		preg_match_all("/<ahref=\"(.*?)\">(.*?)<\/a>/is",$content,$Arraytitle);
	//	var_dump($Arraytitle[1]);
		 // $Arraytitle[];
		 foreach($Arraytitle[1] as $vo){
	//	echo $vo,$t,"<br/>";
			$url_number=$this->page_url($vo);
			$content=$this->resolution($vo);
			$page=$this->pages($content);
			
			for($i=1;$i<=$page;$i++){
				$url='http://list.dangdang.com/book/'.$url_number.'_P'.$i.'_Z40.html?filter=0_0_0';
				$content=$this->resolution($url);
				$url_book=$this->data_url($content);
				foreach($url_book as $vo){
					$content=$this->resolution($vo);
					@$this->data_data($content,$vo,$t);
			 }
			}
			$t++;
			if($t==47)$t++;
		
		 }
				
				return $t;
	
	}
	//获取页数
	function pages($content){
			//		   "/<span>(.*?)<\/span><\/div><divname=\"__link_page_btm\"class=\"pagepanel\">/is"
		preg_match_all("/<inputid=\"jumpto\"(.*?)<\/div><divname=\"__link_page_btm\"class=\"pagepanel\">/is",$content,$Arraytitle);
		preg_match_all("/<span>(.*?)<\/span>/is",$Arraytitle[1][0],$Arraytitle);
		preg_match("/[0-9]+/", $Arraytitle[1][0],$Arraytitle1);
		return $page=$Arraytitle1[0];
	
	}
	//获取翻页url第一页
	function page_url($url){
		preg_match_all("/[0-9]+.[0-9]+.[0-9]+/",$url,$url);
		$url_number=$url[0][0];
		return $url_number;
	
	}
	//抓取翻页内书url
	 function  data_url($content){
	
		preg_match_all("/<aname=\"link_prd_img\"href=\"(.*?)\"title=\"/is",$content,$Arraytitle);
		
		$url=$Arraytitle[1];
		
		return $url;
	}
	//------------url end--------------
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
	
function sql($data){

	$data['time']=time();
	//	var_dump($data);
		$sql="INSERT INTO  `wentaowang`.`wt_book` (`book_id` ,
													`book_name` ,
													`author` ,
													`translator` ,
													`pic_name` ,
													`press` ,
													`timeline` ,
													`pages` ,
													`pricing` ,
													`plot_summary` ,
													`author_summary` ,
													`isbn` ,
													`inventory` ,
													`price_1` ,
													`integral` ,
													`collect` ,
													`want_read` ,
													`reading` ,
													`read` ,
													`grade` ,
													`class_id` ,
													`time` ,
													`juage`)
											VALUES (
													'',
													'$data[book_name]',
													'$data[author]', 
													'$data[translator]' ,  
													'$data[pic_name]', 
													'$data[press]',
													'$data[timeline]' , 
													'$data[pages]', 
													'$data[pricing]', 
													'$data[plot_summary]' ,
													NULL,
													'$data[isbn]' , 
													NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , '$data[class_id]' ,'$data[time]' , NULL )";
		//		echo $sql;			
		$sql_1="SELECT * FROM wt_book where isbn='$data[isbn]'";
		
		$result=mysql_query($sql_1);
		$count=mysql_num_rows($result);

		
		if($count==0){
		    mysql_query($sql)or die(mysql_error());
	}

			
		
	}
	
	function run(){
	
		$url=array( 'http://book.dangdang.com/01.03.htm?ref=book-01-A',
					'http://book.dangdang.com/01.05.htm?ref=book-01-A',
					'http://book.dangdang.com/01.01.html?ref=book-01-A',
					'http://book.dangdang.com/01.21.htm?ref=book-01-A',
					'http://book.dangdang.com/01.22.htm?ref=book-01-A',
					'http://book.dangdang.com/01.50.html?ref=book-01-A',
					'http://book.dangdang.com/01.58.htm?ref=book-01-A');
		// $url="http://product.dangdang.com/product.aspx?product_id=20915489&ref=book-02-M";
		// $content=$this->resolution($url);
		// @$this->data_data($content,$url);
		$t=13;
		for($i=0;$i<4;$i++){
			$url_=$url[$i];
			$content=$this->resolution($url_);
			$t=$this->url_1class($content,$t);
		}
		echo "ok";
		// $content=$this->resolution("http://list.dangdang.com/book/01.21.20.htm");
		// @$this->data_url($content);
	}
	
	
}
ini_set('max_execution_time', '360000000*28');
	
	$cai=new gather();
	$cai->run();
  
?>

