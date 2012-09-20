<? 
	/*
	Function:
		write_toolbar
	
	Purpose:
			Displays toolbar on the top.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		David PS
	
	History:
		2011/06/16 (DPS) -- written
	*/
	
	function write_toolbar($date, $type)
	{
		include ("globals.php");
				
		print("		<tr background=\"./common_files/sm_toolbar_bg_black.png\">\n");

		/*Zoom tool*/
		print("			<td align=left valign=middle height=30 >\n");
		print("					<a href='#' class=\"mail2\" onclick=\"zoomable=-1*zoomable;if (zoomable==1){writeText('<img src=common_files/zoom_small_grey.png width=25 border=0 title=&quot;Click to turn off zoom function. Drag UP and RIGHT to change zoom box.&quot;>');}else{writeText('<img src=common_files/zoom_small.png width=25 border=0 title=&quot;Click to turn on zoom function. Drag UP and RIGHT to change zoom box.&quot;>');}\"><b id=\"zoomtoggle\"><img src=common_files/zoom_small.png width=25 border=0 title='Click to turn ON zoom function. Drag UP and RIGHT to change zoom box.'></b></a>\n");   
		print("			</td>	\n"); 
		
		print("			<td align=center height=30>\n");
		/*dropdowns*/
		print("				<ul id=\"toolnav\">\n");
		
		/*Download*/
		print("					<li><a href=\"#\" class=\"Download\">Download</a>\n");
		print("					    <div class=\"sub\">\n");
		print("					    <div class=\"sub_small\">\n");
		print("			            <ul>\n");
		
										$instrument = substr($type,0,4);
										$filter = substr($type,5,5);
										$file = find_latest_file($date, $instrument, $filter, 'png', 'fd'); 			

		print("		                	<li><a href=\"${arm_data_path}data/$dirdate/pngs/$instrument/$file\">PNG</a></li>\n");

										$file = find_latest_file($date, $instrument, $filter, 'fts.gz', 'fd'); 			
		
		print("							<li><a href=\"${arm_data_path}data/$dirdate/fits/$instrument/$file\">FITS</a></li>\n");
		print("	            		</ul>\n");
		print("					    </div>\n");
		print("					    </div>\n");
		print("					</li>\n");
		
		
		/*main menu*/
		if (strtotime($date) > strtotime("20100804")){
		print("					<li><a href=\"#\" class=\"Menu\">Others</a>\n");
		print("					    <div class=\"sub\">\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Main</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'1','div');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Far side</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'2','div');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">SDO short</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'3','div');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">SDO long</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'4','div');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("					    </div>\n");
		print("					</li>\n");
		
		print("				</ul>\n");
		print("			</td> \n");

		} elseif (strtotime($date) < strtotime("20090520")){
		print("					<li><a href=\"#\" class=\"Menu\">Others</a>\n");
		print("					    <div class=\"sub\">\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Main</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'1','div');
		print("			                  </div>\n");
		print("			            </ul>\n");

		} else{
		print("					<li><a href=\"#\" class=\"Menu\">Others</a>\n");
		print("					    <div class=\"sub\">\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Main</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'1','div');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			            <ul>\n");
		print("			                  <li><h2><a href=\"#\">Far side</a></h2></li>\n");
		print("			                  <div class=\"sm-table\">\n");
		write_index_images($date,'2','div');
		print("			                  </div>\n");
		print("			            </ul>\n");
		print("			</td> \n");

		}
		
		/*Share this*/
		print("			<td align=right valign=middle height=30>\n");
		include ("share_include.txt"); 
		print("			</td>  \n");
		print("			</tr>\n");
		
		}	
?>
