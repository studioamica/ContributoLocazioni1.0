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

// PARAMETRI NECESSARI DI ACCESSO AL DATABASE

	$db_host = "";
	$db_user = "";
	$db_password = "";
	$db_name = "";

// QUERY PER LA CONNESSIONE
	$db = mysql_connect($db_host, $db_user, $db_password);
	mysql_select_db($db_name, $db);

// COSTANTE
	$nome_sito="";

// FUNZIONI CONTROLLO
	include ($root.'/inc/funzioni.php');

// LAYOUT PAGINA
	include ($root."/layout/print_layout.php");
	
?>
