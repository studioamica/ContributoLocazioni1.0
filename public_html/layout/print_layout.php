<?
//session_start();
//global $root;
//$root=$_SERVER['DOCUMENT_ROOT'];

//echo $root;


?>
<? function printMenu_1($menu) {
        if ($menu=="") { ?>
                &nbsp;&raquo;&nbsp;Login
        <?
                return;
        }?>
                Sei in:&nbsp;
                <a href="Menu.php" title="Vai al Menu Generale">Menu Generale</a>&nbsp;&raquo;&nbsp;
                <?
                foreach ($menu as $key=>$val) {
                        if ($key!="") { ?>
                        <a href="<?=$key ?>" title="Vai alla pagina <?=$val?>"><?=$val ?></a>&nbsp;&raquo;&nbsp;
                        <?
                        } else { ?>
                                <?=$val ?>
                        <?
                        }
                }?>

<?
}
?>

<?php

function print_top($page_title,$menu="") {

//global $root;

// adesso controlliamo la variabile style che ci permetterà di settare il foglio di stile tramite la $_session*/

//if($_REQUEST["style"]!="") $_SESSION["style"]=$_REQUEST["style"];

//$style=$_SESSION["style"];
// se non è settata andrà di default nella versione grafica*/

//if($style=="") {

  $style="graphics";

//  $_SESSION["style"]="graphics";

//}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>

<?

	if (is_array($menu)) $sub_title=" ".end($menu);

	else $sub_title="";

?>

<title><?=$page_title?><?=$sub_title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="/css/graphics.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="aural, handheld" href="/css/pda.css" />
</head>
<body>

<?php
	include("config.php");

	

 include ($root .'/layout/version.php');

}

//* fine della print_top e inizio della print bottom */

function print_bottom($colonna_sx="",$colonna_dx="") {

global $HTTP_SERVER_VARS;

//global $root;

?>


<? include($colonna_dx); ?>
 </div>
  <!-- Fine Contenuti -->
  <hr />

<? include ($root."/layout/bottom.php")?>


</body>
</html>
<?

}

?>
