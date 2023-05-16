	$strsql  = "SELECT * FROM b_richiedenti, b_configurazione ";
	$strsql .= "WHERE b_richiedenti.anno = b_configurazione.anno AND ";
	$strsql .= "b_richiedenti.anno = '" . $anno . "' AND ";
	$strsql .= "redimpannuo>pensioneminimainps2 AND redimpannuo<= redditoerp AND escluso='n' ";
	
	$rs_fascia_b = mysql_query($strsql,$strconnessione); //invia la query contenuta in $strsql al database apero e connesso

				
	//echo $strsql . "<p>"; 


    	$progressivo = 0;
        $risultato = "";

        $totfabbisogno = 0;
        $totcontributo = 0;

if (mysql_num_rows($rs_fascia_b)>0) {
			
	while ($record = mysql_fetch_object($rs_fascia_b)) {

            $progressivo = $progressivo + 1;
            $cognome = $record->cognome;
            $nome = $record->nome;
            $indirizzo = $record->indirizzo;
            $lavaut = $record->lavaut;
            $lavdip = $record->lavdip;
            $nvani = $record->nvani;
            $catcatastale = $record->catcatastale;
            $concordato = $record->concordato;
            $libero = $record->libero;
            $nonspecificato = $record->nonspecificato;
            $numreg = $record->numreg;
            $datareg = mysql2date($record->datareg);
            $numfiglicarico = $record->numfiglicarico;
            $numaltricomp = $record->numaltricomp;
            $totcomp = $record->totcomp;
            $ultra65 = $record->ultra65;
            $handicap = $record->handicap;
            $altradebolezza = $record->altradebolezza;
            $redimpannuo =$record->redimpannuo;
            $redconv = $record->redconv;
            $canoneannuo = $record->canoneannuo;
            $mesiloc = $record->mesiloc;
            $incidenza = $record->incidenza;
            $maggiorazione = $record->maggiorazione;
            $incidenza14 = $record->incidenza14;
            $fabbisogno = $record->fabbisogno;
            $contributo = $record->contributo;
            
            $totfabbisogno = $totfabbisogno + $fabbisogno;
            $totcontributo = $totcontributo + $contributo;



	
            $risultato  = "<tr height=18 style='height:13.5pt'>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $progressivo . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $cognome . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $nome . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $indirizzo . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $lavaut . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $lavdip . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $nvani . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $catcatastale . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $concordato . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $libero . "</td>";

            
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $nonspecificato . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $numreg . "</td>";
            $risultato .= "<td class=xl612302 style='border-top:none;border-left:none;  width:73pt' x:num>" . $datareg . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $numfiglicarico . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $numaltricomp . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $totcomp . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $ultra65 . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $handicap . "</td>";

           
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $altradebolezza . "</td>";
            $risultato .= "<td class=euro style='border-top:none;border-left:none;  width:73pt' x:num>" . $redimpannuo . "</td>";
            $risultato .= "<td class=euro style='border-top:none;border-left:none;  width:73pt' x:num>" . $redconv . "</td>";
            $risultato .= "<td class=euro style='border-top:none;border-left:none;  width:73pt' x:num>" . $canoneannuo . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $mesiloc . "</td>";
            $risultato .= "<td class=decimale style='border-top:none;border-left:none' x:num>" . $incidenza . "</td>";
            $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>" . $maggiorazione . "</td>";
            $risultato .= "<td class=euro style='border-top:none;border-left:none;  width:73pt' x:num>" . $incidenza14 . "</td>";
            $risultato .= "<td class=euro style='border-top:none;border-left:none;  width:73pt' x:num>" . $fabbisogno . "</td>";
            $risultato .= "<td class=euro style='border-top:none;border-left:none;  width:73pt' x:num>" . $contributo . "</td>";
            $risultato .= "</tr>";

        }

        
        
        $totfabbisogno = $totfabbisogno;
        $totcontributo = $totcontributo;



        $risultato .= "<tr height=18 style='height:13.5pt'>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";

        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";


        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=xl592302 style='border-top:none;border-left:none' x:num>&nbsp;</td>";
        $risultato .= "<td class=euro_rosso style='border-top:none;border-left:none;  width:73pt' x:num>" . $totfabbisogno . "</td>";
        $risultato .= "<td class=euro_rosso style='border-top:none;border-left:none;  width:73pt' x:num>" . $totcontributo . "</td>";
        $risultato .= "</tr>";

}

	$chiusura = "</tr></table></div></body></html>";

	echo $stile . $corpo . $risultato . $chiusura;

 	        
        //Set fs = CreateObject("Scripting.FileSystemObject")
        //Set textfile = fs.CreateTextFile("d:\cataldo\fascia_b.xls", True)
        //textfile.writeline (stile & Corpo & risultato & "</tr></table></div></body></html>")
        //textfile.Close
        
        //MsgBox ("Fascia_B.xls, generato")
