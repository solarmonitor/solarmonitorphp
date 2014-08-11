<? 
function create_table_flares($today_t,$today_c,$today_s,$yesterday_t,$yesterday_c,$yesterday_s,$interval)
{
  for ($i=0;$i<count($today_t);$i++)
    {
      $today_t[$i] = $today_t[$i] + (24.*60.);
    }
  $all_time = array_merge($yesterday_t,$today_t);
  $all_class = array_merge($yesterday_c,$today_c);
  $all_size = array_merge($yesterday_s,$today_s);
  $positions = array();
  for ($i=0;$i<count($all_time);$i++)
    {
      $positions[] = floor($all_time[$i]/$interval);
    }
  $columns = (24 * 60.)/$interval;
  $class = array("X","M","C");
  print " <html>\n";
  print "  <head> \n";
  print "      <script src=\"raphael.js\" type=\"text/javascript\" charset=\"utf-8\"></script> \n";
  print "      <script src=\"common_files/tabbedContent/js/jquery-1.4.4.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script> \n";
  print "     <script src=\"dots.js\" type=\"text/javascript\" charset=\"utf-8\"></script> \n";
  print "     <link rel=\"stylesheet\" href=\"dots.css\" type=\"text/css\" media=\"screen\"> \n";
  print "      <link rel=\"stylesheet\" href=\"demo-print.css\" type=\"text/css\" media=\"print\"> \n";
  print "       <style type=\"text/css\" media=\"screen\"> \n";
  print "           body {\n";
  print "              margin: 0;\n";
  print "          }\n";
  print "          #chart {\n";
  print "               color: #333;\n";
 print "               left: 40%;\n";
  print "               margin: -115px 0 0 -250px;\n";
  print "               position: absolute;\n";
  print "               top: 50%;\n";
  //  print "               width: 300px;\n";
  print "               width: 650px;\n";
  print "           }\n";
  print "      </style> \n";
  print "   </head> \n";
  print "   <body> \n";


  print "<table id=\"for-chart\">\n";
  print "   <tfoot>\n";
  print "    <tr>\n";
  print "      <td>&nbsp;</td>\n";

  for ($j=0;$j<2;$j++)
    { 
      for($i=0;$i<$columns;$i++)
	{
	  if (($i*$interval % 180.) == 0)
	    {	  $str_time = date("H:i",$i*$interval*60);
	      	  print "<th>$str_time</th>\n";
	    }
	  else
	    {
	      	  print "<th></th>\n";
	      
	    }
	}
    }
  print "    </tr>\n";
  print "   </tfoot>\n";
  print "   <tbody>\n";
  for ($j=0;$j<3;$j++)
    {
      print "    <tr>\n";
      print "      <th scope=\"row\">$class[$j]</th>\n";
      for ($i=0;$i<$columns*2;$i++)
	{
	  if (in_array($i,$positions))
	    {
	      $k = array_search($i,$positions);
	      if ($class[$j] == $all_class[$k])
		{
		  print "        <td>$all_size[$k]</td>\n";
		}
	      else
		{
		  print "        <td></td>\n";
		}
	    }
	  else
	    {
	      print "        <td></td>\n";
	    }
	}
      print "    </tr>\n";
    }
  print "   </tbody>\n";
  print "</table>\n";
  print "<div id=\"chart\"></div> \n";

  print " </body> \n";
  print "</html> \n";



}

function create_plot_flares($today_t,$today_c,$today_s,$yesterday_t,$yesterday_c,$yesterday_s)
{
  $time_diff = array();
  $i = 1;
  sort($today_t);
  for ($j=0;$j<count($today_t)-1;$j++)
    {
      $time_diff[]=$today_t[$i]-$today_t[$j];
      $i++;
    }
  $i = 1;
  sort($yesterday_t);
  for ($j=0;$j<count($yesterday_t)-1;$j++)
    {
      $time_diff[]=$yesterday_t[$i]-$yesterday_t[$j];
      $i++;
    }
$interval =  (min($time_diff) > 180 || $time_diff == NULL)?180:min($time_diff);
$ranges = array(1,5,15,30,60,120,180);
if ($interval < 180)
  {
    for ($i=1;$i<count($ranges);$i++)
      {
	if (($interval >= $ranges[$i-1]) && ($interval <= $ranges[$i]))
	  {
	    $interval = $ranges[$i-1];
	    break;
	  }
      }
  }


  print("	  <tr>\n");
  print("             <td colspan=7>\n");
  create_table_flares($today_t,$today_c,$today_s,$yesterday_t,$yesterday_c,$yesterday_s,$interval);
  print("             </td>\n");
  print("         </tr>\n");
}
	/*
	Function:
		write_ar_table
	
	Purpose:
			Displays the 'Today's NOAA Active Regions' table for ARM.  If 
		./data/DATE/meta/ar_table.txt does not exist, that is noted on the page.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/12 (RH) -- written
		2004/07/15 (RH) -- added events linking
	*/
	
	function write_new_ar_table($date)
	{	
	include ("globals.php");
		
		//	Contruct the file name
		$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_" . $date . ".txt";

			print("<div class=noaat>\n");		
			print("<table class='frame' rules=rows width=700 align=center cellpadding=0 cellspacing=0 frame=hsides>\n");
			print("	  <tr align=center class=noaatit>\n");
			print("         <td colspan=7> Today's/<font color=grey>Yesterday's</font> NOAA Active Regions </td>\n");
			print("   </tr>\n");
			print("   <tr align=center class=noaacolumns>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='This is a unique number assigned to each new active region by NOAA.'\">NOAA Number</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The locations are given in heliographic (latitude and longitude) and heliocentric (arcseconds from Sun centre).'\">Latest <br> Position</a></div></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The Hale class describes the magnetic complexity of an active region'\">Hale <br> Class</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The McIntosh class describes the complexity of the sunspot group'\">McIntosh Class</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='The area in millionths of the solar disk area.'\">Sunspot Area<br> [millionths]</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='Number of the Spots that form the active region'\">Number of Spots</div></i></td>\n");
			print("         <td class=noaacol><i><div onmouseover=\"title='Number of Flares associated with the active region.'\">Recent <br> Flares</div></i></td>\n");
			print("   </tr>\n");
		
		//	Print the start of the table and the column headers.  These always display.
//TODO: this if should go before the header or make a change to say that there is not ARs			
		if (file_exists($file))
		{
			//	Read the entire contents of the file in to the lines array
			$lines = file($file);
			$linen = 0;
			foreach ($lines as $line)
			{
				//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
				list($number, $location1, $location2, $hale, $mcintosh, $area, $nspots, $events ) = split('[ ]', $line, 8);
				
				//	Split the Hale text in to individual characters.  For each part go through each character and 
				//	build a string with the image tags for each of the greek letters.
				list($hale1,$hale2) = split('[/]', $hale,2);
				$hale1_arr = preg_split('//', $hale1, -1, PREG_SPLIT_NO_EMPTY);
				$hale2_arr = preg_split('//', $hale2, -1, PREG_SPLIT_NO_EMPTY);
				
				$hale1_str = "";
				$hale2_str = "";
				
				foreach($hale1_arr as $elem)
				{
					switch($elem)
					{
						case 'a':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/alpha.jpg\">";
							$hale1_str = $hale1_str . "&alpha;";
							break;
						case 'b':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/beta.jpg\">";
							$hale1_str = $hale1_str . "&beta;";
							break;
						case 'g':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/gamma.jpg\">";
							$hale1_str = $hale1_str . "&gamma;";
							break;
						case 'd':
							//$hale1_str = $hale1_str . "<img src=\"./common_files/delta.jpg\">";
							$hale1_str = $hale1_str . "&delta;";
							break;
						case '-':
							$hale1_str = $hale1_str . "-";
							break;	
					}
				}
				
				foreach($hale2_arr as $elem)
				{
					switch($elem)
					{
						case 'a':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/alpha.jpg\">";
							$hale2_str = $hale2_str . "&alpha;";
							break;
						case 'b':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/beta.jpg\">";
							$hale2_str = $hale2_str . "&beta;";
							break;
						case 'g':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/gamma.jpg\">";
							$hale2_str = $hale2_str . "&gamma;";
							break;
						case 'd':
							//$hale2_str = $hale2_str . "<img src=\"./common_files/delta.jpg\">";
							$hale2_str = $hale2_str . "&delta;";
							break;
						case '-':
							$hale2_str = $hale2_str . "-";
							break;	
					}
				}
				
				//	this section works similar to the write_events function.
				//	first, start with a blank events string, then split all the parts of the events up into an array.
				//	loop through the array.
				$events_str = order_events($events) ;
				
				//	Finally print all of the columns.  $events still needs to be parsed and implemented. 
				// Explodes the strings so that today/yesterday can have different formats in html 

					$mac=explode("/" , $mcintosh) ;
					$ar=explode("/" , $area) ;
					$n_spot=explode("/" , $nspots) ;

					//	Print the columns with their identifiers
					print("<tr class=noaaresults align=center>\n");
					print("  <td   id=\"noaa_number\" bgcolor=#f0f0f0>    <a class=mail2 href=\"index.php?date=$date&region=$number\">$number</a></td>\n");
					print("  <td   id=\"position\"    bgcolor=#f0f0f0>    $location1<br>$location2 </td>\n");
					print("  <td   id=\"hale\"        bgcolor=#f0f0f0>    $hale1_str/<font color=grey>$hale2_str</font> </td>\n");
					print("  <td   id=\"mcintosh\"    bgcolor=#f0f0f0>    $mac[0]/<font color=grey>$mac[1]</font> </td>\n");
					print("  <td   id=\"area\"        bgcolor=#f0f0f0>    $ar[0]/<font color=grey>$ar[1]</font></td>\n");
					print("  <td   id=\"nspots\"      bgcolor=#f0f0f0>    $n_spot[0]/<font color=grey>$n_spot[1]</font></td>\n");
					if ($events_str != "-")
					  {
					    //print("  <td   onClick=\"servOC($linen,7,'./ar_table_flare.php?date=$date&region=$number','#99ccff')\" id=\"name".$linen."7\" onMouseOver=\"rowOver($linen,7)\" onMouseOut=\"rowOut($linen,7,'#99ccff')\" bgcolor=#f0f0f0>         $events_str                </td>\n");
					    print("  <td   id=\"events\" bgcolor=#f0f0f0>         $events_str                </td>\n");
					  }
					else
					  {
					    print("  <td   id=\"events\"      bgcolor=#f0f0f0>         $events_str                </td>\n");
					  }
					print("</tr>\n");
print("<tr style=\"display:none\" id=\"ihtr".$linen."7\"><td bgcolor=\"#ECECD9\" colspan=\"7\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td width=\"10\"></td><td style=\"border:3px solid #003366\"><iframe frameborder=\"0\" width=\"100%\" id=\"ihif".$linen."7\"></iframe></td></tr></table></td></tr> \n");


					$linen++;
			}
		}
		else
		{
			//	If there is no data file, display a warning message
			print("	<tr align=center>\n");
			print("		<td colspan=7 align=\"center\" bgcolor=\"#f0f0f0\"><font color=\"#000000\">\n");
			print("			<i>No Data Available For This Day</i>\n");
			print("		</td></font>\n");
			print("	</tr>\n");
		}	
		
		//	Close off the table
		print("</table>\n");
		print("	<div align=center style=\"width : 688px ;\">\n") ;
		print("		<p align=left>\n") ;
		print("			<font size=\"-4\" color=blue> C1 (HH:MM) -Today</font><br>\n") ;
		print("			<font color=\"#58ACFA\" size=\"-4\">C1 (HH:MM) -Yesterday</font>\n") ;
		print("		</p>\n") ;
		print("	</div>\n") ;
		print("</div>\n");			
	}
?>
