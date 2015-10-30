<?
/*...............................................*/
// FUNCTION : write_forecast_paragraph()
// AUTHOR : Michael Tierney 
// DATE : 12/08/2014
// PURPOSE : Writes the paragraph under the flare probability table
/*...............................................*/

function write_forecast_paragraph()
{
	
	print("								<td bgcolor=#FFFFFF align=left valign=top colspan=1>\n") ;
	print("									<table width=100% height=100% cellpadding=20 cellspacing=0 border=0><tr><td valign=top><p>\n") ;
	print("										Solar Monitor's flare prediction system's (FPS) probabilities are calculated using\n") ;
	print("											<a class=mail2 href=\"http://www.swpc.noaa.gov/\">NOAA Space Weather Prediction Center</a> data\n") ;
	
	print("	                              	 	combined over 1969-1976 and 1988-1996 (details of which can be found in <a class=mail2 href = http://adsabs.harvard.edu/abs/2012ApJ...747L..41B> Bloomfield <i>et al.</i>, 2012, <i>The Astrophysical Journal Letters</i>, <b>747</b>, L41 </a>, along with full forecast verification testing). </p> <p>See <a class=mail2 href=http://www.springerlink.com/content/h02309110582457j/ target=_blank>Gallagher, P. T., Moon, Y.-J., Wang, H., <i>Solar Physics</i>, <b>209</b>, 171, (2002)</a>,<br> Wheatland, M. S., 2001, <i>Solar Physics</i>, 	<b>203</b>, 87 and Moon <i>et al.</i>, 2001, <i>Journal of Geophysical Research-Space Physics</i>, <b>106(A12)</b> 29951 for further details.</br></p>\n") ;

	print(" 										<p> Occurrence of '...' indicates that McIntosh class was not observed in the period over which the Poisson flare rate statistics were determined. When viewed in real-time and before 22:00 UT, NOAA predictions are valid up to 22:00 UT on the current date. When viewed in real-time after 22:00 UT (or when viewing past dates), NOAA predictions are valid up to 22:00 UT on the following date. The most recent data can also be found at NOAA's <a class=mail2 href=http://www.swpc.noaa.gov/ftpdir/latest/daypre.txt> 3-day Space Weather Predictions</a> page.</br></p>\n") ;
    
	print("											<p>Please contact <a class=mail2 href=\"mailto:peter.gallagher@tcd.ie\">Peter Gallagher</a> if you have any comments or questions regarding this research.<br>\n") ;

	print("									</font></td></tr></table>\n") ;
	print("								</td>\n") ;
}

?>
