<? 
	include ("include.php");
	include ("globals.php");
	$indexnum = "1";
	
	if(isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = "smdi_igram";	
	
	if (isset($_GET['region']))
		$region = $_GET['region'];
	else
		$region = "00000";

	if (isset($_GET['indexnum']))
		$indexnum = $_GET['indexnum'];
	else
		$indexnum = "1";

	$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_titles_" . $date . ".txt";
	if (file_exists($file))
	{
		$lines=file($file);
		$title = "No Region $region Found";
		foreach($lines as $line)
		{
			list($number, $temp_title) = split('[ ]', $line, 2);
			if ($number == $region)
			{
				$title = $temp_title;
				break;
			}
		}	
	}
	else
	{
		$title = "No Title Found";
	}
	
	//if ($indexnum == "1")
		$sub_title = $region_strs1[$type];
	//else 
	//	$sub_title = $region2_strs1[$type];
	
	$year = substr($date,0,4);
	$month = substr($date,4,2);
	
	$instrument = substr($type,0,4);
	$filter = substr($type,5,5);
	$file = find_latest_file($date, $instrument, $filter, 'png', 'ar', $region); 

	$url = "${arm_data_path}data/$dirdate/pngs/$instrument/$file";
		
	$curr_date = gmdate("Ymd");
	
	if ($date > $curr_date)
		$url = "common_files/placeholder_604.png";
?>
<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
	  <? require("common_files/themes.php"); ?>
		<table class='frame' width="620" height="710" align="center" valign=middle border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td align=center>
					<? write_title_cal1($date, $sub_title, $this_page, $indexnum, $type, $width="95%", $region); ?>
				</td>
			</tr>
			<tr>
				<td bgcolor=#FFFFFF align=center>
					<? print link_image($url, 604, false); ?>
				</td>
			</tr>
			<tr>
				<td bgcolor=#FFFFFF align=center>
					<table width=100% border=0 cellpadding=0 cellspacing=0>
						<tr>
	  
							<?
		$links=array();
$k=array();

		for($i=0;$i<count($region_types);$i++)
		{
			$type_r = $region_types[$i];
			$instrument = substr($type_r,0,4);
			$filter = substr($type_r,5,5);
			$file = find_latest_file($date, $instrument, $filter, 'small60.jpg', 'ar', $region);
			$links[] = link_image("${arm_data_path}data/$dirdate/pngs/$instrument/$file", 35, false);
			//			var_dump(file_exists("${arm_data_path}data/$dirdate/pngs/$instrument/$file"));
			$k[]= (file_exists("${arm_data_path}data/$dirdate/pngs/$instrument/$file") && $type != $region_types[$i]) ? $i : -1;
		}
//var_dump($k);
print("<td align=\"center\" colspan=\"7ve \">\n");
								for($i=0;$i<count($region_types);$i++)
								{
								  if ($k[$i] != -1)
									 {
									   print("<a href=./region_pop.php?date=$date&type=" . $region_types[$i] . "&region=$region title=\"".$region_strs1[$region_types[$i]]."\">". $links[$i] . "</a>\n");
									 }
								  
//									print("<td background=common_files/brushed-metal.jpg valign=middle align=center><font size=-1 color=white>\n");
//									$temp_type = $region_types[$i];
//									$string = $region_strs2[$temp_type];
//									print("	<b><a class=mail href=\"./region_pop.php?date=$date&type=$region_types[$i]&region=$region\">$string</a></b>\n");
//									print("</font></td>\n");								
								}
print("</td></tr>\n</table>\n");

?>
				</td>
			</tr>
						<tr>
						<td colspan='3' align='center'>
 <? include ("share_include.txt"); ?>
 </td>
</table>
	</body>
</html>