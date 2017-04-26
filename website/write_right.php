<?
	/*
	Function:
		write_right
		write_right_accordion*	
	Purpose:
			Displays right navigation links.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewettvt.edu
	    David PS --
	History:
		2004/07/13 (RH) -- written
		2008/11/04 (P.Higgins) -- added soho movies, removed "bbso report" and "solarmonitor" heading
		2010  (DPS) -- added accordion function to the file.
	*/
	
	function write_right($date)
	{
	
	//Get link for HEK button
	$prev_day=date("Ymd",strtotime("-1 day", strtotime($date)));
	$heklink="https://www.lmsal.com/isolsearch?hek_query=https://www.lmsal.com/hek/her?cosec=2&&cmd=search&type=column&event_type=ar,ce,cd,ch,cj,cw,ef,fi,fe,fa,fl,lp,os,sg,sp,ss,pg,ot,nr&event_region=all&event_coordsys=helioprojective&x1=-5000&x2=5000&y1=-5000&y2=5000&result_limit=40&event_starttime=".substr($prev_day,0,4)."-".substr($prev_day,4,2)."-".substr($prev_day,6,2)."T00:00:00&event_endtime=".substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2)."T00:00:00";
	
		print("<table width=50 height=680 border=0>\n");
		print("	<tr>\n");
		print("		<td align=center valign=top>\n");
//		print("                       <br><font color=white><b>Solar<br>Monitor</b></font><br>\n");
		print("			<br><b><a class=mail4 href=\"./index.php\">Home</a></b><br>\n");
		print("			<a class=mail href=\"./search.php?date=$date\">Search</a><br>\n");
		print("         <a class=mail href=\"./news.php\">News</a><br>\n");
		print("         <a class=mail href=\"./credits.php\">Credits</a><br><br>\n");
		print("			<font color=white><b>GOES</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=xray\")>X-rays</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=proton\")>Protons</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=electron\")>Electrons</a><br><br>\n");
		print("			<font color=white><b>ACE</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=aceplasma\")>Plasma</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=acemag\")>B Field</a><br><br>\n");
		print("			<font color=white><b>SDO/EVE</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve3day\")>3 Day</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve6hr\")>6 Hour</a><br><br>\n");
//		print("			<font color=white><b>SOHO</b></font><br>\n");
//		print("			<a class=mail href=JavaScript:OpenSoho(\"./soho_pop.php?date=$date&type=eit195\")>Movies</a><br><br>\n");
/*		print("			<font color=white><b>RHESSI</b></font><br>\n");
		print("			<a href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=rhessi\")>Times</a><br><br>\n");
*/
		
		//	print("			<font color=white><b>Geomag</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenAurora(\"./aurora_pop.php?date=$date&type=geddsnowcast\")>Now-cast</a><br><br>\n");
		
		
		print("			<font color=white><b>Events</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenHek(\"$heklink\")>HEK</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenLastEvents(\"http://www.lmsal.com/solarsoft/last_events/\")>SolarSoft</a><br>\n");
		print("			<a class=mail href=JavaScript:OpenEvents()>SWPC</a><br><br>\n");
		print("			<font color=white><b>MM</b></font><br>\n");
		print("			<a class=mail href=JavaScript:OpenMotD(\"./motd_pop.php?date=$date\")>MotD</a><br><br>\n");
//		print("			<br><font color=white><b>BBSO</b></font><br>\n");
//		print("			<a href=JavaScript:TermWindow()>Activity<br>Report</a><br>\n");
		print("			<font color=white><b>IDL</b></font><br>\n");
		print("         <a class=mail target=_blank href=\"./objects/solmon/\">SOLMON Object</a><br><br>\n");
		print("		</td>\n");
		print("	</tr>\n");
		print("</table>\n");
		/*print("		</td>\n");
		print("	</tr>\n");
		print("	<tr>\n");
		print("		<td align=center valign=top>\n");*/		
		
		/*print("	<tr>\n");
		print("		<td align=center valign=top>\n");
		print("			<a href=\"./search.php?date=$date\">Search Archive</a><br><br><hr>\n");
		print("			<a href=JavaScript:TermWindow()>BBSO<br>Activity<br>Report<br><br></a>\n");
		print("		</td>\n");
		print("	</tr>\n");*/
		//print("			<font color=white><b>GOES</b></font><br>\n");
	}
			function write_right_clean()
	{
		print("<table width=70 border=0>\n");
		print("</table>\n");
	}
		
		function write_right_accordion($date)
	{
	
	//Get link for HEK button
	$prev_day=date("Ymd",strtotime("-1 day", strtotime($date)));
	$heklink="https://www.lmsal.com/isolsearch?hek_query=https://www.lmsal.com/hek/her?cosec=2&&cmd=search&type=column&event_type=ar,ce,cd,ch,cj,cw,ef,fi,fe,fa,fl,lp,os,sg,sp,ss,pg,ot,nr&event_region=all&event_coordsys=helioprojective&x1=-5000&x2=5000&y1=-5000&y2=5000&result_limit=40&event_starttime=".substr($prev_day,0,4)."-".substr($prev_day,4,2)."-".substr($prev_day,6,2)."T00:00:00&event_endtime=".substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2)."T00:00:00";
	
		print("<table width=70 border=0>\n");
		print("   <tr>\n");
		print("		<td align=center valign=top height=\"460px\">\n");
		print("        <br><div id=\"sliderr\">\n");
		//TODO: On mouse over! : http://www.java2s.com/Code/JavaScript/jQuery/jQueryUIAccordionOpenonmouseover.htm
		print("          <div class=\"header\" id=\"GOES-header\" onmouseover>GOES</div>\n");
		print("          <div class=\"content\" id=\"GOES-content\">		\n");
		print("          <div class=\"text\">\n");
		print("      		<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=xray\")>X-rays</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=proton\")>Protons</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenGoes(\"./goes_pop.php?date=$date&type=electron\")>Electrons</a>\n");
		print("     	</div>\n");
		print("  		</div>\n");
		print("  		<div class=\"header\" id=\"ACE-header\">ACE</div>\n");
		print("  		<div class=\"content\" id=\"ACE-content\">\n");
    	print("	 		<div class=\"text\">\n");
		print("				<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=aceplasma\")>Plasma</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenAce(\"./ace_pop.php?date=$date&type=acemag\")>B Field</a>\n");
    	print("			</div>\n");
		print(" 		</div>\n");
		print("  		<div class=\"header\" id=\"EVE-header\">SDO/EVE</div>\n");
		print(" 		<div class=\"content\" id=\"EVE-content\">\n");
		print(" 	   	<div class=\"text\">\n");
		print("    			<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve3day\")>3 Day</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenEve(\"./eve_pop.php?date=$date&type=eve6hr\")>6 Hour</a>\n");
		print("   		</div>\n");
		print("  		</div>\n");
		//	print(" 		<div class=\"header\"><a class=mail5 href=JavaScript:OpenAurora(\"./aurora_pop.php?date=$date&type=geddsnowcast\")>GeoMag</a></div>\n");
		//print("		    <div class=\"content\" id=\"GEOMAG-content\">\n");
		//print(" 	   	<div class=\"text\">\n");
		//print("    			<a class=mail href=JavaScript:OpenAurora(\"./aurora_pop.php?date=$date&type=geddsnowcast\")>Now-cast</a>\n");
		//print("			</div>\n");
		//print("			</div>\n");
		print("  		<div class=\"header\" id=\"Events-header\">Events</div>\n");
  		print("			<div class=\"content\" id=\"Events-content\">\n");
		print("			<div class=\"text\">\n");
		print("				<a class=mail href=JavaScript:OpenLastEvents(\"http://www.lmsal.com/solarsoft/last_events/\")>SolarSoft</a><br>\n");
		print("				<a class=mail href=JavaScript:OpenEvents()>SWPC</a>\n");
		print("				<a class=mail href=JavaScript:OpenHek(\"$heklink\")>HEK</a><br>\n");
		print("			</div>\n");
  		print("			</div>\n");
		//	print("          <div class=\"header\" id=\"Forecast-header\">Forecast</div>\n");
		//	print("		 <div class=\"content\" id=\"Forecast-content\">\n");
		//	print("			   <div class=\"text\">\n");
		//	print("				<a class=mail href=\"./forecast.php?date=$date\">Flare Forecast</a><br>\n");
		//	print("	           		<a class=mail href=JavaScript:OpenMotD(\"./motd_pop.php?date=$date\")>MM MotD</a>\n");
		//	print("			   </div>\n");
		//	print("  	</div>\n");

		print("		  </div>\n");
		print("		</td>\n");
		print("	</tr>\n");
//		print(" <tr height=auto>\n");
//		print(" <td  align=center valign=bottom>\n");
//		print("        <a class=mail5 target=_blank href=\"./objects/solmon/\">IDL Access</a>\n");
//		print("			<br><font color=white><b>BBSO</b></font><br>\n");
//		print("			<a href=JavaScript:TermWindow()>Activity<br>Report</a><br>\n");
//		print("		  <div class=\"right\">\n");
//		print("			<div class=\"header2\">IDL</div>\n");
//		print("         <a class=mail target=_blank href=\"./objects/solmon/\">SOLMON Object</a><br><br>\n");
//		print("		  </div>\n");
//		print("		</td>\n");
//		print("	</tr>\n");
		print("</table>\n");
	}
	
?>
