

<SCRIPT LANGUAGE="JavaScript">
<!--

function nomeMese(i,year) {

switch (i) {
    		case 0:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Gennaio " + year;
			break;
			case 1:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Febbraio " + year;
			break;
			case 2:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Marzo " + year;
			break;
			case 3:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Aprile " + year;
			break;
			case 4:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Maggio " + year;
			break;
			case 5:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Giugno " + year;
			break;
			case 6:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Luglio " + year;
			break;
			case 7:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Agosto " + year;
			break;
			case 8:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Settembre " + year;
			break;
			case 9:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Ottobre " + year;
			break;
			case 10:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Novembre " + year;
			break;
			case 11:
    			document.calControl.mese.value= i;
				document.calControl.mmese.value= "Dicembre " + year;
			break;


		}
}


function nextYear() {
var year;
var month;
var now = new Date();


	if (parseInt(document.calControl.mese.value)==11) {
		document.calControl.mese.value=0;
		document.calControl.anno.value= parseInt(document.calControl.anno.value) + 1;
		month=parseInt(document.calControl.mese.value);
		year=parseInt(document.calControl.anno.value);
		nomeMese(0,year);
	}
	else {
		document.calControl.mese.value= parseInt(document.calControl.mese.value) + 1;
		month=parseInt(document.calControl.mese.value);
		year=parseInt(document.calControl.anno.value);
		nomeMese(month,year);

	}

	displayCalendar(0,year,month);
}


function prewYear() {
var year;
var month;
var now = new Date();


	if (parseInt(document.calControl.mese.value)==0) {
		document.calControl.mese.value=11;
		document.calControl.anno.value= parseInt(document.calControl.anno.value) - 1;
		month=parseInt(document.calControl.mese.value);
		year=parseInt(document.calControl.anno.value);
		nomeMese(11,year);
	}
	else {
		document.calControl.mese.value= parseInt(document.calControl.mese.value) -1 ;
		month=parseInt(document.calControl.mese.value);
		year=parseInt(document.calControl.anno.value);
		nomeMese(month,year);

	}

	displayCalendar(0,year,month);
}



function displayCalendar(init,year,month) {
   var i;
   var now = new Date();
   var nowYear = now.getYear(); //-95
   var nowMonth = now.getMonth();
   var nowDay   = now.getDate();
   var gg="";
   var mese="";
   var pippo;


 if (year==0) {

 	year = now.getYear();
	if (parseInt(navigator.appVersion) >4) {
		year= now.getYear()+1900;
	}

 	month = now.getMonth();

 }



   // on open of document
   if (init==1)  {
        document.calControl.mese.value = now.getMonth();
        document.calControl.giorno.selectedIndex = now.getDate();
	document.calControl.anno.value= now.getYear();
	if (parseInt(navigator.appVersion) >4) {
		document.calControl.anno.value= now.getYear()+1900;
	}

        nomeMese(month,year);

   }


        var days=getDaysInMonth(month+1,year);

        var firstOfMonth = new Date (year, month, 1);

        var startingPos=firstOfMonth.getDay();

        days+=startingPos;

   // label days of week
   i=0;



   // blank out non date buttons

   //alert(startingPos);

   for (i=0; i<startingPos; i++) {


         document.calButtons.elements[i].value = "     ";


    	 //document.calButtons.elements[i].type = "hidden";
	}

		gg="";
        for (i=startingPos; i<days; i++)  {



        	gg=	i-startingPos+1;
        	if (gg<=9) {
        		document.calButtons.elements[i].value = "0" + gg ;


			}
			else {
				document.calButtons.elements[i].value = gg ;
			}


         }

   // show focus on today if the calendar is the proper month and year

   	if (month==nowMonth && year==nowYear)  { //+95

	    document.calButtons.elements[nowDay+startingPos-1].focus();
    }


   // blank out rest of non date buttons
        for (i=days; i<42; i++)  {  //i<49

        	//document.calButtons.elements[i].type = "hidden";

      		document.calButtons.elements[i].value = "     ";

      		//alert(document.calButtons.elements[i].focus)

      	}

}

function leapYear (Year) {
        if (((Year % 4)==0) && ((Year % 100)!=0) || ((Year % 400)==0))
                return (1);
        else
                return (0);
}

function getDaysInMonth(month,year)  {
   var days;
   if (month==1 || month==3 || month==5 || month==7 || month==8 ||
      month==10 || month==12)  days=31;
   else if (month==4 || month==6 || month==9 || month==11) days=30;
   else if (month==2)  {
      if (leapYear (year)==1)  days=29;
      else days=28;
   }
        return (days);
}

function valore_data(nometasto) {
var dataclick;
var giorno;
var mese;
var anno;

	giorno = eval("document.calButtons." + nometasto + ".value")

	if (giorno=="     ") {

		alert("Selezionare un giorno valido!!!");
		return false;
	}
	else {

		mese = parseInt(document.calControl.mese.value)+1;
		anno = document.calControl.anno.value;

		if (mese<=9) {

			mese = "0" + mese;
		}

		dataclick= giorno + "/" + mese + "/" + anno;

		document.calControl.dataclick.value= dataclick;
		//alert (dataclick);



		if (document.calControl.campo.value=="err") {
			window.close();
		}
		else {
			window.close();
			creator.setCalendario( document.calControl.dataclick.value,document.calControl.campo.value);
		}

	}
}



// -->
</SCRIPT>
<title>Calendario</title>
<html>

<BODY bgcolor="white" ONLOAD="displayCalendar(1,0,0)">

<CENTER>
<FORM NAME="calControl">
<table  cellpadding="0" cellspacing="0">

  <tr>

    <td><INPUT TYPE="button" NAME="prew" VALUE="<-"    onClick="prewYear()"></td>
    <td>
     <input type="text" name="mmese" value="" size="20">
     <input type="hidden" name="giorno" value="" size="20">
     <input type="hidden" name="mese" value="" size="20">
     <input type="hidden" name="anno" value="" size="20">
     <input type="hidden" name="dataclick" value="" size="20">
<?php
	if (isset($_GET["N"])) {
?>
        <input type='hidden' name="campo" value="<? echo($_GET["N"]); ?>">
<?php
	}
	else {
?>
 	<input type='hidden' name="campo" value="err">
<?php
	}

?>
    </td>

    <td>
<INPUT TYPE="button" NAME="next" VALUE="->"    onClick="nextYear()"></td>
  </tr>
</table>
</form>

   <FORM NAME="calButtons">
   <table border="0" cellpadding="0" cellspacing="0" >
  <tr>
   <td width="0%">D</td>
   <td width="0%">L</td>
   <td width="0%">M</td>
   <td width="0%">M</td>
   <td width="0%">G</td>
   <td width="0%">V</td>
   <td width="0%">S</td>
   </tr>




   </CENTER>

<CENTER>
  <tr>
    <td width="0%"><INPUT TYPE="button" NAME="but1"  value="" onclick="valore_data('but1')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but2"  value="" onclick="valore_data('but2')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but3"  value="" onclick="valore_data('but3')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but4"  value="" onclick="valore_data('but4')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but5"  value="" onclick="valore_data('but5')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but6"  value="" onclick="valore_data('but6')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but7"  value="" onclick="valore_data('but7')"></td>
  </tr>
  <tr>
    <td width="0%"><INPUT TYPE="button" NAME="but8"  value="" onclick="valore_data('but8')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but9"  value="" onclick="valore_data('but9')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but10" value="" onclick="valore_data('but10')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but11" value="" onclick="valore_data('but11')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but12" value="" onclick="valore_data('but12')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but13" value="" onclick="valore_data('but13')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but14" value="" onclick="valore_data('but14')"></td>
  </tr>
  <tr>
    <td width="0%"><INPUT TYPE="button" NAME="but15" value="" onclick="valore_data('but15')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but16" value="" onclick="valore_data('but16')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but17" value="" onclick="valore_data('but17')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but18" value="" onclick="valore_data('but18')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but19" value="" onclick="valore_data('but19')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but20" value="" onclick="valore_data('but20')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but21" value="" onclick="valore_data('but21')"></td>
  </tr>
  <tr>
    <td width="0%"><INPUT TYPE="button" NAME="but22" value="" onclick="valore_data('but22')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but23" value="" onclick="valore_data('but23')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but24" value="" onclick="valore_data('but24')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but25" value="" onclick="valore_data('but25')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but26" value="" onclick="valore_data('but26')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but27" value="" onclick="valore_data('but27')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but28" value="" onclick="valore_data('but28')"></td>
  </tr>
  <tr>
    <td width="0%"><INPUT TYPE="button" NAME="but29" value="" onclick="valore_data('but29')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but30" value="" onclick="valore_data('but30')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but31" value="" onclick="valore_data('but31')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but32" value="" onclick="valore_data('but32')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but33" value="" onclick="valore_data('but33')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but34" value="" onclick="valore_data('but34')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but35" value="" onclick="valore_data('but35')"></td>
  </tr>
  <tr>
    <td width="0%"><INPUT TYPE="button" NAME="but36" value="" onclick="valore_data('but36')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but37" value="" onclick="valore_data('but37')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but38" value="" onclick="valore_data('but38')" ></td>
    <td width="0%"><INPUT TYPE="button" NAME="but39" value="" onclick="valore_data('but39')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but40" value="" onclick="valore_data('but40')" ></td>
    <td width="0%"><INPUT TYPE="button" NAME="but41" value="" onclick="valore_data('but41')"></td>
    <td width="0%"><INPUT TYPE="button" NAME="but42" value="" onclick="valore_data('but42')"></td>
  </tr>
</table>
</CENTER>


</FORM></CENTER>

</body>
</html>