<?php

        function arsql_search($region)
	{
	  print "<br> sql_search <br>";
$region = "11263";
	  print $region;
	  print "<br>";
	  class ARDB extends SQLite3{
	    function __construct(){
	      $this->open('data/ar_db.sqlite');
	    }
	  }

	  $var = new ARDB();
	  $result= $var->query('SELECT date FROM regions WHERE number="'.$region.'"');
	  $date =  $result->fetchArray();
	  $date = $date['date'];
	  print $date;
	  var_dump($result);
	  if($result){
	    return $date;
	    	  }




	  //$db = new SQLite3('./data/ar_db.sqlite');
	  //var_dump($db);
	  //var_dump($db->querySingle('SELECT date FROM regions WHERE number="11763"'));
	  //print_r($db->querySingle('SELECT date FROM regions WHERE number="'.$region.'"', true));

 }
?>