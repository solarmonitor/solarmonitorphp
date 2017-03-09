<?
/*...............................................*/
// FUNCTION : write_reghist_entry($type , $data)
// AUTHOR : Aoife McCloskey 
// DATE : 08/003/2017
// ARGS : $type = String telling function what style its supposed to use
//		  $data = array containing the data to be shown on the table 
// PURPOSE : Writes sub-tables within the flare history table
/*...............................................*/

	function write_reghist_entry($type , $data)
	{
		include ("globals.php") ;
		for ($i = 0 ; $i < count($data) ; ++$i)
		{
			print("							<tr>\n");
			if ($type == "pr") 
			{
					$flare_today = $data[$i][0] ;
					$flare_yest = $data[$i][1] ;
					print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
					print("									$flare_today\n");
					print("								</td>\n");
					print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
					print("									$flare_yest\n");
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
				$mcint_today = $data[$i][1] ;
				$mcint_yest = $data[$i][0] ;
				print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									$mcint_today\n");
				print("								</td>\n");
				print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									$mcint_yest\n");
				print("								</td>\n");
			}
		print("							</tr>\n") ;
		}

	}
?>
