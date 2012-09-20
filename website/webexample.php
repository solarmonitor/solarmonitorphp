<? 
include ("include.php");
$indexnum = "-1";
$date = "20100901"
?>
<html>
	<head>
		<title>Tabbed content</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

		<script type='text/javascript' src='./common_files/tabbedContent/js/jquery-1.4.4.min.js'></script>

		<link href='common_files/tabbedContent/css/tabbedContent.css' rel='stylesheet' type='text/css' />
		<script src="common_files/tabbedContent/js/tabbedContent.js" type="text/javascript"></script>
	</head>

	<body>
	
<table bgcolor=#787878 width=815 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
						<!--<font size=1><br> </font>-->
						<? write_title_cal1($date, $title, $this_page, $indexnum); ?>
						<!--<font size=1><br> </font>-->
					</td>
				</tr>
				<tr>
					<td background=common_files/brushed-metal.jpg valign=top align=center>
						<? write_left($date, -1); ?>
					</td>
				
					<td bgcolor=#FFFFFF valign=top>
<div class='tabbed_content'>
	<div class='tabs'>
		<div class='moving_bg'>
			&nbsp;
		</div>
		<span class='tab_item'>
			Tab one
		</span>
		<span class='tab_item'>
			Tab two
		</span>
		<span class='tab_item'>
			Tab three
		</span>
		<span class='tab_item'>
			Tab four
		</span>
	</div>

	<div class='slide_content'>
		<div class='tabslider'>

			<!-- content goes here -->
			<? 
write_index_images("20100901","1");
write_index_images("20100901","2"); 
write_index_images("20100901","3"); 
write_index_images("20100901","4");
			?>

		</div>
	</div>
</div>
</td>
					<td background=common_files/brushed-metal.jpg valign=top align=center>
						<? write_right_accordion($date); ?>
					</td>


</tr>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
						<? write_bottom($date); ?>
					</td>
				</tr>


</table>

	</body>
</html>
