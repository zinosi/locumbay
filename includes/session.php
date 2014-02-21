<?php
 session_start();
 if(!isset($_SESSION['type']) && !isset($_SESSION['status']))
 {
	 header('location:signin.php');
 }
?>