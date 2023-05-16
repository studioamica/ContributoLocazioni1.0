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
<script language="JavaScript" type="text/JavaScript">
function help(theURL) { //v2.0
	window.open(theURL,"","menubar=no status=no, toolbar=no,scrollbars=no,height=300, width=500")
  	//window.open(theURL,winName,features);
}
</script>
<script>
function validate() {

var msg="";
var risp;

 if (document.box.modificadati.value==1) {
	
	msg="";

	if (isNaN(document.box.pensioneminimainps2.value)) { 
		msg = msg + "Controllare il Valore della Pensione Inps\n"; 
	}
	
	if (isNaN(document.box.percincida.value)) { 
		msg = msg + "Controllare il Valore dell'Incidenza Fascia A\n"; 
	}

	if (isNaN(document.box.redditoerp.value)) { 
		msg = msg + "Controllare il Valore del Reddito ERP\n"; 
	}

	if (isNaN(document.box.percincidb.value)) { 
		msg = msg + "Controllare il Valore dell'Incidenza Fascia B\n"; 
	}

	if (isNaN(document.box.fondocomune.value)) { 
		msg = msg + "Controllare il Valore del Fondo Comune\n"; 
	}

	if (isNaN(document.box.fondoregione.value)) { 
		msg = msg + "Controllare il Valore del Fondo Regione\n"; 
	}

	if (isNaN(document.box.percridincida.value)) { 
		msg = msg + "Controllare il Valore della Riduzione Incidenza Fascia A\n"; 
	}

	if (isNaN(document.box.maxcontributoa.value)) { 
		msg = msg + "Controllare il Valore del Contributo Massimo Fascia A\n"; 
	}

	if (isNaN(document.box.maxcontrcomunea .value)) { 
		msg = msg + "Controllare il Valore del Contributo Massimo Fascia A - Bando Comunale\n"; 
	}

	if (isNaN(document.box.percridincidb.value)) { 
		msg = msg + "Controllare il Valore della Riduzione Incidenza Fascia B\n"; 
	}

	if (isNaN(document.box.maxcontributob.value)) { 
		msg = msg + "Controllare il Valore del Contributo Massimo Fascia B\n"; 
	}

	if (isNaN(document.box.maxcontrcomuneb .value)) { 
		msg = msg + "Controllare il Valore del Contributo Massimo Fascia B - Bando Comunale\n"; 
	}

	if (isNaN(document.box.percincr.value)) { 
		msg = msg + "Controllare il Valore della Percentuale di Incremento del Contributo\n"; 
	}

	//if (document.box.applicareincremento.value == document.box.aumentarelimiti.value & document.box.aumentarelimiti.value == "S") { 
	//	msg = msg + "Scegliere se Incrementare il Contributo o Aumentare i limiti del Reddito\n"; 
	//}

	if (isNaN(document.box.perclimiti.value)) { 
		msg = msg + "Controllare il Valore della Percentuale dei Limti di Reddito\n"; 
	}

	if (isNaN(document.box.impfigliacarico.value)) { 
		msg = msg + "Controllare il Valore dell'Importo Figli a Carico\n"; 
	}	

	if (isNaN(document.box.percabb.value)) { 
		msg = msg + "Controllare il Valore della Percentuale di abbattimento del Reddito\n"; 
	}
	
	if (msg != "") {
		alert(msg)
		return false
	} 


	if (document.box.maxcontributoa.value < document.box.maxcontrcomunea.value) { 
		msg = msg + "Attenzione! Il Contributo Massimo Fascia A - Bando Comunale è superiore di quello previsto per legge\n";  	
	}

	if (document.box.maxcontributob.value < document.box.maxcontrcomuneb.value) { 
		msg = msg + "Attenzione! Il Contributo Massimo Fascia B - Bando Comunale è superiore di quello previsto per legge\n";  	
	}

	if (msg != "") {
		alert(msg)
		return false
	} 


	//if (okdupl(document.box.operazione.value,i)==false) {return false;};

	
 }
 else {
	//if (okdupl(document.box.operazione.value,i)==false) {return false;};
	return false;

 }	
	//if (okdupl(document.box.operazione.value,i)==false) {return false;};


		return okins(document.box.operazione.value);
	
}
	



</script>
	
<?php 

	include ($root."/layout/print_layout.php");

	$titolo = array("/SceltaAnnoP.php"=>"Scelta Anno",""=>"Parametri");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione">
		<div id="navvoci"><?php printMenu_1($titolo); ?></div>
		<div id="logout"><a href='index.php'>LOG OUT</a></div>
		<div id="clear">&nbsp;</div>
	</div>

	<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
	
	<div style="width:68%;margin-left:21%;margin-right:11%text-align:center;">
<?php		
		$strconnessione = connessione();
		
		$strsql  = "SELECT b_configurazione.* FROM b_configurazione ";
		$strsql .= "WHERE codfiscale = '" . $codfiscale ."' AND anno = '" .$anno . "' " ;
		
		//echo $strsql . "<p>";			

		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		$record = mysql_fetch_object($risultato);

		$permessi = "DML"; //op_inserimento($codoperator,$codmenu_1);

		$i=0;

?>

	<h3 align="left">&raquo; Gestione Parametri relativi all'anno <? echo $anno; ?> - Decreto 7 giugno 1999</h3>


			<form method='POST'  action='SaveParametri.php' name='box' onSubmit='return validate()'>

			<input type='hidden' name='codfiscale' value='<? echo $codfiscale; ?>'>
			<input type='hidden' name='comune' value='<? echo $record->comune; ?>'>
			<input type='hidden' name='cap' value='<? echo $record->cap; ?>'>
			<input type='hidden' name='provincia' value='<? echo $record->provincia; ?>'>
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

			<div id="modulip">

			<table>
			<tr>
			<td>Comune</td>
			<td><strong><? echo $record->comune; ?></strong> - <strong><? echo $record->cap; ?></strong> Provincia di 
			<strong><? echo $record->provincia; ?></strong></td>
			<td>Codice Fiscale</td>
			<td><strong><? echo $record->codfiscale; ?></strong></td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip">

			<table>
			<tr>
			<td colspan="2"><h2><strong><a href="JavaScript:help('art1comma1a.htm')">?</a> Art. 1 comma 1 - criterio a)</strong></h2></td>
        		</tr>

			<tr>	
			<td>Doppio Pensione Minima Inps</td>
			<td><input type="text" name='pensioneminimainps2' value="<? echo $record->pensioneminimainps2;?>"></td>
			<td>Percentuale Incidenza Fascia A</td>
			<td><input type="text" name='percincida' value="<? echo $record->percincida;?>"></td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip">

			<table>
			<tr>
			<td colspan="2"><h2><strong><a href="JavaScript:help('art1comma1b.htm')">?</a> Art. 1 comma 1 - criterio b)</strong></h2></td>
        		</tr>

			<tr>
			<td>Limite Reddito ERP</td>
			<td><input type='text' name='redditoerp' value="<? echo $record->redditoerp; ?>"></td>
			<td>Percentuale Incidenza Fascia B</td>
			<td><input type='text' name='percincidb' value="<? echo $record->percincidb; ?>"></td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip" style="float:left">

			<table>
			<tr>
			<td colspan="2"><h2><strong><a href="JavaScript:help('art2comma1.htm')">?</a> Art. 2 comma 1</strong></h2></td>
        		</tr>
			
			<tr>
			<td>Fondo Comune</td>
			<td><input type='text' name='fondocomune' value="<? echo $record->fondocomune; ?>"></td>
			</tr>
			</table>

			</div>

			<div id="modulip" style="float:right">

			<table>
			<tr>
			<td colspan="2"><h2><strong><a href="JavaScript:help('art2comma2.htm')">?</a> Art. 2 comma 2</strong></h2></td>
        		</tr>

			<tr>	
			<td>Fondo Regione</td>
			<td><input type="text" name='fondoregione' value="<? echo $record->fondoregione;?>">			</td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip">

			<table>
			<tr>
			<td colspan="2"><h2><strong><a href="JavaScript:help('art2comma3a.htm')">?</a> Art. 2 comma 3 - criterio a)</strong></h2></td>
        		</tr>

			<tr>	
			<td>Percentuale Riduzione Incidenza Fascia A</td>
			<td><input type="text" name='percridincida' value="<? echo $record->percridincida;?>"></td>
			<td>Contributo Massimo Fascia A</td>
			<td><input type="text" name='maxcontributoa' value="<? echo $record->maxcontributoa;?>"></td>
			</tr>

			<tr>	
			<td>&nbsp;</td>
			<td colspan="2">Contributo Massimo Fascia A - Bando Comunale</td>
			<td><input type="text" name='maxcontrcomunea' value="<? echo $record->maxcontrcomunea;?>"></td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip">

			<table>
			<tr>
			<td colspan="2"><h2><strong><a href="JavaScript:help('art2comma3b.htm')">?</a> Art. 2 comma 3 - criterio b)</strong></h2></td>
        		</tr>

			<tr>	
			<td>Percentuale Riduzione Incidenza Fascia B</td>
			<td><input type='text' name='percridincidb' value="<? echo $record->percridincidb; ?>"></td>
			<td>Contributo Massimo Fascia B</td>
			<td><input type='text' name='maxcontributob' value="<? echo $record->maxcontributob; ?>"></td>
			</tr>

			<tr>	
			<td>&nbsp;</td>
			<td colspan="2">Contributo Massimo Fascia B - Bando Comunale</td>
			<td><input type="text" name='maxcontrcomuneb' value="<? echo $record->maxcontrcomuneb;?>"></td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip">

			<table>
			<tr>
			
			<td colspan="2"><h2><strong><a href="JavaScript:help('art2comma4.htm')">?</a> Art. 2 comma 4 - incremento contributo</strong></h2></td>
        		</tr>
			
			<tr>	
			<td>Applicare Incremento Contributo?</td>
			<td><select size='1' name="applicareincremento" id="applicareincremento">
              			<option selected value="<? echo $record->applicareincremento; ?>"><? echo $record->applicareincremento; ?></option>
              			<option value="S">S</option>
              			<!--<option value="N">N</option> -->
              		</select></td>
			<td>Percentuale Incremento Contributo</td>
			<td><input type="text" name='percincr' value="<? echo $record->percincr;?>"></td>
			</tr>
			<tr>	
			<td>Aumentare Limiti di Reddito delle Fasce A e B?</td>
			<td><select size='1' name="aumentarelimiti" id="aumentarelimiti">
              			<option selected value="<? echo $record->aumentarelimiti; ?>"><? echo $record->aumentarelimiti; ?></option>
              			<option value="S">S</option>
              			<!-- <option value="N">N</option> -->
              		</select></td>
			<td>Percentuale Incremento Limiti</td>
			<td><input type="text" name='perclimiti' value="<? echo $record->perclimiti;?>"></td>
			
			</tr>

			<tr>
			<td colspan="4">NOTA: Se l'incremento del contributo non consente all'utente di rientrare nella graduatoria 
			allora si applica l'aumento dei limiti di reddito</td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>

			<div id="modulip">

			<table>
			<tr>
			<td colspan="2"><h2><strong>Criteri di Calcolo</strong></h2></td>
        		</tr>

			<tr>	
			<td>Importo Figli a Carico</td>
			<td><input type='text' name='impfigliacarico' value="<? echo $record->impfigliacarico; ?>"></td>
			<td>Percentuale Abbatimento del Reddito</td>
			<td><input type='text' name='percabb' value="<? echo $record->percabb; ?>"></td>
			</tr>
			</table>

			</div>

			<div id="clear">&nbsp;</div>
			

			<input type='hidden' name='codice' value="<? echo  $record->codice; ?>">

			<?php sceltaoperazione($permessi,$i,0); ?>
			
			
			</form>
<?php
			mysql_free_result($risultato); //libera la memoria dal risultato della query 
			mysql_close($strconnessione);	//chiude la connessione aperta

?>

</div>
</div>
  <br clear="all" class="hide"/>
<!-- Fine div contenuti -->

<? include ($root."/layout/bottom.php"); ?>