<?
	function write_index_images_div($date,$indexnum)
	{
		include("globals.php");
		
		//Test for bakeout and keyhole.
		$eit_bakeout = in_bakeout($date);
		$eit_keyhole = in_keyhole($date);
		
		
		//Get instrument parameters depending on which index page.
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
		elseif ($indexnum == "3")
		{	
			$index_types = $index3_types;
			$index_types_strs = $index3_types_strs;
		}
		elseif ($indexnum == "4")
		{	
			$index_types = $index4_types;
			$index_types_strs = $index4_types_strs;
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
			//Take care of Bakeout and keyhole cases.
			$aia193file="${arm_data_path}data/$dirdate/pngs/thmb/saia_00193_thumb.png";
			if($index_types[$i] == 'bake_00195')
			{
	//			if (@fopen($aia193file, "r"))
	//			{
	//				$links[$i] = link_image($aia193file, 50, false);
	//				$index_types[$i] = 'saia_00193';
	//				list($instrument, $filter) = split('[_]', $index_types[$i],2);
	//				$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
	//				if($file !== "No File Found"){
	//					$times[$i]="AIA 193&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
	//				}else{$times[$i]="AIA 193&Aring; ".$date." ";}
	//			}
	//			else
	//			{
					$links[] = "<img src=\"common_files/NoData/thumb/bakeout.thumb.png\" width=50 height=50 border=0>";
	//			}
			}
			elseif($index_types[$i] == 'keyh_00195')
			{
	//			if (@fopen($aia193file, "r"))
	//			{
	//				$links[$i] = link_image($aia193file, 50, false);
	//				$index_types[$i] = 'saia_00193';
	//				list($instrument, $filter) = split('[_]', $index_types[$i],2);
	//				$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
	//				if($file !== "No File Found"){
	//					$times[$i]="AIA 193&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
	//				}else{$times[$i]="AIA 193&Aring; ".$date." ";}
	//			}
	//			else
	//			{
					$links[] = "<img src=\"common_files/NoData/thumb/keyhole.thumb.png\" width=50 height=50 border=0>";
	//			}
			}
			else
			{
				$links[] = link_image("${arm_data_path}data/$dirdate/pngs/thmb/$index_types[$i]_thumb.png", 50, false);
			}
			
			//Take care of backups for other missing instruments on a given day.
			list($instrument, $filter) = split('[_]', $index_types[$i],2);
			$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
			if($file == "No File Found")
			{
				if($index_types[$i] == 'bake_00195')
				{
					$times[]="EIT CCD BAKEOUT";
				}
				
				//  Shaun and Paul 13-Oct-2010 START OF ADDED CODE
                //  Attempting to add AIA 193 in if EIT 195 not present
                elseif($index_types[$i] == 'seit_00195')
                {
                     $aia193file="${arm_data_path}data/$dirdate/pngs/thmb/saia_00193_thumb.png";
                     if (@fopen($aia193file, "r"))
                     {
                     	$links[$i] = link_image($aia193file, 50, false);
                        $index_types[$i] = 'saia_00193';
                        list($instrument, $filter) = split('[_]', $index_types[$i],2);
                        $file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
                        if($file !== "No File Found")
                        {
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "AIA 193&Aring; ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
                        	//$times[]="AIA 193&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
                        }
                        else{
                        	$times[]="AIA 193&Aring; ".$date." ";
                        }
                     }
                     else
                     {
                     	$times[]="No Time Data Available";
                     }
				}	
				//  Shaun and Paul 13-Oct-2010 END OF ADDED CODE
				
			elseif($index_types[$i] == 'smdi_maglc')
				{
					$gongfile="${arm_data_path}data/$dirdate/pngs/thmb/gong_maglc_thumb.png";
					$hmifile="${arm_data_path}data/$dirdate/pngs/thmb/shmi_maglc_thumb.png";
					if (@fopen($hmifile, "r"))
					{
						$links[$i] = link_image($hmifile, 50, false);
						$index_types[$i] = 'shmi_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "HMI Mag ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="HMI Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="HMI Mag ".$date." ";}
					}
					elseif (@fopen($gongfile, "r"))
					{
						$links[$i] = link_image($gongfile, 50, false);
						$index_types[$i] = 'gong_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "GONG Mag ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="GONG Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="GONG Mag ".$date." ";}
					}
					else
					{
						$times[]="No Time Data Available";
					}
				}
				elseif($index_types[$i] == 'gong_maglc')
				{
					$mdifile="${arm_data_path}data/$dirdate/pngs/thmb/smdi_maglc_thumb.png";
					$hmifile="${arm_data_path}data/$dirdate/pngs/thmb/shmi_maglc_thumb.png";
					if (@fopen($mdifile, "r"))
					{
						$links[$i] = link_image($mdifile, 50, false);
						$index_types[$i] = 'smdi_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "MDI Mag ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="MDI Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="MDI Mag ".$date." ";}
					}
					elseif (@fopen($hmifile, "r"))
					{
						$links[$i] = link_image($hmifile, 50, false);
						$index_types[$i] = 'shmi_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "HMI Mag ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="HMI Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="HMI Mag ".$date." ";}
					}
					else
					{
						$times[]="No Time Data Available";
					}
				}
				elseif($index_types[$i] == 'shmi_maglc')
				{
					$mdifile="${arm_data_path}data/$dirdate/pngs/thmb/smdi_maglc_thumb.png";
					$gongfile="${arm_data_path}data/$dirdate/pngs/thmb/gong_maglc_thumb.png";
					if (@fopen($mdifile, "r"))
					{
						$links[$i] = link_image($mdifile, 50, false);
						$index_types[$i] = 'smdi_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "MDI Mag ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="MDI Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="MDI Mag ".$date." ";}
					}
					elseif (@fopen($gongfile, "r"))
					{
						$links[$i] = link_image($gongfile, 50, false);
						$index_types[$i] = 'gong_maglc';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "GONG Mag ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="GONG Mag ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="GONG Mag ".$date." ";}
					}
					else
					{
						$times[]="No Time Data Available";
					}
				}
				elseif($index_types[$i] == 'smdi_igram')
				{
					$gongintfile="${arm_data_path}data/$dirdate/pngs/thmb/gong_igram_thumb.png";
					$chmiintfile="${arm_data_path}data/$dirdate/pngs/thmb/chmi_06173_thumb.png";
					if (@fopen($chmiintfile, "r"))
					{
						$links[$i] = link_image($chmiintfile, 50, false);
						$index_types[$i] = 'chmi_06173';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "HMI 6173&Aring; ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="AIA 4500&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="HMI 6173&Aring; ".$date." ";}

					}
					elseif (@fopen($gongintfile, "r"))
					{
						$links[$i] = link_image($gongintfile, 50, false);
						$index_types[$i] = 'gong_igram';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "GONG Cont ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="GONG Cont ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="GONG Cont ".$date." ";}

					}
					else
					{
						$times[]="No Time Data Available";
					}
				}
				elseif($index_types[$i] == 'swap_00174')
				{
					$aia171file="${arm_data_path}data/$dirdate/pngs/thmb/saia_00171_thumb.png";
					if (@fopen($aia171file, "r"))
					{
						$links[$i] = link_image($aia171file, 50, false);
						$index_types[$i] = 'saia_00171';
						list($instrument, $filter) = split('[_]', $index_types[$i],2);
						$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
						if($file !== "No File Found"){
							list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
							$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
							$str = "AIA 171&Aring; ".$fdate . " " . date("H:i", strtotime($dt));
							$times[]=$str;
							//$times[]="AIA 171&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
						}else{$times[]="AIA 171&Aring; ".$date." ";}
					}
					elseif ($eit_bakeout)
					{
						$trace171file="${arm_data_path}data/$dirdate/pngs/thmb/trce_m0171_thumb.png";
						if (@fopen($trace171file, "r"))
						{
							$links[$i] = link_image($trace171file, 50, false);
							$index_types[$i] = 'trce_m0171';
							list($instrument, $filter) = split('[_]', $index_types[$i],2);
							$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
							if($file !== "No File Found"){
								list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
								$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
								$str = "TRACE 171&Aring; ".$fdate . " " . date("H:i", strtotime($dt));
								$times[]=$str;
								//$times[]="TRACE 171&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
							}else{$times[]="TRACE 171&Aring; ".$date." ";}

						}
						else
						{
							$times[]="No Time Data Available";
						}
					}
					else
					{
						$eit171file="${arm_data_path}data/$dirdate/pngs/thmb/seit_00171_thumb.png";
						if (@fopen($eit171file, "r"))
						{
							$links[$i] = link_image($eit171file, 50, false);
							$index_types[$i] = 'seit_00171';
							list($instrument, $filter) = split('[_]', $index_types[$i],2);
							$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
							if($file !== "No File Found"){
								list($inst, $filt, $fd, $fdate, $time, $ext) = split('[_.]',$file,6);
								$dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
								$str = "EIT 171&Aring; ".$fdate . " " . date("H:i", strtotime($dt));
								$times[]=$str;
								//$times[]="EIT 171&Aring; ".$date." ".substr($file,23,2) . ":" . substr($file,25,2);
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

		
		
		//print("<ul>\n");
		for ($i=0;$i<count($index_types);$i++)
		{
			if ($i < 3)
				print("	<li class=\"top\">\n");
			elseif ($i >= 3)
				print("	<li>\n");						
			if($index_types[$i] == 'bake_00195' || $index_types[$i] == 'keyh_00195')
			{
				print("         <a href=\"http://sohowww.nascom.nasa.gov/hotshots/2004_01_04/\">\n");
			}
			else
			{
				print("			<a href=\"full_disk.php?date=$date&type=" . $index_types[$i] . "&indexnum=$indexnum\">\n");
			}
			print("				" . $links[$i] . "\n");
			print("			</a>\n");
			print("		</li>\n");
			
			//if ($i == (count($index_types)-1))
			//	print("	</ul>\n");
			
		}

	//	print("	<tr>\n");
	//	print("		<td align=left valign=top colspan=3>\n");
						//print("</ul\n");
		
		
		}
		
		
		?>
