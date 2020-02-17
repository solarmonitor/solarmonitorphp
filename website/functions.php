<?
	/*
	Function:
		link_image
	
	Purpose:
			Links to $file if $file exists, otherwise links to a placeholder image of the 
		correct size.
	
	Parameters:		
		Input:
			file -- the image being linked to
			size -- the size of said image.  this implies square, maybe later allow for rectangle
			map -- whether or not the image is part of an image map (boolean)
		Output:
			output -- an html tagged img link
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/13 (RH) -- written
		2004/07/14 (RH) -- added map parameter
	*/
	
	function link_image($file, $size, $map)
	{
		//	if the image is part of an image map, set a string with the mapname
		if ($map)
		{
			$map_str = "usemap=\"#fulldiskmap\"";
			$zoomjs = "onmouseover=\"if (zoomable==1){TJPzoom(this);}\"";
		}
		else
		{
			$map_str = ""; 
			$zoomjs = "";
		}
		//	if the desired file is found, return an html taged string linking to that image
		//	otherwise return one linking to the placeholder.
		if (file_exists($file)) {
//			$stamp = imagecreatetruecolor(200 , 200) ;
//			$orig_im = imagecreatefrompng($file) ;
//			imagecopyresampled($stamp , $orig_im , 0 , 0 , 0 , 0 , 200) ;

//			$src = imagecreatefrompng("Sure.png") ;
//			imagecopy($stamp , $src , 0 , 0 , 0 , 0 , 200 , 200) ;
//			imagepng($stamp) ;
			$output = "<img src=$file width=$size heigth=$size border=0 $map_str $zoomjs>";
		}
		else
			$output = "<img src=\"./common_files/placeholder_${size}\" width=$size heigth=$size border=0 $map_str $zoomjs>";
			
		return $output;
	}

	function multiexplode ($delimiters,$data) {
		$MakeReady = str_replace($delimiters, $delimiters[0], $data);
		$Return    = explode($delimiters[0], $MakeReady);
		return  $Return;
	}

	function find_latest_file($date, $instrument, $filter, $extension, $fd_ar, $region_number="00000")
	{
		include("globals.php");
		
		//	find what folder the desired file should be in
		if ($extension == "txt")
		  {
		    $folder = "meta";
		    $instr = "";
		  }
		elseif (preg_match("/fts/",$extension))
		  {
		    $folder = "fits";
		    $instr = $instrument . "/";
		  }
		elseif (preg_match("/png|jpg/",$extension))
		  {
		    $instr = $instrument . "/";
		    $folder = "pngs";
		  }
		
		//	initialize the latest variables
		$latest_file = "No File Found";
		$latest_time = strtotime("19800101 00:00:00");
		
		//	open the dir if it exists

		$dir = "${arm_data_path}data/$dirdate/$folder/$instr";
		if (is_dir($dir))
		{
			if ($dir_handle = opendir($dir))
			{
				//	loop through the files in the directory

				while(false !== ($file = readdir($dir_handle)))
				{
					if(($file != ".") && ($file != ".."))
					{
						//	if the folder is meta, the only files we should need start with map_coord
						if ($folder == "meta")
						{
							list($meta1, $rest) = multiexplode(array("_","."), $file, 2);
							if ($meta1 != "forecast")
								list($meta2, $rest) = multiexplode(array("_","."), $rest, 2);
						}
						else
							$rest = $file;
						
						//	so test to see if it is a map_coord
						//if(($folder == "meta") && ($meta1 != "map"))
						//	continue;
							
						//	get the instrument, filter, and ar or fd type
						list($file_instrument, $file_filter, $fd_ar_type, $rest) = explode('_', $rest, 4);

						//	if it is a fd and we want an fd, parse the rest of the filename
						if (($fd_ar_type == "fd") && ($fd_ar == "fd"))
						{
							list($file_date, $file_time, $rest) = multiexplode(array("_","."), $rest); 
						}
						elseif (($fd_ar_type == "ch") && ($fd_ar == "ch"))
						{
							list($file_date, $file_time, $rest) = multiexplode(array("_","."), $rest, 3);	
						}
						elseif (($fd_ar_type == "pr") && ($fd_ar == "pr"))
						{
							list($file_date, $file_time, $rest) = multiexplode(array("_","."), $rest, 3);
						}
						//	if it is an ar and we want an ar parse the rest of the filename
						elseif (($fd_ar_type == "ar") && ($fd_ar == "ar"))
						{
							list($file_region, $file_date, $file_time, $rest) = multiexplode(array("_","."), $rest, 4);
							//	go to next file if we dont get the region number we want
							if ($file_region != $region_number)
								continue;
						}
						elseif (($fd_ar_type == "ap") && ($fd_ar == "ap"))
						{
							list($file_region, $file_date, $file_time, $rest) = multiexplode(array("_","."), $rest, 4);
							//	go to next file if we dont get the region number we want
							if ($file_region != $region_number)
								continue;
						}
						//	if we dont get the type we want, move to next file
						else
						{
							continue;
						}

						//	if the instrument or filter dont match, move on.  this may need fixing after gsxi is correct
						// added that the rest need to equal to 'png' in order to continue! so no conflict with jpg thumbnails!
						//						print($dir." ".$extension."  ".$rest." <br>");


						if (($instrument != $file_instrument) || ($filter != $file_filter) || ($rest != $extension)) {//&& (($rest != "png") || ($rest != "fts.gz")))
							
							continue;
						}	
						//	if (($fd_ar == "ar") && ($rest != "png"))
						// continue;
						
						//	get the hour, min and sec
						$hh = substr($file_time,0,2);
						$mm = substr($file_time,2,2);
						$ss = substr($file_time,4,2);
						
						//	compare the times

						if($latest_time <= strtotime("$file_date $hh:$mm:$ss"))
						{
							$latest_time = strtotime("$file_date $hh:$mm:$ss");
							$latest_file = $file;
						}
				
					}
				}
			}
			closedir($dir_handle);
		}
		
		//	return the resulting file.. maybe this should return directory, i dont know yet
		echo $latest_file;
		return $latest_file;
	} 
	
	function find_all_filter_files($date, $instrument, $filter, $extension, $fd_ar, $region_number="00000")
	{
		// Copy from find_latest_file to find all the files of certain filter for that day.
		include("globals.php");
		
		//	find what folder the desired file should be in
		switch($extension)
		{
			case "txt":
				$folder = "meta";
				$instr = "";
				break;
			case "fts":
				$folder = "fits";
				$instr = $instrument . "/";
				break;
			case "png":
				$instr = $instrument . "/";
				$folder = "pngs";
				break;
		}
		
		//	initialize the latest variables
		$all_files = array();
		
		//	open the dir if it exists
		$dir = "${arm_data_path}data/$dirdate/$folder/$instr";
		if (is_dir($dir))
		{
			if ($dir_handle = opendir($dir))
			{
				//	loop through the files in the directory
				while(false !== ($file = readdir($dir_handle)))
				{
					if(($file != ".") && ($file != ".."))
					{
						//	if the folder is meta, the only files we should need start with map_coord
						if ($folder == "meta")
						{
							list($meta1, $rest) = explode('_', $file, 2);
							if ($meta1 != "forecast")
								list($meta2, $rest) = explode('_', $rest, 2);
						}
						else
							$rest = $file;
							
						//	so test to see if it is a map_coord
						//if(($folder == "meta") && ($meta1 != "map"))
						//	continue;
							
						//	get the instrument, filter, and ar or fd type
						list($file_instrument, $file_filter, $fd_ar_type, $rest) = explode('_', $rest, 4);
						
						//	if it is a fd and we want an fd, parse the rest of the filename
						if (($fd_ar_type == "fd") && ($fd_ar == "fd"))
						{
							list($file_date, $file_time, $rest) = multiexplode(array("_","."), $rest, 3);	
						}
						//	if it is an ar and we want an ar parse the rest of the filename
						elseif (($fd_ar_type == "ar") && ($fd_ar == "ar"))
						{
							list($file_region, $file_date, $file_time, $rest) = multiexplode(array("_","."), $rest, 4);
							//	go to next file if we dont get the region number we want
							if ($file_region != $region_number)
								continue;
						}
						//	if we dont get the type we want, move to next file
						else
						{
							continue;
						}
						
						//	if the instrument or filter dont match, move on.  this may need fixing after gsxi is correct
						if (($instrument != $file_instrument) || ($filter != $file_filter))
							continue;
						
						$all_files[]=$file;
						
						/*
						//	compare the times
						if($latest_time <= strtotime("$file_date $hh:$mm:$ss"))
						{
							$latest_time = strtotime("$file_date $hh:$mm:$ss");
							$latest_file = $file;
						} */
					}
				}
			}
			closedir($dir_handle);
		}
		
		//	return the resulting file.. maybe this should return directory, i dont know yet
		return $all_files;
	} 
	
	
	function find_region($region_num)
	{
		include("globals.php");
		$data_dir = "${arm_data_path}data/";
		$most_recent_date = "00000000";
		if (is_dir($data_dir))
		{
			if ($dir_handle = opendir($data_dir))
			{
				//	loop through the files in the directory
				while(false !== ($dir = readdir($dir_handle)))
				{
					$date = $dir;
					$dir = $data_dir . $dir ."/";
					if (is_dir($dir) && ($dir != ".") && ($dir != ".."))
					{
						$meta_file = $dir . "meta/arm_ar_summary_$date.txt";
						if (file_exists($meta_file))
						{
							$lines = file($meta_file);
							foreach ($lines as $line)
							{
								//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be explode later.
								list($number, $rest ) = explode(' ', $line, 2);
								if ($number == $region_num)
								{
									if (($date) > ($most_recent_date))
										$most_recent_date = $date;	
								}
							}
						}
					}
				}
			}
		}
		
		return $most_recent_date;
	}

	function fast_find_region($region_num)
	{
	  	include("globals.php");
		$data_dir = "${arm_data_path}data/";
		$found_date = "00000000";
		if (is_dir($data_dir))
		{
			//get the list of directories
			$dirs = scandir($data_dir);
			//remove . and ..
			unset($dirs[0],$dirs[1]);
			//reindex the array
			sort($dirs);
			
			$n_elements = count($dirs);	
			
			$l_bound = 0;
			$r_bound = $n_elements-1;
			$curr = round($n_elements/2);
			
			$index = fast_find_region_help($data_dir, $region_num, $dirs, $l_bound, $r_bound, $curr, 0);
			
			if ($index != -1)
				$found_date = $dirs[$index];

		}
		
		return $found_date;
	}
	
	function fast_find_region_help($data_dir, $region_num, $dirs, $l_bound, $r_bound, $curr, $passes)
	{
		//if($passes > (log(count($dirs),2)+3)) return -1;
		
		if($passes == 6)
		{
			$seq = $l_bound;
			while ($seq <= $r_bound)
			{
				if (is_region_on_day($data_dir, $region_num, $dirs[$seq]))
					return($seq);
				else
					$seq++;
			}
			return(-1);
		}
		
		if(is_region_on_day($data_dir, $region_num, $dirs[$curr]))
		{
			return($curr);
		}
		else
		{
			//print("$l_bound $curr $r_bound " . $dirs[$l_bound] . " " . $dirs[$curr] . " " . $dirs[$r_bound] . " " . $passes . "<br>" );
			
			$min=min_region($data_dir, $dirs[$curr]);
			$i=0;
			while($min == '1000000')
			{
				$i++;
				$min=min_region($data_dir, $dirs[$curr-$i]);
			}
			//print("MIN: $min <br>");
			if ($min < $region_num)
			{
				return(fast_find_region_help($data_dir, $region_num, $dirs, $curr, $r_bound, floor(($r_bound+$curr)/2), ++$passes));
			}
			else
			{
				return(fast_find_region_help($data_dir, $region_num, $dirs, $l_bound, $curr, floor(($curr+$l_bound)/2), ++$passes));
			}
		}
	}
	
	function is_region_on_day($data_dir, $region_num, $dir)
	{
		$date = $dir;
		$dir = $data_dir . $dir ."/";
		if (is_dir($dir) && ($dir != ".") && ($dir != ".."))
		{
			$meta_file = $dir . "meta/arm_ar_summary_$date.txt";
			if (file_exists($meta_file))
			{
				$lines = file($meta_file);
				foreach ($lines as $line)
				{
					//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be explode later.
					list($number, $rest ) = explode(' ', $line, 2);
					if ($number == $region_num)
					{
						return true;
					}
				}
			}
		}
		return false;
	}
	
	function min_region($data_dir, $dir)
	{
		$date = $dir;
		$dir = $data_dir . $dir ."/";
		$min = '1000000';
		
		if (is_dir($dir) && ($dir != ".") && ($dir != ".."))
		{
			$meta_file = $dir . "meta/arm_ar_summary_$date.txt";
			if (file_exists($meta_file))
			{
				$lines = file($meta_file);
				foreach ($lines as $line)
				{
					//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be explode later.
					list($number, $rest ) = explode(' ', $line, 2);
					if ($number < $min)
					{
						$min=$number;
					}
				}
			}
		}
		return $min;
	}
	
	function sm_message()
	{
		include("globals.php");
		$warning_file = "${arm_data_path}warning.txt";
//		print("$warning_file");
		if (file_exists($warning_file))
		{
			$lines = file($warning_file);
			if (count($lines) > 0){
				print("<br><div id=\"warning\">\n");
				print("         <div class=\"headerw\" id=\"warning-header\">Close <img src='common_files/close_icon.png' height=15 border=0></a></div>\n");
				print("         <div class=\"contentw\" id=\"warning-content\" style=\" display:block; \">		\n");
				print("            <div class=\"textw\">\n");
				foreach ($lines as $line)
				{
					print("               ".$line."\n");
				}
				print("     	   </div>\n");
				print("  		</div>\n");
				print("     </div>\n");
			
			}
		}	
		return(-1);
	}

        function arsql_search($region)
	{
	  class ARDB extends SQLite3{
	    function __construct(){
	      $this->open('data/ar_db.sqlite');
	    }
	  }

	  $var = new ARDB();
	  $result= $var->query('SELECT date FROM regions WHERE number="'.$region.'"');
	  $date =  $result->fetchArray();
	  $date = $date['date'];
	  //print $date;
	    //	  if($result)
	    //{
	      return $date;
//}
//	  else return "00000000";
	}


        function write_ticker($date)
	{
		// ticker from http://www.jquerynewsticker.com/
		print("<div id=\"ticker-wrapper\" class=\"no-js\">\n");
		print("    <ul id=\"js-news\" class=\"js-hidden\">\n");

		$items = array();
		$items[] = scrape_ticker_activity_level($date);
		$items[] = scrape_ticker_most_active_region($date);
		$items[] = scrape_ticker_most_likely_to_flare($date);
		$eit_bakeout = in_bakeout($date);
		$eit_keyhole = in_keyhole($date);
		if($eit_bakeout || $eit_keyhole) 
		  {
		    $item=array();
		    $prob = ($eit_bakeout)?"Bakeout":"Keyhole";
		    $item["text"] = "SOHO EIT is in ".$prob;
		    $item["link"] = "http://sohowww.nascom.nasa.gov/hotshots/2004_01_04/";
		    $items[] = $item;
		  }

		for($i=0;$i < count($items);$i++){
		  if($items[$i]["text"] != "none"){
		    print("  <li class=\"news-item\"><a href=".$items[$i]["link"].">");
		    print($items[$i]["text"]."</a></li>\n");
		  }
		}
		print("</ul>\n");
		print("</div>\n");

		print("<script type=\"text/javascript\">\n");
		print("    $(function () {\n");
		print("        $('#js-news').ticker({\n");
		print(" displayType:'fade'\n");
		print("    });\n");
		print("    });\n");
		print("</script>\n");


	}

	/*
	Function:
		order_events
	
	Purpose:
		orders events such that yesterdays events are after todays events on list	
	Parameters:		
		Input:
			events - an array of event times and classes
		Output:
			output -- modified event array 
	
	Author(s):
		Michael Tierney -- tiernemi@tcd.ie
	
	History:
		05/08/2014 -- Wrote function
	*/
	function order_events($events)
	{
		$ev_str = '' ;
		$y = 0 ;
		$y_events=0 ;

		if($events[0] != '-')
		{
			$events_arr = explode(' ' , $events) ;
			$n_events = count($events_arr) ;
			
			if ($events_arr[0] != '/')
			{
				$t_events=1;
			}
			else
			{
				$t_events=0;
			}
			

			for ($i = 0 ; $i < count($events_arr) ; ++$i)
			{
				if ($events_arr[$i] == "/")	
				{
					$y = 1 ;
					$y_events=1;
				}
				else
				{
					$url[] = $events_arr[$i];
					$data[] = $events_arr[$i+1];
					list($size,$time) = explode('(', $events_arr[$i+1] , 2);
					
					if ($y == 1) 
					{ 
		
						$ev_time[] = (strtotime(substr($time,0,5)) - strtotime("00:00"))/60. - 1440 ;  //time in minutes from midnight.
						$time_inst = (strtotime(substr($time,0,5)) - strtotime("00:00"))/60. - 1440 ;  //time in minutes from midnight.
						$col = "#58ACFA";
						if ($i == ($n_events-2))
						switch ($t_events){
						case 0:
						{
						$data[count($data)-1] = "<font color=\"black\">- / </font>" . $data[count($data)-1] ;
						break;
						}
						case 1:
						{
						$data[count($data)-1] = "<font color=\"black\">/ </font>" . $data[count($data)-1] ;
						break;
						}
						}
					}
					else
					{
						$ev_time[] = (strtotime(substr($time,0,5)) -strtotime("00:00"))/60.;  //time in minutes from midnight.
						$time_inst =  (strtotime(substr($time,0,5)) -strtotime("00:00"))/60.;  //time in minutes from midnight.
						$col = "#0000FF" ;
					}						

					$url_inst = $events_arr[$i] ;
					$data_inst = $data[count($data)-1] ;
					$col_ar[] = $col ;
					// Orders from latest to earliest
					for ($j = count($data) - 1 ; $j > 0 ; --$j)
					{
							if ($ev_time[$j] > $ev_time[$j-1])
							{
								$ev_time[$j] = $ev_time[$j-1] ;
								$ev_time[$j-1] = $time_inst ;
								$url[$j] = $url[$j-1] ;
								$url[$j-1] = $url_inst ;
								$data[$j] = $data[$j-1] ;
								$data[$j-1] = $data_inst ;
								$col_ar[$j] = $col_ar[$j-1] ;
								$col_ar[$j-1] = $col ;			
							}
							else
							{
								continue ;
							}
					}
					++$i ;
				}
			}
			if ($y_events != 1)	
			{	
			$data[count($data)-1] = $data[count($data)-1]."<font color=\"black\"> / - </font>" ;
			}
			
			for ($i = 0 ; $i < count($data) ; ++$i) 
			{
				$ev_str = $ev_str . "<a class=mail2 style=\"color:$col_ar[$i];\"  href=javascript:OpenLastEvents(\"$url[$i]\")>$data[$i]</a><br>" ;
			}
		}		

		else
		{
			$ev_str = "-" ;
		}
		return $ev_str ;
	}
	
	function write_statcounter()
	{
		/*
	Function:
		write_statcounter
	
	Purpose:
			adds statcounter.com code to the site
	
	Parameters:		
		Input:
			none
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2006/05/22 (RH) -- written
	*/
	
		print("<!-- Start of StatCounter Code -->\n");
		print("<script type=\"text/javascript\" language=\"javascript\">\n");
		print("<!--\n"); 
		print("var sc_project=1583330;\n"); 
		print("var sc_invisible=1;\n"); 
		print("var sc_partition=14;\n"); 
		print("var sc_security=\"3bc361e8\";\n"); 
		print("//-->\n");
		print("</script>\n");

		print("<script type=\"text/javascript\" language=\"javascript\" src=\"http://www.statcounter.com/counter/counter.js\"></script><noscript><a href=\"http://www.statcounter.com/\" target=\"_blank\"><img  src=\"http://c15.statcounter.com/counter.php?sc_project=1583330&java=0&security=3bc361e8&invisible=1\" alt=\"free web tracker\" border=\"0\"></a> </noscript>\n");
		print("<!-- End of StatCounter Code -->\n");
	}

	function write_googleanalytics()
	{

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
	
		print("<!-- Start of Google Analytics Code -->\n");
		print("<script src=\"http://www.google-analytics.com/urchin.js\" type=\"text/javascript\">\n");
		print("</script>\n"); 
		print("<script type=\"text/javascript\">\n"); 
		print("_uacct = \"UA-341043-2\";\n"); 
		print("urchinTracker();\n"); 
		print("</script>\n");
		print("<!-- End of Google Analytics Code -->\n");
	}

	////////////////////////////////////////////////////////////

	function write_forecast_paragraph()
	{	


	print("								<td bgcolor=#FFFFFF align=left valign=top colspan=1>\n") ;
	print("									<table width=100% height=100% cellpadding=20 cellspacing=0 border=0><tr><td valign=top><p>\n") ;
	print("										Solar Monitor's flare prediction system's probabilities are calculated using <a class=mail2 href=\"http://www.swpc.noaa.gov/\">NOAA Space Weather Prediction Center</a> data. There are two main methods, <b>MCSTAT</b> and <b>MCEVOL</b>, that use sunspot-group McIntosh classifications and Poisson statistics to calculate flaring probabilities valid for a 24-hr period*. The flaring probabilities are calculated using historical data from the periods 1969-1976 & 1988-1996 (MCSTAT) and 1988-2008 (MCEVOL).\n</p>") ;	
	print("<p><b>MCSTAT</b> – Uses point-in-time McIntosh classifications to calculate Poisson flaring probabilities. Details about the method [1] and forecast verification testing [2] can be found in the following papers:\n </p>");
	print("<p>[1] <a class=mail2 href=http://www.springerlink.com/content/h02309110582457j/ target=_blank>Gallagher, P. T., Moon, Y.-J., Wang, H., <i>Solar Physics</i>, <b>209</b>, 171, (2002)</a><br>
	[2]  <a class=mail2 href = http://adsabs.harvard.edu/abs/2012ApJ...747L..41B> Bloomfield <i>et al.</i>, 2012, <i>The Astrophysical Journal Letters</i>, <b>747</b>, L41 </a> </p>") ;
	print("<p><b>MCEVOL</b> – Uses the evolution of McIntosh classifications over a 24-hr period to calculate Poisson flaring probabilities. Details about the method and flaring rate statistics can be found in the following:</p>
	[1] <a class=mail2 href=https://link.springer.com/article/10.1007/s11207-016-0933-y target=_blank>McCloskey, A.E., Gallagher, P.T. & Bloomfield, D.S., <i>Solar Physics</i>, <b>291</b>, 1711, (2016)</a>");
	print("<p> Further Reading: <br> Wheatland, M. S., 2001, <i>Solar Physics</i>, 	<b>203</b>, 87 <br> Moon <i>et al.</i>, 2001, <i>Journal of Geophysical Research-Space Physics</i>, <b>106(A12)</b> 29951</br></p>\n");
	print("<hr style=border-top: dotted 1px />");
	print(" 										<p> <b>Notes</b>: <br> <br>
	'...' =  McIntosh class or evolution was not observed in the period over which the Poisson flare rate statistics were determined. <br>
	* When viewed in real-time and before 22:00 UT, NOAA predictions are valid up to 22:00 UT on the current date. When viewed in real-time after 22:00 UT (or when viewing past dates), NOAA predictions are valid up to 22:00 UT on the following date. The most recent data can also be found at NOAA's <a class=mail2 href=http://www.swpc.noaa.gov/ftpdir/latest/daypre.txt> 3-day Space Weather Predictions</a> page.</br></p>\n") ;
	print("<hr style=border-top: dotted 1px />");
	print("											<p>Please contact <a class=mail2 href=\"mailto:peter.gallagher@tcd.ie\">Peter Gallagher</a> if you have any queries regarding this research.<br>\n") ;

	print("									</font></td></tr></table>\n") ;
	print("								</td>\n") ;
	}
?>
