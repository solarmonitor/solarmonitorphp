<? 
	include ("include.php");
        include("globals.php"); 	
		
	$title = "SolarMonitor News";
	$indexnum = "1";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
	  <? require("common_files/themes.php"); ?>
		<center>
			<table class='frame' width=842 border=0 cellpadding=0 cellspacing=0 align="center">
				<tr>
					<td align="center" colspan=3>
						<? write_title_clean($date, $title, $this_page, $indexnum); ?>
					</td>
				</tr>
				<tr>
					<td valign=top align=center>
						<? write_left_clean(); ?>
					</td>
					<td bgcolor=#FFFFFF valign=top align=center>
						<table width=640>
							<tr>
								<td>
									<table cellpadding=5 cellspacing=5>
									<?
										$file = "common_files/news.txt";
										if (file_exists($file))
										{
											$lines=file($file);
											print("										<b>News:</b>\n");
											foreach($lines as $line)
											{
												list($news_date, $text) = explode('[ ]', $line,2);
												print("										<tr>\n");
												print("											<td align=left width=20% valign=top>\n");
												print("												$news_date\n");
												print("											</td>\n");
												print("											<td align=left>\n");
												print("												$text\n");
												print("											</td>\n");
												print("										</tr>\n");
											}											
										}
										else
										{
											print("No News Found");								
										}
									?>
									</table>
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
			<hr size=2>
		<? write_footer_new($time_updated); ?>
			<p>
		</center>
	</body>
</html>
