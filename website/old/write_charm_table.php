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
	
	function write_charm_table($date)
	{
		include ("globals.php");
		
		// TODO: Show when there's not file a info saying there is not detection run today.
		
		
		//	Find possible files
		$tablefiles=glob("${arm_data_path}data/charm/charm_".$date."_????_chgrp.csv")?glob("${arm_data_path}data/charm/charm_".$date."_????_chgrp.csv"):array();
		if (count($tablefiles) !== 0)
		{
			$tablefiles = array_reverse($tablefiles);
			$file = $tablefiles[0];
			
		//	Print the start of the table and the column headers. 
			print("<div class=charmt>\n");		
			print("<table class='frame' rules=rows width=100% align=center cellpadding=0 cellspacing=0>\n");
			print("	  <tr align=center class=chtit>\n");
			print("         <td colspan=6 border=0> CHARM Coronal Hole Groups </td>\n");
			print("   </tr>\n");
			print("   <tr align=center class=chcolumns>\n");
			print("         <td>Group ID</td>\n");
			print("         <td>Location</td>\n");
			print("         <td>E/W-most points [Deg]</td>\n");
			print("         <td>Area [10<sup>4</sup>Mm<sup>2</sup>]</td>\n");
			print("         <td>B<sub>z</sub> [G]</td>\n");
			print("         <td>&Phi; [10<sup>20</sup>Mx]</td>\n");
			print("   </tr>\n");
		

			//	Read the entire contents of the file in to the lines array
			$lines = file($file);
			foreach ($lines as $line)
			{
				//	Extract all info from the line.  Events that get hyperlinks are all stored in $events and need to be split later.
				list($chgroup, $location, $edges, $area, $magfield, $flux) = split('[;]', $line, 6);
				
				if ($chgroup[0] !== '#')
				{
					//	Print the columns with their identifiers
					print("<tr class=chresults align=center>\n");
					print("  <td   id=\"groupid\">  $chgroup  </td>\n");
					print("  <td   id=\"location\"> $location </td>\n");
					print("  <td   id=\"edges\">    $edges    </td>\n");
					print("  <td   id=\"area\">     $area     </td>\n");
					print("  <td   id=\"Bfield\">   $magfield </td>\n");
					print("  <td   id=\"flux\">     $flux     </td>\n");
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