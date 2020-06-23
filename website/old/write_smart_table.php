<?
	/*
	Function:
		write_charm_table
	
	Purpose:
			Displays the 'Today's CHARM detections' table for SolarMonitor.

	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		David Perez-Suarez (modified version of write_ar_table from Russ Hewett)

	History:
		2010/11/16 (DPS) -- written
	*/
	
	function write_smart_table($date)
	{
		include ("globals.php");
		$smart_path = (strtotime($date) > strtotime($date_smart_hmi))?"smart_hmi_output/":"${arm_data_path}data/smart/";
		$smart_hour = (strtotime($date) > strtotime($date_smart_hmi))?"??????":"????";

		// TODO: Show when there's not file a info saying there is not detection run today.
		
		
		//	Find possible files
		$tablefiles=glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt")?glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt"):array();
		if (count($tablefiles) !== 0)
		{
			$tablefiles = array_reverse($tablefiles);
			$file = $tablefiles[0];
			
		//	Print the start of the table and the column headers. 
			print("<div class=charmt>\n");		
			print("<table class='frame' rules=rows width=100% align=center cellpadding=0 cellspacing=0>\n");
			print("	  <tr align=center class=chtit>\n");
			print("         <td colspan=8 border=0> SMART Magnetic Features </td>\n");
			print("   </tr>\n");
			print("   <tr align=center class=chcolumns>\n");
			print("         <td>ID</td>\n");
			print("         <td>Type</td>\n");
			print("         <td>Lat<sub>HG</sub>,Lon<sub>HG</sub> [Deg]</td>\n");
			print("         <td>&Phi; [Mx]</td>\n");
			print("         <td>L<sub>PIL</sub> [Mm]</td>\n");
			print("         <td>R* [Mx]</td>\n");
			print("         <td>WL<sub>SG</sub> [G/Mm]</td>\n");
			print("   </tr>\n");
		

			//	Read the entire contents of the file in to the lines array
			$lines = file($file);
			foreach ($lines as $line)
			{
				//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
			  list($ar_id, $ar_type, $ar_lat, $ar_lon, $ar_phi, $ar_lpil,$ar_r,$ar_wl) = split('[;]', $line, 8);
				
				if ($ar_id[0] !== '#')
				{
					//	Print the columns with their identifiers
					print("<tr class=chresults align=center>\n");
					print("  <td   id=\"ar_id\">    $ar_id     </td>\n");
					print("  <td   id=\"type\">     $ar_type   </td>\n");
					print("  <td   id=\"latlon\"> 	".$ar_lat.",".$ar_lon."    </td>\n");
					print("  <td   id=\"flux\">     $ar_phi    </td>\n");
					print("  <td   id=\"Lpil\">     $ar_lpil   </td>\n");
					print("  <td   id=\"Rvalue\">   $ar_r      </td>\n");
					print("  <td   id=\"WL_sg\">    $ar_wl     </td>\n");
					print("</tr>\n");
				}
				
			}
			
			
			//	Close off the table
			print("</table>\n");
			print("</div>\n");			
		}
		else
		{
			//TODO: Fix this output
			//	If there is no data file, display a warning message
			//print("	<tr class=chresults align=center>\n");
			//print("		<td colspan=6 align=\"center\" bgcolor=\"#f0f0f0\"><font color=\"#000000\">\n");
			//print("			<i>No Data Available For This Day</i>\n");
			//print("		</td>\n");
			//print("	</tr>\n");
			print("No Data Available For This Day\n");
		}	
		
	}
?>