<?
	function write_index_body_admin($date, $indexnum)
	{
		include("globals.php");
		$eit_bakeout = in_bakeout($date);
		$eit_keyhole = in_keyhole($date);
		
		if ($indexnum == "2")
		{	
			$index_types = $index2_types;
			$index_types_strs = $index2_types_strs;
			if ($eit_keyhole == "1")
			{
				$index_types = $keyhole_index2_types;
				$index_types_strs = $keyhole_index2_types_strs;
			}
			if ($eit_bakeout)
			{
				$index_types = $bakeout_index2_types;
				$index_types_strs = $bakeout_index2_types_strs;
			}
		}
		else
		{
			if ($eit_keyhole == "1")
			{
				$index_types = $keyhole_index_types;
				$index_types_strs = $keyhole_index_types_strs;
			}
			if ($eit_bakeout)
			{
				$index_types = $bakeout_index_types;
				$index_types_strs = $bakeout_index_types_strs;
			}
		}
		
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

		
		
		print("<table>\n");
		for ($i=0;$i<count($index_types);$i++)
		{
			if ($i == 0)
				print("	<tr>\n");
			elseif (($i % 3) == 0)
				print("	<tr>\n	<tr>\n");
				
			print("		<td align=center valign=center>\n");
			print("			<small><i>" . $times[$i] . "</i></small>\n");
			
			if($index_types[$i] == 'bake_00195' || $index_types[$i] == 'keyh_00195')
			{
				print("         <a href=\"http://sohowww.nascom.nasa.gov/hotshots/2004_01_04/\">\n");
			}
			else
			{
				print("			<a href=\"index_inst_admin.php?date=$date&type=" . $index_types[$i] . "&indexnum=$indexnum\">\n");
			}
			print("				" . $links[$i] . "\n");
			print("			</a>\n");
			print("		</td>\n");
			
			if ($i == (count($index_types)-1))
				print("	</tr>\n");
		}

		print("	<tr>\n");
		print("		<td align=left valign=top colspan=3>\n");
		
		//Write the link to the INDEX2.php page with STEREO and Farside.
		if ($indexnum == "2")
		{
		print("<table vspace=0 align=center width=10px height=25px border=0 cellpadding=0 cellspacing=0 background=common_files/brushed-metal.jpg><tr><td align=center><a class=mail href=index_admin.php?date=$date>&nbsp;&lArr;&nbsp;Back&nbsp;</a></td></tr></table>\n");
		}
		else
		{
			//TODO: Single index page for two pages changing varaible page!
		print("<table vspace=0 align=center width=10px height=25px border=0 cellpadding=0 cellspacing=0 background=common_files/brushed-metal.jpg><tr><td align=center><a class=mail href=index_admin.php?date=$date>&nbsp;More&nbsp;Instruments&nbsp;&rArr;&nbsp;</a></td></tr></table>\n");
		}
		?>
		
		<hr>
		<hr>	
					<?php print("<blink>***Admin page***</blink>")?>

		<?
		print("		</td>\n");
		print("	</tr>\n");
		print("</table>	\n");
	}
?>
					
					
