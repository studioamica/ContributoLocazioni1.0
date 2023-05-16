<?php
	session_start();
	
	
	include("config.php");
	include ($root.'/inc/funzioni.php');
	include ($root."/layout/print_layout.php");


	#$menu = array(""=>"");	
    	print_top("Legge 431/98 - Studio Amica ","");

	session_unset();
	session_destroy();
?>

<form action="log.php" method="post" name="box" target="_self">
<fieldset>
<legend>Pagina di autenticazione per l'accesso alla gestione del portale</legend>
<br>
<table width="200" border="0" align="center" cellpadding="2" cellspacing="2" class="box">
  <tr>
    <th scope="row">Username</td>
    <td><div align="left">
      <label for="username">
      <input type="text" name="username" id="username">
      </label>
    </div></td>
  </tr>
  <tr>
    <th scope="row">Password</td>
    <td><div align="left">
      <label for="password">
      <input type="password" name="password" id="password">
      </label>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <br>
      <input type="submit" name="invia" value="Entra">
    </div></td>
    </tr>
</table>

</fieldset>
</form>

</div>
  <br clear="all" class="hide" />
<!-- Fine div contenuti -->

<? include ($root."/layout/bottom.php"); ?> 
</div>
