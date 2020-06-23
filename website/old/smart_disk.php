<?
  include ("include.php");
  include ("globals.php");
  $type = "smrt_maglc";
  $indexnum = "1";
  $title = "SMART Magnetic Structure Detections";
$smart_path = (strtotime($date) > strtotime($date_smart_hmi))?"smart_hmi_output/":"${arm_data_path}data/smart/";
$smart_hour = (strtotime($date) > strtotime($date_smart_hmi))?"??????":"????";

?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body onload="slider.init('sliderl');slider.init('sliderl2');slider.init('sliderr');slider.init('sliderr2')">
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame'  width=815 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align=center colspan=3>
						<? write_title_cal1($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_accordion($date,-1); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top>

						<table>
							<tr>
								<td align=left>
									<a class=mail2 href="code_info.php?code=SMART&date=<? print($date); ?>">SMART Info</a><br>
									<?
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$files=glob("${smart_path}smart_plots/full_disk/smart_".$date."_${smart_hour}.png")?glob("${smart_path}smart_plots/full_disk/smart_".$date."_${smart_hour}.png"):array();
										if (count($files) !== 0)
										{
											$files = array_reverse($files);
											$file = $files[0];
											print(link_image("$file", 681, true)."<br>");
											$fdatetime=(strtotime($date) > strtotime($date_smart_hmi))?substr($file,57,6):substr($file,49,4);
											

											//Write table
											write_smart_table($date);

											//											$tablefiles=glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt")?glob("${smart_path}smart_ascii/smart_".$date."_${smart_hour}_ar.txt"):array();
											//if (count($tablefiles) !== 0)
											//{
											//	$tablefiles = array_reverse($tablefiles);
											//	$tablefile = $tablefiles[0];
											//	include $tablefile;
											//PUT AR TABLE INCLUDE HERE.
											//}
											
											$nlfiles=glob("${smart_path}smart_plots/zoom/smart_".$date."_".$fdatetime."_nl_*.png")?glob("${smart_path}smart_plots/zoom/smart_".$date."_".$fdatetime."_nl*.png"):array();
											if (count($nlfiles) !== 0)
											{
												foreach ($nlfiles as $nlfilename) {
													print(link_image("$nlfilename", 500, true)."<br>");
												}
											}										
											
											
										}
										else
										{
											$file="./common_files/placeholder_630x485.png";
											print("<img src=".$file." width=681>");
										}
										
										//$nlfile1 = "./common_files/placeholder_630x485.png";
										//if (@fopen("./phiggins/smart_plots/smart_nl_01_$date.png", "r")){$nlfile1 = "./phiggins/smart_plots/smart_nl_01_$date.png";}
										//$nlfile2 = "./common_files/placeholder_630x485.png";
										//if (@fopen("./phiggins/smart_plots/smart_nl_01_$date.png", "r")){$nlfile1 = "./phiggins/smart_plots/smart_nl_01_$date.png";}
										//$nlfile3 = "./common_files/placeholder_630x485.png";
										//if (@fopen("./phiggins/smart_plots/smart_nl_01_$date.png", "r")){$nlfile1 = "./phiggins/smart_plots/smart_nl_01_$date.png";}
										//print("<img src=".$file." width=681>"); 
									?>
									<? //write_image_map($date, $type); ?>
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
						<? write_bottom_clean(); ?>
					</td>
				</tr>
			</table>
			<p>
			
			<? //write_ar_table($date) ?>
			
			<p>
			<? //write_events($date); ?>
			<p>
			<hr size=2>
			<p>
		</center>
	<? write_footer_new($time_updated); ?>
	</body>
</html>
