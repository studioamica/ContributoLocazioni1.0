<?php
	session_start();

	$username=@$_POST["username"];
	$password=@$_POST["password"];

	$cryptpassw = crypt($password,$username);

	echo $username . " " . $password . " -> " . $cryptpassw

?>



<form action="/generapassword.php" method="post" name="box" target="_self">

Username       <input type="text" name="username" id="username"><br/>
Password      <input type="password" name="password" id="password"><br/>
 
      <input type="submit" name="invia" value="Entra">
    
</form>
