<?php

require_once('workflows.php');
$w = new Workflows();
$fp = fopen('http://files.domi-online.de/insertTags.csv', 'r');
$results = array();
$i=0;
while (!feof($fp)) {
    $row = fgetcsv($fp,0,';');
    $temp = array(
  		'uid' => $i,
  		'arg' => $row[0],
  		'title' => $row[0],
  		'subtitle' => $row[1],
  		'icon' => 'icon.png',
  		'valid' => 'yes',
  		'autocomplete' => 'autocomplete'
  	);
    
    array_push( $results, $temp );
    $i++;
}
fclose($fp);

if(!empty($in)){
  $in = explode(' ',$in);
  foreach ($results as $key => $value){
  	$getItem = true;
  	foreach($in as $input){
  		if(!empty($input)){
	  		if(strpos(strtolower($value['title']),strtolower($input)) === false && strpos(strtolower($value['subtitle']),strtolower($input)) === false) {
		  		$getItem = false;
		  	}	
  		}
  	}
  	if($getItem === false){
	  	unset($results[$key]);
  	}
  } 
}
echo $w->toxml( $results );

?>