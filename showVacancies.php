<?php
 ini_set('display_errors','1');
 include('includes/session.php');
 if($_SESSION['type'] == '2')
 {
	  header('location:locumcp.php');
 }
 $title = "LocumBay | Pharmacy Control Panel";
 include('includes/header.php');
 include('includes/connect.php');
?>
<style>

body{background:url(includes/images/whitetexture.png) repeat;}

</style>

</head>
      
<body>

<?php 
 $sidenav = 6;$native = 1;
 include('includes/navcp.php');
 include('includes/sidenav.php');
?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Locum Vacancies&nbsp;&nbsp;<a href="locumvacancy.php" class="btn btn-primary">Add New Vacancy</a></h2>
          <div class="table-responsive">
         
              <?php
			  $compId = $_SESSION['id'];
			  //$compId = 1;
			//  echo $compId;
			$query = "SELECT * FROM locum_vacancy LEFT JOIN pharmacy_branch on locum_vacancy.lv_store=pharmacy_branch.pb_id WHERE locum_vacancy.lv_muser = '$compId'";
	//		  $query = "SELECT * from locum_vacancy WHERE lv_muser = '$compId'";
			  $result = mysql_query($query);
			  $num = mysql_num_rows($result);
			  if($num)
			  {
				  ?>
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Branch Name</th>
                          <th>Start date</th>
                          <th>End Date</th>
                          <th>Description</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
				  <?php $i = 0;
				  while($row = mysql_fetch_assoc($result))
				  {$i++;
					  ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['pb_name'];?></td>
                      <td><?php echo $row['lv_start'];?></td>
                      <td><?php echo $row['lv_end'];?></td>
                      <td><?php echo $row['lv_desc'];?></td>
                      <td>
                             <a href="locumvacancy.php?lv=<?php echo $row['lv_id']; ?>" class="btn btn-primary">Edit</a>&nbsp;<a href="locumvacancy.php?lv=<?php echo $row['lv_id']; ?>" class="btn btn-danger">Deactivate</a>
                      </td>
                    </tr>
				 <?php
				  }?>
                     </tbody>
            </table>
			 <?php }
			 else
			 {
				 echo "No Vacancy is present currently";
			 }
			  ?>
           
          </div>
        </div>
      </div>
    </div>
   <?php include('includes/footer.php'); ?>

	<script>
	$('.changeRole').on('click',function(e){
		e.preventDefault(); 
		var v_id = $(this).attr('v_id');
		var role = $("#UserType_"+v_id).find('option:selected').val();
		//alert(role);
		$.ajax({
		  type: "POST",
		  url: "backend.php",
		//  dataType:"json",
		  data: { 'id': v_id, 'role': role, 'change_role':'1' },
		  success: function(html){
			  alert(html);
		  }
		})
	});
	
	</script>




  </body>
</html>
