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
  $_SESSION["anno1"] = $anno;
}
if (isset($_SESSION["anno1"])) {
  $anno = $_SESSION["anno1"];
}

$Cod = 0;
if (isset($_GET["Cod"])) {
  $Cod = $_GET["Cod"];
}
?>

<script src="/inc/funzioni.js"></script>
<script>
  function validate() {


    var selez="";

    var codice=0;
    var i=0;
    var j=0;
    var errore=false;
    var msg="";


    i=document.box.i.value;

    //le operazioni che seguono possono essere effettuate se si ha l'accesso in inserimento e modifica
    if (document.box.modificadati.value==1) {

      msg="";


      if  (trim(document.box.cognome.value)== "" ) {
        msg = msg + "Inserire il Cognome\n";
      }

      if  (trim(document.box.nome.value)== "" ) {
        msg = msg + "Inserire il Nome\n";
      }

      if  (trim(document.box.indirizzo.value)== "" ) {
        msg = msg + "Inserire l'Indirizzo\n";
      }

      if (!VerificaData(document.box.datanascita.value,0)) {
        msg = msg + "Inserire o Verificare la Data di Nascita\n";
      }


      if  (document.box.cfiscale.value.length != 16 && document.box.cfiscale.value != ".") {
        msg = msg + "Inserire o Verificare il Codice Fiscale\n";
      }

      if (trim(document.box.tipo_reddito.value) == "" ) {
        msg = msg + "Controllare la tipologia di Reddito del Lavoratore (Autonomo/Dipendente/Misto)\n";
      }

      if (isNaN(document.box.nvani.value)) {
        msg = msg + "Controllare il Numero dei Vani\n";
      }

      if (isNaN(document.box.sup_totale.value)) {
        msg = msg + "Controllare la Superficie totale dell'Alloggio\n";
      }

      if (isNaN(document.box.numreg.value)) {
        msg = msg + "Controllare il Numero di Registrazione del Contratto\n";
      }

      if (!VerificaData(document.box.datareg.value,-1)) {
        msg = msg + "Inserire o Verificare la Data di Registrazione del Contratto\n";
      }

      if (!VerificaData(document.box.d_sfratto.value,0)) {
        msg = msg + "Verificare la Data di Sfratto\n";
      }


      if (isNaN(document.box.numfiglicarico.value)) {
        msg = msg + "Controllare il Numero dei Figli a Carico\n";
      }

      if (isNaN(document.box.numaltricomp.value)) {
        msg = msg + "Controllare il Numero degli altri Componenti\n";
      }

      if (isNaN(document.box.totcomp.value)) {
        msg = msg + "Controllare il Numero Totale dei Componenti\n";
      }

      if (isNaN(document.box.redimpannuo.value)) {
        msg = msg + "Controllare il Reddito Imponibile Annuno\n";
      }

      if (isNaN(document.box.canoneannuo.value)) {
        msg = msg + "Controllare il Canone Annuno\n";
      }

      if (isNaN(document.box.mesiloc.value)) {
        msg = msg + "Controllare i Mesi di Locazione\n";
      }

      if (msg != "") {
        alert(msg)
        return false
      }


      //return okins(document.box.operazione.value);

      //verifica se l'operatore vuole effettuare una CANCELLAZIONE  e non ha spuntato il record
      if (okcanc(document.box.operazione.value,i)==false) {return false};

    }
    else {
      if (okcanc(document.box.operazione.value,i)==false) {return false};

    }

    return okins(document.box.operazione.value);
  }





</script>

<?php
include ($root . "/layout/print_layout.php");

$titolo = array("/SceltaAnno.php" => "Scelta Anno", "/GestioneRichiedenti.php" => "Richiedenti", "" => "Dettaglio Richiedente");
print_top("Legge 431/98 - Studio Amica - ", $titolo);
?>
<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php ?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>

<h2 class="hide" align="left">&raquo; Dettaglio Richiedente</h2>

<?php
$strconnessione = connessione();

$permessi = "MILCS";

$strsql = "SELECT * FROM b_richiedenti ";
$strsql .= "WHERE codice = " . $Cod . " AND codfiscale='" . $codfiscale . "' AND anno='" . $anno . "' ";

//echo $strsql . "<p>";

$risultato = mysql_query($strsql, $strconnessione); //invia la query contenuta in $strsql al database apero e connesso
?>
<form method='POST' action='SaveRichiedenti2006.php' name='box' onSubmit='return validate()'>
  <input type='hidden' name='CheckAll' value='true'>
  <input type='hidden' name='codfiscale' value='<? echo $codfiscale; ?>'>
  <input type='hidden' name="anno"  	value="<? echo $anno; ?>">

<?php
if (strpos($permessi, "M") !== false) {
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

  <?php
  $codice = 0;
  $cognome = "";
  $nome = "";
  $indirizzo = "";
  $luogonascita = "";
  $datanascita = "";
  $cfiscale = "";
  $lavaut = "";
  $lavdip = "D";
  $redmisto = "";

  $nvani = 0;
  $sup_totale = 0;
  $catcatastale = "A/3";
  $concordato = "";
  $libero = "";

  $nazionalita = "";
  $d_sfratto = "";

  //$nonspecificato = "";

  $ascensore = "";
  $riscaldamento = "";

  $numreg = "0";
  $datareg = "";
  $numfiglicarico = 0;
  $numaltricomp = 0;
  $totcomp = 0;
  $ultra65 = "N";
  $handicap = "N";
  $altradebolezza = "N";
  $redimpannuo = 0;
  $redconv = 0;
  $canoneannuo = 0;
  $mesiloc = 12;
  $incidenza = 0;
  $maggiorazione = 0;
  $incidenza14 = 0;
  $fabbisogno = 0;
  $contributo = 0;
  $motivoesclusione = "-";
  $note = "";

  $cod_iban = "";

  if (mysql_num_rows($risultato) > 0) {

    $i = 1;
    $record = mysql_fetch_object($risultato);

    $codice = $record->codice;
    $anno = $record->anno;
    $cognome = $record->cognome;
    $nome = $record->nome;
    $indirizzo = $record->indirizzo;
    $luogonascita = $record->luogonascita;
    $datanascita = mysql2date($record->datanascita);
    $cfiscale = $record->cfiscale;
    $lavaut = $record->lavaut;
    $lavdip = $record->lavdip;
    $redmisto = $record->redmisto;
    $nvani = $record->nvani;
    $sup_totale = $record->sup_totale;
    $catcatastale = $record->catcatastale;
    $concordato = $record->concordato;
    $libero = $record->libero;
    //$nonspecificato = $record->nonspecificato;

    $nazionalita = $record->nazionalita;
    $d_sfratto = mysql2date($record->d_sfratto);

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
    $redconv = $record->redconv;
    $canoneannuo = $record->canoneannuo;
    $mesiloc = $record->mesiloc;
    $incidenza = $record->incidenza;
    $maggiorazione = $record->maggiorazione;
    $incidenza14 = $record->incidenza14;
    $fabbisogno = $record->fabbisogno;
    $contributo = $record->contributo;
    $motivoesclusione = $record->motivoesclusione;
    $note = $record->note;

    $codfiscale = $record->codfiscale;

    $cod_iban = $record->cod_iban;
  }


  $tipo_reddito = trim($lavaut . $lavdip . $redmisto);

  //echo $lavaut . " " . $lavdip . " " . $redmisto . "<br />";
  ?>

  <div><label id="lbl" for="selezione">Seleziona: </label>
    <input type='checkbox'   name="selez<? echo $i ?>"  	value="<? echo $codice; ?>" id="selezione"><span id="anno"><strong>   Anno Richiesta</strong></span>
    Anno :
    <strong><? echo $anno; ?></strong></div>
  <div>
    <div id="contenitore">
      <div id="moduli">

        <h2>Anagrafica Richiedente</h2>
        <table cols="2" >
          <tr><td>Cognome</td><td><input type='text' name='cognome' value="<? echo $cognome; ?>"></td></tr>
          <tr><td>Nome</td><td> <input type='text' name='nome' value="<? echo $nome; ?>"></td></tr>
          <tr><td>Luogo Nascita</td><td> <input type='text' name='luogonascita' value="<? echo $luogonascita; ?>"></td></tr>
          <tr><td>Data Nascita</td><td>  <input type='text' name='datanascita' size="10" value="<? echo $datanascita; ?>"></td></tr>
          <tr><td>Codice Fiscale</td><td> <input type='text' name='cfiscale' value="<? echo $cfiscale; ?>"></td></tr>
          <tr><td>Indirizzo</td><td>  <input type='text' name='indirizzo' value="<? echo $indirizzo; ?>"></td></tr>
          <tr><td>Tipologia Reddito</td><td>  <select size='1' name="tipo_reddito" id="tipo_reddito">
                <option selected value="<? echo $tipo_reddito; ?>"><? echo $tipo_reddito; ?></option>
                <option value="A">A</option>
                <option value="D">D</option>
                <option value="M">M</option>
                <option value=""></option>
              </select></td></tr>

          <tr><td colspan="2">&nbsp;&nbsp;</td></tr>
          <tr><td colspan="2">&nbsp;&nbsp;</td></tr>
          <tr><td colspan="2">&nbsp;&nbsp;</td></tr>
        </table>

      </div>

    </div>

    <div id="contenitore">
      <div id="moduli">			<h2><strong>Alloggio</strong></h2>
        <table cols="2">
          <tr><td>N. Vani Alloggio </td><td><input type='text' name='nvani' value="<? echo $nvani; ?>" size="5"></td></tr>
          <tr><td>Sup. totale</td><td><input type='text' name='sup_totale' value="<? echo $sup_totale; ?>" size="5"></td></tr>

          <tr><td>Cat. Catastale	</td><td><select size='1' name="catcatastale" id="catcatastale"><option selected value="<? echo $catcatastale; ?>"><? echo $catcatastale; ?></option>
                <option value="A/2">A/2</option>
                <option value="A/3">A/3</option>
                <option value="A/4">A/4</option>
                <option value="A/5">A/5</option>
                <option value="A/6">A/6</option>
                <option value="A/7">A/7</option>
                <option value="N/D">N/D</option>
              </select></td></tr>

          <tr><td>Ascensore</td><td><select size='1' name="ascensore" id="ascensore">
                <option selected value="<? echo $ascensore; ?>"><? echo $ascensore; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr>
          <tr><td>Riscaldamento</td><td><select size='1' name="riscaldamento" id="riscaldamento">
                <option selected value="<? echo $riscaldamento; ?>"><? echo $riscaldamento; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr>

        </table>

      </div>
      <div id="clear">&nbsp;</div>
      <div id="moduli"><h2><strong>Informazioni sul Contratto</strong></h2>
        <table cols="2">
          <tr><td>Concordato L. 431/98 </td><td><select size='1' name="concordato" id="concordato">
                <option selected value="<? echo $concordato; ?>"><? echo $concordato; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr>
          <tr><td>Libero </td><td><select size='1' name="libero" id="libero">
                <option selected value="<? echo $libero; ?>"><? echo $libero; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr>


          <tr><td>Num. Reg. Contratto </td><td><input type='text' name='numreg' value="<? echo $numreg; ?>" size="10"></td></tr>
          <tr><td>Data Reg. Contratto </td><td><input name="datareg" type ='text'	value="<? echo $datareg; ?>" size="10" maxlength="10" id="datareg" onclick="return calendar('datareg')"></td></tr>

          <tr><td>Data Sfratto</td><td>  <input type='text' name='d_sfratto' size="10" value="<? echo $d_sfratto; ?>"></td></tr>
        </table>
      </div>
    </div>
    <div id="contenitore">
      <div id="moduli"><h2><strong>Nucelo Familiare</strong></h2>
        <table cols="2"	>
          <tr><td>Num. Figli a Carico </td><td><input type='text' name='numfiglicarico' value="<? echo $numfiglicarico; ?>" size="5"></td></tr>
          <tr><td>Num. altri componenti</td><td> <input type='text' name='numaltricomp' value="<? echo $numaltricomp; ?>" size="5"></td></tr>
          <tr><td>Num. Totale Componenti</td><td> <input type='text' name='totcomp' value="<? echo $totcomp; ?>" size="5"></td></tr>
        </table>
      </div>

      <div id="moduli"><h2><strong>Debolezza Sociale</strong></h2>
        <table cols="2">			<tr><td>Ultra 65enni </td><td><select size='1' name="ultra65" id="ultra65">
                <option selected value="<? echo $ultra65; ?>"><? echo $ultra65; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr>
          <tr><td>Handicap</td><td>
              <select size='1' name="handicap" id="handicap">
                <option selected value="<? echo $handicap; ?>"><? echo $handicap; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr>


          <tr><td>Altra debolezza decisa <br />dal Bando Comunale </td><td><select size='1' name="altradebolezza" id="altradebolezza">
                <option selected value="<? echo $altradebolezza; ?>"><? echo $altradebolezza; ?></option>
                <option value="S">S</option>
                <option value="N">N</option>
              </select></td></tr><tr><td colspan="2">&nbsp;&nbsp;</td></tr><tr><td colspan="2">&nbsp;&nbsp;</td></tr></table></div>
    </div>
    <div id="contenitore">
      <div id="moduli"><h2><strong>Dati Reddituali Richiedente</strong></h2>
        <table cols="2">
          <tr><td>Reddito imponibile <br />annuo complessivo</td><td>
              <input type='text' name='redimpannuo' value="<? echo $redimpannuo; ?>" size="10"></td></tr>
          <tr><td>Reddito convenzionale <br />annuo complessivo</td><td>
<? echo $redconv; ?></td></tr>

          <tr><td>Canone Annuo</td><td>
              <input type='text' name='canoneannuo' value="<? echo $canoneannuo; ?>" size="10"></td></tr>
          <tr><td>Mesi Locazione</td><td>
              <input type='text' name='mesiloc' value="<? echo $mesiloc; ?>" size="10"></td></tr>
          <tr><td>Incidenza Canone reddito</td><td>
<? echo $incidenza; ?></td></tr>
          <tr><td>Maggiorazione deb. soc. 25%</td><td>
<? echo $maggiorazione; ?></td></tr>
          <tr><td>Ulteriore Riduzione</td><td>
              <? echo $incidenza14; ?></td></tr></table>

      </div>
    </div>
    <!--
    <div id="clear">&nbsp;</div>
    -->
    <div id="contenitore">
      <div id="moduli">			<h2><strong>Dati Banca</strong></h2>
        <table cols="2">
          <tr><td>IBAN </td><td><input type='text' name='codiban' value="<? echo $cod_iban; ?>" size="35" maxlength="27" ></td></tr>
        </table>
      </div>
    </div>

    <div id="clear">&nbsp;</div>

    <div id="contributo" align="center"><h2><strong>Note</strong></h2>
      <table cols="2">
        <tr>
          <td><textarea rows='5' name="note" cols='100' id="note"><? echo $note; ?></textarea></td>
        </tr>
      </table>
    </div>


    <div id="contributo" align="center"><h2><strong>Fabbisogno e Contributo Attribuito</strong></h2>
      <table cols="2">
        <tr><td>Fabbisogno </td><td><? echo $fabbisogno; ?></td></tr>
        <tr><td>Contributo Attribuito</td><td> <? echo $contributo; ?></td></tr>
        <tr><td>Esclusione</td><td> <? echo $motivoesclusione; ?></td></tr>
      </table>
    </div>


  </div>
  <div id="clear">&nbsp;</div>
  <div  align="center">
    <input type='hidden' name='codice' value="<? echo $codice; ?>">

    <input type='hidden' name='nazionalita' value="<? echo $nazionalita; ?>">



<?php
//aggiunto il 14/06/2011 per b loccare il comune di leverano
//if ($codoperator <> 16) {

sceltaoperazione($permessi, $i, 0);
//}
?>

  </div> <div id="clear">&nbsp;</div>
</form>
<?php
mysql_free_result($risultato); //libera la memoria dal risultato della query
mysql_close($strconnessione); //chiude la connessione aperta BUUUUUUUUUUUUUU!!!!!
?>

<p align="center"><a href="GestioneRichiedenti.php">Indietro</a>

</div>
<br clear="all" class="hide"/>
<!-- Fine div contenuti -->

    <? include ($root . "/layout/bottom.php"); ?>