<?
	include ("include_admin.php");
	
	if (isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = "smdi_maglc";
		
	if (isset($_GET['indexnum']))
		$indexnum = $_GET['indexnum'];
	else
		$indexnum = "1";
	
	if ($type == "trce_m0171")
	{
		$title = "TRACE 171 &Aring; Mosaic and NOAA Active Regions";	
	}
	else
	{
		$temp_index = $fd_types2num[$type];
		$title = $fd_strs2[$temp_index] . " and NOAA Active Regions";	
	}

?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<? /*<body onLoad = scroll(0) onUnload = window.defaultStatus = ''> */ ?>
	<body>
		<center>
			<table bgcolor=#787878 width=815 border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
						<!--<font size=1><br> </font>-->
						<? write_title($date, $title, $this_page, $indexnum,$type); ?>
						<!--<font size=1><br> </font>-->
					</td>
				</tr>
				<tr>
					<td background=common_files/brushed-metal.jpg valign=top align=center>
					</td>
					<td bgcolor=#FFFFFF valign=top align=center>
						<? write_index_body_inst_admin($date, $indexnum, $type); ?>
					</td>
					<td background=common_files/brushed-metal.jpg valign=top align=center>
						<? /*write_right($date); */?>
					</td>
				</tr>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
						<? /*write_bottom($date); */?>
					</td>
				</tr>
			</table>
 			<p></p>
			<hr size=2>
			<p></p>
		</center>
	</body>
</html>
