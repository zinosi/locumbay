<?php
 include('includes/connect.php');

 if($_POST['flag']=='delete')
 {
	$id = $_POST['id'];
	$col = $_POST['col'];
	$table = $_POST['table'];
	
	$query = "DELETE FROM $table WHERE $col = '$id'";
	mysql_query($query) or die(mysql_error());
	echo json_encode(array('error'=>false,'msg'=> 'Deleted')); 
 }// if($_POST['flag']=='add_country')

 elseif($_POST['flag']=='add_country')
 {
	$conName = $_POST['c_name'];	 
	$query = "SELECT * FROM countries WHERE c_name = '$conName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Country already Exist'));	
	} 
	else{
		$query1 = "INSERT INTO countries (c_name)VALUES('$conName')";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Country Added'));		
	}
	 
 }// if($_POST['flag']=='add_country')

 elseif($_POST['flag']=='change_country')
  {
	$conName = $_POST['c_name'];
	$c_id = $_POST['c_id'];	 
	$query = "SELECT * FROM countries WHERE c_name = '$conName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Country already Exist'));	
	} 
	else{
		$query1 = "UPDATE countries SET c_name='$conName' WHERE c_id = '$c_id'";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Country name changed'));		
	}
	 
 }// if($_POST['flag']=='add_country')
 elseif($_POST['flag']=='add_csinuse')
 {
	$conName = $_POST['c_name'];	 
	$query = "SELECT * FROM csinuse WHERE c_name = '$conName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Already Exist'));	
	} 
	else{
		$query1 = "INSERT INTO csinuse (c_name)VALUES('$conName')";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Added'));		
	}
	 
 }// if($_POST['flag']=='add_country')

 elseif($_POST['flag']=='change_csinuse')
  {
	$conName = $_POST['c_name'];
	$c_id = $_POST['c_id'];	 
	$query = "SELECT * FROM csinuse WHERE c_name = '$conName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Already Exist'));	
	} 
	else{
		$query1 = "UPDATE csinuse SET c_name='$conName' WHERE c_id = '$c_id'";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Name changed'));		
	}
	 
 }// if($_POST['flag']=='add_country')
 
 
  elseif($_POST['flag']=='add_service')
 {
	$psName = $_POST['ps_name'];	 
	$query = "SELECT * FROM pharmacy_services WHERE ps_name = '$psName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Service already Exist'));	
	} 
	else{
		$query1 = "INSERT INTO pharmacy_services (ps_name)VALUES('$psName')";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Service Added'));		
	}
	 
 }// if($_POST['flag']=='add_country')

 elseif($_POST['flag']=='change_service')
  {
	$psName = $_POST['ps_name'];
	$ps_id = $_POST['ps_id'];	 
	$query = "SELECT * FROM pharmacy_services WHERE ps_name = '$psName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Service already Exist'));	
	} 
	else{
		$query1 = "UPDATE pharmacy_services SET ps_name='$psName' WHERE ps_id = '$ps_id'";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Service name changed'));		
	}
	 
 }// if($_POST['flag']=='add_country')

elseif($_POST['flag']=='add_qualifyfrom')
 {
	$qName = $_POST['q_name'];	 
	$query = "SELECT * FROM qualifyfrom WHERE q_name = '$qName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Already Exist'));	
	} 
	else{
		$query1 = "INSERT INTO qualifyfrom (q_name)VALUES('$qName')";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Added'));		
	}
	 
 }// if($_POST['flag']=='add_country')

 elseif($_POST['flag']=='change_qualifyfrom')
  {
	$qName = $_POST['q_name'];
	$q_id = $_POST['q_id'];	 
	$query = "SELECT * FROM qualifyfrom WHERE q_name = '$qName'";
	$resultCon = mysql_query($query);
	$foundCon = mysql_num_rows($resultCon);
	if($foundCon)
	{
	echo json_encode(array('error'=>true,'msg'=> 'Already Exist'));	
	} 
	else{
		$query1 = "UPDATE qualifyfrom SET q_name='$qName' WHERE q_id = '$q_id'";
		mysql_query($query1) or die(mysql_error());
		echo json_encode(array('error'=>false,'msg'=> 'Name changed'));		
	}
	 
 }// if($_POST['flag']=='add_country')
 
 elseif($_POST['flag']=='deactivate')
  {
	
	$id = $_POST['id'];
	$table = $_POST['table'];
	$col = $_POST['col'];$col1 = $_POST['col1'];
	 
	$query = "UPDATE $table SET $col = '0' WHERE $col1 = '$id'";
	mysql_query($query) or die(mysql_error());
	echo json_encode(array('error'=>false,'msg'=> 'De-activated')); 
	 
	 
 }// if($_POST['flag']=='add_country')
 
 elseif($_POST['flag']=='activate')
  {
	
	$id = $_POST['id'];
	$table = $_POST['table'];
	$col = $_POST['col'];$col1 = $_POST['col1'];
	 
	$query = "UPDATE $table SET $col = '1' WHERE $col1 = '$id'";
	mysql_query($query) or die(mysql_error());
	echo json_encode(array('error'=>false,'msg'=> 'Activated')); 
	 
	 
 }// if($_POST['flag']=='add_country')






?>