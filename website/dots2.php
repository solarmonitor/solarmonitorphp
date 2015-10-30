<?
include("write_ar_table.php");
include("globals.php");
?>
<HTML> 
<HEAD> 
<script src="function_table.js" type="text/javascript" language="javascript"></script> 
</HEAD> 
    <body> 
 <?
	write_new_ar_table(date('Ymd',strtotime('20031101'))); 
?>
    </body> 
</html> 
