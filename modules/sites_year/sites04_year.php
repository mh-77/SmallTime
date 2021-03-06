<?php
/********************************************************************************
* Small Time
/*******************************************************************************
* Version 0.85
* Author:  IT-Master GmbH
* www.it-master.ch / info@it-master.ch
* Copyright (c) , IT-Master GmbH, All rights reserved
*******************************************************************************/
//-----------------------------------------------------------------------------
// Anzeige der Summen aus Statistik
//-----------------------------------------------------------------------------
echo "<table width=100% border=0 cellpadding=3 cellspacing=1 >";
echo "<tr>";
echo "<td class='td_background_top' width=100 align=left colspan=2>Aktuelle Total - Saldo</td>";
echo "</tr>";
/*
echo "<tr>";
echo "<td class=td_background_tag width=100>Vorholzeit</td>";
echo "<td class=td_background_tag >$user->_Vorholzeit_pro_Jahr h</td>";
echo "</tr>";
*/
echo "<tr>";
echo "<td class='alert";
echo $_jahr->_saldo_t >=0 ? " alert-success" : " alert-error";
echo "'  width=100 align=left>Zeitsaldo</td>";
echo "<td class=td_background_tag align=left>$_jahr->_saldo_t Std.</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='alert";
echo $_jahr->_saldo_F >=0 ? " alert-success" : " alert-error";
echo "' width=100 align=left>Feriensaldo</td>";
echo "<td class=td_background_tag align=left>$_jahr->_saldo_F Tage</td>";
echo "</tr>";
echo "</table>";
echo "<br>";


// ----------------------------------------------------------------------------
// Modler - Daten werden berechnet
// ----------------------------------------------------------------------------	
//__construct($SettingCountry, $lastday, $ordnerpfad, $jahr, $monat, $arbeitstage, $ufeiertag, $_SollProTag, $_startzeit)
/*
Variablen für die Jahressummen:
$_SummeSollProMonat
$_SummeWorkProMonat
$_SummeAbsenzProMonat
$_SummeSaldoProMonat
$_SummeStempelzeiten
$_SummeFerien
$_SummeKrankheit
$_SummeUnfall
$_SummeMilitaer
$_SummeIntern
$_SummeWeiterbildung
$_SummeExtern
*/
//$_data = array(SummeSollProMonat,SummeWorkProMonat,SummeAbsenzProMonat,SummeSaldoProMonat,SummeStempelzeiten,SummeFerien,SummeKrankheit,SummeUnfall,SummeMilitaer,SummeIntern,SummeWeiterbildung,SummeExtern);

$_data[0][0]	= "SummeSollProMonat";
$_data[1][0] 	= "SummeWorkProMonat";	
$_data[2][0] 	= "SummeAbsenzProMona";	
$_data[3][0] 	= "SummeSaldoProMonat";
$_data[4][0] 	= "Auszahlung";	
//$_data[4][0] 	= "SummeStempelzeiten";	
$_data[5][0] 	= "SummeFerien";	
$_data[6][0] 	= "SummeKrankheit";	
$_data[7][0] 	= "SummeUnfall";	
$_data[8][0] 	= "SummeMilitaer";	
$_data[9][0] 	= "SummeIntern";	
$_data[10][0] 	= "SummeWeiterbildung";
$_data[11][0] 	= "SummeExtern";

//print_R($_data);
for($i=0; $i<12;$i++){
	// ----------------------------------------------------------------------------
	// Anzahl der Tage im Monat
	// ----------------------------------------------------------------------------	
	$_temp_time = new time();
	$_temp_time->set_timestamp(mktime(0,0,0,$i+1,1,$_time->_jahr));
	//echo $_temp_time->_letzterTag;
	//echo "<hr>";
	$_jahres_berechnung[$i]         = new time_month( $_settings->_array[12][1] , $_temp_time->_letzterTag, $_user->_ordnerpfad, $_time->_jahr, $i+1, $_user->_arbeitstage, $_user->_feiertage, $_user->_SollZeitProTag, $_user->_BeginnDerZeitrechnung, $_settings->_array[21][1],$_settings->_array[22][1]);	
	//echo "Monat : " .$i . "<br>";
	//echo "Soll " . $_jahres_berechnung[$i]->_SummeSollProMonat; 
	/*
	$_SummeSollProMonat 	+= $_jahres_berechnung[$i]->_SummeSollProMonat;
	$_SummeWorkProMonat		+= $_jahres_berechnung[$i]->_SummeWorkProMonat;
	$_SummeAbsenzProMonat	+= $_jahres_berechnung[$i]->_SummeAbsenzProMonat;
	$_SummeSaldoProMonat	+= $_jahres_berechnung[$i]->_SummeSaldoProMonat;
	$_SummeStempelzeiten	+= $_jahres_berechnung[$i]->_SummeStempelzeiten;
	$_SummeFerien			+= $_jahres_berechnung[$i]->_SummeFerien;
	$_SummeKrankheit		+= $_jahres_berechnung[$i]->_SummeKrankheit;
	$_SummeUnfall			+= $_jahres_berechnung[$i]->_SummeUnfall;
	$_SummeMilitaer			+= $_jahres_berechnung[$i]->_SummeMilitaer;
	$_SummeIntern			+= $_jahres_berechnung[$i]->_SummeIntern;
	$_SummeWeiterbildung	+= $_jahres_berechnung[$i]->_SummeWeiterbildung;
	$_SummeExtern			+= $_jahres_berechnung[$i]->_SummeExtern;
	*/
	$_data[0][1] 	+= $_jahres_berechnung[$i]->_SummeSollProMonat;
	$_data[1][1]	+= $_jahres_berechnung[$i]->_SummeWorkProMonat;
	$_data[2][1]	+= $_jahres_berechnung[$i]->_SummeAbsenzProMonat;
	$_data[3][1]	+= $_jahres_berechnung[$i]->_SummeSaldoProMonat;
	$_data[4][1]	+= $_jahr->get_auszahlung(($i+1), $_time->_jahr);
	//$_data[4][1]	+= $_jahres_berechnung[$i]->_SummeStempelzeiten;
	$_data[5][1]	+= $_jahres_berechnung[$i]->_SummeFerien;
	$_data[6][1]	+= $_jahres_berechnung[$i]->_SummeKrankheit;
	$_data[7][1]	+= $_jahres_berechnung[$i]->_SummeUnfall;
	$_data[8][1]	+= $_jahres_berechnung[$i]->_SummeMilitaer;
	$_data[9][1]	+= $_jahres_berechnung[$i]->_SummeIntern;
	$_data[10][1]	+= $_jahres_berechnung[$i]->_SummeWeiterbildung;
	$_data[11][1]	+= $_jahres_berechnung[$i]->_SummeExtern;	
	//echo "<hr>";	
}
// ----------------------------------------------------------------------------
// Viewer für die Jahresansicht
// ----------------------------------------------------------------------------	
$monate = explode(";",$_settings->_array[11][1]);

echo "<table width='100%' hight='100%' border='0' cellpadding='3' cellspacing='1'>";
echo "<tr>";
echo "<td class='td_background_top' align='middle'>";
echo "Monat";
echo "</td>";

echo "<td class='td_background_top' align='middle'>";
echo "Soll";
echo "</td>";
	
echo "<td class='td_background_top' align='middle'>";
echo "Work";
echo "</td>";
	
echo "<td class='td_background_top' align='middle'>";
echo "Absenz";
echo "</td>";
	
echo "<td class='td_background_top' align='middle'>";
echo "Saldo";
echo "</td>";	

echo "<td class='td_background_top' align='middle'>";
echo "Ausz.";
echo "</td>";

foreach($_absenz->_filetext as $spalten){
	explode(";",$spalten);
	echo "<td width='40' align='middle' class='td_background_top'>";
	echo "" .$spalten[0] . "";
	echo "</td>";
}
echo "</tr>";

$_SummeSollProMonat 		+= $_jahres_berechnung[$i]->_SummeSollProMonat;
$_SummeWorkProMonat		+= $_jahres_berechnung[$i]->_SummeWorkProMonat;
$_SummeAbsenzProMonat	+= $_jahres_berechnung[$i]->_SummeAbsenzProMonat;
$_SummeSaldoProMonat		+= $_jahres_berechnung[$i]->_SummeSaldoProMonat;
$_SummeStempelzeiten		+= $_jahres_berechnung[$i]->_SummeStempelzeiten;
$_SummeFerien			+= $_jahres_berechnung[$i]->_SummeFerien;
$_SummeKrankheit			+= $_jahres_berechnung[$i]->_SummeKrankheit;
$_SummeUnfall			+= $_jahres_berechnung[$i]->_SummeUnfall;
$_SummeMilitaer			+= $_jahres_berechnung[$i]->_SummeMilitaer;
$_SummeIntern			+= $_jahres_berechnung[$i]->_SummeIntern;
$_SummeWeiterbildung		+= $_jahres_berechnung[$i]->_SummeWeiterbildung;
$_SummeExtern			+= $_jahres_berechnung[$i]->_SummeExtern;

for($i=0; $i<12;$i++){
	$_timestamp = mktime(0, 0, 0, $i+1, 1, $_time->_jahr);	
	echo "<tr>";
	echo "<td class=td_background_wochenende>";
	echo "<table width='100%' hight='100%' border='0' cellpadding='2' cellspacing='0'><tr><td width='18' valign='middle'>";
	echo "<img src='images/icons/calendar_view_month.png' border=0>";
	echo "</td><td align='left'>";
	echo "<a title='Monat ".$monate[$i]."' href='?action=show_time&admin_id=".$_SESSION['id']."&timestamp=".$_timestamp."'>".$monate[$i]."</a>&nbsp;";
				
	echo "</td></tr></table>";			
	echo "</td>";

	echo "<td width='60' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeSollProMonat;
	echo "</td>";
	
	echo "<td width='60' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeWorkProMonat;
	echo "</td>";
	
	echo "<td width='60' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeAbsenzProMonat;
	echo "</td>";
	
	echo "<td width='60' align='middle' class=td_background_wochenende>";
	if($_jahres_berechnung[$i]->_SummeSaldoProMonat<0) echo "<font class=minus>";
	echo $_jahres_berechnung[$i]->_SummeSaldoProMonat;
	if($_jahres_berechnung[$i]->_SummeSaldoProMonat<0) echo "</font>";
	echo "</td>";
	
	echo "<td width='60' align='middle' class=td_background_tag><div id='mymodal'>";
	echo "<a title='Auszahlung' href='?action=edit_ausz&admin_id=".$_SESSION['id']."&monat=".($i+1)."&jahr=".$_time->_jahr."&modal'>";
	echo $_jahr->get_auszahlung(($i+1), $_time->_jahr);
	echo "</a>";
	echo "</div></td>";
	
		
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeFerien . "&nbsp;";
	echo "</td>";
	
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeKrankheit . "&nbsp;";
	echo "</td>";
	
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeUnfall . "&nbsp;";
	echo "</td>";
	
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeMilitaer . "&nbsp;";
	echo "</td>";
	
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeIntern . "&nbsp;";
	echo "</td>";
	
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeWeiterbildung . "&nbsp;";
	echo "</td>";
	
	echo "<td width='40' align='middle' class=td_background_tag>";
	echo $_jahres_berechnung[$i]->_SummeExtern . "&nbsp;";
	echo "</td>";

	echo "</tr>";
}
// Totale ------------------------------------------------------
echo "<tr>";
echo "<td class='td_background_top''  align='middle'>";
echo "Total :";
echo "</td>";
foreach($_data as $_spalten){
	//echo "Sunmme " .$_spalten[0] . " : " . $_spalten[1] . "<br>"
	echo "<td align='middle' class=td_background_top>";
	if($_spalten[1]<0) echo "<font class=minus>";
	echo round($_spalten[1],2);
	if($_spalten[1]<0) echo "</font>";
	echo "</td>";
}
echo "</tr>";

echo "</table>"
?>

<?php if (strstr($_template->_modal,'true')){ ?>
<script type="text/javascript">
        $('#mymodal a').click(function(e){
                e.preventDefault();
                $("#modalBody").html("");
                $('#myModalLabel').html($(this).attr('title'));
                $("#modalBody").load(this.href + '');
                $("#mainModal").modal('show');
        });
</script>
<?php } ?>