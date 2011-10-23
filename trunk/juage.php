<?php

	class juagement{
		
		//	private $url;
			
			public $db_name;
			
			function __construct($db_name){
				
				$this->db_name=$db_name;
				
				$this->db($this->db_name);
				
				$this->selete();
				
		//		echo $this->db_name;
				
			}
			
			private function db($db_name){
		
				$link=mysql_connect("localhost","root","") or die(mysql_error());
				
				$query=mysql_select_db($db_name,$link) or die (mysql_error());
				
				mysql_query("SET NAMES 'UTF8'");
	
			}
			
			function selete(){
			 
				for($i=28;$i<=547407;$i++){
			//	echo $i," ";
					$sql="SELECT * FROM wt_url WHERE id='$i'";
			//		echo $sql,"<br/>";
					$result=mysql_query($sql)or die(mysql_error());
	
						while($row=mysql_fetch_array($result)){
						
							$url=$row['url'];
						
							$this->juage($url,$i);
						}
					
				}
		//		echo "ok";
			}
			
			function juage($url,$i){
			
				$sql="SELECT *FROM wt_url WHERE url='$url' AND id!='$i' ";
		//		echo $sql,"<br/>";
				$result=mysql_query($sql)or die(mysql_error());
						
					while($row=mysql_fetch_array($result)){
						
						$id[]=$row['id'];
					}
					
				if(isset($id)){	
					var_dump($id);
				}
					
				if(isset($id)){	$this->isarray($id);}
				}
			
			
			function isarray($id){
				
				if(is_array($id)){
				
					foreach($id as $vo){
					
						$this->delete($vo); 
			
					}
				
				}else{
				
					$this->delete($id);
				}
			}
			
			function delete($id){
			
				$sql="UPDATE wt_url SET yc='1' WHERE id='$id'";
				mysql_query($sql)or die(mysql_error());
	//		echo $sql ,"<br/>";
			}
			
		}
		ini_set('max_execution_time', '360000000*28');
	   $db=new juagement("wentaowang");
	   

?>