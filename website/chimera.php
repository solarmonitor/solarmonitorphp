<?
	include ("include.php");
	
	if (isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = "saia_chimr";
		
	if (isset($_GET['indexnum']))
		$indexnum = $_GET['indexnum'];
	else
		$indexnum = "1";
	
	if ($type == "trce_m0171")
	{
		$title = "TRACE 171 &Aring; Mosaic and NOAA Active Regions";	
	}

        else if ($type == "saia_00171")
	  {
	    $title = "AIA 171&Aring and NOAA Active Regions";
	  }

	else
	{
		$temp_index = $index_types_def[$type];
		$title = $temp_index." and NOAA Active Regions";	
	}
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body onload="slider.init('sliderl');slider.init('sliderl2');slider.init('sliderr');slider.init('sliderr2')">
		<center>
			<table class='frame' width=825 cellpadding=0 cellspacing=0>
				<tr>
					<td align=center colspan=3>
						<? write_title_cal1($date, $title, $this_page, $indexnum, $type); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_accordion($date,-1); ?>
					</td>
					<td bgcolor=#FFFFFF>
						<table cellspacing=0 cellpadding=0>
							<?php  write_toolbar($date,$type);?>
							<tr>
								<td align=left width=681 colspan=3>
									<?
	  									include("globals.php");
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$file = find_latest_file($date, $instrument, $filter, 'png', 'ch'); 
										if (@fopen("${arm_data_path}data/$dirdate/pngs/$instrument/$file", "r")) {
											print(link_image("${arm_data_path}data/$dirdate/pngs/$instrument/$file", 681, true)); 
										}
										else {
											print(link_image("common_files/NoData/thumb/smdi_maglc_thumb.png"  , 681, true)) ;
										}	
									?>
									<? write_image_map($date, $type); ?>
								</td>
							</tr>
						</table>
					</td>
					<td valign=top align=center>
						<? write_right_accordion($date); ?>
					</td>
				</tr>
				<tr>
					<td align=center colspan=3>
						<? write_bottom_clean($date); ?>
					</td>
				</tr>
			</table>
			<p>
			
			<? write_new_ch_table($date) ?>
			
			<p>
			<? write_ch_events($date); ?>
			<p>
			<hr size=2>
	<? write_footer_new($time_updated); ?>
			<p>
		</center>
	<?php write_footer_js();?>		
		
	</body>
</html>
