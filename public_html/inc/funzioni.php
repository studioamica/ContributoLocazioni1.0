<?php


function connessione()
{

	global $connessionedb;
	
	
	$connessionedb = mysql_connect("localhost", "", "");	//apre una connessione sul server "localhost", "username", "password"
	mysql_select_db("", $connessionedb);	//apre un database di nome "dbridottocti"
	

	return $connessionedb;
}


function login($operatore,$password)
{

	$cryptpassw = crypt($password,$operatore);
	
	$strsql  = "SELECT b_operatori.* " ;
	$strsql .= "FROM b_operatori ";
	$strsql .= "WHERE  operatore = '" . $operatore	. "' AND ";
	$strsql .= "password = '" . $cryptpassw . "' ";
	$strsql .= " AND bloccato='N' AND disabilitato='N'";

	//echo $strsql;
	//die();
	
	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
		
	$log_in = 0;

	if (mysql_num_rows($risultato)>0) {
		while ($record = mysql_fetch_object($risultato)) {

			$log_in = $record->codice; //alla variabile $log_in si attribuisce il valore del campo Codice della tabella b_operatori
		}
	}
	
	mysql_free_result($risultato); //libera la memoria dal risultato della query 
	mysql_close($strconnessione);	//chiude la connessione aperta

	return $log_in;
}


function autorizzato($codoperato)
{
	
	$strsql  = "SELECT b_operatori.* ";
	$strsql .= "FROM b_operatori ";
	$strsql .= "WHERE b_operatori.codice = " . $codoperato  . " " ; 
	
	//echo $strsql;

	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
		

	if ( ($codoperato>0) && (mysql_num_rows($risultato)>0) ){
		return $_SESSION["codoperator"];
	}
	else {
		
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}
		
}



function vis_anni($codoperato){

				
	$strconnessione = connessione();
				
	$strsql  = "SELECT b_operatori.* ";
	$strsql .= "FROM b_operatori ";
	$strsql .= "WHERE b_operatori.codice = " . $codoperato  . " " ; 
	

	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
		

	if ( ($codoperato>0) && (mysql_num_rows($risultato)>0) ){

		$record = mysql_fetch_object($risultato);
		$anni = explode(";",$record->anni);
		echo "<select size='1' name='anno' id='anno'>";
		if (is_array($anni)) {

			rsort($anni);
			reset($anni);
			foreach ($anni as $anno) {
				echo "<option value='" . $anno . "'>" . $anno . "</option>";
			}
		}
		else {
			echo "<option value='" . $anni . "'>" . $anni . "</option>";
		}
		echo "</select>";

	}
	else {
		
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}
		
}





//*****************FINE FUNZIONE PER VISUALIZZARE NELLA TABELLA GLI ANNI AUTORIZZAIT







function gruppo($codoperato,$codmenu)
{
	
	$strsql  = "SELECT b_operatori.*  ";
	$strsql .= "FROM b_operatori, b_menu, r_operatori_menu ";
	$strsql .= "WHERE b_operatori.codice = r_operatori_menu.codoperatore AND b_menu.codice = r_operatori_menu.codmenu ";
	$strsql .= "AND b_operatori.codice = " . $codoperato  . " " ; 
	$strsql .= "AND b_menu.codice = " . $codmenu . " ";
	$strsql .= "ORDER BY b_menu.nomemenu ";

	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
		

	if ( ($codoperato>0) && (mysql_num_rows($risultato)>0) ){

		$record = mysql_fetch_object($risultato);
		$_SESSION["gruppo"] = $record->tipo;
		
		return $_SESSION["gruppo"];
	}
	else {
		
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}
	
		



}



function verificacodfiscale($codoperato)
{
	$strsql  = "SELECT b_operatori.* FROM b_operatori WHERE b_operatori.codice = " . $codoperato  . " " ; 

	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
		

	if ( ($codoperato>0) && (mysql_num_rows($risultato)>0) ){

		$codsett = array();	
		$i = 0;	
		$record = mysql_fetch_object($risultato);
		$codfiscale = $record->codfiscale;	
			$i = $i + 1;

		 return $codfiscale;
	}
	else {
		
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}

}



function autorizmenu($codoperato)
{
	
	$strsql  = "SELECT b_operatori.*  ";
	$strsql .= "FROM b_operatori ";
	$strsql .= "WHERE b_operatori.codice = " . $codoperato  . " " ; 
	

	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
		

	if ( ($codoperato>0) && (mysql_num_rows($risultato)>0) ){
		return $_SESSION["codoperator"];
	}
	else {
		
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}
	
		



}

function op_inserimento($codoperato)
{

		$stringa=  "IMCL";
		
	return $stringa;

}


function sceltaoperazione($permessi,$i,$codmenu_1)
{

//echo "<fieldset>";
	//echo "<legend>Scelta Operazione</legend>";
	echo "<p class='box' align='center'><label for='scelta'><b>Scelta operazione da effettuare</b></label> ";
	echo "<select size='1' name='operazione' id='scelta'>";
	echo "<option selected value='0'>Scegli Operazione</option>";

	if (strpos($permessi,"I") !== false) {
		//echo "<input type='submit' name='Inserisci' value='Inserisci'>";
		//echo "Inserimento<input type='radio'  name='Scelta' value='Inserisci'>&nbsp;";
		echo "<option value='Inserimento'>Inserimento</option>";
	}

	if (strpos($permessi,"M") !== false) {
		//echo "<input type='submit' name='Modifica' value='Modifica'>";
		//echo "Modifica<input type='radio' name='Scelta' value='Modifica'>&nbsp;";
		echo "<option value='Modifica'>Modifica</option>";
	}
	if (strpos($permessi,"C") !== false) {
		//echo "<input type='submit' name='Elimina' value='Elimina'>";
		//echo "Cancellazione<input type='radio' name='Scelta' value='Cancella'>&nbsp;";
		echo "<option value='Cancellazione'>Cancellazione</option>";
	}

	if (strpos($permessi,"D") !== false) {
		//echo "<input type='submit' name='Duplica' value='Duplica'>";
		//echo "Modifica<input type='radio' name='Scelta' value='Modifica'>&nbsp;";
		echo "<option value='Duplicazione'>Duplica</option>";
	}

	if (strpos($permessi,"S") !== false) {
		//echo "<input type='submit' name='Stampa' value='Stama'>";
		//echo "Stampa<input type='radio' name='Scelta' value='Stampa'>&nbsp;";
		echo "<option value='Stampa'>Stampa</option>";
	}
	if (strpos($permessi,"E") !== false) {
		//echo "<input type='submit' name='Estrai' value='Estrai'>";
		//echo "Estrazione<input type='radio' name='Scelta' value='Estrai'>&nbsp;";
		echo "<option value='Estrazione'>Estrazione</option>";
	}
	

	if (strpos($permessi,"L") !== false) {
		//echo "<input type='submit' name='Lettura' value='Lettura'>";
		//echo "Estrazione<input type='radio' name='Scelta' value='Lettura'>&nbsp;";
		echo "<option value='Lettura'>Lettura</option>";
	}

	echo "  </select><br><br>";
	//echo "</fieldset><p>";

	echo "<input type='submit' name='Invia' value='Invia'>&nbsp;";
	echo "<input type='Reset' name='Reset' value='Annulla'>&nbsp;";
	echo "<input type='hidden' name='i' value='" . $i ."'>";
	echo "<input type='hidden' name='codmenu_1' value='". $codmenu_1 ."'></p>";

}

// **************** inizio copia file 

function copiafile($nome_file,$destinazione)
{

$nomefile=$nome_file;

//SCRIPT PER L'UPLOAD DEL DOCUMENTO - SE ESISTE VIENE RINOMINATA ANTEPONENDO UN NUMERO
if (is_uploaded_file($nomefile["tmp_name"])) {
        $numero=0;
        $percorso=$destinazione;   
        $nome_documento_doc=$nomefile["name"]; //SELEZIONIAMO DALL'ARRAY IL NOME EFFETTIVO DEL FILE
        $percorso_nomefile=$percorso.$nome_documento_doc ;

        while (file_exists("$percorso_nomefile")) {
              $numero++;
              $percorso_nomefile=$percorso.$numero."_".$nome_documento_doc;
	      //VALORE CHE VA INSERITO NEL DATABASE
              $nome_documento_doc=$numero."_".$nome_documento_doc;
        }

	      copy($nomefile["tmp_name"],$percorso_nomefile);
		return $nome_documento_doc;
}


}

// ********************* fine copia file


function oggi()
{
  $today=getdate();
  switch ($today['mday']) {
    case "1": $day="01"; break;
    case "2": $day="02"; break;
    case "3": $day="03"; break;
    case "4": $day="04"; break;
    case "5": $day="05"; break;
    case "6": $day="06"; break;
    case "7": $day="07"; break;
    case "8": $day="08"; break;
    case "9": $day="09"; break;
	default: $day=$today['mday'];
  }
  switch ($today['month']) {
    case "January": $mese="01"; break;
    case "February": $mese="02"; break;
    case "March": $mese="03"; break;
    case "April": $mese="04"; break;
    case "May": $mese="05"; break;
    case "June": $mese="06"; break;
    case "July": $mese="07"; break;
    case "August": $mese="08"; break;
    case "September": $mese="09"; break;
    case "October": $mese="10"; break;
    case "November": $mese="11"; break;
    case "December": $mese="12"; break;
  }
  $oggi=$day."/".$mese."/".$today['year'];
  return $oggi;
}


function mysql2date($mysql_date)
{
 $anno=substr($mysql_date,0,4);
 $mese=substr($mysql_date,5,2);
 $giorno=substr($mysql_date,8,2);
 $reversed_data="$giorno/$mese/$anno";
 
 if (($reversed_data=="00/00/0000") | ($reversed_data=="//")) {
	$reversed_data="";
 }

 return $reversed_data;
}


function date2mysql($normal_date)
{
 $anno=substr($normal_date,6,4);
 $mese=substr($normal_date,3,2);
 $giorno=substr($normal_date,0,2);
 $reversed_data="$anno-$mese-$giorno";

 if ($reversed_data=="--") {
	$reversed_data="";
 }

 return $reversed_data;
}

//******************************************************


function abilita_check($campo)
{
	$abilitato="";
	if ($campo == "S") {
		$abilitato="checked";
	}
	
	return $abilitato;

}
//*******************************************************


function sino_check($campo,$valore_default)
{


	if ($campo == 1) { 
		$valore_campo="S";
	}
	else {
		$valore_campo=$valore_default;
	}

	return $valore_campo;
}
//*******************************************

function valori_option($campo)
{

	$stringa  = "<option selected value='" . $campo . "'>" . $campo . "</option>";
	$stringa .= "<option value='N'>N</option>";
	$stringa .= "<option value='S'>S</option>";
	$stringa .= "</select>";


	return $stringa;		

}



function record_corr($strsql,$strconnessione,$esito)
{
	$dipendenze=$esito;	

	if (! $dipendenze) {

		$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql 

		if (mysql_num_rows($risultato)>0) {
			$dipendenze=true;
			mysql_free_result($risultato); //libera la memoria dal risultato della query 
		}
	}

	
	return $dipendenze;
}




function vis_all($allegato,$testo,$percorso)

{
	if ($allegato !="") {

		echo "<a href='../documenti/" . $percorso . "/" .  $allegato . "'>" .  $testo . "</a>";

		

		//$peso= filesize($root . "/documenti/" . $percorso . "/" . $allegato);
		//echo "<a href='/documenti/" . $percorso . "/" .  $allegato . "'>";
		//echo "<img border='0' src='/img/" . substr($allegato,-3) .".gif' ></a>"; 
		//echo number_format($peso,0,",",".") . "bytes";
		     


	}	

}

//*************************************

//************* funzione log

function scrivilog($nometab,$operazione,$istruzione,$codoperatore)
{

	$istruzione = str_replace("'",chr(34),$istruzione);
	$strsql = "INSERT INTO b_log (nometab,operazione,istruzione,ip,codoperatore) ";
	$strsql .= "Values ('" ;
	$strsql .= $nometab . "','" . $operazione . "','" . $istruzione . "','" . $_SERVER["REMOTE_ADDR"] . "'," . $codoperatore . ")";


	return $strsql;

}

//*************************************


//****************** funzione dari ricerca

function datiricerca()
{
	$strsql  = "SELECT b_argomenti.* ";
	$strsql .= "FROM b_argomenti ";
	$strsql .= "WHERE b_argomenti.attivo = 'S' ";
	$strsql .= "ORDER BY b_argomenti.argomento ";

	$strconnessione = connessione();
	
	$risultato = mysql_query($strsql,$strconnessione);	//invia la query contenuta in $strsql al database apero e connesso
	
	$argomenti = array();	
	$i = 0;	
	while ($record = mysql_fetch_object($risultato)) {
		$argomenti[$i] = $record->argomento;	
		$i = $i + 1;

	}

	$argomenti[$i] = "Bandib_";	
	$i = $i + 1;

	$argomenti[$i] = "Delibereb_";	
	$i = $i + 1;

	$argomenti[$i] = "Modulisticab_";	
	$i = $i + 1;

	$argomenti[$i] = "Normativab_";	
	$i = $i + 1;

	$argomenti[$i] = "Regolamentib_";	
	$i = $i + 1;

	$argomenti[$i] = "Ricettivitab_";	
	$i = $i + 1;

	$argomenti[$i] = "Scuoleb_";	
	$i = $i + 1;

	$argomenti[$i] = "Servizib_";	
	$i = $i + 1;


	//aggiungere qui eventuali altre tabelle

	mysql_free_result($risultato); //libera la memoria dal risultato della query 
	mysql_close($strconnessione);	//chiude la connessione aperta

	return $argomenti;
}

//********************************
function suddivisione($richiesta,$nomecampo)
{

	$cond="";
	if (is_array($richiesta)) {
		foreach ($richiesta as $parola) {
			if (strlen($parola) >0) {
				$cond .= $nomecampo . " like '%" . $parola . "%' OR ";
			}
		}
		$cond = substr($cond,0,strlen($cond)-3); //per eliminare l'ultimo OR
	}	
	else {
		
		if (strlen($richiesta) >0) {
			$cond .= $nomecampo . " like '%" . $richiesta . "%' ";
		}
	}
	
	return $cond;
}
//***********************************

//*******************funzione per cambiare il formato dle carattere
function c_carattere($richiesta,$testo,$formato)
//Formato = b (bold), c (italic)
{
	$cond=$testo;
	if (is_array($richiesta)) {
		foreach ($richiesta as $parola) {
			$cond = str_replace($parola,"<". $formato . ">" . $parola ."</". $formato . ">", $cond);
		}
	}
	else {
		$cond = str_replace($richiesta,"<". $formato . ">" . $richiesta ."</". $formato . ">", $testo);
	}


	return $cond;
}

//******************FINE funzione per cambiare il formato dle carattere

//******************INIZIO FUNZIONE PER INVIO EMAIL AGLI UTENTI

function invio_email($argomento,$oggetto,$messaggio,$pagina) {


	


	$strconnessione = connessione();

	$strsql  = "SELECT b_mailinglist.* ";
	$strsql .= "FROM b_mailinglist ";
	$strsql .= "WHERE ";
	$strsql .= "argomenti LIKE '%" . $argomento . "%' ";
	$strsql .= "AND iscritto = 'S' ";
	$strsql .= "AND cancellato = 'N'";

	$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
	if (mysql_num_rows($risultato)>0) {

		$mittente = "info@provincia.crotone.it";
				
		//$_SERVER["HTTP_HOST"]
		$messaggio .= "<p>Per un maggiore approfondimento puoi consultare la pagina: ";
		$messaggio .= "<a href='http://www.provincia.crotone.it"  .  $pagina ."'>Approfondimento</a></p>";


		while ($record = mysql_fetch_object($risultato)) {


			
			$destinatario = $record->email;

			$m= new Mail; // create the mail

			$m->From( $mittente );
			$m->To( $destinatario );
			$m->Subject( $oggetto );	

	
			$m->Body($messaggio);	// set the body
			$m->Priority(2) ;	// set the priority to Low 
			$m->Send();		// send the mail
			
			unset($m);

		}

		mysql_free_result($risultato); //libera la memoria dal risultato della query 

	}

	mysql_close($strconnessione);	//chiude la connessione aperta

	
}

//******************FINE FUNZIONE PER INVIO EMAIL AGLI UTENTI


//******************INIZIO FUNZIONE PER INVIO RASSEGNA STAMPA ALLA MAILIG-LIST

function invio_rassegnastampa($oggetto,$messaggio) {


	


	$strconnessione = connessione();


	$strsql = "TRUNCATE TABLE  b_invio";
	$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso			

	$strsql  = "SELECT b_newsletter.* ";
	$strsql .= "FROM b_newsletter ";
	$strsql .= "WHERE ";
	$strsql .= "iscritto = 'S' ";
	$strsql .= "AND cancellato = 'N' ";
	//$strsql .= "AND codice >=464 ";
	//$strsql .= "AND email='info@studioamica.it' ";	
	$strsql .= "ORDER BY codice ";

	$risultato = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
	if (mysql_num_rows($risultato)>0) {

		$mittente = "newsletter@krlavoro.it";
				
		//$_SERVER["HTTP_HOST"]
		
		while ($record = mysql_fetch_object($risultato)) {


			$codice	= $record->codice;
			$destinatario = strtolower($record->email);

			$strsql  = "INSERT INTO b_invio (email,codoperatore) ";
			$strsql .= "Values('" . $destinatario . "'," . $_SESSION["codoperator"] . ")";
			$risultato_1 = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso			


			

			$link  = "<a href='http://www.krlavoro.it/newsletter/registraznews.php?cod=" . $codice . "&email=" . $destinatario . "' target='_new'>";
			$link .=  "Cancellazione</a><br/>";

		
			$messaggio .= "<br/><br/>Nel rispetto del D.lgs 196/2003, tutela della privacy, se questa e-mail � pervenuta ";
			$messaggio .= "erroneamente o non � pi� interessato a riceverla, selezioni il link di " . $link;
			$messaggio .= "</div></div></body></html>";



			$m= new Mail; // create the mail

			$m->From( $mittente );
			$m->To( $destinatario );
			$m->Subject( $oggetto );	

	
			$m->Body($messaggio);	// set the body
			$m->Priority(2) ;	// set the priority to Low 
			$m->Send();		// send the mail
			
			unset($m);

		}

		mysql_free_result($risultato); //libera la memoria dal risultato della query 

	}

	mysql_close($strconnessione);	//chiude la connessione aperta

	
}

//******************FINE FUNZIONE PER INVIO RASSEGNA STAMPA ALLA MAILING-LIST

//******************INIZIO FUNZIONE CONVERSIONE DETERMINE/DELIBERE

function dec_det($nome)
{

	$nomeout="";

	if ($nome == "DTPRE") {
		$nomeout = "Determine Presidenziali";
	}
	elseif ($nome == "DLCP") {
		$nomeout = "Delibere Consiglio Provinciale";
	}
	if ($nome == "DLGP") {
		$nomeout = "Delibre Giunta Provinciale";
	}
	if ($nome == "DTDIR") {
		$nomeout = "Determine Dirigenziali";
	}
	if ($nome == "DTRM") {
		$nomeout = "Determine Riserva Marina";
	}

	return $nomeout;
}


//******************FINE FUNZIONE CONVERSIONE DETERMINE/DELIBERE

//******************INIZIO FUNZIONE PER LO SCROLLING DEI RECORD/PAGINE
function scroll_page($numrecord,$qs_pag,$nrecpag)
{


	$querystring = $_SERVER['QUERY_STRING'];

	$pos = strpos($querystring,"Pag");
	
	if ($pos === false) {

	}
	else {
		$querystring = substr($querystring,0,$pos-1);
	}

	$pagine = ceil($numrecord/$nrecpag);

	//echo "<p>" . $pagine . "<p>";

	if ($pagine >1) {

		$pag=$pagine; 
		$start=1;

		
		if ($qs_pag >=0 && $qs_pag!=0)  {
			
			$start = (ceil($qs_pag/$nrecpag)+1);
				
		}
		

		if ( ($pagine-$start) > 10) {
			$pag = $start + 9;
		}

		
		echo "<p align='center'>";

		if ($start>1) {		
			if ( (($pag*$nrecpag) - ($nrecpag*20)) >=0 ){

				echo "<a href='?" . $querystring . "&Pag=" . (($pag*$nrecpag) - ($nrecpag*20)) . "'>Precedenti</a>&nbsp;";	
			}
			else {
				echo "<a href='?" . $querystring . "&Pag=" . (0) . "'>Precedenti</a>&nbsp;";	
			}
		}	

		for ($i = $start; $i <= $pag; $i++) {
    	

			if ($qs_pag >=0) {

				if ($qs_pag != (($i-1)*$nrecpag) ) {
					echo "<a href='?" . $querystring . "&Pag=" . ($i-1)*$nrecpag . "'>" . $i ."</a>&nbsp;";
				}
				else {
					echo $i . "&nbsp;";
				}
			}
			else {
				
				if ($i!=1) {
					echo "<a href='?" . $querystring . "&Pag=" . ($i-1)*$nrecpag . "'>" . $i ."</a>&nbsp;";
				}
				else {
					echo $i . "&nbsp;";
				}
			}
	
		}

		if ( ($pagine-$start) > 10) { 
			echo "<a href='?" . $querystring . "&Pag=" . ($i-1)*$nrecpag . "'>Successive</a>&nbsp;";
		}
	}


	echo "</p>";


}
//******************FINE FUNZIONE PER LO SCROLLING DEI RECORD/PAGINE
//******************FINE FUNZIONE PER LO SCROLLING DEI RECORD/PAGINE

//*****************FUNZIONE PER VISUALIZZARE NELLA TABELLE IL CHI SEI

function vis_chisei($chisei,$i,$riga) {

				
	$strconnessione = connessione();
				

	$strsql_2  = "SELECT b_chisei.* ";
	$strsql_2 .= "FROM b_chisei ";
	$strsql_2 .= "WHERE attivo='S' ";
	$strsql_2 .= "ORDER BY tipovisitors ";

	$risultato_2 = mysql_query($strsql_2,$strconnessione); //invia la query contenuta in $strsql2 al database apero e connesso

	if ($riga=="S") {	
?>
	
	<th width="21%" align="left" scope="row"><label for="chisei">Selezionare i destinatari:</label></th>
	<td colspan="3">

<?php
	}

?>	

	<select size='5' name="codchisei<? echo $i ?>[]" id="chisei" multiple="multiple">

<?php
	$codchisei = explode(";",$chisei);

	if (is_array($codchisei)) {
		foreach ($codchisei as $chisei) {
?>		
		
	<option value="<? echo $chisei; ?>" selected><? echo $chisei; ?></option>
	

<?php

		}
?>
	<option value=""></option>
<?php
	}
	else {
?>

	<option value="<? echo $chisei; ?>" selected><? echo $chisei; ?></option>

<?php
	}

	if (mysql_num_rows($risultato_2)>0) {

		while ($record = mysql_fetch_object($risultato_2)) {

			$codicechisei	= $record->codice;
			$tipovisitors	= $record->tipovisitors;
			$attivo		= $record->attivo;

								
?>
	<option value="<? echo $tipovisitors; ?>"><? echo $tipovisitors; ?></option>
<?php
								
						
		}
	}

	
	mysql_free_result($risultato_2); //libera la memoria dal risultato della query 
	//mysql_close($strconnessione);	//chiude la connessione aperta
?>
	</select>
<?php

	if ($riga=="S") {	
?>
	</td>
<?php
	}

}

//*****************FINE FUNZIONE PER VISUALIZZARE NELLA TABELLA IL CHI SEI



//****************FUNZIONE PER IL CHI SEI 
function chisei($Postcodchisei) {

	$strchisei="";
	if (is_array($Postcodchisei)) {

		$Postcodchisei = array_unique ($Postcodchisei);//rimuove gli elementi duplicati presenti nell'array

		asort($Postcodchisei);
		reset($Postcodchisei);

		foreach ($Postcodchisei as $chisei) {
		
			$strchisei .= $chisei . ";";

		}
	}
	else {
		$strchisei .= $Postcodchisei . ";";

	}

	$strchisei = substr($strchisei,0,strlen($strchisei)-1); //per eliminare l'ultima virgola

	
		
	return $strchisei;
}
//****************FINE FUNZIONE PER IL CHI SEI 


function converti($stringa) {


	$stringa = str_replace("�",chr(92).chr(39),$stringa); 
	$stringa = str_replace("�",chr(92).chr(39),$stringa);   

	$stringa = str_replace("�",chr(92).chr(34),$stringa); 
	$stringa = str_replace("�",chr(92).chr(34),$stringa); 

	
	$stringa = str_replace("�","euro",$stringa); 

	$stringa = str_replace("�","-", $stringa);

	$stringa = str_replace("�","&agrave;",$stringa); 

	$stringa = str_replace("�","&egrave;",$stringa); 

	$stringa = str_replace("�","&eacute;",$stringa); 

	$stringa = str_replace("�","&igrave;",$stringa); 

	$stringa = str_replace("�","&ograve;",$stringa); 

	$stringa = str_replace("�","&ugrave;",$stringa); 

	$stringa = str_replace("�","&ordm;",$stringa);

	return $stringa;


}

function converti_apice($stringa) {


	$stringa = str_replace(chr(92).chr(39),"�",$stringa); 
	$stringa = str_replace(chr(39),"�",$stringa);   

	//$stringa = str_replace("�",chr(92).chr(34),$stringa); 
	//$stringa = str_replace("�",chr(92).chr(34),$stringa); 

	return $stringa;


}


function converti_slash($stringa) {


	$stringa = str_replace(chr(92).chr(39),chr(39),$stringa); 
	
	$stringa = str_replace(chr(92).chr(34),chr(34),$stringa); 

	return $stringa;


}



function nomepa($nome)
{

	$nomeout="";

	switch ($nome) {
		case "ITA":
        		$nomeout="Italia";
        		break;
		case "EUR":
        		$nomeout="Unione Europea";
        		break;
	}


	return $nomeout;
}



function nomereg($nome)
{

	$nomeout="";

	switch ($nome) {
		case "BAS":
        		$nomeout="Basilicata";
        		break;
		case "CAL":
        		$nomeout="Calabria";
        		break;
		case "CAM":
        		$nomeout="Campania";
        		break;
		case "EMR":
        		$nomeout="Emilia Romagna";
        		break;
		case "FRI":
        		$nomeout="Friuli Venezia Giulia";
        		break;
		case "LAZ":
        		$nomeout="Lazio";
        		break;
		case "LIG":
        		$nomeout="Liguria";
        		break;
		case "LOM":
        		$nomeout="Lombardia";
        		break;
		case "MAR":
        		$nomeout="Marche";
        		break;
		case "MOL":
        		$nomeout="Molise";
        		break;
		case "PIE":
        		$nomeout="Piemonte";
        		break;
		case "PUG":
        		$nomeout="Puglia";
        		break;
		case "SAR":
        		$nomeout="Sardegna";
        		break;
		case "SIC":
        		$nomeout="Sicilia";
        		break;
		case "TOS":
        		$nomeout="Toscana";
        		break;
		case "TRE":
        		$nomeout="Trentino Alto Adige";
        		break;
		case "UMB":
        		$nomeout="Umbria";
        		break;
		case "VAL":
        		$nomeout="Valle d'Aosta";
        		break;
		case "VEN":
        		$nomeout="Veneto";
        		break;
		
	}


	return $nomeout;
}


function nomeprov($nome)
{

	$nomeout="";

	switch ($nome) {
		case "AG":
        		$nomeout="AGRIGENTO";
        		break;
		case "AL":
        		$nomeout="ALESSANDRIA";
        		break;
		case "AN":
        		$nomeout="ANCONA";
        		break;
		case "AO":
        		$nomeout="AOSTA";
        		break;
		case "AP":
        		$nomeout="ASCOLI PICENO";
        		break;
		case "AQ":
        		$nomeout="L'AQUILA";
        		break;
		case "AR":
        		$nomeout="AREZZO";
        		break;
		case "AT":
        		$nomeout="ASTI";
        		break;
		case "AV":
        		$nomeout="AVELLINO";
        		break;
		case "BA":
        		$nomeout="BARI";
        		break;
		case "BG":
        		$nomeout="BERGAMO";
        		break;
		case "BI":
        		$nomeout="BIELLA";
        		break;
		case "BL":
        		$nomeout="BELLUNO";
        		break;
		case "BN":
        		$nomeout="BENEVENTO";
        		break;
		case "BO":
        		$nomeout="BOLOGNA";
        		break;
		case "BR":
        		$nomeout="BRINDISI";
        		break;
		case "BS":
        		$nomeout="BRESCIA";
        		break;
		case "BZ":
        		$nomeout="BOLZANO";
        		break;
		case "CA":
        		$nomeout="CAGLIARI";
        		break;
		case "CB":
        		$nomeout="CAMPOBASSO";
        		break;
		case "CE":
        		$nomeout="CASERTA";
        		break;
		case "CH":
        		$nomeout="CHIETI";
        		break;
		case "CL":
        		$nomeout="CALTANISSETTA";
        		break;
		case "CN":
        		$nomeout="CUNEO";
        		break;
		case "CO":
        		$nomeout="COMO";
        		break;
		case "CR":
        		$nomeout="CREMONA";
        		break;
		case "CS":
        		$nomeout="COSENZA";
        		break;
		case "CT":
        		$nomeout="CATANIA";
        		break;
		case "CZ":
        		$nomeout="CATANZARO";
        		break;
		case "EN":
        		$nomeout="ENNA";
        		break;
		case "FE":
        		$nomeout="FERRARA";
        		break;
		case "FG":
        		$nomeout="FOGGIA";
        		break;
		case "FI":
        		$nomeout="FIRENZE";
        		break;
		case "FC":
        		$nomeout="FORLI - CESENA";
        		break;
		case "FR":
        		$nomeout="FROSINONE";
        		break;
		case "GE":
        		$nomeout="GENOVA";
        		break;
		case "GO":
        		$nomeout="GORIZIA";
        		break;
		case "GR":
        		$nomeout="GROSSETO";
        		break;
		case "IM":
        		$nomeout="IMPERIA";
        		break;
		case "IS":
        		$nomeout="ISERNIA";
        		break;
		case "KR":
        		$nomeout="CROTONE";
        		break;
		case "LE":
        		$nomeout="LECCE";
        		break;
		case "LC":
        		$nomeout="LECCO";
        		break;
		case "LI":
        		$nomeout="LIVORNO";
        		break;
		case "LO":
        		$nomeout="LODI";
        		break;
		case "LT":
        		$nomeout="LATINA";
        		break;
		case "LU":
        		$nomeout="LUCCA";
        		break;
		case "MC":
        		$nomeout="MACERATA";
        		break;
		case "ME":
        		$nomeout="MESSINA";
        		break;
		case "MI":
        		$nomeout="MILANO";
        		break;
		case "MN":
        		$nomeout="MANTOVA";
        		break;
		case "MO":
        		$nomeout="MODENA";
        		break;
		case "MS":
        		$nomeout="MASSA - CARRARA";
        		break;
		case "MT":
        		$nomeout="MATERA";
        		break;
		case "NA":
        		$nomeout="NAPOLI";
        		break;
		case "NO":
        		$nomeout="NOVARA";
        		break;
		case "NU":
        		$nomeout="NUORO";
        		break;
		case "OR":
        		$nomeout="ORISTANO";
        		break;
		case "PA":
        		$nomeout="PALERMO";
        		break;
		case "PC":
        		$nomeout="PIACENZA";
        		break;
		case "PD":
        		$nomeout="PADOVA";
        		break;
		case "PE":
        		$nomeout="PESCARA";
        		break;
		case "PG":
        		$nomeout="PERUGIA";
        		break;
		case "PI":
        		$nomeout="PISA";
        		break;
		case "PN":
        		$nomeout="PORDENONE";
        		break;
		case "PO":
        		$nomeout="PRATO";
        		break;
		case "PR":
        		$nomeout="PARMA";
        		break;
		case "PU":
        		$nomeout="PESARO E URBINO";
        		break;
		case "PT":
        		$nomeout="PISTOIA";
        		break;
		case "PV":
        		$nomeout="PAVIA";
        		break;
		case "PZ":
        		$nomeout="POTENZA";
        		break;
		case "RA":
        		$nomeout="RAVENNA";
        		break;
		case "RC":
        		$nomeout="REGGIO DI CALABRIA";
        		break;
		case "RE":
        		$nomeout="REGGIO NELL'EMILIA";
        		break;
		case "RG":
        		$nomeout="RAGUSA";
        		break;
		case "RI":
        		$nomeout="RIETI";
        		break;
		case "RM":
        		$nomeout="ROMA";
        		break;
		case "RN":
        		$nomeout="RIMINI";
        		break;
		case "RO":
        		$nomeout="ROVIGO";
        		break;
		case "SA":
        		$nomeout="SALERNO";
        		break;
		case "SI":
        		$nomeout="SIENA";
        		break;
		case "SO":
        		$nomeout="SONDRIO";
        		break;
		case "SP":
        		$nomeout="LA SPEZIA";
        		break;
		case "SR":
        		$nomeout="SIRACUSA";
        		break;
		case "SS":
        		$nomeout="SASSARI";
        		break;
		case "SV":
        		$nomeout="SAVONA";
        		break;
		case "TA":
        		$nomeout="TARANTO";
        		break;
		case "TE":
        		$nomeout="TERAMO";
        		break;
		case "TN":
        		$nomeout="TRENTO";
        		break;
		case "TO":
        		$nomeout="TORINO";
        		break;
		case "TP":
        		$nomeout="TRAPANI";
        		break;
		case "TR":
        		$nomeout="TERNI";
        		break;
		case "TS":
        		$nomeout="TRIESTE";
        		break;
		case "TV":
        		$nomeout="TREVISO";
        		break;
		case "UD":
        		$nomeout="UDINE";
        		break;
		case "VA":
        		$nomeout="VARESE";
        		break;
		case "VB":
        		$nomeout="VERBANO-CUSIO-OSSOLA";
        		break;
		case "VC":
        		$nomeout="VERCELLI";
        		break;
		case "VE":
        		$nomeout="VENEZIA";
        		break;
		case "VI":
        		$nomeout="VICENZA";
        		break;
		case "VR":
        		$nomeout="VERONA";
        		break;
		case "VT":
        		$nomeout="VITERBO";
        		break;
		case "VV":
        		$nomeout="VIBO VALENTIA";
        		break;

	}


	return $nomeout;
}

function printMenu($menu) {

        if ($menu=="") {

		echo "Sei nella sezione:&nbsp;Home";
        	return;
        }

	echo "Sei nella sezione:&nbsp;<a href='/' title='Vai alla homepage del sito' tabindex='1' accesskey='h'>Home Page</a>&nbsp;&raquo;&nbsp;";

	foreach ($menu as $key=>$val) {

		if ($key!="") { 
	
			echo "<a href='" . $key . "' title='Vai alla pagina ". $val . "'>" . $val . "</a>&nbsp;&raquo;&nbsp;";

		} 
		else { 
			echo $val;

                }
	}

}


function query_string_style(){
	
	$risultato="";

	if (isset($_SERVER['QUERY_STRING'])) { 

		$querystring =  ($_SERVER['QUERY_STRING']);

		//echo "<p>" . $querystring . "<p>";

		$arrquery  = array();
		$risultato ="";
		$arrquery  = explode("&", $querystring);

		foreach ($arrquery as $v) {
   			if (strpos($v,"style") === false) {
				$risultato .= $v . "&amp;";

			} 
		}
		
	}
	
	return $risultato;
}

function stile($query_style){

	$style="";





	if (isset($query_style)) {
		$_SESSION["style"]=$query_style;
		$style=$_SESSION["style"];

	}
	elseif (isset($_SESSION["style"])) {

		$style = $_SESSION["style"];
	}
	else  {

  		$style="std_color";

  		$_SESSION["style"]="std_color";

	}

	return $style;

}


function std_graphics($query_style){


	$style_graphics="";

	if (isset($query_style)) {

		if ( ($query_style == "solotesto") | ($query_style == "std_graphics") | ($query_style == "ipo") ) { 

			$_SESSION["style_graphics"]=$query_style;
			$style_graphics=$_SESSION["style_graphics"];
		}
		else {
			if (isset($_SESSION["style_graphics"])) {

				$style_graphics = $_SESSION["style_graphics"];
			}
			else  {

  				$style_graphics="std_graphics";

  				$_SESSION["style_graphics"]="std_graphics";
			}
		}

	}
	elseif (isset($_SESSION["style_graphics"])) {

		$style_graphics = $_SESSION["style_graphics"];
	}
	else  {

  		$style_graphics="std_graphics";

  		$_SESSION["style_graphics"]="std_graphics";

	}

	return $style_graphics;

}

function std_color($query_style){


	$style_color="";

	if (isset($query_style)) {

		$_SESSION["style_graphics"]="std_graphics";

		if ( ($query_style == "arancio") | ($query_style == "verde") | ($query_style == "blu") | ($query_style == "std_color")  ) { 

			$_SESSION["style_color"]=$query_style;
			$style_color=$_SESSION["style_color"];

			
		}
		else {
			if (isset($_SESSION["style_color"])) {

				$style_color = $_SESSION["style_color"];
			}
			else  {

  				$style_color="std_color";

  				$_SESSION["style_color"]="std_color";

			}
		}

	}
	elseif (isset($_SESSION["style_color"])) {

		$_SESSION["style_graphics"]="std_graphics";

		$style_color = $_SESSION["style_color"];
	}
	else  {

  		$style_color="std_color";

  		$_SESSION["style_color"]="std_color";

		$_SESSION["style_graphics"]="std_graphics";

	}

	return $style_color;

}

function std_dim($query_style){


	$style_dim="";

	if (isset($query_style)) {

		$_SESSION["style_graphics"]="std_graphics";

		if ( ($query_style == "grandi") | ($query_style == "piccoli") | ($query_style == "std_dim")  ) { 

			$_SESSION["style_dim"]=$query_style;
			$style_dim=$_SESSION["style_dim"];
		}
		else {
			if (isset($_SESSION["style_dim"])) {

				$style_dim = $_SESSION["style_dim"];
			}
			else  {

  				$style_color="std_dim";

  				$_SESSION["style_color"]="std_dim";

			}
		}

	}
	elseif (isset($_SESSION["style_dim"])) {

		$style_dim = $_SESSION["style_dim"];
		
		$_SESSION["style_graphics"]="std_graphics";
	}
	else  {

  		$style_dim="std_dim";

  		$_SESSION["style_dim"]="std_dim";

		$_SESSION["style_graphics"]="std_graphics";

	}

	return $style_dim;

}


function stile_logo($query_style){


	$img="";
	
	if (isset($_SESSION["style_logo"])) {

		$img = $_SESSION["style_logo"];
	}

	if (isset($query_style)) {

		if  ($query_style == "verde") {  
			
			$img = "_verde";
			$_SESSION["style_logo"]=$img;

		}
		elseif  ($query_style == "blu") {  
			
			$img = "_blu";
			$_SESSION["style_logo"]=$img;

		}
		elseif  ($query_style == "std_color") {  
			
			$img = "";
			$_SESSION["style_logo"]=$img;

		}


	}
	elseif (isset($_SESSION["style_color"])) {

		if  ($_SESSION["style_color"] == "verde") {  
			
			$img = "_verde";
			$_SESSION["style_logo"]=$img;

		}
		elseif  ($_SESSION["style_color"] == "blu") {  
			
			$img = "_blu";
			$_SESSION["style_logo"]=$img;

		}
		elseif  ($_SESSION["style_color"] == "std_color") {  
			
			$img = "";
			$_SESSION["style_logo"]=$img;

		}
	}
	

	return $img;

}



?>

