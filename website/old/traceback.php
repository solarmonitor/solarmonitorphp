<?
	include ("include.php");
		
	$title = "Links to SolarMonitor";
	$indexnum = "1";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
		<center>
			<table background=common_files/brushed-metal.jpg width=815 border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
						<? write_title($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left($date, -1); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top align=center>
						<table width=640>
							<tr>
								<td align=left colspan=2>
									<br><b>Links to SolarMonitor:</b><br><br>
									<a href="http://solarcycle24.com/" target="_blank">http://solarcycle24.com</a> <br>
									"SolarCycle24.com will be your one stop source for everything Solar and Aurora as it relates to Cycle 24. You will find Real Time data, News, Charts, Images, Multimedia and much more. My goal is to put all important information from various sources into one spot. As soon as something important is happening on the sun, you will see it here first. "
									<br><br>
									<a href="http://xrt.cfa.harvard.edu/missionops/current.php" target="_blank">http://xrt.cfa.harvard.edu</a> <br>
									"The Hinode X-Ray Telescope (XRT) is a high-resolution grazing-incidence telescope, which is a successor to the highly successful Yohkoh Soft X-Ray Telescope (SXT)."
									<br><br>
									<a href="http://www.stargazing.net/naa/cool.htm" target="_blank">http://www.stargazing.net</a> <br>
									"NASA's Active Region Monitor"
									<br><br>
									<a href="http://umbra.nascom.nasa.gov/sdac.html" target="_blank">http://umbra.nascom.nasa.gov</a> <br>
									"SolarMonitor, the Website formerly known as the Active Region Monitor, offers up-to-date information on solar activity, including images, flare locations, flare predictions, and links to the LMSAL "last events" page, which gives a graphic view of solar and heliospheric activity through soft X-ray, energetic proton, and solar wind data."
									<br><br>
								</td>
							</tr>
						</table>
					</td>
					<td valign=top align=center>
						<? write_right($date); ?>
					</td>
				</tr>
				<tr>
					<td align=center colspan=3>
						<? write_bottom($date); ?>
					</td>
				</tr>
			</table>
			<p>
			<? write_ar_table($date); ?>
			<p>
			<? write_events($date); ?>
			<p>
			<hr size=2>
			<p>
		</center>
		<? write_footer($time_updated); ?>
	</body>
</html>
