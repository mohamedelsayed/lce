<?php if(isset($str) && isset($type) && isset($val)){
	if($type == 'wordsCut'){
		$str_without_tags = strip_tags($str);
		$strArr = split(" ", $str_without_tags);
		if(count($strArr) > $val){
			for($index=0; $index<$val; $index++){
				echo $strArr[$index].' ';
			}
			echo '...';
		}
		else echo $str;
	}
	else 
		echo $str;
}
?>