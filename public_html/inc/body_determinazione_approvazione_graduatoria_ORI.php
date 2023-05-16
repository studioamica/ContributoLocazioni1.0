<?php

include ($root.'/inc/inizio_word.php');
include ($root.'/inc/stile_word.php');
include ($root.'/inc/pie_word.php');

$strconnessione = connessione();

$strsql  = "SELECT Sum(fabbisogno) AS totfabbisogno FROM b_richiedenti ";
$strsql .= "WHERE escluso='N' AND anno='" . $anno . "' AND codfiscale= '" . $codfiscale . "' ";
$rs_richiedenti = mysql_query($strsql,$strconnessione);

$record = mysql_fetch_object($rs_richiedenti);
$totfabbisogno = $record->totfabbisogno;

$corpo  ="<body>";
$corpo .="<h4>COMUNE DI " . $comune . " - PROVINCICIA DI " . $provincia . "</h4>";

$corpo .="<h5>COPIA DI DETERMINAZIONE DEL RESPONSABILE DEL SERVIZIO N. ___/_____ DEL __/__/____</h5>";


$corpo .="<strong>Oggetto: Fondo nazionale per il sostegno all'accesso alle abitazioni in locazione anno " . $anno . " - Approvazione graduatoria.</strong>";
$corpo .="<br/><br/>";

$corpo .="L'anno ____________, il giorno _______ del mese ___________ nel proprio ufficio,<p/>";

$corpo .="<p align='center'><strong>IL RESPONSABILE DEL SERVIZIO</strong></p>";

$corpo .="Vista la legge 9/12/1998 N. 431 che ha istituito il fondo nazionale per il sostegno all'accesso alle abitazioni in locazione;<br/>";
$corpo .="Visto il Decreto del Ministero LL.PP. del 7/06/1999, pubblicato sulla G.U. N. 167 del 19/7/1999;<br/>";
$corpo .="Vista la Deliberazione della Giunta Regionale della Regione Puglia N. 1748 del 27/12/1999;<br/>";
$corpo .="Vista la Deliberazione della Giunta Regionale della Regione Puglia N. ____ del __/__/____;<br/>";
$corpo .="Vista la determina N. ___/______ del __/__/____ di \"Bando di concorso per il sostegno all'accesso alle ";
$corpo .="abitazioni in locazione. Anno ____\";<br/>";
$corpo .="Visto il bando di concorso per il sostegno all'accesso alle abitazioni in locazione pubblicato da questo Comune in data __/__/____<br/>";
$corpo .="Viste le domande pervenute che dall'istruttoria effettuata sono state considerate regolari;<br/>";
$corpo .="Preso atto che tutte le domande suddette sono meritevoli di accoglimento in quanto rispondenti ai ";
$corpo .="criteri stabiliti dalla Deliberazione della Giunta Regionale della Regione Puglia N. 1748 del 27/12/1999;<br/>";
$corpo .="Ritenuto, sulla base di quanto sopra detto, stilare una apposita graduatoria dei soggetti ammissibili a ";
$corpo .="contributo, con affianco di ciascuno indicato l'ammontare del contributo;<br/>";
$corpo .="Vista la graduatoria dei soggetti ammissibili a contributo redatta sulla base del bando di concorso per ";
$corpo .="il sostegno all'accesso alle abitazioni in locazione pubblicato da questo Comune e sulle determinazioni del Decreto Ministeriale LL. PP. del 7 Giugno 1999;<br/>";

$corpo .="<p align='center'><strong>D E T E R M I N A</strong></p>";

$corpo .="<p>";
$corpo .="<ol>";
$corpo .="<li>Approvare la graduatoria dei soggetti ammissibili a contributo per il sostegno all'accesso alle abitazioni in locazione redatta sulla base del bando ";
$corpo .="di concorso pubblicato da questo Comune in data __/__/____, relativo al finanziamento " . $anno . ", e allegata al presente provvedimento per farne parte integrante;</li>";
$corpo .="<li>Inviare detta graduatoria all'Assessorato regionale all'Urbanistica ed ERP;</li>";
$corpo .="<li>Dare atto che il fabbisogno necessario per soddisfare tutte le domande pervenute ammonta a <strong>Euro " . $totfabbisogno . "</strong></li>";
$corpo .="<li>Dare atto che le modalità di erogazione dei contributi di che trattasi fissate da questo Comune sono stabilite Decreto del Ministero LL.PP. del 7/06/1999, pubblicato sulla G.U. N. 167 ";
$corpo .="del 19/07/1999</li>";
$corpo .="<li>Richiedere alla Regione Puglia il contributo di <strong>Euro " . $fondoregione . "</strong> assegnato a questo Comune con Deliberazione ";
$corpo .="della Giunta Regionale della Regione Puglia N. ___ del __/__/____;</li>";
$corpo .="<li>Dare atto che, ai sensi della legge 7 Agosto 1990, N. 241, il responsabile del procedimento amministrativo è l'istruttore direttivo _____________;</li>";
$corpo .="<li>Trasmettere copia del presente provvedimento ai capigruppo consiliari;</li>";
$corpo .="</ol>";
$corpo .="</p>";
$corpo .="<p class='firma'>Il Responsabile del Servizio<br/>";
$corpo .="F.to _______________________</p>";
$corpo .="<p>______________________________________________________________</p>";
$corpo .="<p>La presente è copia conforme all'originale da servire per uso amministrativo.<br/>";
$corpo .="Dalla residenza municipale, __/__/____</p>";
$corpo .="<p class='firma'>Il Responsabile del Servizio<br/>";
$corpo .="_______________________</p>";

$corpo .="</body>";
$corpo .="</html>";


$file = $inizio . $stile . $corpo;

$fp = fopen ($root . "/documenti/" . $codfiscale . "/" . $anno . "_determinazione_approvazione_graduatoria.doc", "w");
$fw = fwrite($fp,$file);
fclose ( $fp);

?>