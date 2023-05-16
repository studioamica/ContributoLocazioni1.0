<?php

include ($root.'/inc/inizio_word.php');
include ($root.'/inc/stile_word.php');
include ($root.'/inc/pie_word.php');


$corpo  ="<body>";
$corpo .="<h4>COMUNE DI " . $comune . " - PROVINCIA DI " . $provincia . "</h4>";
$corpo .="<p>Prot. N. ____________ del __/__/____</p>";
$corpo .="<p><satrong>Oggetto: Deliberazione di G.R. N. ___ del __/__/____ -. Legge N. 431/98. Art. 11 - \"Fondo nazionale per il ";
$corpo .="sostegno all'accesso alle abitazioni in locazione\" – Individuazione dei Comuni – Anno " . $anno . " - RICHIESTA CONTRIBUTO</strong></p>";
$corpo .="<p class='destinatario'><strong>SPETT. REGIONE PUGLIA<br/>";
$corpo .="ASSESSORATO URBANISTICA ED ERP<br/>";
$corpo .="SETTORE EDILIZIA RESIDENZIALE PUBBL.</strong><br/>";
$corpo .="VIALE DELLE MAGNOLIE 6/8<br/> ";
$corpo .="70028 MODUGNO (BA)<br/>";
$corpo .="</p>";
$corpo .="<p align='center'><strong>IL SINDACO</strong></p>";
$corpo .="Vista la legge 9/12/1998 N. 431 che ha istituito il fondo nazionale per il sostegno all'accesso alle abitazioni in locazione;<br/> ";
$corpo .="Visto il Decreto del Ministero LL.PP. del 7/06/1999, pubblicato sulla G.U. N. 167 del 19/07/1999;<br/>";
$corpo .="Vista la Deliberazione della Giunta Regionale della Regione Puglia N. ____ del __/__/_____;<br/>";
$corpo .="Vista la determina N. ____/______ del __/__/____ di Bando di concorso per il sostegno all'accesso alle abitazioni in locazione. Anno " . $anno .";<br/>";
$corpo .="Visto il bando di concorso per il sostegno all'accesso alle abitazioni in locazione pubblicato da questo Comune in data __/__/____;<br/>";
$corpo .="Viste le domande pervenute;<br/>";
$corpo .="Preso atto che tutte le domande suddette sono meritevoli di accoglimento in quanto rispondenti ai criteri stabiliti dalla Deliberazione della Giunta ";
$corpo .="Regionale della Regione Puglia N. 1748 del 27/12/1999;<br/>";
$corpo .="Vista la determina N. ___/______ del __/__/____  di \"Fondo nazionale per il sostegno all'accesso alle abitazioni in ";
$corpo .="locazione\" - Approvazione graduatoria bando finanziamento " . $anno . ";<br/>";
$corpo .="<p align='center'><strong>C H I E D E</strong></p>";
$corpo .="<ol>";
$corpo .="<li>L'erogazione del contributo di  <strong>Euro " . $fondoregione . "</strong> assegnato a questo Comune con Deliberazione della Giunta ";
$corpo .="Regionale della Regione Puglia N. _____ del __/__/____;</li>";
$corpo .="<li>Dare atto che la  graduatoria del  bando di cui al finanziamento " . $anno . " approvata con determina dirigenziale ";
$corpo .="N. __/_______ del __/__/_____  ha evidenziato un fabbisogno di <strong>Euro " . $totfabbisogno . "</strong> per cui se si dovessero rendere ";
$corpo .="disponibili altre somme questa Amministrazione Comunale chiede un contributo aggiuntivo di <strong>Euro " . ($totfabbisogno - $totfondo) . "</strong> ";
$corpo .="necessario per soddisfare appieno tutte le domande pervenute;</li>";
$corpo .="<li>Si chiede altresì che l'erogazione del contributo avvenga in un'unica soluzione e che il codice fiscale del ";
$corpo .="Comune  è il seguente: " . $codfiscale . "</li>";
$corpo .="</ol>";
$corpo .="<p class='firma'>IL SINDACO<br/>";
$corpo .="_________________</p>";
$corpo .="<p>&nbsp;</p>";

$file = $inizio . $stile . $corpo . $pie;

$fp = fopen ($root . "/documenti/" . $codfiscale . "/" . $anno . "_lettera_richiesta_regione.doc", "w");
$fw = fwrite($fp,$file);
fclose ( $fp);

?>
