<? 
include ("../../include.php");
?>
<html>
	<head>
		<title>Tabbed content</title>
		<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js'></script>

		<link href='css/tabbedContent.css' rel='stylesheet' type='text/css' />
		<script src="js/tabbedContent.js" type="text/javascript"></script>
	</head>

	<body>
	
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

	</body>
</html>
