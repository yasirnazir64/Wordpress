<?php


// Check connection
$user='mangrove_db';
$host ='localhost';
$DB='mangrove_main';
$pass='SaA0wxQllk0]';


$search='http://1-to-n.com/clients/mangroves';
$replaceby='http://207.58.140.127';


$dbon=mysql_connect($host,$user ,$pass) or die (mysql_error());
mysql_select_db($DB ,$dbon ) or die(mysql_error().'error');
$tabl_result = mysql_query("show tables from ".$DB) or die(mysql_error());

while($tablss = mysql_fetch_array($tabl_result))
{
	$table=$tablss[0];
$result = mysql_query("SELECT * FROM ".$table."") or die(mysql_error());
if($table!='mangrove_term_relationships')
while($row = mysql_fetch_array($result))
  {
	  
	$query='UPDATE '.$table.' SET ' ;
	$i=0 ; 
	$q='';
	foreach($row as $k=>$v)  
	 {
		 if($i==1)
		 	$condition=' '. $k .'= '.$v ;
		 $i++ ;
		  $row[$k]=str_replace( $search ,$replaceby,$v);
		  
		  if(!is_numeric($k) and $i > 1)
		  	$q.='`'.$k."` = '".mysql_real_escape_string($row[$k])."' ,";
	 }
	 
	$query.=trim($q,',').' where '.$condition;
	mysql_query($query) or die(mysql_error().'---'.$query);
  }

}


?>
