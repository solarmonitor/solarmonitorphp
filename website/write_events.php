<?
	/*
	Function:
		write_events
	
	Purpose:
			Displays non-active region associated events.  This reads input from a file in the
		data folder called na_events.txt.  if there are no events, this file should have the word, none.
		otherwise, the format of the file should be (space delimited):
			URL CLASS_TIME_STRING
			URL CLASS_TIME_STRING
			...
			/
			...
			URL CLASS_TIME_STRING
			URL CLASS_TIME_STRING
		where the ... represents any number of events.  the / representing the previous days data is not
		required, neither is the previos days data.
	
	Parameters:		
		Input:
			date -- the date in YYYYMMDD format for which to display from
		Output:
			none
	
	Author(s):
		Russ Hewett -- rhewett@vt.edu
	
	History:
		2004/07/15 (RH) -- written
	*/
	
	function write_events($date)
	{
		include ("globals.php");
		
		//	start the display
		print("<table width=780>\n");
		print("	<tr>\n");
		print("		<td align=\"left\"><font size=\"-1\">\n");
		
		//	check and see if the required data file exists.  if it doesnt, display a friendly message
		$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_na_events_" . $date . ".txt";
		if (file_exists($file))
		{
			//	read in all the lines of the file.  if the first line is "none", there is no out put.  
			//	display a message as such.  otherwise, loop through each line of the file.
			$lines=file($file);
			$line=$lines[0];
			if ($line[0] == "n")
			{
				print("		<p><b><i>Events not associated with currently named NOAA regions: None</b></i> \n");
			}
			else
			{
				print("		<p><b><i>Events not associated with currently named NOAA regions:</b></i> \n");
				foreach($lines as $line)
				{
					//	if a / is encounted, print the /.  otherwise, print a hyperlink to the event url
					if ($line[0] == "/")
					{
						$col = "#58ACFA";
					}
					else
					{
						list($url, $data) = split('[ ]', $line, 2);
						print("<a class=mail2 style=\"color:$col ;\" href=javascript:OpenLastEvents(\"$url\")>$data</a>");
						$col = "#0000FF";
					}	
				}
			}
		}
		else
		{
			print("		<p><b><i>Events not associated with currently named NOAA regions: No Data Available</b></i> \n");
		}

		//	close up the formatting of the events portion of the table
		print("			</font></td>\n");
		print("			</tr>\n");
		print("			<tr>\n");
		print("				<td align=\"left\"><font size=\"-1\">\n");
		
		//	if the update times file exists, print the footer of the table with the sentence from the old arm site.
		//	otherwise, print it without times available.
		$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_issue_time_" . $date . ".txt";	
		
		if (file_exists($file))
		{
			$times = file($file);
			$time1 = $times[0];
			$time2 = $times[1];
		}
		else
		{	
			$time1 = "some time";
			$time2 = "some time";
		}
		print("				<p><i><b>Note:</b></i> The tabulated data are based on the most recent NOAA/USAF Active Region Summary issued on $time1. The greyed out and light-blue entries are values from the previous day. Slashed cells indicate that the active region has no spots. The latest positions of the active regions are given in both heliographic and heliocentric co-ordinates. The region positions are valid on $time2 .\n");
		print("				</font></td>\n");
		print("			</tr>\n");
		print("		</table>\n");
	}

function write_ch_events($date)
	{
		include ("globals.php");
		
		//	start the display
		print("<table width=780>\n");
		print("	<tr>\n");
		print("		<td align=\"left\"><font size=\"-1\">\n");

		$file = "${arm_data_path}data/" . $dirdate . "/meta/arm_ar_summary_issue_time_" . $date . ".txt";	
		
		if (file_exists($file))
		{
			$time = $times[1];
		}
		else
		{	
			$time = "some time";
		}
		print("				<p><i><b>Note:</b></i> Solar Monitor's coronal hole segmentations are performed by CHIMERA, a copy of which is available at: github.com/solarmonitor/solarmonitoridl/idl. An extensive copy of coronal hole properties are available at: solarmonitor.org/data. The latest positions of the coronal holes are given in heliocentric co-ordinates. The region positions are valid on $time .\n");
		print("				</font></td>\n");
		print("			</tr>\n");
		print("		</table>\n");
	}
?>
