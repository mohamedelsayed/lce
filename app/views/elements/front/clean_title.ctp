<?php if(isset($artistName)){
	//echo Inflector::slug(strtolower($artistName), '-');
	echo Inflector::slug($artistName, '');
}?>