<?php
	include ($root.'/inc/inizio_word.php');
	include ($root.'/inc/stile_word.php');
	include ($root.'/inc/pie_word.php');


	//si eliminano i file presenti


	if ($dir = @opendir($root . "/documenti/". $codfiscale . "/")) {

		
  		while (($file = readdir($dir)) !== false) { 

			if (strpos($file,$anno . "_lettera_rifiuto_contributo_") !== false) {
				
				unlink($root . "/documenti/" . $codfiscale  . "/" . $file);
    			}
  		}  

  	closedir($dir);

	}

	$strconnessione = connessione();

	$strsql  = "SELECT * FROM b_richiedenti, b_configurazione ";
	$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
	$strsql .= "b_richiedenti.codfiscale = b_configurazione.codfiscale AND "; 
	$strsql .= "b_configurazione.codfiscale= '" . $codfiscale . "' AND ";	
	$strsql .= "b_richiedenti.anno = '" . $anno . "' AND escluso='s' ";
	$strsql .= "ORDER BY cognome,nome ";

	//echo $strsql . "<p>";

	$rs_esclusi = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso

	if (mysql_num_rows($rs_esclusi)>0) {

		$progressivo = 0;
		while ($record = mysql_fetch_object($rs_esclusi)) {

        		$progressivo = $progressivo + 1;
            		$cognome = $record->cognome;
           		$nome = $record->nome;
			$cfiscale = $record->cfiscale;
            		$indirizzo = $record->indirizzo;

			$corpo  ="<body>\n";
			$corpo .="<h4>COMUNE DI " . $comune . " - PROVINCIA DI " . $provincia ." </h4>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>Prot. N. ____________ del __/__/____</p>\n";
			$corpo .="<p><strong>Oggetto: Deliberazione di G. R. N. ___ del __/__/____ - Legge n. 431/98. Art. 11 - \"Fondo nazionale per il ";
			$corpo .="sostegno all'accesso alle abitazioni in locazione\" – Individuazione dei Comuni – Anno " . $anno . " – COMUNICAZIONE ";
			$corpo .="RIGETTO ISTANZA</strong></p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p class='destinatario'><strong>EGR. " . $cognome . " " . $nome ."<br/>\n";
			$corpo .= "" . $indirizzo . "<br/>\n";
			$corpo .= "" . $cap . " " . $comune . "</strong><br/>\n";
			$corpo .="</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>Si informa la S.V. che la Sua istanza di <strong>contributo canone di locazione relativo all'anno " . $anno . "</strong>, ";
			$corpo .="per motivi di reddito, non è stata accolta.</p>\n";
			$corpo .="Distinti saluti\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p class='firma'>IL DIRIGENTE<br/>\n";
			$corpo .="_________________</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			$corpo .="<p>&nbsp;</p>\n";
			
			$file = $inizio . $stile . $corpo . $pie;

			$fp = fopen ($root . "/documenti/" . $codfiscale . "/" . $anno . "_lettera_rifiuto_contributo_" . $cfiscale . ".doc", "w");
			$fw = fwrite($fp,$file);
			fclose ( $fp);
		}
	}

?>