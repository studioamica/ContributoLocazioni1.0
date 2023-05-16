<?php

include ($root.'/inc/inizio_word.php');
include ($root.'/inc/stile_word.php');
include ($root.'/inc/pie_word.php');


	$strconnessione = connessione();

	$strsql  = "SELECT * FROM b_richiedenti, b_configurazione ";
	$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
	$strsql .= "b_richiedenti.anno = '" . $anno . "' AND escluso='s' ";
	$strsql .= "ORDER BY cognome,nome ";
		
	$rs_esclusi = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
	
	if (mysql_num_rows($rs_esclusi)>0) {

		while ($record = mysql_fetch_object($rs_esclusi)) {

        		$progressivo = $progressivo + 1;
            		$cognome = $record->cognome;
           		$nome = $record->nome;
            		$indirizzo = $record->indirizzo;

			//$corpo  ="<body>";
			//$corpo .="<h3>COMUNE DI ____________ - PROVINCIA DI ___________</h3><br/>";
			//$corpo .="<p>Prot. N. ____________ del __/__/____</p>";
			//$corpo .="<p><strong>Oggetto: Deliberazione di G. R. N. ___ del __/__/____ - Legge n. 431/98. Art. 11 - \"Fondo nazionale per il ";
			//$corpo .="sostegno all'accesso alle abitazioni in locazione\" – Individuazione dei Comuni – Anno " . $anno . " – COMUNICAZIONE";
			//$corpo .="RIGETTO ISTANZA</p>";
  			//$corpo .="<p class='destinatario'><strong>EGR. " . $cognome . " " . $nome ."<br/>";
			//$corpo .= $indirizzo . "<br/>";
			//$corpo .= $cap . " " . $comune . "</strong><br/>";
			//$corpo .="</p>";

			$corpo = "";
 			$corpo .="<p>&nbsp;</p>";
			$corpo .="<p>Si informa la S.V. che la Sua istanza di <strong>contributo canone di locazione relativo all'anno " . $anno . "</strong>, ";
			$corpo .="per motivi di reddito, non è stata accolta.</p>";
			$corpo .="Distinti saluti";
			$corpo .="<p>&nbsp;</p>";
			$corpo .="<p>&nbsp;</p>";
			$corpo .="<p class='firma'>IL DIRIGENTE<br/>";
			$corpo .="_________________</p>";
			$corpo .="<p>&nbsp;</p>";
			$corpo .="<p>&nbsp;</p>";                        
			$corpo .="<p>&nbsp;</p>";                                                            
			$corpo .="<p>&nbsp;</p>";
			$corpo .="<p>&nbsp;</p>";


			$file = $inizio . $stile . $corpo . $pie;

			$fp = fopen ($root . "/documenti/" . $codfiscale . "/" . $anno . "_lettera_rifiuto_contributo_" . $cfiscale . ".doc", "w");
			$fw = fwrite($fp,$file);
			fclose ( $fp);
		}
	}

	


?>