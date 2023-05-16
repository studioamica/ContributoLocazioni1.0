<?php
    session_start();
	
	include("config.php");
	include ($root.'/inc/funzioni.php');

	$codoperator= autorizmenu(@$_SESSION["codoperator"]);
	$nomeoperator = $_SESSION["nomeoperator"];

	
?>
<?php 

	include ($root."/layout/print_layout.php");

	$titolo = array(""=>"");
	print_top("Legge 431/98 - Studio Amica - ",$titolo); ?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
	<div id="categoria">
	<img src="img/utenza.jpg" width=100% /><br />
	<a href="/SceltaAnno.php">Inserimento/Visulizzazione Richiedenti</a><br/>
	<a href="/Normativa.php">Normativa</a><br/>
	<a href="/SceltaAnnoC.php">Calcola Contributo</a><br/>
	
	</div>
	<div id="categoria"><img src="img/impostazioni.jpg" width=100% /><br />
	<a href="/SceltaAnnoP.php">Gestione Configurazione Parametri</a><br/>
	<a href="/Operatori.php">Gestione Password Operatore</a><br/><br />
	</div><div id="clear">&nbsp;</div>
</div>

<div id="clear10">&nbsp;</div>
<? include ($root."/layout/bottom.php"); ?> 