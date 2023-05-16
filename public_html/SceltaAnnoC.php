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

	$titolo = array(""=>"Scelta Anno Calcolo Contributo");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span id="benvenuto">benvenuto</span> <span id="user"><? echo $nomeoperator ?></span> &nbsp;</div>
<h2 class="hide" align="left">&raquo; Gestione Richiedenti</h2>

	<form method='POST' action="CalcoloContributo.php" name="box" >
	<fieldset>
      <legend>Modulo per la Scelta dell'Anno di Calcolo del Contributo</legend><br>
	
<table width="25%" align="center" border="0" " cellpadding="1" cellspacing="1" class="box">
  <tr class="grigio1">
   
    <th width="20%" scope="col"><div align="left">ANNO</div></th>
    <th width="20%" scope="col"><? echo vis_anni($codoperator); ?></th>
  </tr>
	

	</table>
	<p class='box' align='center'>
	<input type='submit' name='Invia' value='Invia'>
	</p>
	</fieldset>
</form>

<p align="center"> <a href="Menu.php">Menu<br>
</a><br clear="all" class="hide"/>
    <!-- Fine div contenuti -->
  
<? include ($root."/layout/bottom.php"); ?>