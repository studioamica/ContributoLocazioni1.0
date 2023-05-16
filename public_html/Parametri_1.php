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
		$_SESSION["anno1"] = $anno;
	}
	if (isset($_SESSION["anno"])) { 
		$anno = $_SESSION["anno1"];
	}

?>

<script src="/inc/funzioni.js"></script>
<script>
function validate() {

var msg="";
var risp;

 if (document.box.modificadati.value==1) {
	
	msg="";

	if (isNaN(document.box.pensioneminimainps2.value)) { 
		msg = msg + "\n Controllare il Valore della Pensione Inps"; 
	}
	
	if (isNaN(document.box.percincida.value)) { 
		msg = msg + "\n Controllare il Valore dell'Incidenza Fascia A"; 
	}

	if (isNaN(document.box.redditoerp.value)) { 
		msg = msg + "\n Controllare il Valore del Reddito ERP"; 
	}

	if (isNaN(document.box.percincidb.value)) { 
		msg = msg + "\n Controllare il Valore dell'Incidenza Fascia B"; 
	}

	if (isNaN(document.box.fondocomune.value)) { 
		msg = msg + "\n Controllare il Valore del Fondo Comune"; 
	}

	if (isNaN(document.box.fondoregione.value)) { 
		msg = msg + "\n Controllare il Valore del Fondo Regione"; 
	}

	if (isNaN(document.box.percridincida.value)) { 
		msg = msg + "\n Controllare il Valore della Riduzione Incidenza Fascia A"; 
	}

	if (isNaN(document.box.maxcontributoa.value)) { 
		msg = msg + "\n Controllare il Valore del Contributo Massimo Fascia A"; 
	}

	if (isNaN(document.box.percridincidb.value)) { 
		msg = msg + "\n Controllare il Valore della Riduzione Incidenza Fascia B"; 
	}

	if (isNaN(document.box.maxcontributob.value)) { 
		msg = msg + "\n Controllare il Valore del Contributo Massimo Fascia B"; 
	}

	if (isNaN(document.box.percincr.value)) { 
		msg = msg + "\n Controllare il Valore della Percentuale di Incremento"; 
	}

	if (isNaN(document.box.impfigliacarico.value)) { 
		msg = msg + "\n Controllare il Valore dell'Importo Figli a Carico"; 
	}	

	if (isNaN(document.box.percabb.value)) { 
		msg = msg + "\n Controllare il Valore della Percentuale di abbattimento del Reddito"; 
	}
	
	if (msg != "") {
		alert(msg)
		return false
	} 

	
 }
 else {
	return false;

 }	
	if (document.box.operazione.value=="Inserimento") {
		risp = confirm ("Con questa Operazione, stai per aggiungere i dati per il nuovo anno.\nConfermi l'operazione ?")
		if (risp)  {
			return true
		}
		else {
			return false
		}

	}
	else {	

		return okins(document.box.operazione.value);
	}
}
	



</script>
	
<?php 

	include ($_SERVER['DOCUMENT_ROOT']."/layout/print_layout.php");

	$titolo = array("/SceltaAnnoP.php"=>"Scelta Anno",""=>"Parametri");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
<?php		
		$strconnessione = connessione();
		$codmenu_1 = $Menu; //query string
		$permessi = op_inserimento($codoperator,$codmenu_1);

		$strsql  = "SELECT b_configurazione.* FROM b_configurazione ";
		$strsql .= "WHERE codfiscale = '" . $codfiscale ."' AND anno = '" .$anno . "' " ;
		
		//echo $strsql . "<p>";			

		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		$record = mysql_fetch_object($risultato);

		$codmenu_1 = $Menu; //query string

		$permessi = "IMLS"; //op_inserimento($codoperator,$codmenu_1);

		$i=0;

?>


<h3 align="left">&raquo; Gestione Parametri - Decreto 7 giugno 1999</h3>


			<form method='POST'  action='SaveParametri.php' name='box' onSubmit='return validate()'>

			<input type='hidden' name='codfiscale' value='<? echo $codfiscale; ?>'>
			<input type='hidden' name='comune' value='<? echo $record->comune; ?>'>
			<input type='hidden' name="anno" value="<? echo $anno; ?>">

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

			<table width="79%" align="center" border="0" cellspacing="1" cellpadding="1" class="box">


			

			<tr class="grigio2">
			<td>Comune</td>
			<td><strong><? echo $record->comune; ?></strong></td>
			<td>Codice Fiscale</td>
			<td><strong><? echo $record->codfiscale; ?></strong></td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 1 comma 1 - criterio a)</strong></td>
        		</tr>

			<tr class="grigio2">	
			<td>Doppio Pensione Minima Inps</td>
			<td><input type="text" name='pensioneminimainps2' value="<? echo $record->pensioneminimainps2;?>"></td>
			<td>Percentuale Incidenza Fascia A</td>
			<td><input type="text" name='percincida' value="<? echo $record->percincida;?>"></td>
			</tr>
		
			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 1 comma 1 - criterio b)</strong></td>
        		</tr>

			<tr class="grigio2">
			<td>Limite Reddito ERP</td>
			<td><input type='text' name='redditoerp' value="<? echo $record->redditoerp; ?>"></td>
			<td>Percentuale Incidenza Fascia B</td>
			<td><input type='text' name='percincidb' value="<? echo $record->percincidb; ?>"></td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 2 comma 1</strong></td>
        		</tr>
			
			<tr class="grigio2">
			<td>Fondo Comune</td>
			<td><input type='text' name='fondocomune' value="<? echo $record->fondocomune; ?>"></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 2 comma 2</strong></td>
        		</tr>

			<tr class="grigio2">	
			<td>Fondo Regione</td>
			<td><input type="text" name='fondoregione' value="<? echo $record->fondoregione;?>"></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 2 comma 3 - criterio a)</strong></td>
        		</tr>

			<tr class="grigio2">	
			<td>Percentuale Riduzione Incidenza Fascia A</td>
			<td><input type="text" name='percridincida' value="<? echo $record->percridincida;?>"></td>
			<td>Contributo Massimo Fascia A</td>
			<td><input type="text" name='maxcontributoa' value="<? echo $record->maxcontributoa;?>"></td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 2 comma 3 - criterio b)</strong></td>
        		</tr>

			<tr class="grigio2">	
			<td>Percentuale Riduzione Incidenza Fascia B</td>
			<td><input type='text' name='percridincidb' value="<? echo $record->percridincidb; ?>"></td>
			<td>Contributo Massimo Fascia B</td>
			<td><input type='text' name='maxcontributob' value="<? echo $record->maxcontributob; ?>"></td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Art. 2 comma 4 - incremento contributo</strong></td>
        		</tr>
			
			<tr class="grigio2">	
			<td>Applicare Incremento?</td>
			<td><select size='1' name="applicareincremento" id="applicareincremento">
              			<option selected value="<? echo $record->applicareincremento; ?>"><? echo $record->applicareincremento; ?></option>
              			<option value="S">S</option>
              			<option value="N">N</option>
              		</select></td>
			<td>Percentuale Incremento Contributo</td>
			<td><input type="text" name='percincr' value="<? echo $record->percincr;?>"></td>
			
			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4" align="center" class="grigio1"><strong>Criteri di Calcolo</strong></td>
        		</tr>

			<tr class="grigio2">	
			<td>Importo Figli a Carico</td>
			<td><input type='text' name='impfigliacarico' value="<? echo $record->impfigliacarico; ?>"></td>
			<td>Percentuale Abbatimento del Reddito</td>
			<td><input type='text' name='percabb' value="<? echo $record->percabb; ?>"></td>
			</tr>

			<tr>
			<td colspan="4" align="center" ><strong>&nbsp;</strong></td>
        		</tr>

			<tr>
			<td colspan="4">&nbsp;</td>
        		</tr>

			<tr class="grigio1">
			<td colspan="4" align="center"><input type='submit' name='Invia' value='Invia'></td>
			</tr>
			</table>

			<input type='hidden' name='codice' value="<? echo  $record->codice; ?>">

			<?php sceltaoperazione($permessi,$i,0); ?>
			
			
			</form>
<?php
			mysql_free_result($risultato); //libera la memoria dal risultato della query 
			mysql_close($strconnessione);	//chiude la connessione aperta

?>

</div>
  <br clear="all" class="hide"/>
<!-- Fine div contenuti -->

<? include ($_SERVER['DOCUMENT_ROOT']."/layout/bottom.php"); ?>