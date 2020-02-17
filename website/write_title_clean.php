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
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewettvt.edu
	
	History:
		2004/07/12 (RH) -- written
		2004/07/15 (RH) -- added width and type
	*/
	
	function write_title_clean($date, $title, $this_page, $indexnum, $type=NULL, $width=780, $region=NULL)
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
		print("       </td>\n");
		print("       <td align=center>\n");
		// Print title first
		print("         <a href=index.php border=0><img src='common_files/smtitlesmall.png' border=0></a>");
		print("       </td>\n");
		//Close the rounded corner table.
		print("       <td width=22 class='rightup' align=right valign=top>");
		print("       </td>\n");
		print("   </tr>\n");
		print("</table>\n");
	}
?>  