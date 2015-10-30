<?
/*...............................................*/
// FUNCTION : write_flare_prob_img()
// AUTHOR : Michael Tierney 
// DATE : 10/07/2014
// PURPOSE : Displays image of flare probabilities and handles errors
/*...............................................*/

function write_flare_prob_img($date)
{
	include("globals.php") ;

	$path = "${arm_data_path}data/$dirdate/pngs/" ;
	$type = 'shmi_maglc' ;
	$instrument = substr($type,0,4);
	$filter = substr($type,5,5);
	$HMI = $path . $instrument . "/" . find_latest_file($date, $instrument, $filter, 'png', 'pr');
	$type = 'gong_maglc' ;
	$instrument = substr($type,0,4);
	$filter = substr($type,5,5);
	$GONG = $path . $instrument . "/" . find_latest_file($date, $instrument, $filter, 'png', 'pr');

	$NODATA= "common_files/NoData/thumb/smdi_maglc_thumb.png" ;
	
	// Checks if file exists and plots the image if it does : HMI > GONG > NO_DATA
	if (@fopen($HMI , "r")) {
		print(link_image($HMI , 681, true)) ;
		write_image_map($date , 'shmi_maglc' , $mode='prob') ;
	}
	else if (@fopen($GONG , "r")) {
		print(link_image($GONG , 681, true)) ;
		write_image_map($date , 'gong_maglc' , $mode='prob') ;	
	}
	else {
		print(link_image($NODATA , 681, true)) ;
	}
}
?>  
