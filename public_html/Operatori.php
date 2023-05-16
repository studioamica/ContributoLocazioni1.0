<?php
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');

	if (isset($_GET["Cod"])) {
	     $Cod=@$_GET["Cod"];
		 $_SESSION["Cod"]=@$_GET["Cod"];
	}
	else {
	     $Cod=$_SESSION["Cod"];
	}

	$codoperator= autorizzato(@$_SESSION["codoperator"]);
	$nomeoperator = $_SESSION["nomeoperator"];

?>

<script src="../inc/funzioni.js"></script>
<script>
function validate() {



	msg="";

	if  (trim(document.box.operatore.value)== "" ) {
		msg = "Inserire il nome dell'Operatore !!!\n";
	}

	//if  (trim(document.box.codfiscale.value)== "" ) {
	//	msg = msg + "Inserire Codice Fiscale !!!\n";
	//}

	if  (document.box.password.value.length <8) {
		msg = msg  + "Controllare la lunghezza della password !!!\n";
	}

	if  (document.box.newpassword.value.length <8) {
		msg = msg + "Controllare la lunghezza della nuova password !!!\n";
	}

	if  (document.box.password.value != document.box.newpassword.value) {
		msg = msg + "Le password inserite sono diverse !!!\n";
	}



	if (msg != "") {
		alert(msg)
		return false
	}

	//controllo correttezza sintattica email
	if (sendMail1(document.box.email.value)==false) {
		return false;
	}


	return okins(document.box.operazione.value);


}




</script>

<?php

	include ($root."/layout/print_layout.php");

	$titolo = array(""=>"Dati Operatore");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>

<h2 class="hide" align="left">&raquo; Gestione Operatori</h2>

<?php
		$strconnessione = connessione();
		$codmenu_1 = $Menu; //query string
		$permessi = op_inserimento($codoperator,$codmenu_1);

		$strsql  = "SELECT b_operatori.* FROM b_operatori WHERE codice = " . $codoperator ;

		//echo $strsql . "<p>";

		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		$record = mysql_fetch_object($risultato);

		$codmenu_1 = $Menu; //query string

		$permessi = "MLS"; //op_inserimento($codoperator,$codmenu_1);

		$i=0;


		//operatore esistente
?>
			<form method='POST' action='SaveOperatori.php' name='box' onSubmit='return validate()'>
			<table align="center"  border="0" cellspacing="1" cellpadding="1" class="box">
			<tr class="grigio1">
			<td>Password</td>
			<td><input type='password' name='password' value="<? echo $record->password; ?>">almeno 8 caratteri</td>
			</tr>
			<tr class="grigio2">
			<td>Ridigita password</td>
			<td><input type='password' name='newpassword'></td>
			</tr>
			<tr class="grigio1">
			<td>E-Mail</td>
			<td><input type='text' name='email' value="<? echo $record->email; ?>"></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
          		<td>&nbsp;</td>
        		</tr>
			<tr class="grigio2">
			<td colspan="2" align="center"><input type='submit' name='Invia' value='Invia'></td>
			</tr>
			</table>
			<input type='hidden' name='codice' value="<? echo   $codoperator; ?>">
			<input type='hidden' name='operatore' value="<? echo    $record->operatore; ?>">


			<input type='hidden' name='operazione' value='Modifica'>
			<input type='hidden' name='codmenu_1' value="<? echo $codmenu_1; ?>">

			</form>
<?php
			mysql_free_result($risultato); //libera la memoria dal risultato della query
			mysql_close($strconnessione);	//chiude la connessione aperta

?>

</div>
  <br clear="all" class="hide"/>
<!-- Fine div contenuti -->

<? include ($root."/layout/bottom.php"); ?>