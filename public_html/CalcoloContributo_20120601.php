<?php
	session_start();

	include("config.php");
	include ($root.'/inc/funzioni.php');
    
	
	$codoperator= autorizzato(@$_SESSION["codoperator"]);
	
	$nomeoperator = $_SESSION["nomeoperator"];
	$codfiscale = verificacodfiscale($codoperator);
	
	$anno = 0;
	if (isset($_POST["anno"])) { $anno = $_POST["anno"]; }
?>
<?php 

	include ($root."/layout/print_layout.php");

	$titolo = array("/SceltaAnno.php"=>"Scelta Anno",""=>"Calcolo Contributo");
	print_top("Legge 431/98 - Studio Amica - ",$titolo);
?>
	<div id="navigazione"><div id="navvoci"><?php printMenu_1($titolo); ?></div><div id="logout"><a href='index.php'>LOG OUT</a></div><div id="clear">&nbsp;</div></div><?php


?>
<div align="right"><span class="benveuto">benvenuto</span><span class="user"><? echo $nomeoperator ?></span> &nbsp;</div>
<div id="testocalcolo">
<?php

	
	$strconnessione = connessione();

	$agg_table = false;
	$errore=false;
	$msg="";

	$perccontr= 0;


	//in base alla scelta dell'operazione che l'operatore vuole effettuare si eseguono le varie parti di codice

	//l'operatore dalla pagina GestioneReferenti.php ha scelto INSERIMENTO
	//if ($_POST["operazione"] == "Inserimento") {


	//azzeramento dati presenti


					$strsql  = "UPDATE b_richiedenti SET ";
					$strsql .= "redconv = 0, ";
					$strsql .= "incidenza = 0,  ";
					$strsql .= "incidenza14 = 0,  ";
					$strsql .= "fabbisogno = 0,  ";
					$strsql .= "maggiorazione = 0,  ";
					$strsql .= "contributo = 0, ";
					$strsql .= "escluso = 'N', ";
					$strsql .= "motivoesclusione='' ,"; 
					$strsql .= "codoperatore = " 	. $codoperator 		. "  ";
					$strsql .= "WHERE ";
					$strsql .= "codfiscale = '" . $codfiscale . "' AND anno ='" . $anno . "' " ;

					//echo $strsql . "<p>";

					$risultato = mysql_query($strsql,$strconnessione);



		
		$strsql = "SELECT * FROM b_configurazione   WHERE anno= '" . $anno . "' AND codfiscale = '" . $codfiscale . "' ";

		//echo "<p>" . $strsql . "</p>";

		$rs_configurazione = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		
		if (mysql_num_rows($rs_configurazione)>0) {	
			
			$record = mysql_fetch_object($rs_configurazione);

			$pensioneminimainps2 	= $record->pensioneminimainps2;
       		 	$redditoerp 		= $record->redditoerp;
        		$percincida 		= $record->percincida;
        		$percincidb 		= $record->percincidb;
        		$fondoregione 		= $record->fondoregione;
        		$fondocomune 		= $record->fondocomune;
        		$percridincida 		= $record->percridincida;
        		$percridincidb 		= $record->percridincidb;
        		$maxcontributoa 	= $record->maxcontributoa;
        		$maxcontributob 	= $record->maxcontributob;
        		$applicareincremento 	= $record->applicareincremento;
        		$percincr 		= $record->percincr;
			$aumentarelimiti 	= $record->aumentarelimiti;
        		$perclimiti 		= $record->perclimiti;
        		$impfigliacarico 	= $record->impfigliacarico;
        		$percabb 		= $record->percabb;
        

			$pensioneminimainps2_ori 	= $pensioneminimainps2;
       		 	$redditoerp_ori 		= $redditoerp;

        		//if ($applicareincremento == "S") { $percincr = $record->percincr; }
        
        		$totfondo = $fondoregione + $fondocomune;
        
       			$strsql = "SELECT * FROM b_richiedenti  WHERE anno= '" . $anno . "' AND codfiscale = '" . $codfiscale . "' ";
			$rs_richiedenti = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso
		
			if (mysql_num_rows($rs_richiedenti)>0) {
			
				while ($record = mysql_fetch_object($rs_richiedenti)) {

					$codice		= $record->codice;
					$numfiglicarico = $record->numfiglicarico;
            				$ultra65 	= $record->ultra65;
            				$handicap 	= $record->handicap;
           	 			$altradebolezza = $record->altradebolezza;
            				$redimpannuo 	= $record->redimpannuo;
           				$redconv 	= 0;
            				$canoneannuo 	= $record->canoneannuo;
            				$mesiloc 	= $record->mesiloc;
            				$incidenza 	= 0;
            				$maggiorazione 	= 0;
            				$incidenza14 	= 0;
            				$fabbisogno 	= 0;
            				$contributo 	= 0;
					$escluso 	= "N";
					$motivoesclusione = "-";
					$lavaut		= $record->lavaut;


					$pensioneminimainps2 	= $pensioneminimainps2_ori;
       		 			$redditoerp 		= $redditoerp_ori;
					
					//Detrazioni = rs("Figli") * 516.46
					//Abbattimento = 0.4 * Pensione_Dipendente * (RedditoReale - Detrazioni) / RedditoReale
					//RedditoConvenzionale = RedditoReale - Detrazioni - Abbattimento

					$detrazioni = $redimpannuo - ($impfigliacarico * $numfiglicarico);

					if ($lavaut == "A") {
						$redconv = round($detrazioni, 2);
					}
					else {
						//lavoro dipendente o misto
						//se il richiedente è un lavoratore dipendente c'è l'ulteriore abbattimento del 40%
						$redconv = round(($detrazioni * (100 - $percabb) / 100), 2);
					}
				
					//qui c'era la cerifica per l'aumento dei limiti di reddito

					//if ($codice == 3776) {

					//	echo "codice: " . $codice . " redd imp: " . $redimpannuo . " redd conv: " . $redconv . " reddito erp: " . $redditoerp . "<br>";
					//}
		
					//Verifica se il reddito rispetta il requisito fascia A
            				if ($redimpannuo <= $pensioneminimainps2) {
            
                				if ($redimpannuo == 0) {
	                    				$incidenza = 100;
						}
                				else {                    
							$incidenza = round(($canoneannuo / $redimpannuo * 100), 2);
                				}

						//echo $incidenza . "<br/>";

						if ($incidenza >= $percincida) {
                    
                    					$incidenza14 = round(($canoneannuo - ($redimpannuo * $percridincida / 100)), 2);
							$fabbisogno = round(($incidenza14 / 12 * $mesiloc), 2);
                    
                    					if (($ultra65 == "S" | $handicap == "S" | $altradebolezza == "S") & ($applicareincremento == "S")) {
								
                                                		$maggiorazione = round(($fabbisogno * $percincr / 100),2);
                        					$fabbisogno = $fabbisogno + $maggiorazione;
                        
                    					}
							
                    
							if ($fabbisogno > $canoneannuo) {$fabbisogno = $canoneannuo; }
                    					if ($fabbisogno > $maxcontributoa) { $fabbisogno = $maxcontributoa; }
                    
                				}
						else {
							$escluso = "S";
							$motivoesclusione = "L\'incidenza è inferiore al " . $percincida;
						}
                			}
					elseif ($redconv <= $redditoerp) {
						//Verifica se il reddito rispetta il requisito fascia B

						if ($codice == 3776) { echo "qui";}

						$detrazioni = $redimpannuo - ($impfigliacarico * $numfiglicarico);


						if ($lavaut == "A") {
							$redconv = round($detrazioni, 2);
						}
						else {
							//se il richiedente è un lavoratore dipendente c'è l'ulteriore abbattimento dle 40%
							$redconv = round(($detrazioni * (100 - $percabb) / 100), 2);
						}

                       				$incidenza = round(($canoneannuo / $redconv * 100), 2);


						if ($incidenza >= $percincidb) {

							$incidenza14 = round(($canoneannuo - ($redconv * $percridincidb / 100)), 2);
					                $fabbisogno = round(($incidenza14 / 12 * $mesiloc), 2);

							if (($ultra65 == "S" | $handicap == "S" | $altradebolezza == "S") & ($applicareincremento == "S")) {
                    
                        					$maggiorazione = round(($fabbisogno * $percincr / 100),2);
                        					$fabbisogno = $fabbisogno + $maggiorazione;	
								                        
                    					}
							
							if ($fabbisogno > $canoneannuo) {$fabbisogno = $canoneannuo; }
							if ($fabbisogno > $maxcontributob) { $fabbisogno = $maxcontributob;}                                            				

						}
						else {					

							$escluso = "S";
							$motivoesclusione = "L\'incidenza è inferiore al " . $percincidb;

						}

					}
					else {
						//Il reddito del Richiedente supera i limiti consentiti e quindi
						//si aumentano allora i limiti di reddito e si verifica nuovamente la fascia di appartenenza A o B
						//non applicando questa volta l'aumento del contributo
						//se anche in questo caso supera i limiti consentiti, c'è l'esclusione

						if (($ultra65 == "S" OR $handicap == "S" OR $altradebolezza == "S") AND ($aumentarelimiti == "S")) {

							$pensioneminimainps2 = round(($pensioneminimainps2 + ($pensioneminimainps2 * $perclimiti / 100)), 2);
       		 					$redditoerp = round(($redditoerp + ($redditoerp * $perclimiti / 100)), 2);
						}
						else {
							$pensioneminimainps2 	= $pensioneminimainps2_ori;
       		 					$redditoerp 		= $redditoerp_ori;
						}


						$detrazioni = $redimpannuo - ($impfigliacarico * $numfiglicarico);

						if ($lavaut == "A") {
							$redconv = round($detrazioni, 2);
						}
						else {
							//lavoro dipendente o misto
							//se il richiedente è un lavoratore dipendente c'è l'ulteriore abbattimento del 40%
							$redconv = round(($detrazioni * (100 - $percabb) / 100), 2);
						}

						//echo "codice: " . $codice . " redd imp: " . $redimpannuo . " redd conv: " . $redconv . "<br>";
				
						//Verifica se il reddito rispetta il requisito fascia A
            					if ($redimpannuo <= $pensioneminimainps2) {
            
                					if ($redimpannuo == 0) {
	                    					$incidenza = 100;
							}
                					else {                    
								$incidenza = round(($canoneannuo / $redimpannuo * 100), 2);
                					}

							//echo $incidenza . "<br/>";

							if ($incidenza >= $percincida) {
                    
                    						$incidenza14 = round(($canoneannuo - ($redimpannuo * $percridincida / 100)), 2);
								$fabbisogno = round(($incidenza14 / 12 * $mesiloc), 2);
                    
                    						if ($fabbisogno > $canoneannuo) {$fabbisogno = $canoneannuo; }
	                    					if ($fabbisogno > $maxcontributoa) { $fabbisogno = $maxcontributoa; }
        						}
							else {
								$escluso = "S";
								$motivoesclusione = "L\'incidenza è inferiore al " . $percincida;
							}
                				}
						elseif ($redconv <= $redditoerp) {
						//Verifica se il reddito rispetta il requisito fascia B

							$detrazioni = $redimpannuo - ($impfigliacarico * $numfiglicarico);


							if ($lavaut == "A") {
								$redconv = round($detrazioni, 2);
							}
							else {
								//se il richiedente è un lavoratore dipendente c'è l'ulteriore abbattimento dle 40%
								$redconv = round(($detrazioni * (100 - $percabb) / 100), 2);
							}

                       					$incidenza = round(($canoneannuo / $redconv * 100), 2);


							if ($incidenza >= $percincidb) {

								$incidenza14 = round(($canoneannuo - ($redconv * $percridincidb / 100)), 2);
					              	 	$fabbisogno = round(($incidenza14 / 12 * $mesiloc), 2);

								if ($fabbisogno > $canoneannuo) {$fabbisogno = $canoneannuo; }
								if ($fabbisogno > $maxcontributob) { $fabbisogno = $maxcontributob;}                                            				
							}
							else {					

								$escluso = "S";
								$motivoesclusione = "L\'incidenza è inferiore al " . $percincidb;
							}

						}
						else {
							//Il reddito del Richiedente supera i limiti consentiti e quindi non può usufruire del contributo
							$escluso = "S";
							$motivoesclusione = "Il Reddito supera i limiti consentiti sia per la Fascia A che per la B";

						}
					}


					$strsql  = "UPDATE b_richiedenti SET ";
					$strsql .= "redconv = "		. $redconv 		. ", ";
					$strsql .= "incidenza = "	. $incidenza		. ",  ";
					$strsql .= "incidenza14 = "	. $incidenza14		. ",  ";
					$strsql .= "fabbisogno = "	. $fabbisogno		. ",  ";
					$strsql .= "maggiorazione = "	. $maggiorazione	. ",  ";
					$strsql .= "contributo = "	. $contributo 		. ", ";
					$strsql .= "escluso = '"	. $escluso 		. "', ";
					$strsql .= "motivoesclusione='"	. $motivoesclusione	. "' ,"; 
					$strsql .= "codoperatore = " 	. $codoperator 		. "  ";
					$strsql .= "WHERE ";
					$strsql .= "codice = " . $codice ;

					//echo $strsql . "<p>";

					$risultato = mysql_query($strsql,$strconnessione);
                   
				}//while rs_richiedenti

			}//if rs_richiedenti


			$strsql  = "SELECT Sum(fabbisogno) AS totfabbisogno FROM b_richiedenti ";
        		$strsql .= "WHERE escluso='N' AND anno='" . $anno . "' AND codfiscale = '" . $codfiscale . "' ";
			$rs_richiedenti = mysql_query($strsql,$strconnessione);

			$record = mysql_fetch_object($rs_richiedenti);
			$totfabbisogno = $record->totfabbisogno;

			if ($totfabbisogno != "" & $totfabbisogno >0) {

				$strsql  = "SELECT b_richiedenti.* FROM b_richiedenti,b_configurazione ";
				$strsql .= "WHERE b_configurazione.anno = b_richiedenti.anno AND ";
				$strsql .= "b_richiedenti.escluso='N' AND b_richiedenti.anno = '" . $anno . "' AND b_richiedenti.codfiscale = '" . $codfiscale . "' ";
				$rs_richiedenti = mysql_query($strsql,$strconnessione);
    
				$contributo = 0;
			        $perccontr = round(($totfondo / $totfabbisogno * 100), 4);

				//echo $totfondo . " / "  . $totfabbisogno . " * " . 100;

				if ($perccontr > 100) { $perccontr = 100; }
				
				if (mysql_num_rows($rs_richiedenti)>0) {
			
					while ($record = mysql_fetch_object($rs_richiedenti)) {
					
						$contributo 	= 0;
						$codice		= $record->codice;	
					        $fabbisogno 	= $record->fabbisogno;
            
            					$contributo = round(($fabbisogno * $perccontr / 100), 2);

						$strsql  = "UPDATE b_richiedenti SET ";
						$strsql .= "contributo = ". $contributo	. ", ";
						$strsql .= "codoperatore = " 	. $codoperator 	. "  ";
						$strsql .= "WHERE ";
						$strsql .= "codice = " . $codice ;

						//echo $strsql . "<p>";

						$risultato = mysql_query($strsql,$strconnessione);
						
					}
				}

			}


		}
		
			
			
		 
	//}


		$msg= "Calcolo Contributo Terminato Anno " . $anno . " percentuale contributo: " . $perccontr ."%";		
			
			
		


	//}

	


	mysql_close($strconnessione);	//chiude la connessione aperta

	//sono commennati i campi per la creazione dei dati fino alla realizzazione della nuova procedura

	
	//sono stati tolti i commenti perchè la funzione per il 2006 include campi differenti

	if ($anno <= 2005) {
		include ($root.'/inc/create_file.php');
	}
	elseif ($anno >= 2006) {
		include ($root.'/inc/create_file_2006.php');
	}

	include ($root.'/inc/body_determinazione_approvazione_graduatoria.php');

	include ($root.'/inc/body_determinazione_erogazione_contributo.php');

	include ($root.'/inc/body_lettera_fabbisogno.php');

	include ($root.'/inc/body_lettera_richiesta_regione.php');

	include ($root.'/inc/body_lettera_rifiuto_contributo.php');
	


//CREARE IN DOCUMENTI UNA CARTELLA PER OGNI COMUNE DENOMINATA CON IL CODICE FISCALE


?>
	
	<div align="center"><strong><? echo $msg ?></strong></div>

<?php

	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_A.xls")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_fascia_A.xls"; ?>">Fascia A</a><br/>
<?php	
	} 

	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_fascia_B.xls")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_fascia_B.xls"; ?>">Fascia B</a><br/>
<?php	
	} 

	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_esclusi.xls")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale .  "/" . $anno . "_esclusi.xls"; ?>">Esclusi</a><br/>
<?php	
	} 
?>

<?php
	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_determinazione_approvazione_graduatoria.doc")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_determinazione_approvazione_graduatoria.doc"; ?>">Determinazione Approvazione Graduatoria</a><br/>
<?php	
	} 
?>

<?php
	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_lettera_fabbisogno.doc")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_lettera_fabbisogno.doc"; ?>">Lettera Fabbisogno</a><br/>
<?php	
	} 
?>

<?php
	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_lettera_richiesta_regione.doc")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_lettera_richiesta_regione.doc"; ?>">Lettera Richiesta Regione</a><br/>
<?php	
	} 
?>

<?php
	if ($dir = @opendir($root . "/documenti/". $codfiscale . "/")) {

		$i = 0;
  		while (($file = readdir($dir)) !== false) { 

			if (strpos($file,"_lettera_rifiuto_contributo_") !== false & strpos($file,$anno) !== false) {
				$i = $i +1;
?>

	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $file; ?>">Lettera Rifiuto Contributo <? echo $i; ?></a><br/>
<?php
    			}
  		}  

  	closedir($dir);

	}

?>

<?php
	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_determinazione_erogazione_contributo.doc")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_determinazione_erogazione_contributo.doc"; ?>">Determinazione Erogazione Contributo</a><br/>
<?php	
	} 
?>

<?php
	if (file_exists($root . "/documenti/" . $codfiscale . "/" . $anno . "_elenco_richiedenti.xls")) {
?>
	Preleva il file <a href="/documenti/<? echo $codfiscale . "/" . $anno . "_elenco_richiedenti.xls"; ?>">Elenco Richiedenti</a><br/>
<?php	
	} 
?>
</div>
</div>
<br>
  <br clear="all" class="hide"/>
<!-- Fine div contenuti -->
<? include ($root."/layout/bottom.php"); ?>