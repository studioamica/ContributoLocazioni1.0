<?php
	session_start();
	
	
	include("config.php");
	$codfiscale= "80001990748";
?>

<?php
	if ($dir = @opendir($root . "/documenti/". $codfiscale . "/")) {

		$i = 0;
  		while (($file = readdir($dir)) !== false) { 

			if (strpos($file,"_lettera_rifiuto_contributo_") !== false) {
				$i = $i +1;
?>

	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $file; ?>">Lettera Rifiuto Contributo <? echo $i; ?></a><br/>
<?php
    			}
  		}  

  	closedir($dir);

	}

?>
