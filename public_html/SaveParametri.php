<?php
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');
    
	
	$codoperator= autorizzato(@$_SESSION["codoperator"]);
	
	$nomeoperator = $_SESSION["nomeoperator"];
	$codfiscale = verificacodfiscale($codoperator);
	
	$anno = 0;
	if (isset($_POST["anno"])) { $anno = $_POST["anno"]; }
?>
<?php 

	include ($root."/layout/print_layout.php");

	$titolo = array("/SceltaAnnoP.php"=>"Scelta Anno",""=>"Salvataggio Dati");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
<?php

	
	$strconnessione = connessione();

	$agg_table = false;
	$errore=false;
	$msg="";

	//in base alla scelta dell'operazione che l'operatore vuole effettuare si eseguono le varie parti di codice

	//l'operatore dalla pagina GestioneReferenti.php ha scelto INSERIMENTO
	if ($_POST["operazione"] == "Duplicazione") {


		$anno = $_POST["anno"] + 1;

		$strsql  = "DELETE FROM b_configurazione WHERE anno='" . $anno . "' AND codfiscale ='" .$codfiscale . "' ";
		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		$risultato = mysql_query(scrivilog("b_configurazione","Cancel x Duplicaz",$strsql,$codoperator),$strconnessione);
		
			
		$strsql  = "INSERT INTO b_configurazione (";
		$strsql .= "anno,comune,codfiscale,cap,provincia,applicareincremento,aumentarelimiti,pensioneminimainps2,redditoerp,percincida,";
		$strsql .= "percincidb,fondoregione,fondocomune,percridincida,percridincidb,maxcontributoa,maxcontrcomunea,";
		$strsql .= "maxcontributob,maxcontrcomuneb,percincr,perclimiti,impfigliacarico,percabb,codoperatore";
		$strsql .= ") ";
		$strsql .= "Values (" ;
		$strsql .= "'" . $anno				."'" . ",";
		$strsql .= "'" . $_POST["comune"]		."'" . ",";
		$strsql .= "'" . $_POST["codfiscale"]		."'" . ",";
		$strsql .= "'" . $_POST["cap"]			."'" . ",";
		$strsql .= "'" . $_POST["provincia"]		."'" . ",";
		$strsql .= "'" . $_POST["applicareincremento"]	."'" . ",";
		$strsql .= "'" . $_POST["aumentarelimiti"]	."'" . ",";
		$strsql .= ""  . $_POST["pensioneminimainps2"]	.""  . ",";
		$strsql .= ""  . $_POST["redditoerp"]		.""  . ",";
		$strsql .= ""  . $_POST["percincida"]		.""  . ",";
		$strsql .= ""  . $_POST["percincidb"]		.""  . ",";
		$strsql .= ""  . $_POST["fondoregione"]		.""  . ",";
		$strsql .= ""  . $_POST["fondocomune"]		.""  . ",";
		$strsql .= ""  . $_POST["percridincida"]	.""  . ",";
		$strsql .= ""  . $_POST["percridincidb"]	.""  . ",";
		$strsql .= ""  . $_POST["maxcontributoa"]	.""  . ",";
		$strsql .= ""  . $_POST["maxcontrcomunea"]	.""  . ",";
		$strsql .= ""  . $_POST["maxcontributob"]	.""  . ",";
		$strsql .= ""  . $_POST["maxcontrcomuneb"]	.""  . ",";
		$strsql .= ""  . $_POST["percincr"]		.""  . ",";
		$strsql .= ""  . $_POST["perclimiti"]		.""  . ",";
		$strsql .= ""  . $_POST["impfigliacarico"]	.""  . ",";		
		$strsql .= ""  . $_POST["percabb"]		.""  . ",";
		$strsql .= " " . $codoperator;
		$strsql .= ") ";

		
		//echo $strsql . "<p>"; 

		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		$msg= "Inserimento effettuato con successo!!!";
		$risultato = mysql_query(scrivilog("b_configurazione","Inserimento",$strsql,$codoperator),$strconnessione);
	}
	//l'operatore dalla pagina GestioneReferenti.php ha scelto MODIFICA
	elseif ($_POST["operazione"] == "Modifica") {

		
		$strsql  = "UPDATE b_configurazione SET ";
		//$strsql .= "anno = '" 			. $_POST["anno"] 		. "', ";
		//$strsql .= "comune = '" 		. $_POST["comune"]		. "', ";
		//$strsql .= "codfiscale = '"		. $_POST["codfiscale"]		. "', ";
		$strsql .= "applicareincremento = '"	. $_POST["applicareincremento"] . "', ";
		$strsql .= "aumentarelimiti = '"	. $_POST["aumentarelimiti"] 	. "', ";
		$strsql .= "pensioneminimainps2 = "	. $_POST["pensioneminimainps2"]	. ",  ";
		$strsql .= "redditoerp = "		. $_POST["redditoerp"] 		. ",  ";
		$strsql .= "percincida = "		. $_POST["percincida"]		. ",  ";
		$strsql .= "percincidb = "		. $_POST["percincidb"] 		. ",  ";
		$strsql .= "fondoregione = "		. $_POST["fondoregione"] 	. ",  ";
		$strsql .= "fondocomune = "		. $_POST["fondocomune"] 	. ",  ";
		$strsql .= "percridincida = "		. $_POST["percridincida"] 	. ",  ";
		$strsql .= "percridincidb = "		. $_POST["percridincidb"]	. ",  ";
		$strsql .= "maxcontributoa = "		. $_POST["maxcontributoa"]	. ",  ";
		$strsql .= "maxcontrcomunea = "		. $_POST["maxcontrcomunea"]	. ",  ";
		$strsql .= "maxcontributob = "		. $_POST["maxcontributob"]	. ",  ";
		$strsql .= "maxcontrcomuneb = "		. $_POST["maxcontrcomuneb"]	. ",  ";
		$strsql .= "percincr = "		. $_POST["percincr"]		. ",  ";
		$strsql .= "perclimiti = "		. $_POST["perclimiti"]		. ",  ";
		$strsql .= "impfigliacarico = "		. $_POST["impfigliacarico"]	. ",  ";
		$strsql .= "percabb = "			. $_POST["percabb"] 		. ",  ";
		$strsql .= "codoperatore = " 		. $codoperator ."  ";
		$strsql .= "WHERE ";
		$strsql .= "codice = " . $_POST["codice"] ;

		//echo $strsql . "<p>";

		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		$msg= "Modifica effettuata con successo!!!";
		$risultato = mysql_query(scrivilog("b_configurazione","Modifica",$strsql,$codoperator),$strconnessione);
		


	}
	//l'operatore dalla pagina GestioneReferenti.php ha scelto CANCELLAZIONE
	

	


	mysql_close($strconnessione);	//chiude la connessione aperta
?>
	
	<div align="center"><strong><? echo $msg ?></strong></div>

</div>
<br>
  <br clear="all" class="hide"/>
<!-- Fine div contenuti -->
<? include ($root."/layout/bottom.php"); ?>