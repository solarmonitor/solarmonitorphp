<?
/*...............................................*/
// FUNCTION : write_pr_table_entry($type , $data)
// AUTHOR : Michael Tierney 
// DATE : 31/07/2014
// ARGS : $type = String telling function what style its supposed to use
//		  $data = array containing the data to be shown on the table 
// PURPOSE : Writes sub-tables within the flare probability table
// HISTORY: Modified to include Mcintosh Evolution Forecast and today/yesterday's Mcintosh class - Aoife McCloskey (May 2017)
/*...............................................*/

	function write_pr_table_entry($type , $data)
	{
		include ("globals.php") ;
		for ($i = 0 ; $i < count($data) ; ++$i)
		{
			print("							<tr>\n");
			if ($type == "pr") 
			{
			// Flare probabilities for dates before MCEVOl was added are replaced by N/A
				if (count($data[$i]) < 3)
				{
					$EVOL_prob = "N/A";
					$SM_prob = $data[$i][0];
					$NOAA_prob = $data[$i][1];

				}
				else
				{
					$EVOL_prob = $data[$i][0] ;
					$SM_prob = $data[$i][1] ;
					$NOAA_prob = $data[$i][2] ;
				}
				print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									$EVOL_prob\n");
				print("								</td>\n");
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
			else if ($type == "mc" )
			{
			$mcint_today = $data[$i][0];
			$mcint_yest = $data[$i][1];
			if ($mcint_today == "")
			{	
			if (count($data) == 1)
			{ 	print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									/ \n ");
				print("								</td>\n");
				print("							<tr>\n");
			return; 
			}
			else
			{
					print("							<tr>\n");
			return; }}
			else
			{

				print("								<td align=center valign=top bgcolor=#f0f0f0><font size=-1>\n") ;
				print("									$mcint_today/<font color=#808080>$mcint_yest \n ");
				print("								</td>\n");
			
			}
				
			}
	print("</tr>\n") ;	
}
	

	
}
?>
