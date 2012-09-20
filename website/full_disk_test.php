<?
	include ("include.php");
	
	if (isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = "smdi_maglc";
		
	if (isset($_GET['indexnum']))
		$indexnum = $_GET['indexnum'];
	else
		$indexnum = "1";
	
	if ($type == "trce_m0171")
	{
		$title = "TRACE 171 &Aring; Mosaic and NOAA Active Regions";	
	}
	else
	{
		$temp_index = $fd_types2num[$type];
		$title = $fd_strs2[$temp_index] . " and NOAA Active Regions";	
	}
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
	<script type="text/javascript" src="./common_files/tabbedContent/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="./common_files/js/jquery.hoverIntent.minified.js"></script>
	
	<?php  write_toolbar($date,$type);?>
	<center>
		<table cellspacing=0 cellpadding=0>
			<tr>
				<td align=left width=681 colspan=2>
									<?
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$file = find_latest_file($date, $instrument, $filter, 'png', 'fd'); 
										print(link_image("${arm_data_path}data/$dirdate/pngs/$instrument/$file", 681, true)); 

		print("		                	<p><a href=\"${arm_data_path}data/$dirdate/pngs/$instrument/$file\">PNG</a><br>\n");
										$file = find_latest_file($date, $instrument, $filter, 'fts', 'fd'); 			
		print("							<p><a href=\"${arm_data_path}data/$dirdate/fits/$instrument/$file\">FITS</a>\n");
										?>
									<? write_image_map($date, $type); ?>
				</td>
			</tr>
		</table>
	<?php 	
		print("				<ul id=\"toolnav\">\n");
		
		/*Download*/
		print("					<li><a href=\"#\" class=\"Download\">Download</a>\n");
		print("					    <div class=\"sub\">\n");
		print("			            <ul>\n");
		
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$file = find_latest_file($date, $instrument, $filter, 'png', 'fd'); 			

		print("		                	<li><a href=\"${arm_data_path}data/$dirdate/pngs/$instrument/$file\">PNG</a></li>\n");

										$file = find_latest_file($date, $instrument, $filter, 'fts', 'fd'); 			
		
		print("							<li><a href=\"${arm_data_path}data/$dirdate/fits/$instrument/$file\">FITS</a></li>\n");
		print("	            		</ul>\n");
		print("					    </div>\n");
		print("					</li>\n");
		
		
		/*main menu*/
		print("					<li><a href=\"#\" class=\"Menu\">Others</a>\n");
		print("					    <div class=\"sub\">\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Main</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
				write_index_images_div($date,'1');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Far side</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images_div($date,'2');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">SDO short</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images_div($date,'3');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">SDO long</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images_div($date,'4');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("					    </div>\n");
		print("					</li>\n");
		
		print("				</ul>\n");
?>	

		
		
	</center>
	<?php write_footer_js();?>		
	</body>
</html>
