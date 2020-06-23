<? 
	include ("include.php");
        include ("globals.php");	

	$title = "Flare Prediction System";	
	$indexnum = "1";
	
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body onload="slider.init('sliderl');slider.init('sliderl2');slider.init('sliderr');slider.init('sliderr2'); warning.init('warning')">
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame' width=842 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align=center colspan=3>
						<? write_title_cal($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<?php write_left_accordion($date,-1); ?>
					</td>

					<td bgcolor=#FFFFFF valign=top width=681>
						<table  class="frame" width=100% id='test'  cellpadding=0 cellspacing=0>
							<tr>	
							    <?php  write_flare_prob_img($date) ; ?>
				    	
							</tr>
							<tr>
								<? write_pr_table() ; ?>
							</tr>
							<tr>
								<? write_forecast_paragraph() ; ?>
							</tr>
						</table>
					</td>


					</td>
					<td valign=top align=center width=82>
						<?php write_right_accordion($date) ; ?>
    					</td>
  				</tr>
				<tr>
					<td align=center colspan=3>
						<?php write_bottom_clean() ; ?>
					</td>
				</tr>
			</table>
			<p>
			<?php write_new_ar_table($date) ; ?>
			<?php write_events($date) ; ?>
			<p>
			<hr size=2>
		</center>	
		<center>
			<?php write_footer_new($time_updated) ; ?>
			
		</center>
			
	</body>
</html>
