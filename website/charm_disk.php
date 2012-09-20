<?
  include ("include.php");
  include ("globals.php");
  $title = "CHARM Coronal Holes Detections";
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
									<a class=mail2 href="code_info.php?code=CHARM&date=<? print($date); ?>">Coronal Hole Automated Recognition and Monitoring Info</a><br>
									<?
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$files=glob("${arm_data_path}data/charm/charm_".$date."_????_chmap.png")?glob("${arm_data_path}data/charm/charm_".$date."_????_chmap.png"):array();
										if (count($files) !== 0)
										{
											$files = array_reverse($files);
											$file = $files[0];
											//put the image
											print(link_image("$file", 681, true)."<br>");
											$fdatetime=substr($file,23,4);
											
											//Write table
											write_charm_table($date);			
																					
										}
										else
										{
											$file="./common_files/placeholder_630x485.png";
											print("<img src=".$file." width=681>");
										}
										?>
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
			
			<p>
			<hr size=2>
			<p>
		</center>
	<? write_footer_new($time_updated); ?>
	</body>
</html>
