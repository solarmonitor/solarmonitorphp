<? 
	include ("include.php");
        include ("globals.php");	

	$title = "Flare Prediction System";	
	$indexnum = "1";
	
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body onload="slider.init('sliderl');slider.init('sliderl2');slider.init('sliderr');slider.init('sliderr2'); warning.init('warning')">
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame' width=842 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align=center colspan=3>
						<? write_title_cal1($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_accordion($date,-1); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top width=681>
						<table  class='frame' width=100% id='test'  cellpadding=0 cellspacing=0>
							<tr>	
							    <?  write_flare_prob_img($date) ; ?>
							</tr>
							<tr valign=top>
								<td class=noaacol align=center valign=middle colspan=5><font color=white>
									<b>Region Flare Probabilities (%)</b>
								</font></td>
							</tr>
							<tr>
								<? write_pr_table() ; ?>
							</tr>
							<tr>
								<td bgcolor=#FFFFFF align=left valign=top colspan=1>
									<table width=100% height=100% cellpadding=20 cellspacing=0 border=0><tr><td valign=top><p>

									Occurrence of '...' indicates that McIntosh class was not observed in 
                                                                        the period over which the Poisson flare rate statistics were determined. 
                                                                        When viewed in 
									real-time and before 22:00 UT, NOAA predictions are valid up to 22:00 UT 
									on the current date. When viewed in real-time after 22:00 UT (or when 
									viewing past dates), NOAA predictions are valid up to 22:00 UT on the 
									following date. The most recent data can also be found at NOAA's
									<a class=mail2 href=http://www.swpc.noaa.gov/ftpdir/latest/daypre.txt>
									3-day Space Weather Predictions</a> page.</br></p>
                                     <p>Solar Monitor's (SM) flare probabilities are calculated using
									<a class=mail2 href="http://www.swpc.noaa.gov/">NOAA Space Weather Prediction Center</a> data 
	                                combined over 1969-1976 and 1988-1996 (details of which can be found in Bloomfield <i>et al.</i>, 
								        2012, <i>The Astrophysical Journal Letters</i>, <b>747</b>, L41, along with full forecast 
                                                                        verification testing). Percentage probabilities 
									are based on the number of flares produced by regions classified using the McIntosh classification 
									scheme (McIntosh, P., 1990, <i>Solar Physics</i>, <b>125</b>, 251) during cycles 21 and 22. For example, 
									over both time periods there were 377 regions classified Eai. As this class produced 131 M-class 
									events, the mean M-class flare rate is ~131/377 or ~0.347 flares per day. Assuming the number of 
									flares per unit time is governed by Poisson statistics, we can estimate a flaring probability
									for the following 24-hours using P( one or more flares ) = 1 - exp( -mean ), i.e.,
									P = 1 - exp( -0.347 ) ~ 0.29, or 29% for an Eai class region to produce one or more M-class
									flares in the next 24-hours. <p>See <a class=mail2 href=http://www.springerlink.com/content/h02309110582457j/
                                    target=_blank>Gallagher, P. T., Moon, Y.-J., Wang, H., <i>Solar Physics</i>,
	                                <b>209</b>, 171, (2002)</a>,<br> Wheatland, M. S., 2001, <i>Solar Physics</i>, 	<b>203</b>, 
									87 and Moon <i>et al.</i>, 2001, <i>Journal of Geophysical Research-Space Physics</i>, 
									<b>106(A12)</b> 29951 for further details.</br></p>
									<p>Click <a class=mail2 href=http://sidc.oma.be/educational/classification.php>here</a> for a description of the various active region classifications from the Royal Observatory of Belgium.<br></p>
	<p>Please contact <a class=mail2 href="mailto:peter.gallagher@tcd.ie">Peter Gallagher</a> if you 
									have any comments or questions regarding this research.<br>
									</font></td></tr></table>
								</td>
							</tr>
						</table>
					</td>
					<td valign=top align=center width=82>
						<? write_right_accordion($date) ; ?>
    				</td>
  				</tr>
				<tr>
					<td align=center colspan=3>
						<? write_bottom_clean() ; ?>
					</td>
				</tr>
			</table>
			<p>
			<? write_new_ar_table($date) ; ?>
			<? write_events($date) ; ?>
			<p>
			<hr size=2>
		<? write_footer_new($time_updated) ; ?>
			<p>
			</center>
			<? write_footer_js() ; ?>
	</body>
</html>
