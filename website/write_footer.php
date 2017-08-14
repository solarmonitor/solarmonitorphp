<? 
	/*
	Function:
		write_footer
	
	Purpose:
			Displays footer information.
	
	Parameters:		
		Input:
			update_date -- the date of last update
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/13 (RH) -- written
	*/
	
	function write_footer($update_date)
	{
		print("<a href=\"http://www.tcd.ie/\"><img src=\"./common_files/tcd_crest.png\" align=right border=0 width=53></a>\n");
		print("<a href=\"http://www.esa.eu/\"><img src=\"./common_files/images/logos/esa_small.jpg\" align=right border=0 width=78></a>\n");
		print("<a href=\"http://www.nasa.gov/goddard/\"><img src=\"./common_files/nasalogo.png\" align=right border=0></a>\n");
		print("<a href=\"http://cordis.europa.eu/fp7/\"><img src=\"./common_files/FP7_Capacities_logo.jpg\" align=right border=0 width=85></a>\n");
		print("<a href=\"http://www.helio-vo.eu/\"><img src=\"./common_files/helio_logo_small.png\" align=right border=0 width=110></a>\n");
		print("<address><font size=\"-1\">\n");
//		print("	<b>Web Curators:</b> Paul Higgins (TCD), Peter Gallagher (TCD), <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shaun Bloomfield (TCD), James McAteer (TCD) <br>\n"); //- <a class=mail2 href=\"mailto:info@solarmonitor.org\">info@solarmonitor.org</a><br>\n");
		print(" <i><b>Developed by:</b></i> <a class=mail2 href=credits.php>TCD SolarMonitor.org team</a><br>\n");
		print("	<b>Contact:</b> <a class=mail2 href=\"mailto:info@solarmonitor.org\">info@solarmonitor.org</a><br><br>\n");
//		print("	<b>Responsible NASA official:</b> Joseph B. Gurman<br>\n");
//		print(" <a class=mail2 href=\"http://beauty.nascom.nasa.gov/nasa_warnings.html\">NASA security and privacy protection statement</a><br><br>\n");
		print("	These pages are automatically updated every 30 minutes.<br>\n");
		print("	Last updated: $update_date\n");
		print("</font></address>\n");
		
		print("<LINK REL=\"alternate\" TITLE=\"SolarMonitor.org RSS\" HREF=\"http://www.solarmonitor.org/rss.php\" TYPE=\"application/rss+xml\">");
		print("<LINK REL=\"alternate\" TITLE=\"SolarMonitor.org RSS Active Region Summary\" HREF=\"http://www.solarmonitor.org/rss2.php\" TYPE=\"application/rss+xml\">");
		write_statcounter();
		write_googleanalytics();
	}
		function write_footer_new($update_date)
	{
	  print("<div  id=\"footer\">\n");
		print("<table width=815 align=center cellpadding=0 cellspacing=0 border=\"0\">\n");
		print("	<tr>\n");
		print("  <td align=\"left\">\n");
		print("		<a class=info href=\"./about.php\">about</a><br>\n");
		print("     <a class=info href=\"./help.php\">help</a><br> \n");
		//		print("		<a class=info href=\"./contact.php\">contact</a><br>\n");
		print("	 </td>\n");
		print("  <td align=\"left\">\n");
		print("     <a class=info href=\"./news.php\">news</a><br> \n");
		//		print("     <a class=info href=\"./jobs.php\">jobs</a><br> \n");
		print("     <a class=info href=\"./rss.php\"><img src=\"./common_files/images/rssfeed.jpg\" width=12> rss feed</a>\n");
		print("	 </td>\n");
		print("  <td align=\"right\">\n");
		print("<a href=\"http://www.dias.ie//\"><img src=\"./common_files/images/logos/dias_logo.jpg\" align=right border=0 height=40></a>\n");
		print("<a href=\"http://www.tcd.ie/\"><img src=\"./common_files/images/logos/TCD-logo-wide_small.jpg\" align=right border=0 height=40></a>\n");
		//print("<a href=\"http://www.esa.eu/\"><img src=\"./common_files/images/logos/esa_small.jpg\" align=right border=0 height=70></a>\n");
		//print("<a href=\"http://www.nasa.gov/goddard/\"><img src=\"./common_files/nasalogo.png\" align=right border=0 height=70></a>\n");
		//print("<a href=\"http://cordis.europa.eu/fp7/\"><img src=\"./common_files/FP7_Capacities_logo.jpg\" align=right border=0 height=70></a>\n");
		//print("<a href=\"http://www.helio-vo.eu/\"><img src=\"./common_files/helio_logo_small.png\" align=right border=0 height=70></a>\n");
		print("	 </td>\n");
		print(" </tr>\n");
		print("</table>\n");
//		print("	Last updated: $update_date\n");
		print("<LINK REL=\"alternate\" TITLE=\"SolarMonitor.org RSS\" HREF=\"http://www.solarmonitor.org/rss.php\" TYPE=\"application/rss+xml\">");
		print("<LINK REL=\"alternate\" TITLE=\"SolarMonitor.org RSS Active Region Summary\" HREF=\"http://www.solarmonitor.org/rss2.php\" TYPE=\"application/rss+xml\">");
		write_statcounter();
		write_googleanalytics();
//		write_piwik();
		print("</div>\n");
	}
		function write_footer_js()
		{
			print("	<script type='text/javascript' src='./common_files/js/jquery.hoverIntent.minified.js'></script>\n");
			print("	<script type='text/javascript'>\n");
			print("	$(document).ready(function() {\n");
			print("		//On Hover Over\n");
			print("function megaHoverOver(){\n");
			print("    $(this).find(\".sub\").stop().fadeTo('fast', 1).show(); //Find sub and fade it in\n");
			print("    (function($) {\n");
			print("        //Function to calculate total width of all ul's\n");
			print("        jQuery.fn.calcSubWidth = function() {\n");
			print("            rowWidth = 0;\n");
			print("            //Calculate row\n");
			print("            $(this).find(\"ul\").each(function() { //for each ul...\n");
			print("                rowWidth += $(this).width(); //Add each ul's width together\n");
			print("            });\n");
			print("        };\n");
			print("    })(jQuery); \n");
			print("\n");
			print("    if ( $(this).find(\".row\").length > 0 ) { //If row exists...\n");
			print("\n");
			print("        var biggestRow = 0;	\n");
			print("\n");
			print("        $(this).find(\".row\").each(function() {	//for each row...\n");
			print("            $(this).calcSubWidth(); //Call function to calculate width of all ul's\n");
			print("            //Find biggest row\n");
			print("            if(rowWidth > biggestRow) {\n");
			print("                biggestRow = rowWidth;\n");
			print("            }\n");
			print("        });\n");
			print("\n");
			print("        $(this).find(\".sub\").css({'width' :biggestRow}); //Set width\n");
			print("        $(this).find(\".row:last\").css({'margin':'0'});  //Kill last row's margin\n");
			print("\n");
			print("    } else { //If row does not exist...\n");
			print("\n");
			print("        $(this).calcSubWidth();  //Call function to calculate width of all ul's\n");
			print("        $(this).find(\".sub\").css({'width' : rowWidth}); //Set Width\n");
			print("\n");
			print("    }\n");
			print("}\n");
			print("//On Hover Out\n");
			print("function megaHoverOut(){\n");
			print("  $(this).find(\".sub\").stop().fadeTo('fast', 0, function() { //Fade to 0 opactiy\n");
			print("      $(this).hide();  //after fading, hide it\n");
			print("  });\n");
			print("}\n");
			print("//Set custom configurations\n");
			print("var config = {\n");
			print("     sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)\n");
			print("     interval: 100, // number = milliseconds for onMouseOver polling interval\n");
			print("     over: megaHoverOver, // function = onMouseOver callback (REQUIRED)\n");
			print("     timeout: 500, // number = milliseconds delay before onMouseOut\n");
			print("    out: megaHoverOut // function = onMouseOut callback (REQUIRED)\n");
			print("};\n");
			print("$(\"ul#toolnav li .sub\").css({'opacity':'0'}); //Fade sub nav to 0 opacity on default\n");
			print("$(\"ul#toolnav li\").hoverIntent(config); //Trigger Hover intent with custom configurations\n");
			print("});\n");
			print("	</script>\n");
		}
?>
