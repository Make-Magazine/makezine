<?php

// redirect broken URLs to this script
// usage: redirects.php?url=/path/
// testing: http://dev.nobisi.com/make/r.php?url=
// check for _ + etc
// ^(.*)\_(.*)$ /r.php?url=$1-$2
// ^(.*)\+(.*)$ /r.php?url=$1-$2
// ^(.*)\s(.*)$ /r.php?url=$1-$2

function clean($string) {
   $string = str_replace(' ', '-', $string); // space to -
   $string = "/".$string."/"; // add slash to beginning and end
   $string = preg_replace('~/+~', '/', $string); // get rid of multiple slashes
   $string = preg_replace('/[^A-Za-z0-9\/\-]/', '-', $string); // remove specials
   return preg_replace('/-+/', '-', $string); // only one hyphen in a row
}

$path = html_entity_decode($_GET['url']);
$path = str_replace(array("http://makezine.com","http://www.makezine.com"), "", $path);
$process = clean($path);
$process = str_replace("/-", "", $process);
$process = str_replace("/-/", "", $process);
$process = str_replace("-/", "/", $process);
//echo $process; die; // testing, debug

header("HTTP/1.1 301 Moved Permanently"); 
header("Location: http://makezine.com".$process); 

?>