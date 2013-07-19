<? 
	include ("include.php");
        include("globals.php"); 	
	$title = "SolarMonitor Acknowledgments";
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
					<font size=+2><i>W</i></font>elcome  to  
					<a class=mail2 href=index.php>SolarMonitor</a>, hosted by the <a class=mail2 href=http://www.physics.tcd.ie/astrophysics/>Solar Physics Group, Trinity College Dublin</a> and <a class=mail2 href=http://www.e-inis.ie>e-INIS, the Irish National e-Infrastructure</a>. These pages 
					contain near-realtime and archived information on active regions and solar activity.<!--, using data from
					the from the <a class=mail2 href="http://www.bbso.njit.edu/Research/Halpha/">Global H-alpha
					Network</a>, the ESA/NASA's <a class=mail2 href=http://sohowww.nascom.nasa.gov> Solar and Heliospheric Observatory (SOHO)</a>, <a class=mail2 href=http://www.gong.noao.edu>GONG+</a>, and the <a class=mail2 href=http://www.sec.noaa.gov/>National Oceanic and Atmospheric Administration (NOAA)</a>.-->
For information on our new SolarMonitor IDL Data Object (SOLMON), check out the <a class=mail2 href="objects/solmon/" target="_blank">SOLMON Tutorial</a>. Check out <a class=mail2 href=news.php>News</a> for other updates. 
<!-- <br><br>After a recent server switch-over <a class=mail2 href=index.php>SolarMonitor</a> does not currently host a complete back-dated archive. However, data and images older than 8-Oct-2008 are available from <a class=mail2 href=http://beauty.nascom.nasa.gov/arm/data>here</a> during this period of repopulation. -->		
<br>
<br><b>SolarMonitor.org Team</b><br>
This web system is maintained and developed by a team of researchers
in the School of Physics, Trinity College Dublin.<br>
<ul>
<li><a class=mail2
href="http://www.tcd.ie/Physics/Astrophysics/gallagher.php" target=_blank>Dr. Peter
T. Gallagher</a> (PI)
<li><a class=mail2
href="http://www.tcd.ie/Physics/Astrophysics/higgins.php" target=_blank>Paul A.
Higgins</a>
<li>Dr. David P&eacute;rez-Su&aacute;rez
<li><a class=mail2 href="http://grian.phy.tcd.ie/~bloomfield/" target=_blank>Dr. D.
Shaun Bloomfield</a>
<li><a class=mail2 href="http://hesperia.gsfc.nasa.gov/~jma/" target=_blank>Dr. R.T.
James McAteer</a>
</ul>

 <b>SolarMonitor Smart Phone Team</b>
<ul>
<li>Iain Billett (CS Summer Intern 2011)
<li>Simon Free (CS Summer Intern 2010)
<li><a class=mail2 href="http://www.scss.tcd.ie/David.OCallaghan/" target=_blank>Dr.
David O'Callaghan</a> (TCD Computer Science)
</ul>

<b>SolarMonitor Alumni</b>
<ul>
<li>Donna Rogers-Lee (Physics Summer Intern 2010)
<li><a class=mail2 href="http://www.russellhewett.com/" target=_blank>Russell J. Hewett</a> (2004-2007)
</ul>

<b>Financial Support</b><br>

SolarMonitor.org is funded by ESA/PRODEX and a grant from the EC
Framework 7 Programme (<a class=mail2
href=http://www.helio-vo.eu target=_blank>HELIO</a>). The smart phone application
has been funded by a <a class=mail2
href=http://www.tcd.ie/Graduate_Studies/InnovationBursaries/ target=_blank>TCD
Innovation Bursary</a>. <br>

<br><b>Publications</b><br>

Further information on SolarMonitor.org can be found in <a class=mail2
href=http://www.springerlink.com/content/h02309110582457j/
target=_blank>Gallagher, P. T., Moon, Y.-J., Wang, H., Solar Physics,
209, 171, (2002)</a>.<br>
SolarMonitor poster:<br> 
<a class=mail2 href='./publications/201110_sw_US/201110_sw_US.png'> Providing access to Solar and Space Weather data in Near-Realtime</a>
[<a href='./publications/201110_sw_US/201110_sw_US.pdf'>pdf</a>]<br>
<br>

<b>Acknowledgments</b><br>

It would be appreciated if publications based on data downloaded from
these pages would acknowledge SolarMonitor.org and the relevant
initial data source listed below. Suggested acknowledgement: "Data
supplied courtesy of SolarMonitor.org".<br>
<ul>
<li><a class=mail2 href=http://sdo.gsfc.nasa.gov
target=_blank>SDO</a> Data supplied courtesy of the SDO/HMI and
SDO/AIA consortia. SDO is the first mission to be launched for 
NASA's Living With a Star (LWS) Program.<p>

<li><a class=mail2 href=http://sohowww.nascom.nasa.gov
target=_blank>SOHO</a> Data supplied courtesy of the SOHO/MDI and
SOHO/EIT consortia. SOHO is a project of international cooperation
between ESA and NASA.<p>

<li><a class=mail2 href=http://www.gong.noao.edu
target=_blank>GONG</a> This work utilizes magnetogram, intensity, and
farside data obtained by the Global Oscillation Network Group (GONG)
project, managed by the National Solar Observatory, which is operated
by AURA, Inc. under a cooperative agreement with the National Science
Foundation.<p>

<li><a class=mail2 href=http://www.sec.noaa.gov/sxi/
target=_blank>SXI</a> Full-disk X-ray images are supplied courtesy of
the Solar X-ray Imager (SXI) team.<p>

<li><a class=mail2 href=http://xrt.cfa.harvard.edu/index.php
target=_blank>XRT</a> Full-disk X-ray images are supplied courtesy of
the Hinode X-Ray Telescope (XRT) team.<p>

<li><a class=mail2
href=http://swrl.njit.edu/ghn_web/latestimg/latestimg.php
target=_blank>GHN</a> Full-disk H-alpha images are supplied courtesy
of the Global High Resolution H-alpha Network (GHN) team.<p>

<li><a class=mail2 href=http://secchi.nrl.navy.mil/
target=_blank>STEREO</a> Full-disk EUVI images are supplied courtesy
of the STEREO Sun Earth Connection Coronal and Heliospheric
Investigation (SECCHI) team.<p>

<li><a class=mail2 href=http://solis.nso.edu/ target=_blank>SOLIS</a>
Full-disk chromaspheric magnetograms are supplied courtesy of the
Synoptic Optical Long-term Investigations of the Sun (SOLIS) team.<p>

<li><a class=mail2 href=http://www.swpc.noaa.gov
target=_blank>NOAA</a> Solar Region Summaries, Solar Event Lists, GOES
5-min X-rays, proton and electron data from the NOAA Space Weather
Prediction Center. <br>
</ul>

<b>SolarMonitor.org Acknowledges the Following</b><br>

The zoom function on pages with full-disk images was adapted from <a
class=mail2 href="http://valid.tjp.hu/tjpzoom/"
target=_blank>TJPzoom</a> by Janos Pal Toth.<br><br>
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
