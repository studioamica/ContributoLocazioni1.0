<?php
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');
    
	
	$codoperator= autorizzato(@$_SESSION["codoperator"]);
	
	$nomeoperator = $_SESSION["nomeoperator"];
	$codfiscale = verificacodfiscale($codoperator);
	

	$anno = 0;
	if (isset($_POST["anno"])) { 
		$anno = $_POST["anno"]; 
		$_SESSION["anno1"] = $_POST["anno"];
	}
	if (isset($_SESSION["anno1"])) { 
		$anno = $_SESSION["anno1"];
	}
	

	$pagina = "";
	if ($anno <= 2005) {
		$pagina= "Richiedenti.php";
	}
	elseif($anno >= 2006) {
		$pagina= "Richiedenti2006.php";
	}

?>

<script src="/inc/funzioni.js"></script>
<script>
function validate() {


var selez="";

var codice=0;
var i=0;
var j=0;
var errore=false;
	

	i=document.box.i.value;
	
//le operazioni che seguono possono essere effettuate se si ha l'accesso in inserimento e modifica
if (document.box.modificadati.value==1) {		

		
	//verifica se l'operatore vuole effettuare una CANCELLAZIONE  e non ha spuntato il record 
	if (okcanc(document.box.operazione.value,i)==false) {return false};

	if (okdupl(document.box.operazione.value,i)==false) {return false;};

}
else {
	if (okcanc(document.box.operazione.value,i)==false) {return false;};

	if (okdupl(document.box.operazione.value,i)==false) {return false;};

}	
	
	codice=okmod(document.box.operazione.value,i);
	if (codice==false) { return false;}
	

	//individua il tipo di azione da compiere:Inserimento,Modifica,Cancellazione,Stampa,Estrazione
	azione(document.box.operazione.value,codice);

	return okins(document.box.operazione.value);

}

function azione(operazione,codice) {

var pagina1 = "";
var pagina2 = "";

	if (codice==false) {return false;}

	



	if (document.box.anno.value <= 2005) {
		pagina1 = "SaveRichiedenti.php";
		pagina2 = "Richiedenti.php?Cod=";
	}
	else if (document.box.anno.value >= 2006) {
		pagina1 = "SaveRichiedenti2006.php";
		pagina2 = "Richiedenti2006.php?Cod="
	}


	if (operazione=="Cancellazione") { 
		 document.box.action=pagina1; 
	 }
	else if (operazione=="Duplicazione") { 
		 document.box.action=pagina1; 
	 }
	else if (operazione=="Inserimento") { 
		 document.box.action=pagina2 + 0 ; 
	 }
	else if (operazione=="Modifica") { 
		 document.box.action=pagina2 + codice; 
	 }


	

}

</script>

<?php	
	
	$strconnessione = connessione();
	//Si verifica che l'Operatore sia il super Amministratore

	

	$strsql  = "SELECT b_richiedenti.* FROM b_richiedenti ";
	$strsql .= "WHERE codfiscale='" . $codfiscale . "' AND anno='" . $anno . "' ORDER BY cognome, nome";
	

	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso

	$totrec = mysql_num_rows($risultato);
	

	$permessi = "MILCSD";

	$i=0;

	$nomeazione="Richiedenti.php?Cod=0" ;
?>

<?php 

	include ($root."/layout/print_layout.php");

	$titolo = array("/SceltaAnno.php"=>"Scelta Anno",""=>"Richiedenti");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>

<h2 class="hide" align="left">&raquo; Gestione Richiedenti</h2>

<p>Sono presenti n. <strong><? echo $totrec;?></strong> richieste</p>

	<form method='POST' action="<? echo $pagina?>?Cod=0" name="box" onSubmit="return validate()">
	<fieldset>
      <legend>Modulo per la Gestione dei Richiedenti - Anno <strong><? echo $anno;?></strong></legend><br>
	<INPUT type='hidden' name='CheckAll' value='true'>
	
	<input type='hidden' name="nomeazione" 	value="<? echo $nomeazione ?>">
	<input type='hidden' name="anno"  	value="<? echo $anno; ?>">


<?php 
	if (strpos($permessi,"M") !== false) { 

?>

		<input type='hidden' name="modificadati" value="1">

<?php
	}
	else {
?>
		<input type='hidden' name="modificadati" value="0">
<?php

	}

?>

<table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1" class="box">
  <tr class="grigio1">
    <td width="5%"><div align="left"><input type='checkbox'   name="c"  onclick="ToggleCheckAll()">Tutti</div></td>
    <th width="10%" scope="col"><div align="left">CODICE</div></th>
    <th width="20%" scope="col"><div align="left">COGNOME</div></th>
    <th width="20%" scope="col"><div align="left">NOME</div></th>
    <th width="20%" scope="col"><div align="left">INDIRIZZO</div></th>
    <th width="15%" scope="col"><div align="right">REDDITO IMP.</div></th>
    <th width="20%" scope="col"><div align="right">CANONE LOC.</div></th>
  </tr>
	
<?php	

	if (mysql_num_rows($risultato)>0) {
			
		while ($record = mysql_fetch_object($risultato)) {

			

			$codice		= $record->codice;
			$cognome	= $record->cognome;
			$nome		= $record->nome;
			$indirizzo	= $record->indirizzo;
			$canoneannuo	= $record->canoneannuo;
			$redimpannuo	= $record->redimpannuo;

			$i=$i+1;


			if ($i % 2 ==0) {
?>
				<tr>
<?php
			}
			else {
?>
			<tr>
<?php						
			}

?>

			<td>
			<input type='hidden'  	name="codice<? echo $i; ?>"  	value="<? echo $codice; ?>">
			<input type='checkbox'  name="selez<? echo $i; ?>" 	value="<? echo $codice; ?>"></td>
			<td><? echo $codice; ?></td>
			<td><a href="<? echo $pagina; ?>?Cod=<? echo $codice; ?>"><? echo $cognome; ?></a></td>
			<td><? echo $nome; ?></td>
			<td><? echo $indirizzo; ?></td>
			<td align="right"><? echo $redimpannuo; ?></td>
			<td align="right"><? echo $canoneannuo; ?></td>
			<tr><td colspan="7" id="clear"><hr /></td></tr>
		</tr>
<?php
				
			}
		
			
			
		 
	}
	
?>
	</table>
	
<?php
	mysql_free_result($risultato); //libera la memoria dal risultato della query 
	mysql_close($strconnessione);	//chiude la connessione aperta

	

	//echo $i;	
	sceltaoperazione($permessi,$i,0);

	 


?>
	</fieldset>
</form>

<p align="center"> <a href="Menu.php">Menu<br>
</a><br clear="all" class="hide"/>
    <!-- Fine div contenuti -->
  
<? include ($root."/layout/bottom.php"); ?>