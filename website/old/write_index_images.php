<?
  function get_type_opt($date,$type)
  {
    $out = array();
    for ($i=0;$i<count($type);$i++)
      {
	if (preg_match("/seit/",$type[$i])) //to fill EIT 195 and 171 possibilities
	  {
	    $eit_bakeout= in_bakeout($date);
	    $eit_keyhole= in_keyhole($date);
	    list($eit,$filter) = explode('_',$type[$i],2);
	    $bake  = array("bake_".$filter);
	    $keyh  = array("keyh_".$filter);
	    // add to the eit arrays the bake entries at the end IF they exist for $date
	    $type =  ($eit_bakeout) ? array_merge((array)$type , (array)$bake) : $type;
	    // add to the eit arrays the keyhole entries at the end IF they exist for $date
	    $type  =  ($eit_keyhole) ? array_merge((array)$type , (array)$keyh): $type;
	  }
	if (preg_match("/bake|keyh/",$type[$i]))
	  {
	    $file = $type[$i];
	    break;
	  }

	list($instrument, $filter) = explode('_', $type[$i],2);
	$file = find_latest_file($date, $instrument, $filter, 'png', 'fd');
	if ($file != "No File Found" && $type[$i] != "seit_00195" && $type[$i] != "seit_00171"){break;}
	if ($file != "No File Found" && preg_match("/seit/",$type[$i]) && !$eit_bakeout){break;}
      }
    if ($file == "No File Found") {$type[$i]=(strtotime($date) < strtotime("20090520"))?$type[1]:$type[0];}
    $out = array($type[$i],$file);
    return $out;
  }
?>



<?
function write_index_images($date,$indexnum,$table_div='table')
	{
	  
		include("globals.php");
		$image_size = ($table_div == 'table')?220:50;
		$format = ($table_div == 'table')?'.png':'_small60.jpg';
		$files=array();
		$links=array();
		$index_types = $index_types_arr[$indexnum];
		for($i=0;$i<count($index_types);$i++)
		{
		  if ($index_types[$i] == "magnetogram" || $index_types[$i] == "continuum" || $index_types[$i] == "o171" || $index_types[$i] == "o195" || $index_types[$i] == "o195f" || $index_types[$i] == "xray") 
		    {
		      $options = get_type_opt($date,$index_types_opt[$index_types[$i]]);
		      list($index_types[$i],$files[$i]) = $options;
		    }
		  else 
		    {
		      list($instrument, $filter) = explode('_', $index_types[$i],2);
		      $files[$i] = find_latest_file($date, $instrument, $filter,'png', 'fd');
		    }
		  //if file No exist => load thumbnail
		  if ($files[$i] == "No File Found")
		    {
		      $times[]="No Time Data Available";
		      $links[] = "<img src=\"common_files/NoData/thumb/".$index_types[$i]."_thumb.png\" width=$image_size height=$image_size border=0>";
		    }       
		  // if file bake => load bake thumbnail
		  elseif (preg_match("/bake/",$files[$i]))
		    {
		      $times[] = $index_types_def[$index_types[$i]];
		      $links[] = "<img src=\"common_files/NoData/thumb/".$index_types[$i]."_thumb.png\" width=$image_size height=$image_size border=0>";
		    }
		  // if file keyhole => load keyh thumb
		  elseif (preg_match("/keyh/",$files[$i]))
		    {
		      $times[]=$index_types_def[$index_types[$i]];
		      $links[] = "<img src=\"common_files/NoData/thumb/".$index_types[$i]."_thumb.png\" width=$image_size height=$image_size border=0>";
		    }
		  // rest -> load proper file
		  else
		    {
		      list($inst, $filt, $fd, $fdate, $time, $ext) = multiexplode(array("_","."),$files[$i],6);
		      $dt = $fdate . " " . substr($time,0,2) . ":" . substr($time,2,2);
		      $str = $index_types_def[$index_types[$i]]." ".$fdate . " " . date("H:i", strtotime($dt));
		      $times[]=$str;
		      $links[] = link_image("${arm_data_path}data/$dirdate/pngs/thmb/$index_types[$i]_thumb$format", $image_size, false);
		    }
		}

		if ($table_div == 'table')
		  {
		    print("<table>\n");
		    for ($i=0;$i<count($index_types);$i++)
		      {
			if ($i == 0)
			  print("	<tr>\n");
			elseif (($i % 3) == 0)
			  print("	</tr>\n	<tr>\n");
		    
			print("		<td align=center valign=center>\n");
			print("			<small><i>" . $times[$i] . "</i></small>\n");
			
			if(preg_match("/bake|keyh/",$index_types[$i]))
			  {
			    print("         <a href=\"http://sohowww.nascom.nasa.gov/hotshots/2004_01_04/\">\n");
			  }
			elseif($files[$i] == "No File Found")
			  {print("			<a>\n");}
			else
			  {
			    print("			<a href=\"full_disk.php?date=$date&type=" . $index_types[$i] . "&indexnum=$indexnum\">\n");
			  }
			print("				" . $links[$i] . "\n");
			print("			</a>\n");
			print("		</td>\n");
			
			if ($i == (count($index_types)-1))
			  print("	</tr>\n");
			
		      }
		    print("</table>\n");
		  }
		elseif ($table_div == 'div')
		  {
		    for ($i=0;$i<count($index_types);$i++)
		      {
			if ($i < 3)
			  print("<li class=\"top\">\n");
			elseif ($i >= 3)
			  print("<li>\n");						
			if(preg_match("/bake|keyh/",$index_types[$i]))
			  {
			    print("         <a href=\"http://sohowww.nascom.nasa.gov/hotshots/2004_01_04/\">\n");
			  }
			elseif($files[$i] == "No File Found")
			  {print("			<a>\n");}
			else
			  {
			    print("			<a href=\"full_disk.php?date=$date&type=" . $index_types[$i] . "&indexnum=$indexnum\" title=\"". $times[$i] ."\">\n");
			  }
			print("				" . $links[$i] . "\n");
			print("			</a>\n");
			print("		</li>\n");
			
			//if ($i == (count($index_types)-1))
			//	print("	</ul>\n");
			
		      }

		  }

		
		
	}
		

?>
