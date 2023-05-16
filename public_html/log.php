<?php
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');

	
	

	$esitologin = login($_POST["username"],$_POST["password"]);

	//echo $esitologin;
	//die();

	if ($esitologin != 0) {
		
		$_SESSION["codoperator"]=$esitologin;
		$_SESSION["nomeoperator"]=$_POST["username"];

		echo '<meta http-equiv="refresh" content="0;URL=Menu.php">';


	}
	else {
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		
	
	}



?>
