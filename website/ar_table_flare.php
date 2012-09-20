<?
$error = 0;
              if (isset($_GET['region']) && isset($_GET['date']))
                  {
                    $region = $_GET['region'];
                    $date = $_GET['date'];
		  }
	      else
		{
		  $error = 1;
		}

include ("globals.php");
include("write_new_ar_table.php");
$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_" . $date . ".txt";
if (file_exists($file))
  {
    $lines = file($file);
    foreach ($lines as $line)
      {
	list($number, $location1, $location2, $hale, $mcintosh, $area, $nspots, $events ) = split('[ ]', $line, 8);
	if ($number == $region)
	  {
	    if ($events[0] != "-")
	      {
		$today_t=array();
		$tomorrow_t=array();
		$today_c=array();
		$tomorrow_c=array();
		$today_s=array();
		$tomorrow_s=array();
		$y = 0;
		$events_arr = split('[ ]', $events);
		for($i=0; $i<count($events_arr); $i++)
		  {
		    //	if there is a slash, add it to the string.  otherwise, get the url and the data that follows
		    //	one array index behind.  incriment the array counter.  add the correct hyperlink to the string.
		    if ($events_arr[$i] == "/")
		      {
			$y = 1;
		      }
		    else
		      {
			$url = $events_arr[$i];
			$data = $events_arr[$i+1];
			list($size,$time) = split('[(]', $data,2);
			$time = (strtotime(substr($time,0,5))-strtotime("00:00"))/60.;  //time in minutes from midnight.
			if ($y == 1)
			  {
			    $yesterday_t[] = $time;
			    $yesterday_c[] = substr($size,0,1);
			    $yesterday_s[] = substr($size,1);  
			  }
			else
			  {
			    $today_t[] = $time;
			    $today_c[] = substr($size,0,1);
			    $today_s[] = substr($size,1);
			  }
			$i++;
		      }
		  }
		create_plot_flares($today_t,$today_c,$today_s,$yesterday_t,$yesterday_c,$yesterday_s);
	      }
	  }
      }
  }


?>