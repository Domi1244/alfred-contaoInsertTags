<?php

require_once('workflows.php');
$w = new Workflows();
$fp = fopen('http://files.domi1244.de/insertTags-3afe5bizOD.csv', 'r');
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
  foreach ($results as $key => $value){
  	if(strpos(strtolower($value['title']),strtolower($in)) === false && strpos(strtolower($value['subtitle']),strtolower($in)) === false) {
  		unset($results[$key]);
  	}
  } 
}
echo $w->toxml( $results );

?>