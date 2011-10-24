<?php
srand((double)microtime()*1000000);
$a=array();
$rp=0;
for($i=0;$i<1000;$i++){
	$new=rand(100000,999999);
	$style=0;
	foreach($a as $x){
		if($x==$new)
		{
			$style=1;
			$rp++;
		}
	}
	echo $style==1 ? '<span style="color:red;">' . $new .'</span>' : $new;
	echo '　　';
	$a[]=$new;
}
echo '重复 : ' . $rp;
?>