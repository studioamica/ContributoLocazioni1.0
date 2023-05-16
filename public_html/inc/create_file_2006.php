<?php

//session_start();
//include("config.php");
//include ($root.'/inc/funzioni.php');

$strconnessione = connessione();

//$anno = "2006";

$strsql = " SELECT *  FROM b_configurazione WHERE anno='" . $anno . "' AND b_configurazione.codfiscale = '" . $codfiscale . "'  ";


//echo $strsql . "<p>";

$rs_configurazione = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso

if (mysql_num_rows($rs_configurazione) > 0) {

  $record = mysql_fetch_object($rs_configurazione);
  $comune = $record->comune;
  $provincia = $record->provincia;
  $cap = $record->cap;
  $codfiscale = $record->codfiscale;
  $fondoregione = $record->fondoregione;
  $fondocomune = $record->fondocomune;
}




$fascia = "A";

$pagina = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"
			xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
			xmlns=\"http://www.w3.org/TR/REC-html40\">
			<html>\n\r
			<body>\n\r

			<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td><strong>Legge 431/98 anno " . $anno . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td  style=\"color:#000000; font-weight:bold;\">Comune di  " . $comune . "</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td width=\"27\"><strong>PROSPETTO RIEPILOGATIVO RISULTANZE BANDO COMUNALE DEL</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td  style=\"color:#000000; font-weight:bold;\">Cod. Fisc. " . $codfiscale . "</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>Finanziamento regionale  Euro <strong>" . number_format($fondoregione, 2, ",", ".") . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>Finanziamento a carico del Comune Euro <strong>" . number_format($fondocomune, 2, ",", ".") . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>Richiedenti Fascia <strong>" . $fascia . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r


			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>D.M. 7/6/99 Art. 1</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r
			</table>
			<br />
			<br />

			<table  border=\"1\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n\r
			<tr>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>N. Progressivo</strong></td>\n\r
			<td colspan=\"2\" rowspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>COGNOME E NOME<strong></td>\n\r
			<td rowspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>INDIRIZZO</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>A</strong> Lavoratore Autonomo</td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>D</strong> Lavoratore Dipendente</td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>M</strong> Reddito Misto</td>\n\r
  			<td colspan=\"2\" rowspan=\"2\" style=\" text-align:center;vertical-align:middle;\"><strong>Alloggio</strong></td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Ascensore</td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Riscaldamento</td>\n\r
  			<td colspan=\"4\" style=\" text-align:center;vertical-align:middle;\"><strong>Contratto</strong></td>\n\r
  			<td colspan=\"6\" style=\" text-align:center;vertical-align:middle;\"><strong>Nucleo Familiare</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Reddito imponibile annuo complessivo</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Canone Annuo</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Mesi di locazione</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Incidenza canone reddito</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Maggiore debolezza sociale 25%</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>U -14%*di T</strong></td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\"><strong>Fabbisogno</strong></td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\"><strong>Contributo Attribuito</strong></td>\n\r
			</tr>\n\r


			<tr>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Concordato L. n. 431/98</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Libero</td>\n\r
			<td colspan=\"2\" style=\" text-align:center;vertical-align:middle;\">Registrazione</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N. figli a carico</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N. altri componenti</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N. totale componenti</td>\n\r
			<td colspan=\"3\" style=\" text-align:center;vertical-align:middle;\">Debolezza sociale</td>\n\r
			<td rowspan=\"2\" style=\" text-align:center;vertical-align:middle;\">Calcolo contributo max concedibile nei limiti del D.M. 7/6/99 Artt. 1 e 2 in ragione del periodo di locazione</td>\n\r
			<td rowspan=\"2\" style=\" text-align:center;vertical-align:middle;\">a seguito determinazioni e/o riduzioni comunali</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero Vani</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sup. complessiva</td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\">n.</td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\">data</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ultrasessantacinquenni</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Handicap</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Indicare altro deciso dal bando comunale</td>\n\r

			</tr>\n\r



			<tr>\n\r
			<td  style=\"text-align:center;\">1</td>\n\r
			<td colspan=\"2\" style=\"text-align:center;\">2</td>\n\r
			<td  style=\"text-align:center;\">3</td>\n\r
			<td colspan=\"3\" style=\"text-align:center;\">4</td>\n\r
			<td  style=\"text-align:center;\">5</td>\n\r
			<td  style=\"text-align:center;\">6</td>\n\r
			<td  style=\"text-align:center;\">7</td>\n\r
			<td  style=\"text-align:center;\">8</td>\n\r
			<td  style=\"text-align:center;\">9</td>\n\r
			<td  style=\"text-align:center;\">10</td>\n\r
			<td  style=\"text-align:center;\">11</td>\n\r
			<td  style=\"text-align:center;\">12</td>\n\r
			<td  style=\"text-align:center;\">13</td>\n\r
			<td  style=\"text-align:center;\">14</td>\n\r
			<td  style=\"text-align:center;\">15</td>\n\r
			<td  style=\"text-align:center;\">16</td>\n\r
			<td  style=\"text-align:center;\">17</td>\n\r
			<td  style=\"text-align:center;\">18</td>\n\r
			<td  style=\"text-align:center;\">19</td>\n\r
			<td  style=\"text-align:center;\">20</td>\n\r
			<td  style=\"text-align:center;\">21</td>\n\r
			<td  style=\"text-align:center;\">22</td>\n\r
			<td  style=\"text-align:center;\">23a</td>\n\r
			<td  style=\"text-align:center;\">23</td>\n\r
			<td  style=\"text-align:center;\">24</td>\n\r
			<td  style=\"text-align:center;\">25</td>\n\r


			</tr>\n\r";




$strsql = "SELECT * FROM b_richiedenti, b_configurazione ";
$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
$strsql .= "b_richiedenti.codfiscale = b_configurazione.codfiscale AND ";
$strsql .= "b_richiedenti.anno = '" . $anno . "' AND ";
$strsql .= "b_configurazione.codfiscale = '" . $codfiscale . "' AND ";
$strsql .= "redimpannuo<=pensioneminimainps2 AND escluso='n' AND contributo >0 ";
$strsql .= "ORDER BY redimpannuo ";

$rs_fascia_a = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
//echo $strsql . "<p>";

$progressivo = 0;
$risultato = "";

$totfabbisogno = 0;
$totcontributo = 0;

if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_A.xls")) {

  unlink($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_A.xls");
}

if (mysql_num_rows($rs_fascia_a) > 0) {

  while ($record = mysql_fetch_object($rs_fascia_a)) {

    $progressivo = $progressivo + 1;
    $cognome = $record->cognome;
    $nome = $record->nome;
    $indirizzo = $record->indirizzo;
    $lavaut = $record->lavaut;
    $lavdip = $record->lavdip;
    $redmisto = $record->redmisto;
    $nvani = $record->nvani;

    //$catcatastale = $record->catcatastale;

    $sup_totale = $record->sup_totale;
    $concordato = $record->concordato;
    $libero = $record->libero;

    //$nonspecificato = $record->nonspecificato;

    $ascensore = $record->ascensore;
    $riscaldamento = $record->riscaldamento;

    $numreg = $record->numreg;
    $datareg = mysql2date($record->datareg);
    $numfiglicarico = $record->numfiglicarico;
    $numaltricomp = $record->numaltricomp;
    $totcomp = $record->totcomp;
    $ultra65 = $record->ultra65;
    $handicap = $record->handicap;
    $altradebolezza = $record->altradebolezza;
    $redimpannuo = $record->redimpannuo;
    //'redconv = $record->redconv;
    $canoneannuo = $record->canoneannuo;
    $mesiloc = $record->mesiloc;
    $incidenza = $record->incidenza;
    $maggiorazione = $record->maggiorazione;
    $incidenza14 = $record->incidenza14;
    $fabbisogno = $record->fabbisogno;
    $contributo = $record->contributo;

    $totfabbisogno = $totfabbisogno + $fabbisogno;
    $totcontributo = $totcontributo + $contributo;

    $risultato .= "<tr>";

    $risultato .="<td>" . $progressivo . "</td>";
    $risultato .="<td>" . $cognome . "</td>";
    $risultato .="<td>" . $nome . "</td>";
    $risultato .="<td>" . $indirizzo . "</td>";
    $risultato .="<td>" . $lavaut . "</td>";
    $risultato .="<td>" . $lavdip . "</td>";
    $risultato .="<td>" . $redmisto . "</td>";
    $risultato .="<td>" . number_format($nvani, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($sup_totale, 2, ",", ".") . "</td>";
    $risultato .="<td>" . $ascensore . "</td>";
    $risultato .="<td>" . $riscaldamento . "</td>";
    $risultato .="<td>" . $concordato . "</td>";
    $risultato .="<td>" . $libero . "</td>";
    $risultato .="<td>" . $numreg . "</td>";
    $risultato .="<td>" . $datareg . "</td>";
    $risultato .="<td>" . $numfiglicarico . "</td>";
    $risultato .="<td>" . $numaltricomp . "</td>";
    $risultato .="<td>" . $totcomp . "</td>";
    $risultato .="<td>" . $ultra65 . "</td>";
    $risultato .="<td>" . $handicap . "</td>";
    $risultato .="<td>" . $altradebolezza . "</td>";
    $risultato .="<td>" . number_format($redimpannuo, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($canoneannuo, 2, ",", ".") . "</td>";
    $risultato .="<td>" . $mesiloc . "</td>";
    $risultato .="<td>" . number_format($incidenza, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($maggiorazione, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($incidenza14, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($fabbisogno, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($contributo, 2, ",", ".") . "</td>";

    $risultato .="</tr>";
  }



  $totfabbisogno = $totfabbisogno;
  $totcontributo = $totcontributo;



  $risultato .="<tr>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td style=\"color:#FF0000; font-weight:bold;\">" . number_format($totfabbisogno, 2, ",", ".") . "</td>";
  $risultato .="<td style=\"color:#FF0000; font-weight:bold; \">" . number_format($totcontributo, 2, ",", ".") . "</td>";
  $risultato .="</tr>";


  $chiusura = "</tr></table></body></html>";

  $file_fascia_a = $pagina . $risultato . $chiusura;

  $fp = fopen($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_A.xls", "w");

  $fw = fwrite($fp, $file_fascia_a);
  fclose($fp);
}



//inizio impaginazione fascia B

$fascia = "B";


$pagina = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"
			xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
			xmlns=\"http://www.w3.org/TR/REC-html40\">
			<html>\n\r
			<body>\n\r

					<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td><strong>Legge 431/98 anno " . $anno . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td  style=\"color:#000000; font-weight:bold;\">Comune di  " . $comune . "</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td width=\"27\"><strong>PROSPETTO RIEPILOGATIVO RISULTANZE BANDO COMUNALE DEL</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td  style=\"color:#000000; font-weight:bold;\">Cod. Fisc. " . $codfiscale . "</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>Finanziamento regionale  Euro <strong>" . number_format($fondoregione, 2, ",", ".") . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>Finanziamento a carico del Comune Euro <strong>" . number_format($fondocomune, 2, ",", ".") . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>Richiedenti Fascia <strong>" . $fascia . "</strong></td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r


			<tr>\n\r
			<td>&nbsp;</td>\n\r
			<td>D.M. 7/6/99 Art. 1</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			<td>&nbsp;</td>\n\r
			</tr>\n\r
			</table>

			<br />
			<br />

			<table  border=\"1\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n\r
			<tr>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>N. Progressivo</strong></td>\n\r
			<td colspan=\"2\" rowspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>COGNOME E NOME<strong></td>\n\r
			<td rowspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>INDIRIZZO</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>A</strong> Lavoratore Autonomo</td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>D</strong> Lavoratore Dipendente</td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>M</strong> Reddito Misto</td>\n\r
  			<td colspan=\"2\" rowspan=\"2\" style=\" text-align:center;vertical-align:middle;\"><strong>Alloggio</strong></td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Ascensore</td>\n\r
  			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Riscaldamento</td>\n\r
  			<td colspan=\"4\" style=\" text-align:center;vertical-align:middle;\"><strong>Contratto</strong></td>\n\r
  			<td colspan=\"6\" style=\" text-align:center;vertical-align:middle;\"><strong>Nucleo Familiare</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Reddito imponibile annuo complessivo</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Reddito convenzionale annuo complessivo art. 2 punto f legge n. 54/84</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Canone Annuo</strong></td>\n\r
  			<td rOWspan=\"3\" style=\" text-align:center;vertical-align:middle;\"><strong>Mesi di locazione</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Incidenza canone reddito</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Maggiore debolezza sociale 25%</strong></td>\n\r
			<td rowspan=\"3\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>U -14%*di T</strong></td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\"><strong>Fabbisogno</strong></td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\"><strong>Contributo Attribuito</strong></td>\n\r
			</tr>\n\r


			<tr>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Concordato L. n. 431/98</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si/No Libero</td>\n\r
			<td colspan=\"2\" style=\" text-align:center;vertical-align:middle;\">Registrazione</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N. figli a carico</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N. altri componenti</td>\n\r
			<td rowspan=\"2\" style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N. totale componenti</td>\n\r
			<td colspan=\"3\" style=\" text-align:center;vertical-align:middle;\">Debolezza sociale</td>\n\r
			<td rowspan=\"2\" style=\" text-align:center;vertical-align:middle;\">Calcolo contributo max concedibile nei limiti del D.M. 7/6/99 Artt. 1 e 2 in ragione del periodo di locazione</td>\n\r
			<td rowspan=\"2\" style=\" text-align:center;vertical-align:middle;\">a seguito determinazioni e/o riduzioni comunali</td>\n\r
			</tr>\n\r

			<tr>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero Vani</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sup. complessiva</td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\">n.</td>\n\r
			<td style=\" text-align:center;vertical-align:middle;\">data</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ultrasessantacinquenni</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Handicap</td>\n\r
			<td style=\"mso-rotate:90; text-align:center;vertical-align:bottom;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Indicare altro deciso dal bando comunale</td>\n\r

			</tr>\n\r



			<tr>\n\r
			<td  style=\"text-align:center;\">1</td>\n\r
			<td colspan=\"2\" style=\"text-align:center;\">2</td>\n\r
			<td  style=\"text-align:center;\">3</td>\n\r
			<td colspan=\"3\" style=\"text-align:center;\">4</td>\n\r
			<td  style=\"text-align:center;\">5</td>\n\r
			<td  style=\"text-align:center;\">6</td>\n\r
			<td  style=\"text-align:center;\">7</td>\n\r
			<td  style=\"text-align:center;\">8</td>\n\r
			<td  style=\"text-align:center;\">9</td>\n\r
			<td  style=\"text-align:center;\">10</td>\n\r
			<td  style=\"text-align:center;\">11</td>\n\r
			<td  style=\"text-align:center;\">12</td>\n\r
			<td  style=\"text-align:center;\">13</td>\n\r
			<td  style=\"text-align:center;\">14</td>\n\r
			<td  style=\"text-align:center;\">15</td>\n\r
			<td  style=\"text-align:center;\">16</td>\n\r
			<td  style=\"text-align:center;\">17</td>\n\r
			<td  style=\"text-align:center;\">18</td>\n\r
			<td  style=\"text-align:center;\">19</td>\n\r
			<td  style=\"text-align:center;\">20</td>\n\r
			<td  style=\"text-align:center;\">21</td>\n\r
			<td  style=\"text-align:center;\">22</td>\n\r
			<td  style=\"text-align:center;\">23a</td>\n\r
			<td  style=\"text-align:center;\">23</td>\n\r
			<td  style=\"text-align:center;\">24</td>\n\r
			<td  style=\"text-align:center;\">25</td>\n\r
			<td  style=\"text-align:center;\">26</td>\n\r


			</tr>\n\r";
$strsql = "SELECT * FROM b_richiedenti, b_configurazione ";
$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
$strsql .= "b_richiedenti.codfiscale = b_configurazione.codfiscale AND ";
$strsql .= "b_richiedenti.anno = '" . $anno . "' AND ";
$strsql .= "b_configurazione.codfiscale = '" . $codfiscale . "' AND ";
$strsql .= "redimpannuo>pensioneminimainps2 AND escluso='n' AND contributo >0 ";
// AND redimpannuo<= redditoerp
$strsql .= "ORDER BY redimpannuo ";

$rs_fascia_b = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
//echo $strsql . "<p>";


$progressivo = 0;
$risultato = "";

$totfabbisogno = 0;
$totcontributo = 0;

if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_B.xls")) {

  unlink($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_B.xls");
}

if (mysql_num_rows($rs_fascia_b) > 0) {

  while ($record = mysql_fetch_object($rs_fascia_b)) {

    $progressivo = $progressivo + 1;
    $cognome = $record->cognome;
    $nome = $record->nome;
    $indirizzo = $record->indirizzo;
    $lavaut = $record->lavaut;
    $lavdip = $record->lavdip;
    $redmisto = $record->redmisto;
    $nvani = $record->nvani;

    //$catcatastale = $record->catcatastale;

    $sup_totale = $record->sup_totale;
    $concordato = $record->concordato;
    $libero = $record->libero;

    //$nonspecificato = $record->nonspecificato;

    $riscaldamento = $record->riscaldamento;
    $ascendore = $record->ascensore;

    $numreg = $record->numreg;
    $datareg = mysql2date($record->datareg);
    $numfiglicarico = $record->numfiglicarico;
    $numaltricomp = $record->numaltricomp;
    $totcomp = $record->totcomp;
    $ultra65 = $record->ultra65;
    $handicap = $record->handicap;
    $altradebolezza = $record->altradebolezza;
    $redimpannuo = $record->redimpannuo;
    $redconv = $record->redconv;
    $canoneannuo = $record->canoneannuo;
    $mesiloc = $record->mesiloc;
    $incidenza = $record->incidenza;
    $maggiorazione = $record->maggiorazione;
    $incidenza14 = $record->incidenza14;
    $fabbisogno = $record->fabbisogno;
    $contributo = $record->contributo;

    $totfabbisogno = $totfabbisogno + $fabbisogno;
    $totcontributo = $totcontributo + $contributo;




    $risultato .= "<tr>";


    $risultato .="<td>" . $progressivo . "</td>";
    $risultato .="<td>" . $cognome . "</td>";
    $risultato .="<td>" . $nome . "</td>";
    $risultato .="<td>" . $indirizzo . "</td>";
    $risultato .="<td>" . $lavaut . "</td>";
    $risultato .="<td>" . $lavdip . "</td>";
    $risultato .="<td>" . $redmisto . "</td>";
    $risultato .="<td>" . number_format($nvani, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($sup_totale, 2, ",", ".") . "</td>";
    $risultato .="<td>" . $ascensore . "</td>";
    $risultato .="<td>" . $riscaldamento . "</td>";
    $risultato .="<td>" . $concordato . "</td>";
    $risultato .="<td>" . $libero . "</td>";
    $risultato .="<td>" . $numreg . "</td>";
    $risultato .="<td>" . $datareg . "</td>";
    $risultato .="<td>" . $numfiglicarico . "</td>";
    $risultato .="<td>" . $numaltricomp . "</td>";
    $risultato .="<td>" . $totcomp . "</td>";
    $risultato .="<td>" . $ultra65 . "</td>";
    $risultato .="<td>" . $handicap . "</td>";
    $risultato .="<td>" . $altradebolezza . "</td>";
    $risultato .="<td>" . number_format($redimpannuo, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($redconv, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($canoneannuo, 2, ",", ".") . "</td>";
    $risultato .="<td>" . $mesiloc . "</td>";
    $risultato .="<td>" . number_format($incidenza, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($maggiorazione, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($incidenza14, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($fabbisogno, 2, ",", ".") . "</td>";
    $risultato .="<td>" . number_format($contributo, 2, ",", ".") . "</td>";

    $risultato .= "</tr>";
  }



  $totfabbisogno = $totfabbisogno;
  $totcontributo = $totcontributo;



  $risultato .="<tr>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td>&nbsp;</td>";
  $risultato .="<td style=\"color:#FF0000; font-weight:bold;\">" . number_format($totfabbisogno, 2, ",", ".") . "</td>";
  $risultato .="<td style=\"color:#FF0000; font-weight:bold; \">" . number_format($totcontributo, 2, ",", ".") . "</td>";
  $risultato .="</tr>";



  $chiusura = "</tr></table></div></body></html>";

  //echo $stile . $corpo . $risultato . $chiusura;

  $file_fascia_b = $pagina . $risultato . $chiusura;

  $fp = fopen($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_B.xls", "w");

  $fw = fwrite($fp, $file_fascia_b);
  fclose($fp);
}


//esclusi

$corpo = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"
			xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
			xmlns=\"http://www.w3.org/TR/REC-html40\">
			<html>\n\r
			<body>\n\r";

$corpo .= "<!--[if !excel]>&nbsp;&nbsp;<![endif]-->";
$corpo .= "<!--Le seguenti informazioni sono state generate dalla Pubblicazione guidata";
$corpo .= "come pagina Web di Microsoft Excel.-->";
$corpo .= "<!--Se una voce viene pubblicata una seconda volta da Excel, verranno";
$corpo .= "sostituite tutte le informazioni tra i tag DIV.-->";
$corpo .= "<!----------------------------->";
$corpo .= "<!--INIZIO OUTPUT PUBBLICAZIONE GUIDATA COME PAGINA WEB -->";
$corpo .= "<!----------------------------->";
$corpo .= "<div id='Modello regione a_2302' align=center x:publishsource='Excel'>";
$corpo .= "<table x:str border=0 cellpadding=0 cellspacing=0 width=1728 style='border-collapse:collapse;table-layout:fixed;width:1296pt'>";
$corpo .= " <col width=64 span=27 style='width:48pt'>";


$corpo .= "<tr height=20 style='height:15.0pt'>";
$corpo .= "<td rowspan=3 height=193 class=xl672302 style='height:144.75pt'>N. progressivo</td>";
$corpo .= "<td colspan=2 rowspan=3 class=xl682302>COGNOME E NOME</td>";
$corpo .= "<td rowspan=3 class=xl732302>INDIRZZO</td>";
$corpo .= "<td rowspan=3 class=xl732302>CODICE FISCALE</td>";
$corpo .= "<td rowspan=3 class=xl732302>MOTIVO ESCLUSIONE</td>";
$corpo .= "</tr>";




$strsql = "SELECT * FROM b_richiedenti, b_configurazione ";
$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
$strsql .= "b_richiedenti.codfiscale = b_configurazione.codfiscale AND ";
$strsql .= "b_configurazione.codfiscale = '" . $codfiscale . "' AND ";
$strsql .= "b_richiedenti.anno = '" . $anno . "' AND escluso='s' ";
$strsql .= "ORDER BY cognome,nome ";

$rs_esclusi = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
//echo $strsql . "<p>";

$progressivo = 0;
$risultato = "";

$totfabbisogno = 0;
$totcontributo = 0;

if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_esclusi.xls")) {

  unlink($root . "/documenti/" . $codfiscale . "/" . $anno . "_esclusi.xls");
}

if (mysql_num_rows($rs_esclusi) > 0) {

  $risultato = "<table border='1'>";

  while ($record = mysql_fetch_object($rs_esclusi)) {

    $progressivo = $progressivo + 1;
    $cognome = $record->cognome;
    $nome = $record->nome;
    $indirizzo = $record->indirizzo;
    $cfiscale = $record->cfiscale;

    $motivoesclusione = $record->motivoesclusione;


    $risultato .="<tr height=18 style='height:13.5pt'>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $progressivo . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $cognome . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $nome . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $indirizzo . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $cfiscale . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:73pt' x:num>" . $motivoesclusione . "</td>";
    $risultato .="</tr>";
  }

  $risultato .= "</table></body></html>";


  $file_esclusi = $corpo . $risultato;

  $fp = fopen($root . "/documenti/" . $codfiscale . "/" . $anno . "_esclusi.xls", "w");

  $fw = fwrite($fp, $file_esclusi);
  fclose($fp);
}


//elenco richiedenti
$corpo = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"
			xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
			xmlns=\"http://www.w3.org/TR/REC-html40\">
			<html>\n\r
			<body>\n\r";

$corpo .= "<!--[if !excel]>&nbsp;&nbsp;<![endif]-->";
$corpo .= "<!--Le seguenti informazioni sono state generate dalla Pubblicazione guidata";
$corpo .= "come pagina Web di Microsoft Excel.-->";
$corpo .= "<!--Se una voce viene pubblicata una seconda volta da Excel, verranno";
$corpo .= "sostituite tutte le informazioni tra i tag DIV.-->";
$corpo .= "<!----------------------------->";
$corpo .= "<!--INIZIO OUTPUT PUBBLICAZIONE GUIDATA COME PAGINA WEB -->";
$corpo .= "<!----------------------------->";
$corpo .= "<div id='Modello regione a_2302' align=center x:publishsource='Excel'>";
$corpo .= "<table x:str border=0 cellpadding=0 cellspacing=0 width=1728 style='border-collapse:collapse;table-layout:fixed;width:1296pt'>";
$corpo .= " <col width=64 span=27 style='width:48pt'>";

$corpo .= "<tr height=20 style='height:15.0pt'>";
$corpo .= "<td rowspan=3 height=193 class=xl672302 style='height:144.75pt'>N. progressivo</td>";
$corpo .= "<td rowspan=3 class=xl682302>COGNOME</td>";
$corpo .= "<td rowspan=3 class=xl682302>NOME</td>";
$corpo .= "<td rowspan=3 class=xl682302>DATA NASCITA</td>";
$corpo .= "<td rowspan=3 class=xl732302>CODICE FISCALE</td>";
$corpo .= "<td rowspan=3 class=xl732302>INDIRZZO</td>";
$corpo .= "<td rowspan=3 class=xl732302>CONTRIBUTO</td>";
$corpo .= "<td rowspan=3 class=xl732302>QUIETANZA</td>";
$corpo .= "<td rowspan=3 class=xl732302>CODICE IBAN</td>";
$corpo .= "<td rowspan=3 class=xl732302>CIN</td>";
$corpo .= "<td rowspan=3 class=xl732302>ABI</td>";
$corpo .= "<td rowspan=3 class=xl732302>CAB</td>";
$corpo .= "<td rowspan=3 class=xl732302>IBAN</td>";
$corpo .= "<td rowspan=3 class=xl732302>CONTO</td>";
$corpo .= "</tr>";

$strsql = "SELECT * FROM b_richiedenti, b_configurazione ";
$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
$strsql .= "b_richiedenti.codfiscale = b_configurazione.codfiscale AND ";
$strsql .= "b_configurazione.codfiscale = '" . $codfiscale . "' AND ";
$strsql .= "b_richiedenti.anno = '" . $anno . "' AND escluso='n' ";
$strsql .= "ORDER BY cognome,nome ";

$rs_esclusi = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
//echo $strsql . "<p>";
$progressivo = 0;
$risultato = "";
$totfabbisogno = 0;
$totcontributo = 0;

if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_elenco_richiedenti.xls")) {
  unlink($root . "/documenti/" . $codfiscale . "/" . $anno . "_elenco_richiedenti.xls");
}

if (mysql_num_rows($rs_esclusi) > 0) {
  $risultato = "<table border='1'>";
  while ($record = mysql_fetch_object($rs_esclusi)) {
    $progressivo = $progressivo + 1;
    $cognome = $record->cognome;
    $nome = $record->nome;
    $indirizzo = $record->indirizzo;
    $cfiscale = $record->cfiscale;
    $datanascita = mysql2date($record->datanascita);
    $contributo = $record->contributo;
    $motivoesclusione = $record->motivoesclusione;
    $cod_iban = $record->cod_iban;

    $risultato .="<tr height=18 style='height:13.5pt'>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $progressivo . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $cognome . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $nome . "</td>";
    $risultato .= "<td class=xl612302 style='border-top:none;border-left:none;  width:73pt' x:num>" . $datanascita . "</td>";
    //$risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $datanascita . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $cfiscale . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $indirizzo . "</td>";
    $risultato .="<td class=euro style='border-top:none;border-left:none' x:num>" . $contributo . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' > _____________ </td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' >" . $cod_iban . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' >" . substr($cod_iban,4,1) . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' >" . substr($cod_iban,5,5) . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' >" . substr($cod_iban,10,5) . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' >" . substr($cod_iban,0,4) . "</td>";
    $risultato .="<td class=xl592302 style='border-top:none;border-left:none;  width:93pt' >" . substr($cod_iban,15,12) . "</td>";
	$risultato .="</tr>";
  }
  $risultato .= "</table>";
  $file_esclusi = $corpo . $risultato;
  $fp = fopen($root . "/documenti/" . $codfiscale . "/" . $anno . "_elenco_richiedenti.xls", "w");
  $fw = fwrite($fp, $file_esclusi);
  fclose($fp);
}
?>

