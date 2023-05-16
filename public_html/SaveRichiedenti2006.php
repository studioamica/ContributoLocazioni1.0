<?php
session_start();

include("config.php");
include ($root . '/inc/funzioni.php');

$codoperator = autorizzato(@$_SESSION["codoperator"]);
$nomeoperator = $_SESSION["nomeoperator"];
$codfiscale = verificacodfiscale($codoperator);
$anno = 0;
if (isset($_POST["anno"])) {
  $anno = $_POST["anno"];
}
?>
<?php
include ($root . "/layout/print_layout.php");
$titolo = array("/SceltaAnno.php" => "Scelta Anno", "/GestioneRichiedenti.php" => "Richiedenti", "" => "Salvataggio Dati");
print_top("Legge 431/98 - Studio Amica - ", $titolo);
?>
<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php
?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
<?php
$strconnessione = connessione();
$agg_table = false;
$errore = false;
$msg = "";
//in base alla scelta dell'operazione che l'operatore vuole effettuare si eseguono le varie parti di codice
//l'operatore dalla pagina GestioneReferenti.php ha scelto INSERIMENTO
if ($_POST["operazione"] == "Inserimento") {
  $cognome = strip_tags($_POST["cognome"]);
  $cognome = converti($cognome);
  $nome = strip_tags($_POST["nome"]);
  $nome = converti($nome);
  $indirizzo = strip_tags($_POST["indirizzo"]);
  $indirizzo = converti($indirizzo);
  $luogonascita = strip_tags($_POST["luogonascita"]);
  $luogonascita = converti($luogonascita);
  $cfiscale = strip_tags($_POST["cfiscale"]);
  $cfiscale = converti($cfiscale);
  $note = strip_tags($_POST["note"]);
  $note = converti($note);
  $nazionalita = strip_tags($_POST["nazionalita"]);
  $nazionalita = converti($nazionalita);
  $rd = "";
  $ra = "";
  $rm = "";
  if ($_POST["tipo_reddito"] == "D") {
    $rd = "D";
  }
  elseif ($_POST["tipo_reddito"] == "A") {
    $ra = "A";
  }
  elseif ($_POST["tipo_reddito"] == "M") {
    $rm = "M";
  }
  $spt = 0;
  if ($_POST["sup_totale"] != "") {
    $spt = $_POST["sup_totale"];
  }
  $nvani = 0;
  if ($_POST["nvani"] != "") {
    $nvani = $_POST["nvani"];
  }

  $strsql = "INSERT INTO b_richiedenti (";
  $strsql .= "anno,cognome,nome,indirizzo,luogonascita,datanascita,cfiscale,lavaut,lavdip,redmisto,nvani,sup_totale,riscaldamento,";
  $strsql .= "concordato,libero,ascensore,catcatastale,nazionalita,d_sfratto,";
  $strsql .= "numreg,datareg,numfiglicarico,numaltricomp,totcomp,ultra65,handicap,altradebolezza,";
  $strsql .= "redimpannuo,canoneannuo,mesiloc,note,codfiscale,cod_iban,codoperatore";
  $strsql .= ") ";
  $strsql .= "Values (";
  $strsql .= "\"" . $_POST["anno"] . "\"" . ",";
  $strsql .= "\"" . $cognome . "\"" . ",";
  $strsql .= "\"" . $nome . "\"" . ",";
  $strsql .= "\"" . $indirizzo . "\"" . ",";
  $strsql .= "\"" . $luogonascita . "\"" . ",";
  $strsql .= "\"" . date2mysql($_POST["datanascita"]) . "\"" . ",";
  $strsql .= "\"" . $cfiscale . "\"" . ",";
  $strsql .= "\"" . $ra . "\"" . ",";
  $strsql .= "\"" . $rd . "\"" . ",";
  $strsql .= "\"" . $rm . "\"" . ",";
  $strsql .= "" . $nvani . "" . ",";
  $strsql .= "" . $spt . "" . ",";
  $strsql .= "\"" . $_POST["riscaldamento"] . "\"" . ",";
  $strsql .= "\"" . $_POST["concordato"] . "\"" . ",";
  $strsql .= "\"" . $_POST["libero"] . "\"" . ",";
  $strsql .= "\"" . $_POST["ascensore"] . "\"" . ",";
  $strsql .= "\"" . $_POST["catcatastale"] . "\"" . ",";
  $strsql .= "\"" . $nazionalita . "\"" . ",";
  $strsql .= "\"" . date2mysql($_POST["d_sfratto"]) . "\"" . ",";
  $strsql .= "" . $_POST["numreg"] . "" . ",";
  $strsql .= "\"" . date2mysql($_POST["datareg"]) . "\"" . ",";
  $strsql .= "" . $_POST["numfiglicarico"] . "" . ",";
  $strsql .= "" . $_POST["numaltricomp"] . "" . ",";
  $strsql .= "" . $_POST["totcomp"] . "" . ",";
  $strsql .= "\"" . $_POST["ultra65"] . "\"" . ",";
  $strsql .= "\"" . $_POST["handicap"] . "\"" . ",";
  $strsql .= "\"" . $_POST["altradebolezza"] . "\"" . ",";
  $strsql .= "" . $_POST["redimpannuo"] . "" . ",";
  $strsql .= "" . $_POST["canoneannuo"] . "" . ",";
  $strsql .= "" . $_POST["mesiloc"] . "" . ",";
  $strsql .= "\"" . $note . "\"" . ",";
  $strsql .= "\"" . $_POST["codfiscale"] . "\"" . ",";
  $strsql .= "\"" . $_POST["codiban"] . "\"" . ",";
  $strsql .= " " . $codoperator;
  $strsql .= ") ";
  //echo $strsql . "<p>";
  $risultato = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
  $msg = "Inserimento effettuato con successo!!!";
  $risultato = mysql_query(scrivilog("b_richiedenti", "Inserimento", $strsql, $codoperator), $strconnessione);
}
//l'operatore dalla pagina GestioneReferenti.php ha scelto MODIFICA
elseif ($_POST["operazione"] == "Modifica") {
  $cognome = strip_tags($_POST["cognome"]);
  $cognome = converti($cognome);
  $nome = strip_tags($_POST["nome"]);
  $nome = converti($nome);
  $indirizzo = strip_tags($_POST["indirizzo"]);
  $indirizzo = converti($indirizzo);
  $luogonascita = strip_tags($_POST["luogonascita"]);
  $luogonascita = converti($luogonascita);
  $cfiscale = strip_tags($_POST["cfiscale"]);
  $cfiscale = converti($cfiscale);
  $note = strip_tags($_POST["note"]);
  $note = converti($note);
  $nazionalita = strip_tags($_POST["nazionalita"]);
  $nazionalita = converti($nazionalita);
  $rd = "";
  $ra = "";
  $rm = "";
  if ($_POST["tipo_reddito"] == "D") {
    $rd = "D";
  }
  elseif ($_POST["tipo_reddito"] == "A") {
    $ra = "A";
  }
  elseif ($_POST["tipo_reddito"] == "M") {
    $rm = "M";
  }
  $spt = 0;
  if ($_POST["sup_totale"] != "") {
    $spt = $_POST["sup_totale"];
  }
  $nvani = 0;
  if ($_POST["nvani"] != "") {
    $nvani = $_POST["nvani"];
  }

  $strsql = "UPDATE b_richiedenti SET ";
  $strsql .= "cognome = \"" . $cognome . "\", ";
  $strsql .= "nome = \"" . $nome . "\", ";
  $strsql .= "indirizzo = \"" . $indirizzo . "\", ";
  $strsql .= "luogonascita = \"" . $luogonascita . "\", ";
  $strsql .= "datanascita = \"" . date2mysql($_POST["datanascita"]) . "\", ";
  $strsql .= "cfiscale = \"" . $cfiscale . "\", ";
  $strsql .= "lavaut = \"" . $ra . "\", ";
  $strsql .= "lavdip = \"" . $rd . "\", ";
  $strsql .= "redmisto = \"" . $rm . "\", ";
  $strsql .= "nvani = " . $nvani . " , ";
  $strsql .= "sup_totale = " . $spt . " , ";
  $strsql .= "ascensore = \"" . $_POST["ascensore"] . "\", ";
  $strsql .= "concordato = \"" . $_POST["concordato"] . "\", ";
  $strsql .= "libero = \"" . $_POST["libero"] . "\", ";
  $strsql .= "catcatastale = \"" . $_POST["catcatastale"] . "\", ";
  $strsql .= "nazionalita = \"" . $nazionalita . "\", ";
  $strsql .= "d_sfratto = \"" . date2mysql($_POST["d_sfratto"]) . "\", ";
  $strsql .= "riscaldamento = \"" . $_POST["riscaldamento"] . "\", ";
  $strsql .= "numreg = " . $_POST["numreg"] . ",  ";
  $strsql .= "datareg = \"" . date2mysql($_POST["datareg"]) . "\", ";
  $strsql .= "numfiglicarico = " . $_POST["numfiglicarico"] . ",  ";
  $strsql .= "numaltricomp = " . $_POST["numaltricomp"] . ",  ";
  $strsql .= "totcomp = " . $_POST["totcomp"] . ",  ";
  $strsql .= "ultra65 = \"" . $_POST["ultra65"] . "\", ";
  $strsql .= "handicap = \"" . $_POST["handicap"] . "\", ";
  $strsql .= "altradebolezza = \"" . $_POST["altradebolezza"] . "\", ";
  $strsql .= "redimpannuo = " . $_POST["redimpannuo"] . ",  ";
  $strsql .= "canoneannuo = " . $_POST["canoneannuo"] . ",  ";
  $strsql .= "mesiloc = " . $_POST["mesiloc"] . ",  ";
  $strsql .= "note = \"" . $note . "\", ";
  $strsql .= "cod_iban = \"" . $_POST["codiban"] . "\", ";
  $strsql .= "codoperatore = " . $codoperator . "  ";
  $strsql .= "WHERE ";
  $strsql .= "codice = " . $_POST["codice"];
  //echo $strsql . "<p>";
  $risultato = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
  $msg = "Modifica effettuata con successo!!!";
  $risultato = mysql_query(scrivilog("b_richiedenti", "Modifica", $strsql, $codoperator), $strconnessione);
}
//l\"operatore dalla pagina GestioneReferenti.php ha scelto CANCELLAZIONE
elseif ($_POST["operazione"] == "Cancellazione") {
  $i = $_POST["i"];
  //echo $i;
  $msg = "Nessun Record Cancellato";
  for ($j = 1; $j <= $i; $j++) {
    $selez = 0;
    if (isset($_POST["selez" . $j])) {
      $selez = $_POST["selez" . $j];
      $strsql = "DELETE FROM b_richiedenti WHERE codice = " . $selez;
      //echo $strsql . "<p>";
      $risultato = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
      $risultato = mysql_query(scrivilog("b_richiedenti", "Cancellazione", $strsql, $codoperator), $strconnessione);
      $msg = "Cancellazione effettuata con successo!!!";
    }
  }
}
elseif ($_POST["operazione"] == "Duplicazione") {
  $i = $_POST["i"];
  //echo $i;
  $msg = "Nessun Record Duplicato";
  for ($j = 1; $j <= $i; $j++) {
    $selez = 0;
    if (isset($_POST["selez" . $j])) {
      $selez = $_POST["selez" . $j];
      $strsql = "SELECT * FROM b_richiedenti WHERE codice = " . $selez;
      //echo $strsql . "<p>";
      $risultato = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
      $record = mysql_fetch_object($risultato);
      $codice = $record->codice;
      $anno = $record->anno;
      $cognome = $record->cognome;
      $nome = $record->nome;
      $indirizzo = $record->indirizzo;
      $luogonascita = $record->luogonascita;
      $datanascita = $record->datanascita;
      $cfiscale = $record->cfiscale;
      $lavaut = $record->lavaut;
      $lavdip = $record->lavdip;
      $redmisto = $record->redmisto;
      $nvani = $record->nvani;
      $sup_totale = $record->sup_totale;
      $riscaldamento = $record->riscaldamento;
      $concordato = $record->concordato;
      $libero = $record->libero;
      $ascensore = $record->ascensore;
      $numreg = $record->numreg;
      $datareg = $record->datareg;
      $numfiglicarico = $record->numfiglicarico;
      $numaltricomp = $record->numaltricomp;
      $totcomp = $record->totcomp;
      $ultra65 = $record->ultra65;
      $handicap = $record->handicap;
      $altradebolezza = $record->altradebolezza;
      $catcatastale = $record->catcatastale;
      $nazionalita = $record->nazionalita;
      $d_sfratto = $record->d_sfratto;
      $codfiscale = $record->codfiscale;
      $codiban = $record->cod_iban;
      $anno = $anno + 1;
      $strsql = "INSERT INTO b_richiedenti (";
      $strsql .= "anno,cognome,nome,indirizzo,luogonascita,datanascita,cfiscale,lavaut,lavdip,redmisto,";
      $strsql .= "nvani,sup_totale,riscaldamento,concordato,libero,ascensore,catcatastale,nazionalita,d_sfratto,";
      $strsql .= "numreg,datareg,numfiglicarico,numaltricomp,totcomp,ultra65,handicap,altradebolezza,";
      $strsql .= "redimpannuo,canoneannuo,mesiloc,codfiscale,cod_iban,codoperatore";
      $strsql .= ") ";
      $strsql .= "Values (";
      $strsql .= "\"" . $anno . "\"" . ",";
      $strsql .= "\"" . $cognome . "\"" . ",";
      $strsql .= "\"" . $nome . "\"" . ",";
      $strsql .= "\"" . $indirizzo . "\"" . ",";
      $strsql .= "\"" . $luogonascita . "\"" . ",";
      $strsql .= "\"" . $datanascita . "\"" . ",";
      $strsql .= "\"" . $cfiscale . "\"" . ",";
      $strsql .= "\"" . $lavaut . "\"" . ",";
      $strsql .= "\"" . $lavdip . "\"" . ",";
      $strsql .= "\"" . $redmisto . "\"" . ",";
      $strsql .= "" . $nvani . "" . ",";
      $strsql .= "" . $sup_totale . "" . ",";
      $strsql .= "\"" . $riscaldamento . "\"" . ",";
      $strsql .= "\"" . $concordato . "\"" . ",";
      $strsql .= "\"" . $libero . "\"" . ",";
      $strsql .= "\"" . $ascensore . "\"" . ",";
      $strsql .= "\"" . $catcatastale . "\"" . ",";
      $strsql .= "\"" . $nazionalita . "\"" . ",";
      $strsql .= "\"" . $d_sfratto . "\"" . ",";
      $strsql .= "" . $numreg . "" . ",";
      $strsql .= "\"" . $datareg . "\"" . ",";
      $strsql .= "" . $numfiglicarico . "" . ",";
      $strsql .= "" . $numaltricomp . "" . ",";
      $strsql .= "" . $totcomp . "" . ",";
      $strsql .= "\"" . $ultra65 . "\"" . ",";
      $strsql .= "\"" . $handicap . "\"" . ",";
      $strsql .= "\"" . $altradebolezza . "\"" . ",";
      $strsql .= "" . 0 . "" . ",";
      $strsql .= "" . 0 . "" . ",";
      $strsql .= "" . 12 . "" . ",";
      $strsql .= "\"" . $codfiscale . "\"" . ",";
      $strsql .= "\"" . $codiban . "\"" . ",";
      $strsql .= " " . $codoperator;
      $strsql .= ") ";
      //echo $strsql . "<p>";
      //die();
      $risultato = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
      $risultato = mysql_query(scrivilog("b_richiedenti", "Duplicazione", $strsql, $codoperator), $strconnessione);
      $msg = "Duplicazione effettuata con successo!!!";
    }
  }
}
mysql_close($strconnessione); //chiude la connessione aperta
?>
<div align="center"><strong><? echo $msg ?></strong></div>
</div>
<br>
<br clear="all" class="hide"/>
<!-- Fine div contenuti -->
<? include ($root . "/layout/bottom.php"); ?>