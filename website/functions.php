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
							list($meta1, $rest) = split('[_.]', $file, 2);
							if ($meta1 != "forecast")
								list($meta2, $rest) = split('[_.]', $rest, 2);
						}
						else
							$rest = $file;
							
						//	so test to see if it is a map_coord
						//if(($folder == "meta") && ($meta1 != "map"))
						//	continue;
							
						//	get the instrument, filter, and ar or fd type
						list($file_instrument, $file_filter, $fd_ar_type, $rest) = split('[_.]', $rest, 4);
						
						//	if it is a fd and we want an fd, parse the rest of the filename
						if (($fd_ar_type == "fd") && ($fd_ar == "fd"))
						{
							list($file_date, $file_time, $rest) = split('[_.]', $rest, 3);	
						}
						elseif (($fd_ar_type == "pr") && ($fd_ar == "pr"))
						{
							list($file_date, $file_time, $rest) = split('[_.]', $rest, 3);
						}
						//	if it is an ar and we want an ar parse the rest of the filename
						elseif (($fd_ar_type == "ar") && ($fd_ar == "ar"))
						{
							list($file_region, $file_date, $file_time, $rest) = split('[_.]', $rest, 4);
							//	go to next file if we dont get the region number we want
							if ($file_region != $region_number)
								continue;
						}
						elseif (($fd_ar_type == "ap") && ($fd_ar == "ap"))
						{
							list($file_region, $file_date, $file_time, $rest) = split('[_.]', $rest, 4);
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


						if (($instrument != $file_instrument) || ($filter != $file_filter) || ($rest != $extension)) //&& (($rest != "png") || ($rest != "fts.gz")))
							continue;
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
							list($meta1, $rest) = split('[_.]', $file, 2);
							if ($meta1 != "forecast")
								list($meta2, $rest) = split('[_.]', $rest, 2);
						}
						else
							$rest = $file;
							
						//	so test to see if it is a map_coord
						//if(($folder == "meta") && ($meta1 != "map"))
						//	continue;
							
						//	get the instrument, filter, and ar or fd type
						list($file_instrument, $file_filter, $fd_ar_type, $rest) = split('[_.]', $rest, 4);
						
						//	if it is a fd and we want an fd, parse the rest of the filename
						if (($fd_ar_type == "fd") && ($fd_ar == "fd"))
						{
							list($file_date, $file_time, $rest) = split('[_.]', $rest, 3);	
						}
						//	if it is an ar and we want an ar parse the rest of the filename
						elseif (($fd_ar_type == "ar") && ($fd_ar == "ar"))
						{
							list($file_region, $file_date, $file_time, $rest) = split('[_.]', $rest, 4);
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
								//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
								list($number, $rest ) = split('[ ]', $line, 2);
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
					//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
					list($number, $rest ) = split('[ ]', $line, 2);
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
					//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
					list($number, $rest ) = split('[ ]', $line, 2);
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
?>
