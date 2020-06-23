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
						<? write_title_cal($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_accordion($date,-1); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top width=680>
						<table  class='frame' width=100% height=673 cellpadding=0 cellspacing=0>
							<tr>
								<td bgcolor=#FFFFFF align=left valign=top colspan=1 height=10%>
									<table cellspacing=0 cellpadding=20 border=0 width=100% height=100%><tr><td>
									Welcome to the Flare Prediction System. 
                                                                        This page lists the active regions present on the Sun today, together with their probability
									of producing C-, M-, or X-class events. Flare probabilities are calculated using
									<a class=mail2 href="http://www.swpc.noaa.gov/">NOAA Space Weather Prediction Center</a> data 
	                                                                combined over 1969-1976 and 1988-1996 (details of which can be found in Bloomfield <i>et al.</i>, 
								        2012, <i>The Astrophysical Journal Letters</i>, <b>747</b>, L41, along with full forecast 
                                                                        verification testing). The percentage probabilities 
									are based on the number of flares produced by regions classified using the McIntosh classification 
									scheme (McIntosh, P., 1990, <i>Solar Physics</i>, <b>125</b>, 251) during cycles 21 and 22. For example, 
									over both time periods there were 377 regions classified Eai. As this class produced 131 M-class 
									events, the mean M-class flare rate is ~131/377 or ~0.347 flares per day. Assuming the number of 
									flares per unit time is governed by Poisson statistics, we can estimate a flaring probability
									for the following 24-hours using P( one or more flares ) = 1 - exp( -mean ), i.e.,
									P = 1 - exp( -0.347 ) ~ 0.29, or 29% for an Eai class region to produce one or more M-class
									flares in the next 24-hours. <p>See <a class=mail2 href=http://www.springerlink.com/content/h02309110582457j/
                                                                        target=_blank>Gallagher, P. T., Moon, Y.-J., Wang, H., <i>Solar Physics</i>,
	                                                                <b>209</b>, 171, (2002)</a>,<br> Wheatland, M. S., 2001, <i>Solar Physics</i>, <b>203</b>, 
									87 and Moon <i>et al.</i>, 2001, <i>Journal of Geophysical Research-Space Physics</i>, 
									<b>106(A12)</b> 29951 for further details.</br></p>
									<p>Click <a class=mail2 href=http://sidc.oma.be/educational/classification.php>here</a> for a description of the various active region classifications from the Royal Observatory of Belgium.<br>
									</td></tr></table>
								</td>
							</tr>
							<tr valign=top>
								<td class=noaacol align=center valign=middle colspan=5><font color=white>
									<b>Region Flare Probabilities (%)</b>
								</font></td>
							</tr>
							<tr>
								<td colspan=1 valign=middle height=1%><table cellpadding=5 cellspacing=0 border=0 width=100% height=1%><tr>
									<td class=noaacol align=center><font color=white size=-1>
										<i><b>Number</b></i>
									</font></td>
									<td class=noaacol align=center><font color=white size=-1>
										<i><b>McIntosh</b></i>
									</font></td>
									<td class=noaacol align=center><font color=white size=-1>
										<i><b>C-class</b></i>
									</font></td>
									<td class=noaacol align=center><font color=white size=-1>
										<i><b>M-class</b></i>
									</font></td>
									<td class=noaacol align=center><font color=white size=-1>
										<i><b>X-class</b></i>
									</font></td>
								</tr></table>
							</tr>
								<tr><td colspan=1 valign=bottom height=1%><table width=100% cellspacing=0 cellpadding=5 border=0 rules=rows>
							<?
								$file = "${arm_data_path}data/$dirdate/meta/arm_forecast_" . $date . ".txt";
								
								if (file_exists($file))
								{
									$lines=file($file);
									$nline=count($lines);
									if ($nline < 2)
									{
										$line=$lines;
									}
									else
									{
										$line=$lines[0];
									}
						//temporary->
						//echo 'Use this file: '.$file;
						//echo '<br>Line[0] is: '.$lines[0];
						//endtemporary
									
									if ($line == "N" || $line == "")
									{
										print("							<tr>\n");
										print("								<td align=center valign=middle  bgcolor=#f0f0f0 colspan=5><font color=white>\n");
										print("									<b>No Prediction Found</b>");
										print("								</font></td>");
										print("							</tr>\n");										
									}
									else
									{
										foreach($lines as $line)
										{
											list($region, $mcintosh, $c, $m, $x) = split('[ ]', $line, 5);
											
											print("							<tr>                      \n");
											print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n");
											print("									<a class=mail2 href=\"region.php?date=$date&region=$region\">$region</a>\n");
											print("								</td>\n");
											print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n");
											print("									$mcintosh\n");
											print("								</td>\n");
											print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n");
											print("									$c\n");
											print("								</td>\n");
											print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n");
											print("									$m\n");
											print("								</td>\n");
											print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n");
											print("									$x\n");
											print("								</td>\n");
											print("							</tr>\n");
										}
									}
								}
								else
								{
									print("							<tr>\n");
									print("								<td align=center valign=middle background=common_files/brushed-metal.jpg colspan=5><font color=white>\n");
									print("									<b>No Prediction Found</b>");
									print("								</font></td>");
									print("							</tr>\n");
								}
							?>
							</table></td></tr>
							<tr>
								<td bgcolor=#FFFFFF align=left valign=top colspan=1>
									<table width=100% height=100% cellpadding=20 cellspacing=0 border=0><tr><td valign=top><p><i><b>NOTE:</b></i> 
									Occurrence of '...' indicates that McIntosh class was not observed in 
                                                                        the period over which the Poisson flare rate statistics were determined. 
                                                                        Values in parantheses/brackets give the NOAA/SWPC forecast probabilities for the 
									occurrence of one or more C-, M-, or X-class flares. When viewed in 
									real-time and before 22:00 UT, NOAA predictions are valid up to 22:00 UT 
									on the current date. When viewed in real-time after 22:00 UT (or when 
									viewing past dates), NOAA predictions are valid up to 22:00 UT on the 
									following date. The most recent data can also be found at NOAA's
									<a class=mail2 href=http://legacy-www.swpc.noaa.gov/ftpdir/latest/daypre.txt>
									3-day Space Weather Predictions</a> page.
									<p>Please contact <a class=mail2 href="mailto:peter.gallagher@tcd.ie">Peter Gallagher</a> if you 
									have any comments or questions regarding this research.<br></font></td></tr></table>
								</td>
							</tr>
						</table>
					</td>
					<td valign=top align=center width=82>
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
			<? write_new_ar_table($date) ?>
			<? write_events($date); ?>
			<p>
			<hr size=2>
		<? write_footer_new($time_updated); ?>
			<p>
			</center>
	</body>
</html>