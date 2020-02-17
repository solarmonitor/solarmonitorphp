<?
	/*
	Function:
		write_header
	
	Purpose:
			Displays header information.
	
	Parameters:		
		Input:
			date -- the date for display
			title -- the title info to be displayed
			this_page -- for write_jscript
		Output:
			none 
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/13 (RH) -- written
	*/
	
	function write_header($date, $title, $this_page)
	{
		print("<head>\n");
		print(" <link rel=\"icon\" href=\"./common_files/favicon.ico\" type=\"image/x-icon\">\n");
		print("	<link rel=\"shortcut icon\" href=\"./common_files/favicon.ico\" type=\"image/x-icon\">\n");
		print("	<meta http-equiv=\"Pragma\" content=\"no-cache\">\n");
		print("	<meta http-equiv=\"refresh\" content=\"1800\">\n");
		print("	<title>$title</title>\n");
		print("	<link rel=stylesheet href=\"./common_files/arm-style.css\" type=\"text/css\">\n");
		print("	<meta name=\"orgcode\" content=\"682\">\n");
		print("	<meta name=\"rno\" content=\"Joseph.B.Gurman.1\">\n");
		print("	<meta name=\"content-owner\" content=\"Peter.T.Gallagher.1\">\n");
		print("	<meta name=\"webmaster\" content=\"Amy.E.Skowronek.1\">\n");
		print(" <script type=\"text/javascript\" src=\"./common_files/slider.js\"></script>");
		print(" <script type=\"text/javascript\" src=\"./common_files/warning.js\"></script>");
		print(" <script type=\"text/javascript\" src=\"./function_table.js\"></script>");
		print("	<script language=JavaScript1.2>\n");
			write_jscript($date, $this_page);
		print("	</script>\n");
	    print("<script language=\"JavaScript\" src=\"./common_files/global.js\"></script>\n");
		
		//TODO: Clean calendar files and tests (DPS, 27/Aug/'10)
		print("	<!-- link calendar files  -->\n");
	    print("<script language=\"JavaScript\" src=\"./common_files/tigra_calendar/calendar_eu.js\"></script>\n");
	    print("<link rel=\"stylesheet\" href=\"./common_files/tigra_calendar/calendar.css\">\n");

	    
		//TODO: Clean transition table files (DPS, 31/Aug/'10)
		//From: http://www.gayadesign.com/diy/animated-tabbed-content-with-jquery/
		print("<script type=\"text/javascript\" src=\"./common_files/tabbedContent/js/jquery-1.4.4.min.js\"></script>\n");
	    print("<script type=\"text/javascript\" src=\"./common_files/tabbedContent/js/tabbedContent.js\"></script>\n");
		print("<link href=\"./common_files/tabbedContent/css/tabbedContent.css\" rel=\"stylesheet\" type=\"text/css\" />\n");

		//Inclusion of lightbox2
//		print("<script type=\"text/javascript\" src=\"./common_files/js/prototype.js\"></script>\n");
//		print("<script type=\"text/javascript\" src=\"./common_files/js/scriptaculous.js?load=effects,builder\"></script>\n");
//		print("<script type=\"text/javascript\" src=\"./common_files/js/lightbox.js\"></script>\n");
//		print("<link rel=\"stylesheet\" href=\"./common_files/css/lightbox.css\" type=\"text/css\" media=\"screen\" />\n");

		//Inclusion of jq-lightbox
		//print("<script type=\"text/javascript\" src=\"./common_files/js/jqlightbox/jquery.js\"></script>\n");
//		print("<script type=\"text/javascript\" src=\"./common_files/js/jqlightbox/jquery.lightbox-0.5.js\"></script>\n");
//		print("<link rel=\"stylesheet\" type=\"text/css\" href=\"./common_files/css/jqlightbox/jquery.lightbox-0.5.css\" media=\"screen\" />\n");
		
//		print("<script type=\"text/javascript\">\n");
//		print("	$(function test() {\n");
//		print("	$('a[@rel*=lightbox]').lightBox();\n");
//		print("	});\n");
//		print("</script>\n");

		//Incluiding ticker js
		print("<link href=\"./ticker/jquery_news_ticker/styles/ticker-style.css\" rel=\"stylesheet\" type=\"text/css\" />\n");
		print("<script src=\"./ticker/jquery_news_ticker/includes/jquery.ticker.js\" type=\"text/javascript\"></script>\n");

		//Inclusion of colorbox (using same version of jquery.
		print("<link rel=\"stylesheet\" type=\"text/css\" href=\"./common_files/js/colorbox/colorbox/colorbox.css\" media=\"screen\" />\n");
		print("<script src=\"./common_files/js/colorbox/colorbox/jquery.colorbox.js\"></script>\n");
		print("<script>\n");
		print("	$(document).ready(function(){\n");
		print("      		$(\"a[rel='lightbox']\").colorbox({transition:\"fade\"});\n");
		print("	});\n");
		print("</script>\n");
		include("globals.php");
		
		//Inclusion of form 
 		print(" <script type=\"text/javascript\">\n");
 		print(" //<![CDATA[ \n");
  		print("  $(window).load(function(){\n");
		print("  $(function() {\n");
		print("    $('input.cal_box').each(function() {\n");
 		print("       $.data(this, 'default', this.value);\n");
		print("    }).css(\"color\",\"white\")\n");
		print("    .focus(function() {\n");
		print("        if (!$.data(this, 'edited')) {\n");
		print("            this.value = \"YYYYMMDD ");
		print($date);
		print("\";\n");
		print("            $(this).css(\"color\",\"white\");\n");
		print("        }\n");
//		print("    }).change(function() {\n");
//		print("        $.data(this, 'edited', this.value != "");\n");
//		print("    }).blur(function() {\n");
//		print("        if (!$.data(this, 'edited')) {\n");
//		print("            this.value = $.data(this, 'default');\n");
//		print("            $(this).css(\"color\",\"gray\");\n");
//		print("        }\n");
		print("    });\n");
		print("   });\n");
		print("  });\n");
		print("  //]]> \n");
		print("  </script>  \n");


		//Inclusion of NOAA search form
		//Inclusion of form 
 		print(" <script type=\"text/javascript\">\n");
 		print(" //<![CDATA[ \n");
  		print("  $(window).load(function(){\n");
		print("  $(function() {\n");
		print("    $('input.ar_box').each(function() {\n");
 		print("       $.data(this, 'default', this.value);\n");
		print("    }).css(\"color\",\"white\")\n");
		print("    .focus(function() {\n");
		print("        if (!$.data(this, 'edited')) {\n");
		print("            this.value = \"00000\";\n");
		print("            $(this).css(\"color\",\"white\");\n");
		print("        }\n");

//		print("    }).change(function() {\n");
//		print("        $.data(this, 'edited', this.value != "");\n");
//		print("    }).blur(function() {\n");
//		print("        if (!$.data(this, 'edited')) {\n");
//		print("            this.value = $.data(this, 'default');\n");
//		print("            $(this).css(\"color\",\"gray\");\n");
//		print("        }\n");
		print("    });\n");
		print("   });\n");
		print("  });\n");
		print("  //]]> \n");
		print("  </script>  \n");


	
		
		//Insert the cool Zoom Function. (Edit: P.A.Higgins 14-May-2009)
		if ($this_page == "full_disk.php")
		{
			print("	<script type='text/javascript' src='common_files/tjpzoom.js'></script>\n");
			print("	<script type='text/javascript' src='common_files/tjpzoom_config_default.js'></script>\n");
			print("	<script type='text/javascript'>\n");
			print("	function writeText(txt){document.getElementById('zoomtoggle').innerHTML=txt;}\n");
			print("	</script>\n");
			print("	<script type='text/javascript'>\n");
			print("		var TJPzoomoffset='smart';\n");
			print("		var zoomable=-1;\n");
			print("	</script>\n");
		}
		if (preg_match("/pop.php/",$this_page,$rubbish))
		{
			print("		<meta http-equiv=\"Pragma\" content=\"no-cache\">\n");
//			print("		<meta http-equiv=\"refresh\" content=\"300\">\n");
//			print("		<title>$title ( Updates dynamically every 5-mins) </title>\n");
			
		}
		
		if ($this_page == "aurora_pop.php")
		{
			print("		<link rel=\"stylesheet\" href=\"./common_files/js_gifplayer/aeplayer.css\" type=\"text/css\">\n");
			print("		<script type=\"text/javascript\" src=\"./common_files/js_gifplayer/menu.js\"></script>\n");
			print("		<script type=\"text/javascript\" src=\"./common_files/js_gifplayer/aeplayer.js\"></script>\n");
			print("		<script type=\"text/javascript\">\n");
			print("			window.onload = function() {\n");
			print("				aemenu.init(\"icmenu\", \"icact\");\n");
			print("				aemenu.init(\"stmenu\", \"stact\");\n");
			print("				aemenu.init(\"simenu\", \"siact\");\n");
			print("				aemenu.init(\"abmenu\", \"abact\");\n");
			print("				aep.makeAllPlayers();\n");
			print("		}\n");
			print("		</script>\n");
			
		}

      /* check the theme in a cookie */
      $theme = @$_COOKIE["theme"];
      if (!$theme) { //we didn't set the cookie yet
         // select first key of the themes array in config.inc.php as default
         $theme_keys = array_keys($themes);
         $theme = $theme_keys[0]; 
      }
      foreach ($themes as $skin => $url) {
	//var_dump($skin);
         echo "<link type=\"text/css\" rel=\"";
         if ($skin==$theme) {
            echo "stylesheet";
         } else {
            echo "prefertch alternate stylesheet";
         }
         echo "\" href=\"$url\" title=\"$skin\"";
         echo " media=\"screen\" />\n";
      }
		
		$current_date = gmdate("Ymd");
		if (strtotime($date) > strtotime($current_date))
		  {
		    print("<STYLE type=\"text/css\">\n");
		    print(".cal_box{ color: red}\n");
		    print("</STYLE>\n");
		  }
		print("</head>\n");
	}
?>
