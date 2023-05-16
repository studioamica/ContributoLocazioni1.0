<?php
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');
    
	
	$codoperator= autorizzato(@$_SESSION["codoperator"]);
	
	$nomeoperator = $_SESSION["nomeoperator"];
	$codfiscale = verificacodfiscale($codoperator);
	
?>

<?php 

	include ($root."/layout/print_layout.php");

	$titolo = array(""=>"Normativa");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
<h2 class="hide" align="left">&raquo; Gestione Normativa</h2>

<div id="testonorm">


<a href="/normativa/20070711_1158.pdf">Deliberazione Giunta Regionale dell'11/07/2007 n. 1158</a><br/>
Fondo nazionale per il sostegno all'accesso alle abitazioni in locazione. Anno 2006<br/><br/>


<a href="/normativa/20060619_892.pdf">Deliberazione Giunta Regionale del 19/06/2006 n. 892</a><br/>
Determinazione nuovi limiti di reddito per assegnazioni di alloggi di erp<br/><br/>


<a href="/normativa/20041112_269.pdf">Legge del 12/11/2004 n. 269</a><br/>
Modifica alla legge 431/1998 - contratti di locazione<br/><br/>

<a href="/normativa/20020730_189.pdf">Legge del 30/07/2002 n. 189</a><br/>
Modifica del Decreto Legislativo n. 286/98 - permesso di soggiorno e carta di soggiorno<br/><br/> 

<a href="/normativa/20020108_2.pdf">Legge del 08/01/2002 n. 2</a><br/>
Modifica della Legge n. 431/98 - contratti di locazione<br/><br/>


<a href="/normativa/20010404_242.pdf">Decreto del Presidente del Consiglio dei Ministri del 04/04/2001 n. 242</a><br/>
Indicatore della situazione economica equivalente (ISEE)<br/><br/> 

<a href="/normativa/20000503_130.pdf">Decreto Legislativo del 03/05/2000 n. 130</a><br/>
Indicatore della situazione economica equivalente (ISEE)<br/><br/>

<a href="/normativa/19990507_221.pdf">Decreto del Presidente del Consiglio dei Ministri del 07/05/1999 n. 221</a><br/>
Indicatore della situazione economica equivalente (ISEE)<br/><br/>

<a href="/normativa/19990607.pdf">Decreto del Ministero dei lavori pubblici (ora Ministero delle infrastrutture e dei trasporti) del 07/06/99</a><br/>
Requisiti per avere il contributo stabiliti dallo Stato<br/><br/>

<a href="/normativa/19981209_431.pdf">Legge del 9/12/1998 n. 431</a><br/>
Legge statale istitutiva del fondo per l´affitto (art. 11) e contratti di locazione<br/><br/>

<a href="/normativa/19980331_109.pdf">Decreto legislativo del 31/03/1998 n. 109</a><br/>
Indicatore della situazione economica equivalente (ISEE)<br/><br/> 

<a href="/normativa/19980725_286.pdf">Decreto legslativo del 25/07/1998 n. 286</a><br/>
Permesso di soggiorno e carta di soggiorno<br/><br/> 

<a href="/normativa/19920808_359.pdf">Legge del 08/08/1992 n. 359</a><br/>
Patti in deroga<br/><br/>

<a href="/normativa/19860426_131.pdf">Decreto del Presidente della Repubblica del 26/04/1986 n. 131</a><br/>
Registrazione dei contratti di locazione<br/><br/>

<a href="/normativa/19780725_392.pdf">Legge del 25/07/1978 n. 392</a><br/>
Equo Canone<br/><br/> 

</div>
<p align="center"> <a href="Menu.php">Menu<br>
</a><br clear="all" class="hide"/>
    <!-- Fine div contenuti -->
  
<? include ($root."/layout/bottom.php"); ?>