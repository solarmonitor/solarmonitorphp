<?
	include ("include.php");
		
	$title = "SolarMonitor Contact";
	$indexnum = "1";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
		<center>
			<table background=common_files/brushed-metal.jpg width=815 border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
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
								To contact the SolarMonitor.org team you can write an email to:
								<a class=mail2 href=\"mailto:info@solarmonitor.org\">info@solarmonitor.org</a><br><br>
								
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
