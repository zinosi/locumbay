<?php
 ini_set('display_errors','1');
 session_start();
 if(!isset($_SESSION['id']))
 {
	header('location:index.php');
 }
 //include('includes/session.php');
 $title = "Admin HomePage || LocumBay";
 include('includes/header.php');
 include('includes/connect.php');
 
 
?>
</head>
      
<body>
<?php 
 $nav = 1;$native = 1;
 $sidenav =1 ;
 include('includes/navcp.php');
 include('includes/sidenav.php');
?>


</body>
</html>