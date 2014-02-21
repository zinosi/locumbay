<?php
 ini_set('display_errors','1');
 include('includes/connect.php');
 if(isset($_POST['change_role']))
 {
	 $id = $_POST['id'];
	 $role = $_POST['role'];
	 
	 $query = "UPDATE pharmacy_user SET p_usertype = '$role' WHERE p_id = '$id'";
	 $result = mysql_query($query);
	 if($result)
	 {
		 echo json_encode(array('error'=>false, 'msg'=>'Role changed'));
	 }
	 else
	 {
		 echo json_encode(array('error'=>true, 'msg'=>'Some problem occured.Pleae try again later.'));
	 }
 }
?>