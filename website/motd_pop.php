<?
	include ("include.php");
        include ("globals.php");	
	
	$title = "Max Millenium Message of the Day";
?>
<html>
	<? write_header($date, $title, $this_page) ?>
<!-- 	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<title><? print($title); ?></title>
		<link rel=stylesheet href="./common_files/arm-style.css" type="text/css">
	</head>  -->
	<body>
		<table class='frame' width="670" height="575" align=center valign=middle border=0 cellspacing=0 cellpadding=0>
			<tr>
				<td align=center>
					<? write_title_cal1($date, $title, $this_page, NULL, $indexnum="1", $width="100%"); ?>
				</td>
			</tr>
			<tr>
				<td align=left valign=top height=100% bgcolor="#FFFFFF">
					<br>
					<?
						$file = "${arm_data_path}data/$dirdate/meta/arm_mmmotd_${date}.txt";
						if(file_exists($file))
						{
							//print("<pre>\n");
							print("\n");
							$lines = file($file);
							foreach($lines as $line)
							{
								$part_line = $line;
								$count = substr_count($line, "<A");
								for($i=0;$i<$count;$i++)
								{
									$pos=strpos($part_line, "<A");
									$line=substr_replace($line, "<a class=mail2", $pos,2);
									
								}
								print("$line\n");
							}														
						}
						else
						{
							$date_str = date("D F d, Y",strtotime($date));
							print("<br>No Message of the Day for<br>$date_str");
						}
					?>
				</td>
			</tr>
			<tr>
				<td align=center>
						  <? write_bottom_clean(); ?>
				</td>
			</tr>			  
		</table>
	</body>
</html>