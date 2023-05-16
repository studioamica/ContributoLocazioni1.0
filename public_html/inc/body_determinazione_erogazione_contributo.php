<?php

include ($root.'/inc/inizio_word.php');
include ($root.'/inc/stile_word.php');
include ($root.'/inc/pie_word.php');


$corpo  ="<body>";

$corpo .="<h4>COMUNE DI " . $comune . " - PROVINCICIA DI " . $provincia . "</h4>";

$corpo .="<h5>COPIA DI DETERMINAZIONE DEL RESPONSABILE DEL SERVIZIO N. ___/_____ DEL __/__/____</h5>";


$corpo .="<strong>Oggetto: Fondo nazionale per il sostegno all'accesso alle abitazioni in locazione anno " . $anno . "</strong><br/><br/>";


$corpo .="L'anno ____________, il giorno _______ del mese ___________ nel proprio ufficio,<p/>";

$corpo .="<p align='center'><strong>IL RESPONSABILE DEL SERVIZIO</strong></p>";

$corpo .="Vista la legge 9/12/1998 N. 431 che ha istituito il fondo nazionale per il sostegno all'accesso alle abitazioni in locazione;<br/>";
$corpo .="Visto il Decreto del Ministero LL.PP. del 7/06/1999, pubblicato sulla G.U. N. 167 del 19/7/1999;<br/>";
$corpo .="Vista la Deliberazione della Giunta Regionale della Regione Puglia N. 1748 del 27/12/1999;<br/>";
$corpo .="Vista la Deliberazione della Giunta Regionale della Regione Puglia N. ____ del __/__/____;<br/>";
$corpo .="Vista la determina N. ___/______ del __/__/____ di \"Bando di concorso per il sostegno all'accesso alle ";
$corpo .="abitazioni in locazione. Anno " . $anno ."\";<br/>";
$corpo .="Visto il bando di concorso per il sostegno all'accesso alle abitazioni in locazione pubblicato da questo Comune in data __/__/____<br/>";
$corpo .="Viste le domande pervenute che dall'istruttoria effettuata sono state considerate regolari;<br/>";
$corpo .="Vista la determina N. ___/_____ del __/__/____ di \"Fondo nazionale per il sostegno all'accesso alle abitazioni in locazione - Approvazione graduatoria\";";
$corpo .="Preso atto che la Regione Puglia ha già accreditato i fondi al Comune;<br/>";

$corpo .="<p align='center'><strong>D E T E R M I N A</strong></p>";

$corpo .="<p>";
$corpo .="<ol>";
$corpo .="<li>Erogare e liquidare in favore dei cittadini residenti a " . $comune . ", inseriti in un elenco allegato alla presente per farne ";
$corpo .="parte integrante, la somma complessiva di <strong>Euro " . $totfondo  . "</strong> divisa tra gli aventi diritto secondo le modalità ";
$corpo .="stabilite il Decreto del Ministero LL.PP. del 7/06/1999, pubblicato sulla G.U. N. 167 del 19/07/1999;</li>";
$corpo .="<li>Imputare la somma complessiva di <strong>Euro " . $totfondo . "</strong> al cap. __ cod. _____ del bilancio " .$anno . ";</li>";
$corpo .="<li>Dare atto che, ai sensi della legge 7 Agosto 1990, N. 241, il responsabile del procedimento amministrativo è l'istruttore direttivo _____________;</li>";
$corpo .="<li>Trasmettere copia del presente provvedimento al dirigente dei servizi finanziari e ai capigruppo consiliari;</li>";
$corpo .="</ol>";
$corpo .="</p>";
$corpo .="<p class='firma'>Il Responsabile del Servizio<br/>";
$corpo .="F.to _______________________</p>";
$corpo .="Attestazione di regolarità contabile e attestazione di copertura finanziaria;";
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


$fp = fopen ($root . "/documenti/" . $codfiscale . "/" . $anno . "_determinazione_erogazione_contributo.doc", "w");
$fw = fwrite($fp,$file);
fclose ( $fp);

?>
