<?php
	
		$link=mysql_connect("localhost","root","") or die(mysql_error());
		
		$query=mysql_select_db('wentaowang',$link) or die (mysql_error());
		
		mysql_query("SET NAMES 'UTF8'");
		
		$data['email']="luwentaona@live.cn";
		
		$sql="select * from wt_user where email='$data[email]'";
		 echo $sql;
		$result=mysql_query($sql)or die(mysql_error());
		
		while($row=mysql_fetch_array($result)){
				
			 $user_id=$row['user_id'];
		}
	echo $user_id;
?>