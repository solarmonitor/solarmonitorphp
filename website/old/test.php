<?php
include("functions.php");
include("globals.php");
include("scrape_functions.php");
print "<br><h1> variables </h1><br>";
echo date("M d Y H:i:s");
echo gmdate("M d Y H:i:s");
echo gmdate("M d Y H:i:s",time());
print "<br>";
echo date ("H:i",250);
$times = array(123,22);
print "<br>";
echo $times[1]*2;
print "<br>";
$i = 1;
$ll = array();
  for($j=0;$j<count($times)-1;$j++)
    {
      $ll[] = $times[$i]-$times[$j];
      echo $ll[$j];
print "<br>";
      $i++;
    }
$kk = '';
$kk =  (min($ll) > 30 || $ll == NULL)?30:min($ll);
  echo "kk=".$kk."<br>";
print " &nbsp;\n";
print "<br>";
//include("write_index_regions.php");
//include("write_index_body_slider.php");
//$region = "11063";
//$date =  arsql_search($region);

// testing ticker output
$items = array();
$items[] = scrape_ticker_activity_level($date);
$items[] = scrape_ticker_most_active_region($date);
$items[] = scrape_ticker_most_likely_to_flare($date);
//var_dump($items);
print("<ul>\n");
for($i=0;$i < count($items);$i++){
  print("  <li class=\"news-item\"><a href=\"".$items[$i]["link"]."\">");
  print($items[$i]["text"]."</a></li>\n");
}
print("</ul>\n");
echo $date;
//print $date;
print "		<form name=\"ARSearch\">\n";
print "		<font size=3 color=\"white\"><b><input type=\"text\" size=\"5\" name=\"region\" value=\"\" class=\"ar_box\" onchange=\"this.ar.submit();\" > \n";
print "		</b></font></form>\n";
//write_index_body_slider($date,"1","ar","11287");
if ($region) {
  print "<br> Region exists <br>"; 
  print $region." starts day:".$date ;
}
?>

<table border=1>
<tr>
  <td> hola </td><td colspan="3">hola2</td>
</tr>
<tr>
  <td> hola </td><td>hola2</td>  <td> hola </td><td>hola2</td>
</tr>
</table>
