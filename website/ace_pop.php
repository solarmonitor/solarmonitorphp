<?
// 2008-11-04 (P. Higgins): written	
// 2009-04-09 (P. Higgins): modified

	include ("include.php");
        include ("globals.php");	
	
	if(isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = "aceplasma";
		
	if ($type == "aceplasma")
	{
		$title = "Plasma ";
	}
	else
	{
		$title = "Magnetic Field ";
	}
	
	$year = substr($date,0,4);
	$yy = substr($date,2,2);
	$month = substr($date,4,2);
	$day = substr($date,6,2);
	
	$curr_date = gmdate("Ymd");
	
	if ($type == "aceplasma")
	{
		if ($date > $curr_date)
		{
			$url = "./common_files/placeholder_630x485.png";
		}
		else if ($date == $curr_date)
		{
			$url = "http://services.swpc.noaa.gov/images/ace-swepam-3-day.gif";
		}
		else
		{
			$url = "./common_files/placeholder_630x485.png";
			if (@fopen("data/".$dirdate."/pngs/ace/sace_plasma_".$date.".gif", "r")){$url = "data/".$dirdate."/pngs/ace/sace_plasma_".$date.".gif";}
		}
	}
	else
	{
		if ($date > $curr_date)
		{
			$url = "./common_files/placeholder_630x485.png";
		}
		else if ($date == $curr_date)
		{
			$url = "http://services.swpc.noaa.gov/images/ace-mag-3-day.gif";
		}
		else
		{
			$url = "./common_files/placeholder_630x485.png";
			if (@fopen("data/".$dirdate."/pngs/ace/sace_bfield_".$date.".gif", "r")){$url = "data/".$dirdate."/pngs/ace/sace_bfield_".$date.".gif";}
		}
	}	
	
	if ($date > $curr_date)
		$url = "./common_files/placeholder_630x485.png";

function get_text($filename)
{
	$fp_load = fopen("$filename", "rb");
	
	if ( $fp_load )
	{
		while ( !feof($fp_load) )
		{
			$content .= fgets($fp_load, 8192);
		}
	
		fclose($fp_load);
		return $content;
	}
}

//print($url." ");
//print($date." ");
//print($curr_date);

?>
<html>
	<? write_header($date, $title, $this_page) ?>
<!-- 	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="refresh" content="300">
		<title><? print($title); ?>( Updates dynamically every 5-mins) </title>
		<link rel=stylesheet href="./common_files/arm-style.css" type="text/css">
	</head> -->
	<body>
		<table class='frame' width="674" height="575" align=center border=0 cellspacing=0 cellpadding=0 border=0>
			<tr>
				<td align=center>				
					<? write_title_cal($date, $title, $this_page, $indexnum="1", $type, $width="95%"); ?>
				</td>
			</tr>
			<tr>
				<td align=center>
					&nbsp;<br><img src="<? print $url ?>" autostart="true" width="640" height="512" /><br>&nbsp;</a>
				</td>
			</tr>
			<tr>
				<td  align=center>
                                    <b><font color=white>
					ACE <br>
					<a class=mail href="./ace_pop.php?date=<? print $date ?>&type=aceplasma">Plasma</a>&nbsp;/&nbsp;<a class=mail href="./ace_pop.php?date=<? print $date ?>&type=acemag">B Field</a>
                                    </font></b>
				</td>
			</tr>
		</table>
	</body>
</html>
