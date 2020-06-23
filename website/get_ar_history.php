<?
/*...............................................*/
// FUNCTION : get_ar_history.php
// AUTHOR : Aoife McCloskey 
// DATE : 03/08/2017
// PURPOSE : Gets NOAA active region history for current and previous day 
// HISTORY: 
/*...............................................*/



	function get_ar_history()
	{
		include ("globals.php") ;
		$file_yest = "${arm_data_path}data/$dirdate/meta/arm_ar_summary_" . $date . ".txt";
			if (file_exists($file_yest))
		{
			$lines=file($file_yest)	;
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
			$no_data = "No Data";
			return $no_data;
			}
			else
			{
				$i = 0;
				foreach($lines as $line)
				{
					list($region, $loc, $loc_arc, $mtwil, $mcintosh,$area,$nspot) = preg_split("[\s]", $line, 7);
		
					// Converts strings to arrays of today/yesterday data using ) and ( as delimiters
					$region_data[$i] = $region ;
					$loc_data[$i]=$loc;
					$loc_arc_data[$i]=$loc_arc;
					$mtwil_split =  preg_split("[/]", $mtwil);
					$mtwil_data[$i]= $mtwil_split;
					$mcintosh_split = preg_split("[/]",$mcintosh);
					$mcintosh_data[$i]=$mcintosh_split;
					$area_split = preg_split("[/]", $area);
					$area_data[$i]= $area_split;
					$nspot_split = preg_split("[/]", $nspot);
					$nspot_data[$i]= $nspot_split;
					++$i ;
				}
				
			return array($region_data,$loc_data,$loc_arc_data,$mtwil_data,$mcintosh_data,$area_data,$nspot_data);
			  
			}
}
		
	}

	
?>
