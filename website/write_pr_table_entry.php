<?
/*...............................................*/
// FUNCTION : write_pr_table_entry($type , $data)
// AUTHOR : Michael Tierney 
// DATE : 31/07/2014
// ARGS : $type = String telling function what style its supposed to use
//		  $data = array containing the data to be shown on the table 
// PURPOSE : Writes sub-tables within the flare probability table
/*...............................................*/

	function write_pr_table_entry($type , $data)
	{
		include ("globals.php") ;
		for ($i = 0 ; $i < count($data) ; ++$i)
		{
			print("							<tr>\n");
			if ($type == "pr") 
			{
					$SM_prob = $data[$i][0] ;
					$NOAA_prob = $data[$i][1] ;
					print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
					print("									$SM_prob\n");
					print("								</td>\n");
					print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
					print("									$NOAA_prob\n");
					print("								</td>\n");
			}
			else if ($type == "reg")
			{
				print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									<a class=mail2 href=\"region.php?date=$date&region=$data[$i]\">$data[$i]</a>\n");
				print("								</td>\n");
			}
			else
			{
				print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									$data[$i]\n");
				print("								</td>\n");
			}
		print("							</tr>\n") ;
		}

	}
?>
