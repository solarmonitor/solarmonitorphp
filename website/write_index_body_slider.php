<?
function write_index_body_slider($date, $indexnum, $fdar, $region = "00000")
	{
		
	//	include("globals.php");
		print("<div class='tabbed_content'>\n");
		print("	<div class='tabs'>\n");
		print("		<div class='moving_bg'>\n");
		print("			&nbsp;\n");
		print("		</div>\n");
		
		if (strtotime($date) > strtotime("20100804")){
			print("		<span class='tab_item'>\n");
			print("			Main\n");
			print("		</span>\n");
			print("		<span class='tab_item'>\n");
			print("			Far-side\n");
			print("		</span>\n");
			print("		<span class='tab_item'>\n");
			print("			SDO short-wave\n");
			print("		</span>\n");
			print("		<span class='tab_item'>\n");
			print("			SDO long-wave\n");
			print("		</span>\n");
			print("	</div>\n");
			print("	<div class='slide_content'>\n");
			print("		<div class='tabslider'>\n");
			print("			<!-- content goes here -->\n");
			if ($fdar == 'fd')
			  {
			    write_index_images($date,"1");
			    write_index_images($date,"2");
			    write_index_images($date,"3");
			    write_index_images($date,"4");
			  }
			else
			  {
			    write_index_regions($date,"1","table",$region);
			    write_index_regions($date,"2","table",$region);
			    write_index_regions($date,"3","table",$region);
			    write_index_regions($date,"4","table",$region);
			  }
		} elseif (strtotime($date) < strtotime("20090520")){
			print("		<span class='tab_item'>\n");
			print("			Main\n");
			print("		</span>\n");
			print("	</div>\n");
			print("	<div class='slide_content'>\n");
			print("		<div class='tabslider'>\n");
			print("			<!-- content goes here -->\n");
			if ($fdar == 'fd') {write_index_images($date,"1");}
			else {write_index_regions($date,"1","table",$region);}
		} else {
			print("		<span class='tab_item'>\n");
			print("			Main\n");
			print("		</span>\n");
			print("		<span class='tab_item'>\n");
			print("			Far-side\n");
			print("		</span>\n");
			print("	</div>\n");
			print("	<div class='slide_content'>\n");
			print("		<div class='tabslider'>\n");
			print("			<!-- content goes here -->\n");
			if ($fdar == 'fd')
			  {
			    write_index_images($date,"1");
			    write_index_images($date,"2");
			  }
			else
			  {
			    write_index_regions($date,"1","table",$region);
			    write_index_regions($date,"2","table",$region);
			  }
		}


		print("		</div>\n");
		print("<div style=\"clear: both\"> <!-- --> </div>\n");
		print("	</div>\n");
		print("</div>\n");
		
		print(" <!-- write_ticker($date) -->");
	}
?>
					

		
