<? 
	include ("include.php");
        include("globals.php"); 
        if (isset($_GET['code']))
	  {
	    $code = $_GET['code'];
	  }
	else
	  { $code = '';}

        if ($code == 'SMART')
	  {
	    $type = "smrt_maglc";
	    $indexnum = "1";
	    $title = "SMART Magnetic Structure Detections";
	  }
        elseif ($code == 'CHARM')
	  {
	    $type = "char_euv";
	    $indexnum = "1";
	    $title = "CHARM Coronal Hole Group Detections";	    
	  }
  
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame' width=842 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align="center" colspan=3>
						<? write_title_clean($date, $title, $this_page, $indexnum, $type); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_clean($date,-1	); ?>
					</td>
					<td bgcolor=#FFFFFF  valign=top>
						<table cellpadding=15>
							<tr>
								<td align=left width=640>
	  <? include('common_files/'.$code.'_info.html') ?>

								</td>
							</tr>
						</table>
					</td>
					<td valign=top align=center>
						<? write_right_clean($date); ?>
					</td>
				</tr>
				<tr>
					<td align=center colspan=3>
						<? write_bottom_clean($date); ?>
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
