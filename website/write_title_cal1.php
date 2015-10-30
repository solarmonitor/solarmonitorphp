<?
	/*
	Function:
		write_title
	
	Purpose:
			Displays the title bar and the previous and next navigation links.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
			title -- the string to display in the title
			this_page -- the php file currently being displayed
			type -- optional paramter, this allows the nav links to point to the same type of page (eit_fd, region_###, etc)
			width -- allows the width to be changed, optional.  this is used in the pop up window php files
		Output
			none
	
	Author(s):
		Russ Hewett -- rhewettvt.edu
	
	History:
		2004/07/12 (RH) -- written
		2004/07/15 (RH) -- added width and type
	*/
	
	function write_title_cal1($date, $title, $this_page, $indexnum, $type=NULL, $width=780, $region=NULL)
	{
	  	include("globals.php");
		$current_date = gmdate("Ymd");
		//	send the INDEXNUM so it goes back to the correct 6 image panel

		if (isset($indexnum))
			$indexnum_str="&indexnum=$indexnum";
		else
			$indexnum_str="";

		//	if a type is needed, add that to the query string, otherwise, it should be empty
		if (isset($type))
			$type_str="&type=$type";
		else
			$type_str="";
			
		//	if a region is needed, add that to the query string, otherwise, it should be empty
		if (isset($region))
			$region_str="&region=$region";
		else
			$region_str="";
			
		$pop_up = strpos($this_page, "pop");
		
		//Make a table for the rounded corner bg which the other table will be in the center cell.
		print("<table width=100% height=100% cellpadding=0 cellspacing=0 border=0>\n");
		print("   <tr>\n");
		print("       <td width=22 class='leftup' valign=top align=left>\n");
		print("   </td>\n");
		print("   <td align=center>\n");
		// Print title first
		print("<a href=index.php border=0><img src='common_files/smtitlesmall.png' border=0></a>");
		if (($date == $current_date) && ($this_page == "index.php")){
			sm_message();
		}

		//	Calculate the yyyymmdd date of the previous/next day, week, and rotation
		$prev_day=date("Ymd",strtotime("-1 day", strtotime($date)));
		$prev_week=date("Ymd",strtotime("-7 day", strtotime($date)));
		$prev_rot=date("Ymd",strtotime("-27 day", strtotime($date)));
		
		$next_day=date("Ymd",strtotime("+1 day", strtotime($date)));
		$next_week=date("Ymd",strtotime("+7 day", strtotime($date)));
		$next_rot=date("Ymd",strtotime("+27 day", strtotime($date)));


		// The following switches between the old and new flare probability page.
		// 

		$next_page = $this_page;
		if (isset($_SERVER['HTTP_REFERER'])) { $previous = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH); }

		if ($this_page == 'forecast.php' && strtotime($date) <= strtotime("20150830")){
				$this_page = 'forecast_no_fps.php';
				$next_page = 'forecast.php';
			}	
		if ($this_page == 'forecast_no_fps.php' && strtotime($date) == strtotime("20150829")){
			$next_page = 'forecast.php';
		}	
		if ($this_page == 'forecast_no_fps.php' && strtotime($date) >= strtotime("20150829") && $previous=='/forecast_no_fps.php') {$this_page = 'forecast.php';}



		
		$human_readable_date = date("Ymd", strtotime($date));		
		//	Open the table up		
		print("<table width=$width border=0 cellpadding=0 cellspacing=0>\n");
		//		print("	<tr>                                             \n");
		//		print("		<td valign=middle colspan=3 align=center><font size=+1 color=white><b>\n");
		
		//	Write out and close the rest of the table
		//print("			$title\n");
		//		print("		</font></td>\n	");
		//		print("	</tr>                                             \n");
		print("	<tr>                                             \n");
		print(" <td align=\"left\">");
		print("		<form name=\"calendar\">\n");
		print("		<!-- calendar attaches to existing form element -->\n");

		$datecolor = (strtotime($date) > strtotime($current_date))?"red":"white";
	
		print("		<font size=3 color=\"$datecolor\"><b><input type=\"text\" size=\"11\" name=\"date\" value=\"Date Search $date\" class=\"cal_box\" onchange=\"this.calendar.submit();\" > \n");
	    print("		<script language=\"JavaScript\">\n");
	    print("		new tcal ({\n");
        print("				// form name\n");
		print("		'formname': 'calendar',\n");
        print("				// input name\n");
		print("		'controlname': 'date'\n");
		print("	  		});\n");
	    print("		</script>\n");
//      print("		\n");
		if ($this_page != "index.php") {
			if (isset($type)) print("		<input type=\"hidden\" name=\"type\" value=\"$type\">");
			if (isset($region)) print("		<input type=\"hidden\" name=\"region\" value=\"$region\">");
		}
	    print("		</b></font></form></td>\n");


		$date_str = date("j F Y",strtotime($date));
		$current_date_str = date("j F Y",strtotime($current_date));
//		$datecolor = (strtotime($date) > strtotime($current_date))?"red":"white";
		print(" <td align=\"center\"> 	<font size=3 color=\"$datecolor\"><b><a class=mail3 href =\"./index.php?date=$date\">$date_str</a></b></font>  </td>\n");
		print(" <td align=right>\n");
		print("		<form name=\"ARSearch\" id=\"ar_search\">");
		print("		<fieldset class=\"ar_search\">");
		print("			<input name=\"region\" type=\"text\" class=\"ar_box\" maxlength=10 value='NOAA Search'/>");
		print("			<button class=\"ar_btn\" title=\"Submit Search\">Search</button>");
				print("		</fieldset>");
		print("		</form>");


		print(" </td>\n");
		print("	</tr>                                             \n");

		print("	<tr>                                             \n");
		print("		<td valign=middle align=left><font size=2 color=#FFFFFF><b>\n");
		//print("		<td bgcolor=gray valign=middle align=left><font color=#FFFFFF>\n");
		print("			<font size=2>&lArr;</font><a class=mail3 href =\"./$this_page?date=${prev_day}${type_str}${region_str}${indexnum_str}\" title=\"-1 day\" accesskey=\",\"><i>$prev_day</i></a>\n");
		print("			<font size=2>&lArr;</font><a class=mail3 href =\"./$this_page?date=${prev_week}${type_str}${region_str}${indexnum_str}\" title=\"-7 days\"><i>Week</i></a>\n");
		print("			<font size=2>&lArr;</font><a class=mail3 href =\"./$this_page?date=${prev_rot}${type_str}${region_str}${indexnum_str}\" title=\"-27 days\"><i>Rotation</i></a>\n");
		print("		</b></font></td>\n");
		//print("		</td>\n");
		print("		<td valign=\"middle\" align=\"center\">\n");
		//print("		<td bgcolor=gray valign=middle align=center><font color=white>\n");
//		print("			<font size=3>$human_readable_date_line</font>\n");
//		print("		</b></font></td>\n");
	
		print("			<font size=2><a class=mail3 href =\"./$this_page?date=${current_date}${type_str}${region_str}${indexnum_str}\" title=\"$current_date_str\"><i><b>Today</b></i></a></font>\n");
		print("		</td>\n");
		
		print("		<td  valign=middle align=right><font size=2 color=#FFFFFF><b>\n");
		//print("		<td bgcolor=gray valign=middle align=right><font color=#FFFFFF>\n");
		print("			<a class=mail3 href =\"./$this_page?date=${next_rot}${type_str}${region_str}${indexnum_str}\" title=\"+27 days\"><i>Rotation</i></a><font size=2>&rArr;</font>\n");
		print("			<a class=mail3 href =\"./$this_page?date=${next_week}${type_str}${region_str}${indexnum_str}\" title=\"+7 days\"><i>Week</i></a><font size=2>&rArr;</font>\n");    
		print("			<a class=mail3 href =\"./$next_page?date=${next_day}${type_str}${region_str}${indexnum_str}\" title=\"+1 day\" accesskey=\".\"><i>$next_day</i></a><font size=2>&rArr;</font>\n");  
		print("		</b></font></td>\n");
		//print("		</td>\n");
		print("	</tr>\n");
		print("</table>\n");
		
		//Close the rounded corner table.
		print("</td><td  width=22 class='rightup' align=right valign=top></td></tr></table>\n");
	}
?>  
