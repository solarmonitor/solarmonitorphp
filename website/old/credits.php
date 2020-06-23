<?
	include ("include.php");
		
	$title = "SolarMonitor Acknowledgments";
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
<li>Dr. David Suarez-Perez
<li><a class=mail2 href="http://grian.phy.tcd.ie/~bloomfield/" target=_blank>Dr. D.
Shaun Bloomfield</a>
<li><a class=mail2 href="http://hesperia.gsfc.nasa.gov/~jma/" target=_blank>Dr. R.T.
James McAteer</a>
</ul>

 <b>SolarMonitor Smart Phone Team</b>
<ul>
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
209, 171, (2002)</a>.<br><br>

<b>Acknowledgments</b><br>

It would be appreciated if publications based on data downloaded from
these pages would acknowledge SolarMonitor.org and the relevant
initial data source listed below. Suggested acknowledgement: "Data
supplied courtesy of SolarMonitor.org".<br>
<ul>
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
