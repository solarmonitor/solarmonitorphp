<?
// 2010-08-03 (P. Higgins): written	

	include ("include.php");
        include ("globals.php");	
	
	if(isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = "geddsnowcast";
		
	if ($type == "geddsforecast")
	{
		$title = "GEDDS Aurora Forecast ";
	}
	elseif ($type == "geddsnowcast")
	{
		$title = "GEDDS Aurora Now-cast ";
	}
	elseif ($type == "tecmap")
	{
		$title = "Total Electron Content Map ";
	}
	elseif ($type == "kpind")
	{
		$title = "Global KP Index ";
	}
	elseif ($type == "currentaurora")
	{
		$title = "Current Auroral Oval ";
	}
	elseif ($type == "poesmovie")
	{
		$title = "NOAA POES Movie ";
	}
	else
	{
		$type == "kyotoindices";
		$title = "Kyoto AE Indices ";
	}
	
	
	
	$year = substr($date,0,4);
	$yy = substr($date,2,2);
	$month = substr($date,4,2);
	$day = substr($date,6,2);
	
	$curr_date = gmdate("Ymd");
	
	if ($type == "geddsforecast")
	{
		$url = "No forecast available. Check: <a href=http://www.gedds.alaska.edu/AuroraForecast/Default.asp?Date=".$date." target=_blank>http://www.gedds.alaska.edu/AuroraForecast</a>";
		$foundforecast = 0;
		if (@fopen("data/".$dirdate."/meta/arm_aurora_forecast_".$date.".txt", "r")){
			$url = "data/".$dirdate."/meta/arm_aurora_forecast_".$date.".txt";
			$foundforecast = 1;
		}
	}
	elseif ($type == "geddsnowcast")
	{
		$url = "No now-cast available. Check: <a href=http://www.gedds.alaska.edu/auroraforecast/ShortTerm.asp target=_blank>http://www.gedds.alaska.edu/auroraforecast/ShortTerm.asp</a>";
		$foundforecast = 0;
		if (@fopen("data/".$dirdate."/meta/arm_aurora_nowcast_".$date.".txt", "r")){
			$url = "data/".$dirdate."/meta/arm_aurora_nowcast_".$date.".txt";
			$foundforecast = 1;
		}
	}
	elseif ($type == "tecmap")
	{
		if ($date == $curr_date){
			$url = "<br><img width=100% src=http://helios.swpc.noaa.gov/ctipe/plots/CTIPeTEC.png><br><img width=100% src=http://helios.swpc.noaa.gov/ctipe/plots/CTIPeElectronDensity.png><br>";
		}else{
			$url = "<br><img src=common_files/placeholder_630x485.png>";
			if (@fopen("data/".$dirdate."/pngs/iono/tec_map_".$date.".png","r")){
				$url = "<img width=100% src=data/".$dirdate."/pngs/iono/tec_map_".$date.".png><br>";
			}
			if (@fopen("data/".$dirdate."/pngs/iono/elec_map_".$date.".png","r")){
				$url = $url."<img width=100% src=data/".$dirdate."/pngs/iono/elec_map_".$date.".png><br>";
			}
		}
		$foundforecast = 0; //just so it print() instead of include()
	}
	elseif ($type == "kpind")
	{
		if ($date == $curr_date){
			$url = "<br><img width=100% src=http://www.swpc.noaa.gov/rt_plots/Kp.gif><br><br><img width=100% src=http://www-app3.gfz-potsdam.de/kp_index/ql_bar.gif><br><br><img width=100% src=http://gpsweather.meteo.be/dynamic/geomagnetism/hybrid_KP_Prediction/image.php?date=2011-12-08><br>";
		}else{
			$url = "<br><img src=common_files/placeholder_630x485.png>";
			if (@fopen("data/".$dirdate."/pngs/iono/kpindswpc_".$date.".png","r")){
				$url = "<img width=100% src=data/".$dirdate."/pngs/iono/kpindswpc_".$date.".png><br>";
			}
			if (@fopen("data/".$dirdate."/pngs/iono/kpindpots_".$date.".png","r")){
				$url = $url."<img width=100% src=data/".$dirdate."/pngs/iono/kpindpots_".$date.".png><br>";
			}
			if (@fopen("data/".$dirdate."/pngs/iono/kpindfore_".$date.".png","r")){
				$url = $url."<img width=100% src=data/".$dirdate."/pngs/iono/kpindfore_".$date.".png><br>";
			}
		}
		$foundforecast = 0; //just so it print() instead of include()
	}
	elseif ($type == "currentaurora")
	{
		if ($date == $curr_date){
			$novation="http://www.ngdc.noaa.gov/stp/ovation_prime/data/north_nowcast_aacgm.png";
			//"http://sd-www.jhuapl.edu/Aurora/ovation_live/je_north_latest_oval.png";
			$sovation="http://www.ngdc.noaa.gov/stp/ovation_prime/data/south_nowcast_aacgm.png";
			//"http://sd-www.jhuapl.edu/Aurora/ovation_live/je_south_latest_oval.png";
			$npoes="http://www.swpc.noaa.gov/pmap/gif/pmapN.gif";
			$spoes="http://www.swpc.noaa.gov/pmap/gif/pmapS.gif";
		}else{
			if (@fopen("data/".$dirdate."/pngs/iono/poes_oval_".$date.".png","r")){$npoes="data/".$dirdate."/pngs/iono/poes_oval_".$date.".png";}else{$npoes="common_files/placeholder_630x485.png";}
			if (@fopen("data/".$dirdate."/pngs/iono/poes_sout_".$date.".png","r")){$spoes="data/".$dirdate."/pngs/iono/poes_sout_".$date.".png";}else{$spoes="common_files/placeholder_630x485.png";}
			if (@fopen("data/".$dirdate."/pngs/iono/ovation_n_".$date.".png","r")){$novation="data/".$dirdate."/pngs/iono/ovation_n_".$date.".png";}else{$novation="common_files/placeholder_630x485.png";}
			if (@fopen("data/".$dirdate."/pngs/iono/ovation_s_".$date.".png","r")){$sovation="data/".$dirdate."/pngs/iono/ovation_s_".$date.".png";}else{$sovation="common_files/placeholder_630x485.png";}
		}
		$url="<table width=100% height=600 cellspacing=0 cellpadding=0><tr><td><img width=337px src=$novation></td><td><img width=337px src=$sovation></td></tr><tr><td><img width=337px src=$npoes></td><td><img width=337px src=$spoes></td></tr></table>";
		$foundforecast = 0; //just so it print() instead of include()
	}
	elseif ($type == "poesmovie")
	{
		$url = "<br><img src=common_files/placeholder_630x485.png>";
//view-source:http://www.animatedengines.com/otto.shtml
		if (@fopen("data/".$dirdate."/mpgs/iono/poes_n_".$date.".gif","r")){
			$url = '<div class="aeplayer aepframes_40" style="width: 450px; height: 400px; background: url('.'http://solarmonitor.org/data/'.$dirdate.'/mpgs/iono/poes_n_'.$date.'.gif'.') repeat scroll"></div>';}//0px -8145px//
			//$url = '<div id="container"><div id="content"><div class="aeplayer aepframes_24" style="width: 450px; height: 400px; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-image: url('.'http://solarmonitor.org/data/'.$date.'/mpgs/iono/poes_n_'.$date.'.gif'.'); background-position: 0px -1629px; background-repeat: initial initial; "></div></div></div>';}
			//<div class="aep_panel"><button class="playpause pause"></button><button class="prev"></button><div class="slider"><div class="knob" style="position: relative; left: 64.5px; "></div></div><button class="next"></button><span class="slabel">Speed 10 fps</span></div>
			//$url = '<div class="aeplayer aepframes_24" style="width: 450px; height: 400px; background: url('.'http://solarmonitor.org/data/'.$date.'/mpgs/iono/poes_n_'.$date.'.gif'.')"></div>';}
			//$url = "<img src=data/".$dirdate."/mpgs/iono/poes_n_".$date.".gif><br>";}
		$foundforecast = 0; //just so it print() instead of include()
	}
	else
	{
		if ($date == $curr_date){
			$url = "&nbsp;<br><img width=650 src=http://wdc.kugi.kyoto-u.ac.jp/ae_realtime/today/rtae_".$date.".png><br>&nbsp;";
		}else{
			$url = "&nbsp;<br><img src=common_files/placeholder_630x485.png><br>&nbsp;";
			if (@fopen("data/".$dirdate."/pngs/iono/kyoto_indices_".$date.".png","r")){
				$url = "&nbsp;<br><img width=100% src=data/".$dirdate."/pngs/iono/kyoto_indices_".$date.".png><br>&nbsp;";
			}
		}
		$foundforecast = 0; //just so it print() instead of include()
	}
	
//	if ($date > $curr_date+5)
//		$url = "No forecast available. Check: <a href=http://www.gedds.alaska.edu/AuroraForecast/Default.asp?Date=".$date." target=_blank>http://www.gedds.alaska.edu/AuroraForecast</a>";

function get_text($filename)
{
	$fp_load = fopen("$filename", "rb");
	
	if ( $fp_load )
	{
		while ( !feof($fp_load) )
		{
			$content .= fgets($fp_load, 8192);
		}
	
		fclose($fp_load);
		return $content;
	}
}

//print($url." ");
//print($date." ");
//print($curr_date);

?>
<html>
	<? write_header($date, $title, $this_page) ?>
<!--  	<head>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="refresh" content="300">
		<title><? print($title); ?>( Updates dynamically every 5-mins) </title>
		<link rel=stylesheet href="./common_files/arm-style.css" type="text/css">
		
		<!-- <link rel="stylesheet" href="css/main.css" type="text/css" media="screen"> 
		<link rel="stylesheet" href="./common_files/js_gifplayer/aeplayer.css" type="text/css">
		<script type="text/javascript" src="./common_files/js_gifplayer/menu.js"></script>
		<script type="text/javascript" src="./common_files/js_gifplayer/aeplayer.js"></script>
		<script type="text/javascript">
		
			window.onload = function() {
				aemenu.init("icmenu", "icact");
				aemenu.init("stmenu", "stact");
				aemenu.init("simenu", "siact");
				aemenu.init("abmenu", "abact");
				aep.makeAllPlayers();
			}
		
		</script>
		
	</head> -->
	<body>
		<table class='frame' width="674" height="575" align=left valign=middle border=0 cellspacing=0 cellpadding=0 border=0>
			<tr>
				<td align=center>				
					<? write_title_cal1($date, $title, $this_page, $indexnum="1", $type=$type, $width="95%");?>
				</td>
			</tr>
			<tr>
				<td height=500 align=center>
					<div class="textbox">
					<?
					
					if ($foundforecast == 0){
						print($url);
					}
					else{
						//include($url);
						//Extract Aurora info Meta Data.
						$aurmetalines = file($url);
						list($dummy, $datevld) = split('[;]', $aurmetalines[1], 8);
						list($dummy, $condition) = split('[;]', $aurmetalines[2], 8);
						list($dummy, $level) = split('[;]',$aurmetalines[3]);
						$level = preg_replace( "/\s*/m","", $level );
						//Construct Image Name.
						$aurimg="common_files/aurora/aurora_world_".$level.".png";
						//Extract Condition Description.
						$aurdescriptfile="common_files/aurora_description.txt";
						$aurdescriptlines = file($aurdescriptfile);
						
						if ($type == "geddsnowcast"){
							$aurdescript=$aurdescriptlines[$level+13];
							
							print("<b>Current Auroral Oval: Level ".$level." - ".$condition."</b><br>");
							print("<img src=".$aurimg." width=70%><br><br>");
							print("<b>".$datevld."</b><br>");
							print($aurdescript);
						}
						if ($type == "geddsforecast"){
							$aurdescript=$aurdescriptlines[$level+1];
							
							print("<b>Auroral Oval Forecast: Level ".$level." - ".$condition."</b><br>");
							print("<img src=".$aurimg." width=70%><br><br>");
							print("<b>".$datevld."</b><br>");
							print($aurdescript);
						}
					}
					?>
					</div>
					<br>
				</td>
			</tr>
			<tr><td height=50> </td></tr>
		</table>	
		
		<!-- *********************************************************
			 * You may use this code for free on any web page provided that 
			 * these comment lines and the following credit remain in the code.
			 * Floating Div from http://www.javascript-fx.com
			 ********************************************************  -->
		<div id="divBottomLeft" style="position:absolute;">
		<!-- Start - put your content here --->
			<table class='frame' align=center height="50" width="674">
					<tr>
						<td  valign=top align=center><div class=textbox><b>
							Aurora: <a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=currentaurora">Image</a>&nbsp;/&nbsp;
							<a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=geddsnowcast">Now-cast</a>&nbsp;/&nbsp;
							<a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=geddsforecast">Forecast</a>&nbsp;/&nbsp;
							<a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=poesmovie">Movie</a>
							<br>Global: <a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=kyotoindices">AE</a>&nbsp;/&nbsp;
							<a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=kpind">KP (Now/Forecast)</a>&nbsp;/&nbsp;
							<a class=mail href="./aurora_pop.php?date=<? print $date ?>&type=tecmap">TEC</a>
						</font></b></div></td>
					</tr>
			</table>

		<!-- End   - put your content here --->
		</div>
		
		<script type="text/javascript">
		var ns = (navigator.appName.indexOf("Netscape") != -1);
		var d = document;
		function JSFX_FloatDiv(id, sx, sy,xtab,ytab)
		{
			var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			var px = document.layers ? "" : "px";
			window[id + "_obj"] = el;
			if(d.layers)el.style=el;
			el.cx = el.sx = sx;
			el.cy = el.sy = sy;

			el.sP=function(x,y){this.style.left=x+px;
								this.style.top=y+px;};
		
			el.floatIt=function()
			{
				var pX, pY;
				pX = (this.sx >= 0) ? 0 : ns ? innerWidth : 
				document.documentElement && document.documentElement.clientWidth ? 
				document.documentElement.clientWidth : document.body.clientWidth;
				pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ? 
				document.documentElement.scrollTop : document.body.scrollTop;
				if(this.sy<0) 
				pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ? 
				document.documentElement.clientHeight : document.body.clientHeight;
				this.cx += (pX + this.sx*window.innerWidth - this.cx - xtab)/8;
				this.cy += (pY + this.sy*window.innerHeight - this.cy - ytab)/8;
				this.sP(this.cx, this.cy);
				setTimeout(this.id + "_obj.floatIt()", 40); //40);
			}
			return el;
		}
		//input width % to shift div by, and height % to shift div down by.
		//1 = 100% which is the bottom of the page, or right of page.
		//3rd and 4th inputs are width and height of div menu, respectively.
		JSFX_FloatDiv("divBottomLeft", .01,.99,0,50).floatIt();
		</script>
	<!--8,550-->
	
	<br><br><br><br><br><br>
	</body>
</html>
