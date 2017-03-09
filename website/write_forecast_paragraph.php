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
	print("										Solar Monitor's flare prediction system's probabilities are calculated using <a class=mail2 href=\"http://www.swpc.noaa.gov/\">NOAA Space Weather Prediction Center</a> data.  The data used is combined from periods 1969-1976 and 1988-1996. There are two main methods, <b>MCSTAT</b> and <b>MCEVOL</b>, both use sunspot McIntosh classification data and Poisson statistics to calculate flaring probabilities for the next 24hr.\n</p>") ;	
	print("<p><b>MCSTAT</b> – Uses point-in-time McIntosh classifications to calculate Poisson flaring probabilities. Details about the method [1] and forecast verification testing [2] can be found in the following papers:\n </p>");
	print("<p>[1] <a class=mail2 href=http://www.springerlink.com/content/h02309110582457j/ target=_blank>Gallagher, P. T., Moon, Y.-J., Wang, H., <i>Solar Physics</i>, <b>209</b>, 171, (2002)</a><br>
	[2]  <a class=mail2 href = http://adsabs.harvard.edu/abs/2012ApJ...747L..41B> Bloomfield <i>et al.</i>, 2012, <i>The Astrophysical Journal Letters</i>, <b>747</b>, L41 </a> </p>") ;
	print("<p><b>MCEVOL</b> – Uses the evolution of McIntosh classifications over 24hr period to calculate Poisson flaring probabilities. Details about the method and flaring rate statistics can be found in the following:</p>
	[1] <a class=mail2 href=https://link.springer.com/article/10.1007/s11207-016-0933-y target=_blank>McCloskey, A.E., Gallagher, P.T. & Bloomfield, D.S., <i>Solar Physics</i>, <b>291</b>, 1711, (2016)</a>");
	print("<p> Further Reading: <br> Wheatland, M. S., 2001, <i>Solar Physics</i>, 	<b>203</b>, 87 <br> Moon <i>et al.</i>, 2001, <i>Journal of Geophysical Research-Space Physics</i>, <b>106(A12)</b> 29951</br></p>\n");
	print("<hr style=border-top: dotted 1px />");
	print(" 										<p> <b>Notes</b>: <br> <br>
 '--' =  McIntosh class or evolution was not observed in the period over which the Poisson flare rate statistics were determined. <br>
 When viewed in real-time and before 22:00 UT, NOAA predictions are valid up to 22:00 UT on the current date. When viewed in real-time after 22:00 UT (or when viewing past dates), NOAA predictions are valid up to 22:00 UT on the following date. The most recent data can also be found at NOAA's <a class=mail2 href=http://www.swpc.noaa.gov/ftpdir/latest/daypre.txt> 3-day Space Weather Predictions</a> page.</br></p>\n") ;
    
	print("											<p>Please contact <a class=mail2 href=\"mailto:peter.gallagher@tcd.ie\">Peter Gallagher</a> if you have any comments or questions regarding this research.<br>\n") ;

	print("									</font></td></tr></table>\n") ;
	print("								</td>\n") ;
}

?>
