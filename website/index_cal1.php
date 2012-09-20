<?
	include("include.php");
	include("globals.php");
		
	$title = "www.SolarMonitor.org";
	$indexnum = "1";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body onload="slider.init('sliderl');slider.init('sliderr'); warning.init('warning')">
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame'  width=815 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align=center colspan=3>
						<? write_title_cal1($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_accordion($date,-1); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top>
    <? if ($region == '') 
	{
	  write_index_body_slider($date, $indexnum,"fd");
	} 
       else 
	{
	  write_index_body_slider($date, $indexnum,"ar",$region);
        }
    ?>
					</td>
					<td valign=top align=center>
						<? write_right_accordion($date); ?>
					</td>
				</tr>
				<tr>
					<td align=center colspan=3>
						<? write_bottom_clean(); ?>
					</td>
				</tr>
			</table>
			<p>
 			<? write_new_ar_table($date); ?>
			<? write_events($date); ?>
			<p>
			<hr size=2>
		<? write_footer_new($time_updated); ?>
			<p>
			</center>
	</body>
</html>
