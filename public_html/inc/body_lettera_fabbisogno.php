<?php

include ($root.'/inc/inizio_word.php');
include ($root.'/inc/stile_word.php');
include ($root.'/inc/pie_word.php');


$corpo = "<body>";
$corpo .="<h4>COMUNE DI " . $comune. " - PROVINCIA DI " . $provincia . "</h4>";
$corpo .="<p>Prot. N. ____________ del __/__/____</p>";
$corpo .="<p><strong>Oggetto: Deliberazione di G. R. N. ___ del __/__/____ - Legge n. 431/98. Art. 11 - \"Fondo nazionale per il ";
$corpo .="sostegno all'accesso alle abitazioni in locazione\" – Individuazione dei Comuni – Anno " . $anno . " – FABBISOGNO FINANZIARIO</strong></p>";
$corpo .="<p class='destinatario'><strong>SPETT. REGIONE PUGLIA<br/>";
$corpo .="ASSESSORATO URBANISTICA ED ERP<br/>";
$corpo .="SETTORE EDILIZIA RESIDENZIALE PUBBL.</strong><br/>";
$corpo .="VIALE DELLE MAGNOLIE 6/8<br/> ";
$corpo .="70028 MODUGNO   (BA)<br/>";
$corpo .="</p>";



$corpo .="<p align='center'><strong>IL SINDACO</strong></p>";

$corpo .="Vista la legge 9/12/1998 N. 431 che ha istituito il fondo nazionale per il sostegno all'accesso alle abitazioni in locazione;<br/> ";
$corpo .="Visto il Decreto del Ministero LL.PP. del 7/06/1999, pubblicato sulla G.U. N. 167 del 19/07/1999;<br/>";
$corpo .="Vista la Deliberazione della Giunta Regionale della Regione Puglia N.____ del __/__/____;<br/>";
$corpo .="Vista la determina N. ___/_____ del __/__/____ di \"Bando di concorso per il sostegno all'accesso alle abitazioni in ";
$corpo .="locazione. Anno " . $anno . ";<br/>";
$corpo .="Visto il bando di concorso per il sostegno all'accesso alle abitazioni in locazione pubblicato da questo Comune in data __/__/____;<br/>";
$corpo .="Viste le domande pervenute;<br/>";
$corpo .="Preso atto che tutte le domande suddette sono meritevoli di accoglimento in quanto rispondenti ai criteri stabiliti dalla Deliberazione della Giunta ";
$corpo .="Regionale della Regione Puglia N. 1748 del 27/12/1999;<br/>";
$corpo .="<p align='center'><strong>D I CH I A R A</strong></p>";
$corpo .="Che il fabbisogno finanziario necessario ad ottemperare a tutte le richieste pervenute è di <strong>Euro " . $totfabbisogno . "</strong>";
$corpo .="<p>&nbsp;</p>"; 
$corpo .="<p>&nbsp;</p>";
$corpo .="<p>&nbsp;</p>";
$corpo .="<p class='firma'>IL SINDACO<br/>";
$corpo .="_________________</p>";

$corpo .="<p>&nbsp;</p>";

$file = $inizio . $stile . $corpo . $pie;

$fp = fopen ($root . "/documenti/" . $codfiscale . "/" . $anno . "_lettera_fabbisogno.doc", "w");
$fw = fwrite($fp,$file);
fclose ( $fp);


?>