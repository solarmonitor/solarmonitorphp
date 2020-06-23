<?
	function write_index_body_inst_admin($date, $indexnum, $type)
	{
		include("globals.php");
		
		$instrument = substr($type,0,4);
		$filter = substr($type,5,5);
		$file = find_all_filter_files($date, $instrument, $filter, 'png', 'fd'); 

		$count = count($file);
		echo "Files: " . $count . "<br>";
		print("<table>\n");
		for ($i = 0; $i < $count; $i++) 
		{	
			$link = link_image("${arm_data_path}data/$date/pngs/$instrument/$file[$i]", 220, false); 
				list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file[$i],6);
				$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
				$str = " " . $fdate . " " . date("H:i", strtotime($dt));
				$times="     ".$str."     ";

			if ($i == 0)                          //create the header for each row for every 3 columns
				print("	<tr>\n");
			elseif (($i % 3) == 0)
				print("	<tr>\n	<tr>\n");

			print("		<td align=center valign=center>\n");
			print("			<small><i>" . $times . "</i></small><br>\n");
			//TODO: create full_disk_admin that visualize the image I want! 
	//		print("			<a href=\"full_disk.php?date=$date&type=" . $index_types[$i] . "&indexnum=$indexnum\">\n");
	//		print("			")
			print("				" . $link. "\n");
	//		print("			</a>\n");
			print("		</td>\n");
			
			if ($i == (count($index_types)-1))
			print("	</tr>\n");
		}

		print("	<tr>\n");
		print("		<td align=left valign=top colspan=3>\n");
			
				
			
print("<table vspace=0 align=center width=10px height=25px border=0 cellpadding=0 cellspacing=0 background=common_files/brushed-metal.jpg><tr><td align=center><a class=mail href=index_admin.php?date=$date>&nbsp;&lArr;&nbsp;Menu&nbsp;</a></td></tr></table>\n");
					
  		

 ?>		
		<hr>
		<hr>	
					<?php print("<blink>***Admin page***</blink>")?>

		<?
		print("		</td>\n");
		print("	</tr>\n");
		print("</table>	\n");
		
	
		
/*		
	<? write_header($date, $title, $this_page) ?>
	<body>
		<center>
			<table background=common_files/brushed-metal.jpg width=825 cellpadding=0 cellspacing=0>
				<tr>
					<td background=common_files/brushed-top-big.jpg align=center colspan=3>
						<? write_title($date, $title, $this_page, $indexnum, $type); ?>
					</td>
				</tr>
				<tr>
					<td bgcolor=#FFFFFF>
						<table cellspacing=0 cellpadding=0>
							<tr>
								<td align=left width=681>
									<?
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$file = find_latest_file($date, $instrument, $filter, 'png', 'fd'); 
										print(link_image("${arm_data_path}data/$date/pngs/$instrument/$file", 681, true)); 
									?>
									<? write_image_map($date, $type); ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p>
			
			<p>
			<hr size=2>
			<p>
		</center>
	<? write_footer($time_updated); ?>
	</body>
</html>

*/		
		
		
/*		
		$links=array();
		for($i=0;$i<count($index_types);$i++)
		{
			if($index_types[$i] == 'bake_00195')
			{
				$links[] = "<img src=\"common_files/NoData/thumb/bakeout.thumb.png\" width=220 height=220 border=0>";
			}
			elseif($index_types[$i] == 'keyh_00195')
			{
				$links[] = "<img src=\"common_files/NoData/thumb/keyhole.thumb.png\" width=220 height=220 border=0>";
			}
			else
			{
				$links[] = link_image("${arm_data_path}data/$date/pngs/thmb/$index_types[$i]_thumb.png", 220, false);
			}
			
			list($instrument, $filter) = split('[_]', $index_types[$i],2);
			$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
			if($file == "No File Found")
			{
				if($index_types[$i] == 'bake_00195')
				{
					$times[]="EIT CCD BAKEOUT";
				}
				elseif($index_types[$i] == 'smdi_maglc')
				{
					$gongfile="${arm_data_path}data/$date/pngs/thmb/gong_maglc_thumb.png";
					if (@fopen($gongfile, "r"))
					{
						$links[$i] = link_image($gongfile, 220, false);
						$index_types[$i] = 'gong_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							$times[]="GONG Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="GONG Mag ".$date." ";}
					}
					else
					{
						$times[]="No Time Data Available";
					}
				}
				elseif($index_types[$i] == 'smdi_igram')
				{
					$gongintfile="${arm_data_path}data/$date/pngs/thmb/gong_igram_thumb.png";
					if (@fopen($gongintfile, "r"))
					{
						$links[$i] = link_image($gongintfile, 220, false);
						$index_types[$i] = 'gong_igram';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							$times[]="GONG Cont ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="GONG Cont ".$date." ";}

					}
					else
					{
						$times[]="No Time Data Available";
					}
				}
				elseif($index_types[$i] == 'swap_00174')
				{
					if ($eit_bakeout)
					{
						$trace171file="${arm_data_path}data/$date/pngs/thmb/trce_m0171_thumb.png";
						if (@fopen($trace171file, "r"))
						{
							$links[$i] = link_image($trace171file, 220, false);
							$index_types[$i] = 'trce_m0171';
							list($instrument, $filter) = split('[_]', $index_types[$i],2);
							$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
							if($file !== "No File Found"){
								$times[]="TRACE 171&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
							}else{$times[]="TRACE 171&Aring; ".$date." ";}

						}
						else
						{
							$times[]="No Time Data Available";
						}
					}
					else
					{
						$eit171file="${arm_data_path}data/$date/pngs/thmb/seit_00171_thumb.png";
						if (@fopen($eit171file, "r"))
						{
							$links[$i] = link_image($eit171file, 220, false);
							$index_types[$i] = 'seit_00171';
							list($instrument, $filter) = split('[_]', $index_types[$i],2);
							$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
							if($file !== "No File Found"){
								$times[]="EIT 171&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
							}else{$times[]="EIT 171&Aring; ".$date." ";}

						}
						else
						{
							$times[]="No Time Data Available";
						}
					}
				}
				else
				{
					$times[]="No Time Data Available";
				}
			}
			else
			{
				list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
				$str = $index_types_strs[$index_types[$i]];
				$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
				//$str = $str . " " . date("d-M-Y H:i", strtotime($dt)) . " UT";
				$str = $str . " " . $fdate . " " . date("H:i", strtotime($dt));
				$times[]=$str;
			}
		}

		
		
		*/
	}
?>
					