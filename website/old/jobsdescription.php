<?
	include ("include.php");
	if (isset($_GET['offer']))
		$offer = $_GET['offer'];
	$title = "SolarMonitor Jobs";
	$indexnum = "1";
?>

<html>
	<? write_header($date, $title, $this_page) ?>
	<body>
		<center>
			<table background=common_files/brushed-metal.jpg width=815 border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td background=common_files/brushed-metal.jpg align=center colspan=3>
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
										$file = "common_files/jobs/".$offer.".txt";
										if (file_exists($file))
										{
											$lines=file($file);
											foreach($lines as $line)
											{
												list($title, $text) = split('[|]', $line,2);
												print("										<tr>\n");
												print("											<td align=left valign=top width=20%>\n");
												print("												<b><font color=\"gray\">$title</font></b>\n");
												print("											</td>\n");
												print("											<td align=left>\n");
												print("												$text</a>\n");
												print("											</td>\n");
												print("										</tr>\n");
											}											
										}
										else
										{
											print("No Jobs Found");								
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
