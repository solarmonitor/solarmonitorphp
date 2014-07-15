<?
	/*
	File:
		globals
	
	Purpose:
			Variables that are required by nearly all php files.  Includes the paths for code and data as well as code.
		Will also include start and end dates for missions.
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/12 (RH) -- written
		2004/09/08 (RH) -- updated - added path vars
		2006/11/17 (RH) -- updated - changed SXI to EIT 171 -- we really need to rewrite this whole system..
		2011/09/09 (DPS) -- updated - rewriten the whole system
	*/


	//	Path related globals
	//	All of these paths must be within the server document root.  eg, "/" is the server root path, 
	//	not the system root path.  Trailing '/' must be included.
	
		//	PHP Code Path
		//	The path in which the PHP lies
		//	$php_code_path = "/";
		
		//	Data Path
		//	This is the folder that the data/ folder lies in.
		$arm_data_path = "";
 
               if (isset($_GET['region']) && !isset($_GET['date']))
		  {
		    $region = $_GET['region'];
		    $date_use = arsql_search($region);
		    if ($date_use == "00000000")
		      {
			print "***no date";			
		      }
		    else
		      {
			$date = date("Ymd",strtotime($date_use));
			if (!isset($_GET['type']))
			  header("Location: index.php?date=$date&region=$region");
		      }
		  }
                elseif (!isset($_GET['region']) && isset($_GET['date']))
		  {
		    $date =  $_GET['date'];
		    $region = '';
		  }
                elseif (isset($_GET['region']) && isset($_GET['date']))
		  {
		    $date =  $_GET['date'];
		    $region = $_GET['region'];
		  }
                else
		  {
		    $date = gmdate("Ymd");
		    $region = '';
		  }
		  

//		if (isset($_GET['date']))
//			$date = $_GET['date'];
//		else	
//			$date = gmdate("Ymd");
		
		$current_date = gmdate("Ymd");

		if($date == $current_date)
		{
			if(gmdate("H:i") < "00:45")
				$date = $date - 1;
		}
			$dirdate = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
//print "<br>".$dirdate;
//			$dirdate = $date;	
                        $date_smart_hmi = "20101116";

$index_types_def = array("smdi_maglc" => "MDI Mag", "smdi_igram" => "MDI Cont", "bbso_halph" => "GHN H&alpha;",
			 "seit_00171" => "EIT 171&Aring", "seit_00195" => "EIT 195&Aring", "seit_00284" => "EIT 284&Aring","seit_00304" => "EIT 304&Aring",
			 "hxrt_flter" => "XRT", "gsxi_flter" => "SXI X-rays", 
			 "gong_maglc" => "GONG Mag", "gong_igram" => "GONG+ Continuum", "gong_farsd" => "GONG Farside",  
			 "slis_chrom" => "SOLIS Mag", 
			 "stra_00195" => "STEREO A", "strb_00195" => "STEREO B", 
			 "swap_00174" => "SWAP 174&Aring", 
			 "shmi_maglc" => "HMI Mag", 
			 "chmi_06173" => "HMI 6173&Aring",
			 "saia_00094" => "AIA 94&Aring", "saia_00131" => "AIA 131&Aring", "saia_00171" => "AIA 171&Aring", "saia_00193" => "AIA 193&Aring", "saia_00211" => "AIA 211&Aring", 
			 "saia_00304" => "AIA 304&Aring", "saia_00335" => "AIA 335&Aring", "saia_01600" => "AIA 1600&Aring", "saia_01700" => "AIA 1700&Aring",
			 "trce_m0171" => "TRACE 171&Aring", 
			 "bake_00171" => "CCD BAKEOUT","keyh_00171" => "SOHO KEYHOLE",
			 "bake_00195" => "CCD BAKEOUT","keyh_00195" => "SOHO KEYHOLE");
			 //Yokoh SXI?

$index_types_opt = array(
			 "magnetogram" => array("shmi_maglc","smdi_maglc","gong_maglc"), //magnetogram
			 "continuum" => array("chmi_06173","smdi_igram","gong_igram"), //continuum
			 "o171" => array("swap_00174","saia_00171","seit_00171","trce_m0171"), //171
			 "o195" => array("saia_00193","seit_00195"), //195
			 "o195f" => array("saia_00193","seit_00195","trce_m0171")); //195f

//
$index_types_arr = array (
		      1 => array("magnetogram","continuum" , "bbso_halph", "o171"       , "o195"       , "hxrt_flter"),
		      2 => array("magnetogram","slis_chrom", "gong_farsd", "strb_00195", "o195f"      , "stra_00195"),
		      3 => array("magnetogram","saia_00094", "saia_00131", "saia_00171", "saia_00193", "saia_00211"),
		      4 => array("magnetogram","saia_00304", "saia_00335", "saia_01600", "saia_01700", "chmi_06173"));

	

$region_types = array("smdi_igram", "smdi_maglc", "bbso_halph", "seit_00304", "swap_00174", "seit_00195", "seit_00284", "hxrt_flter", "gong_maglc", "gong_bgrad","saia_00171", "saia_00304", "saia_00193", "saia_00094", "saia_00131", "saia_00211", "saia_00335", "saia_01600", "saia_01700", "shmi_maglc", "shmi_magss", "chmi_06173");
$region_strs1 = array("smdi_igram" => "MDI Continuum", "smdi_maglc" => "MDI Magnetogram", "bbso_halph" => "BBSO H-Alpha", "seit_00304" => "EIT 304&Aring","seit_00171" => "EIT 171&Aring", "trce_m0171" => "Trace 171&Aring", "seit_00195" => "EIT 195&Aring", "seit_00284" => "EIT 284&Aring", "hxrt_flter" => "Hinode XRT", "gong_maglc" => "GONG+ Magnetogram", "gong_bgrad" => "Magnetic Gradient","slis_chrom" => "SOLIS Chromospheric Mag", "gong_farsd" => "GONG Farside", "strb_00195" => "STEREO B 195&Aring", "stra_00195" => "STEREO A 195&Aring", "gong_igram" => "GONG+ Continuum", "swap_00174" => "SWAP 174&Aring", "saia_00171" => "AIA 171&Aring","saia_00304" => "AIA 304&Aring", "saia_00193" => "AIA 193&Aring", "saia_0094" => "AIA 94&Aring", "saia_00131" => "AIA 131&Aring", "saia_00211" => "AIA 211&Aring", "saia_00335" => "AIA 335&Aring", "saia_01600" => "AIA 1600&Aring", "saia_01700" => "AIA 1700&Aring", "shmi_maglc" => "HMI Magnetogram", "shmi_magss" => "Sunspot Contours", "chmi_06173" =>"HMI 6173&Aring"); 
$region_strs2 = array("smdi_igram" => "Cont", "smdi_maglc" => "Mag", "bbso_halph" => "H&alpha;","seit_00304" => "304&Aring", "seit_00171" => "171&Aring", "seit_00195" => "195&Aring", "seit_00284" => "284&Aring","hxrt_flter" => "XRT", "gong_maglc" => "Mag", "gong_bgrad" => "Magnetic<br>Gradient");

$themes = array(
		"modern" => "./common_files/css/modern.css",
		"clasic" => "./common_files/css/clasic.css");

//print "<br> end globals <br>";
?>
