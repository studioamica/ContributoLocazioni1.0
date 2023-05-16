<?php
	
	global $root;
	
	if (isset($_SERVER['DOCUMENT_ROOT'])) 
	{
		$root = $_SERVER['DOCUMENT_ROOT'];
	}
	else 
	{
		$root = substr ($_SERVER["PATH_TRANSLATED"], 0, strpos($_SERVER["PATH_TRANSLATED"], "web"))."web";
	}


	

	
?>
