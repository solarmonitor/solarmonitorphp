<? 
	include ("include.php");
        include("globals.php"); 	
	$type = "smrt_maglc";
	$indexnum = "1";
        $title = "SMART Magnetic Structure Detections";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame' width=842 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align="center" colspan=3>
						<? write_title_clean($date, $title, $this_page, $indexnum, $type); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_clean($date,-1	); ?>
					</td>
					<td bgcolor=#FFFFFF  valign=top>
						<table cellpadding=15>
							<tr>
								<td align=left width=640>
									<b>Interpreting the <a class=mail2 href="smart_disk.php?date=<? print($date); ?>">SMART</a> Page:</b>
									
									<p>The full-disk image is a <i>SOHO</i>/MDI madnetogram thresholded at 70G and corrected for line-of-sight B-field effects. Near-realtime magnetograms 
									are not properly calibrated. Planning data is used and we estimate a calibration factor. Thus, these data are not 
									science quality and <b><i>should be used for planning or quick-look purposes only</i></b>.</p>
									<p>Green contours denote detected feature boundaries and the blue/white numbers are feature IDs.</p>
									<p>The feature table below contains one entry for each feature labeled in the image. The fields are explained below:
									<br><br><b>ID</b>: An integer uniquely identifying each feature on the disk. This corresponds to the labels in the image. IDs are in order of descending area.
									<br><br><b>TYPE</b>: A three letter code classifying the feature. The first letter is polarity; <b>M</b>ulti- or <b>U</b>nipolar. The second letter is size; <b>B</b>ig or <b>S</b>mall. The third letter is <b>E</b>merging or <b>D</b>ecaying.
									<br><br><b>Lat<sub>HG</sub>/Lon<sub>HG</sub></b>: The <a class=mail2 href="http://en.wikipedia.org/wiki/Stonyhurst_Observatory#Stonyhurst_heliographic_coordinates" target=_blank>Stonyhurst Heliographic</a> Latitude and Longitude.
									<br><br><b>&Phi;</b>: The magnetic flux in maxwells. 
									<br><br><b>L<sub>PIL</sub></b>: The polarity inversion line (PIL) length. If there is no PIL present, this will be 0.
									<br><br><b>R*</b>: A modified version of <a class=mail2 href="http://adsabs.harvard.edu/abs/2007ApJ...655L.117S" target=_blank>Schrijver's R-Value</a>, with a lower flux threshold, in units of maxwells.
									<br><br><b>WL<sub>SG</sub></b>: <a class=mail2 href="http://adsabs.harvard.edu/abs/2006ApJ...644.1258F" target=_blank>Falconer's proxy for feature non-potentiality</a>, which uses only the strong-gradient PIL segments, in units of gauss per megameter.
									</p>
									<p>Below the feature table, extracted images of <i>multipolar</i> features appear. The image title is of the form: ID_YYYYMMDD_HHMM. The axes are in units of megameters. PIL segments are over-plotted in red and strong-gradient PIL segments over-plotted in green. The magenta contours show where the R* contribution is concentrated.</p>
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
			
			<? //write_ar_table($date) ?>
			
			<p>
			<? //write_events($date); ?>
			<p>
			<hr size=2>
			<p>
		</center>
	<? write_footer_new($time_updated); ?>
	</body>
</html>
