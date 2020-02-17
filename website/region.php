<?
	include ("include.php");
	
	$indexnum = "1";
	
	if (isset($_GET['region']))
		$region = $_GET['region'];
	else
		header("Location: index.php?date=$date");
	
	$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_titles_" . $date . ".txt";
	if (file_exists($file))
	{
		$lines=file($file);
		$title = "No Region $region Found";
		foreach($lines as $line)
		{
			list($number, $temp_title) = explode(' ', $line, 2);
			if ($number == $region)
			{
				$title = $temp_title;
				break;
			}
		}	
	}
	else
	{
		$title = "No Title Found";
	}
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body onload="slider.init('sliderl');slider.init('sliderr'); warning.init('warning')">
		<center>
			<table bgcolor=#787878 width=815 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td background=common_files/brushed-top-big.jpg align=center colspan=3>
						<? write_title_cal($date, $title, $this_page, NULL, $indexnum, 780, $region); ?>
					</td>
				</tr>
				<tr>
					<td background=common_files/brushed-metal.jpg valign=top align=center>
						<? write_left_accordion($date,-1); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top>
	  <? write_index_body_slider($date, $indexnum,"ar",$region);?>
					</td>
					<td background=common_files/brushed-metal.jpg valign=top align=center>
						<? write_right_accordion($date); ?>
					</td>
				</tr>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
						<? write_bottom_clean(); ?>
					</td>
				</tr>
			</table>
			<p>
			
			<? write_ar_table($date) ?>
			<? write_events($date); ?>
			<p>
			<hr size=2>
	<? write_footer_new($time_updated); ?>
			<p>
		</center>
	</body>
</html>