<?php 
function xssattack($var) {
	$var = htmlentities($var);
	$var = htmlspecialchars($var);
	$var = strip_tags($var);
	return $var;}
	
function mysqlattack($var) {
    $var = xssattack($var);
	$var = mysql_real_escape_string($var);
	return $var;	
}


function validate_empty($var,$errorv,$custom=''){
	if(empty($var)){
		if($custom == '' ){
		global $error;
		$error .= "<li>You can't leave ".$errorv." empty.</li>";
		}else {
		global $error;
		$error .= "<li>".$custom."</li>";}
	}}
	
function validate_email($var,$custom='') {
	if(!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $var)) {
	if($custom == '' ){
		global $error;
		$error .= "<li>Please enter a valid Email Address</li>";
		}else {
		global $error;
		$error .= "<li>".$custom."</li>";}
	}}

function validate_same($var,$var1,$errorv,$custom=''){
	if($var != $var1) {
		if($custom == '' ){
		global $error;
		$error .= "<li>".$errorv." Do not Match</li>";
		}else {
		global $error;
		$error .= "<li>".$custom."</li>";}
	}}	
	
function remaining_time($var){
	$mins = floor($var/60);
	$hours = floor($var/3600);
	$days = floor($var/86400);
	
	if($days > 0) {
		echo $days.' Days';
	}
	else {
	if($hours > 0) {
		echo $hours.' Hours';
	}else {
		echo $mins.' Minutes';
	}
	}
}

function time_left($integer) 
 {  
     $seconds=$integer;  
     if ($seconds/60 >=1)  
     {  
     $minutes=floor($seconds/60);  
     if ($minutes/60 >= 1)  
     { # Hours  
     $hours=floor($minutes/60);  
  
     if ($hours/24 >= 1)  
  
     { #days  
  
     $days=floor($hours/24);  
  
     if ($days/7 >=1)  
  
     { #weeks  
  
     $weeks=floor($days/7);  
  
     if ($weeks>=2) $return="$weeks Weeks";  
  
     else $return="$weeks Week";  
  
     } #end of weeks  
  
     $days=$days-(floor($days/7))*7;  
  
     if ($weeks>=1 && $days >=1) $return="$return, ";  
  
     if ($days >=2) $return="$return $days days"; 
  
     if ($days ==1) $return="$return $days day"; 
  
     } #end of days 
  
     $hours=$hours-(floor($hours/24))*24;  
  
     if ($days>=1 && $hours >=1) $return="$return, ";  
  
     if ($hours >=2) $return="$return $hours hours"; 
  
     if ($hours ==1) $return="$return $hours hour"; 
  
     } #end of Hours 
  
     $minutes=$minutes-(floor($minutes/60))*60;  
  
     if ($hours>=1 && $minutes >=1) $return="$return, ";  
  
     if ($minutes >=2) $return="$return $minutes minutes"; 
  
     if ($minutes ==1) $return="$return $minutes minute"; 
  
     } #end of minutes  
  
     $seconds=$integer-(floor($integer/60))*60;  
  
     if ($minutes>=1 && $seconds >=1) $return="$return, ";  
  
     if ($seconds >=2) $return="$return $seconds seconds"; 
  
     if ($seconds ==1) $return="$return $seconds second"; 
  
     $return="$return.";  
  
     return $return;  
  
 } 
?>