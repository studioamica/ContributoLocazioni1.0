<?php
	
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');
	
	$codoperator= autorizzato(@$_SESSION["codoperator"]);	

	include ($root."/layout/print_layout.php");
	
	$titolo = array("/Operatori.php"=>"Dati Operatore",""=>"Salvataggio Dati");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>

<?

	
	$strconnessione = connessione();

	$agg_table = false;
	$errore=false;
	$msg="";

	//in base alla scelta dell'operazione che l'operatore vuole effettuare si eseguono le varie parti di codice

	if ($_POST["operazione"] == "Modifica") {


		
			$strsql  = "UPDATE b_operatori SET ";
			$strsql .= "password ='" 	. crypt($_POST["password"],$_POST["operatore"]) ."',  ";
			$strsql .= "email ='" 		. strip_tags(str_replace(chr(146),chr(96),$_POST["email"])) ."',  ";
			$strsql .= "codoperatore = " 	. $codoperator ."  ";
			$strsql .= "WHERE ";
			$strsql .= "codice = " 		. $_POST["codice"] ;

			//echo $strsql . "<p>";

			$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
			$msg= "Modifica effettuata con successo!!!";
			$risultato = mysql_query(scrivilog("b_operatori","Modifica",$strsql,$codoperator),$strconnessione);
		


	}
	

	


	mysql_close($strconnessione);	//chiude la connessione aperta
?>
	
	
	<div align="center"><strong><? echo $msg ?></strong></div>
</div>
<br>
  <br clear="all" class="hide"/>
<!-- Fine div contenuti -->

<? include ($root."/layout/bottom.php"); ?>


