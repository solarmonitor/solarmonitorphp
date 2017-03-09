<?
/*...............................................*/
// FUNCTION : write_flarehist_table()
// AUTHOR : Michael Tierney 
// DATE : 31/07/2014
// PURPOSE : Writes the flare probability table
/*...............................................*/



	function write_flarehist_table()
	{
		include ("globals.php");
		
		print("						<td valign=middle height=1%><table rules=rows cellpadding=1 cellspacing=0 border=0 width=100% height=1%><tr>\n") ;
		print("						<th class=noaacol align=center><font color=white size=-1>\n") ;
		print("								<i><b>NOAA Number</b></i>\n") ;
		print("							</font></th>\n") ;
		print("							<th class=noaacol align=center><font color=white size=-1>\n") ;
		print("								<i><b>McIntosh Class</b></i>\n") ;
		print("							</font></th>\n") ;
		print("							<th class=noaacol align=center><font color=lime size=-1>\n") ;
		print("								<i><b>C-class </b></i>\n") ;
		print("							</font></th>\n") ;
		print("							<th class=noaacol align=center><font color=#3399ff size=-1>\n") ;
		print("								<i><b>M-class </b></i>\n") ;
		print("							</font></th>\n") ;
		print("							<th class=noaacol align=center><font color=#ff0000 size=-1>\n") ;
		print("								<i><b>X-class</b></i>\n") ;
		print("							</font></th>\n") ;
		print("						</tr>\n") ;
		print("					<tr>\n") ;
						  
		$file = "${arm_data_path}data/$dirdate/meta/ar_history_" . $date . ".txt";
		echo '<script>myfunction()</script>';				
		if (file_exists($file))
		{
			$lines=file($file)	;
			$nline=count($lines);
									
			if ($nline < 2)
			{
				$line=$lines;
			}
			else
			{
				$line=$lines[0];
			}
			if ($line =="N" || $line = "")
			{
				print("										<td align=center valign=middle bgcolor=#f0f0f0 colspan=5><font color=white\n") ;
				print("										<b>No Prediction Found</b>\n") ;
				print("									</font></td></tr></table></td>\n") ;
			}
			else
			{
				$i = 0;
				foreach($lines as $line)
				{
					list($region, $mcintosh, $c, $m, $x) = split('[ ]', $line, 5);
		
					// Converts strings to arrays of today/yesterday data using ) and ( as delimiters

					$c = str_replace(")","",$c) ;
					$m =  str_replace(")","",$m);
					$x = rtrim($x) ;
					$x = str_replace(")","",$x) ;
					$c_probs = explode("(" , $c) ; 
					$m_probs = explode("(" , $m) ; 
					$x_probs = explode("(" , $x) ; 
					$c_prob_data[$i] = $c_probs ;
				   	$m_prob_data[$i] = $m_probs  ;
					$x_prob_data[$i] = $x_probs  ;
				  	$reg_data[$i] = $region  ;
					$mcintosh = explode("/",$mcintosh);
				   	$mc_class_data[$i] = $mcintosh  ;
					++$i ;
				}
				
				// Builds tables and writes data in using write_pr_table_entry($mode , $data) 
										
				print("						<td>\n") ;
				print("							<table rules=rows cellpadding=1 cellspacing=0 border=0 width=100%>\n") ;
				print("								<th class=noaacol align=center><font color=white size=-1>\n") ;
				print("								<i><b><br> </b></i>\n") ;
				print("							</font></th>\n") ;
				write_reghist_entry("reg" , $reg_data) ;
				print("							</table>\n") ;
				print("						</td>\n") ;
				print("						<td>\n") ;
				print("							<table rules=all cellpadding=1 cellspacing=0 border=0 width=100%>\n") ;
			
				print("								</font></th>\n") ;
				print("								<th class=noaacol align=center><font color=white size=-1>\n") ;
				print("									<i><b>Day -1</b></i>\n") ;
				print("								<th class=noaacol align=center><font color=white size=-1>\n") ;
				print("									<i><b>Day 0</b></i>\n") ;
				print("									</font></div></th>\n") ;
					
				write_reghist_entry("mc" , $mc_class_data) ; 
				print("							</table>\n") ;
				print("						</td>\n") ;
				print("						<td>\n") ;
				print("							<table rules=all cellpadding=1 cellspacing=0 border=0 >\n") ;
				print("								<th class=noaacol align=center><font color=lime size=-1>\n") ;
				print("									<i><b>Day -1</b></i>\n") ;
				print("								<th class=noaacol align=center><font color=lime size=-1>\n") ;
				print("									<i><b>Day 0</b></i>\n") ;
				print("									</font></div></th>\n") ;
				write_reghist_entry("pr" , $c_prob_data) ;
				print("							</table>\n") ;
				print("						</td>\n") ;
				print("						<td>\n") ;
				print("							<table rules=all cellpadding=1 cellspacing=0 border=0>\n") ;
				print("								<th class=noaacol align=center><font color=#3399ff size=-1>\n") ;
				print("									<i><b>Day -1</b></i>\n") ;
				print("								<th class=noaacol align=center><font color=#3399ff size=-1>\n") ;
				print("									<i><b>Day 0</b></i>\n") ;
				print("									</font></div></th>\n") ;
				
				write_reghist_entry("pr" , $m_prob_data) ;
				print("							</table>\n") ;
				print("						</td>\n") ;
				print("						<td>\n") ;
				print("							<table rules=all cellpadding=1 cellspacing=0 border=0>\n") ;
				print("								<th class=noaacol align=center><font color=#ff0000 size=-1>\n") ;
				print("									<i><b>Day -1</b></i>\n") ;
				print("								<th class=noaacol align=center><font color=#ff0000 size=-1>\n") ;
				print("									<i><b>Day 0</b></i>\n") ;
				print("									</font></div></th>\n") ;
			
				write_reghist_entry("pr" , $x_prob_data) ;
				print("							</table>\n") ;
				print("						</td>\n") ;
				print("				</tr>\n") ;
				print("				</table>\n") ;	
			}
		}
		else
		{
			print("										<td align=center background=common_files/brushed-metal.jpg valign=middle bgcolor=#f0f0f0 colspan=5><font color=white\n") ;
			print("										<b>No Prediction Found</b>\n") ;
			print("									</font></td></tr></table></td>\n") ;
		}
	}
?>
