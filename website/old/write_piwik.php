<?
	/*
	Function:
		write_googleanalytics
	
	Purpose:
			adds google analytics code to the site
	
	Parameters:		
		Input:
			none
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett2@uiuc.edu
	
	History:
		2006/05/62 (RH) -- written
	*/
	
	function write_piwik()
	{
		print("<!-- Piwik -->\n");
		print("<script type=\"text/javascript\">\n");
		print("var pkBaseURL = ((\"https:\" == document.location.protocol) ? \"https://grian.phy.tcd.ie/stats/\" : \"http://grian.phy.tcd.ie/stats/\");\n");
		print("document.write(unescape(\"%3Cscript src='\" + pkBaseURL + \"piwik.js' type='text/javascript'%3E%3C/script%3E\"));\n");
		print("</script><script type=\"text/javascript\">\n");
		print("try {\n");
		print("var piwikTracker = Piwik.getTracker(pkBaseURL + \"piwik.php\", 1);\n");
		print("piwikTracker.trackPageView();\n");
		print("piwikTracker.enableLinkTracking();\n");
		print("} catch( err ) {}\n");
		print("</script><noscript><p><img src=\"http://grian.phy.tcd.ie/stats/piwik.php?idsite=1\" style=\"border:0\" alt=\"\" /></p></noscript>\n");
		print("<!-- End Piwik Tracking Code -->\n");
	}
?>
