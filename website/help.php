<? 
	include ("include.php");
        include("globals.php"); 	
		
	$title = "SolarMonitor Help";
	$indexnum = "1";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame' width=842 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align="center" colspan=3>
						<? write_title_clean($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_clean(); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top align=center>
						<table width=640>
							<tr>
								<td align=justify colspan=2>
								 SolarMonitor.org provides realtime information about the solar activity.
								 The most recent images of the sun are shown on the front page, together
								 with the description of the different NOAA AR of the day and which flares
								 has been associated to them.<br>
								 On the right hand side there are few access to time-series data from 
								 different instruments.<br>
								 On the left hand side the list of the NOAA ARs detected for today, 
								 the automated detected ones by the SMART code, and the Coronal Holes
								 detections made by the CHARM code. The information refeered to those
								 codes can be seen on the codes info page.<br>
								 Solar monitor allows to browse by date using the links on the top panel,
								 by direct input of the date in YYYYMMDD format, or using the calendar.  For
								 the keyboard shortcuts lover notice that using 
								 <a href='http://en.wikipedia.org/wiki/Access_key'>the proper access key for your browser</a> 
								 with , and . you can go back and
								 ahead one day.
								  <h3>FAQ</h3>						

								</td>
							</tr>
						</table>
					</td>
					<td valign=top align=center>
						<? write_right_clean($date); ?>
					</td>
				</tr>
				<tr>
					<td align=center colspan=3>
						<? write_bottom_clean($date); ?>
					</td>
				</tr>
			</table>
			<p>
			<hr size=2>
		<? write_footer_new($time_updated); ?>
			<p>
		</center>
	</body>
</html>
