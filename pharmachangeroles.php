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
 $sidenav = 3;$native = 1;
 include('includes/navcp.php');
 include('includes/sidenav.php');
?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Users&nbsp;&nbsp;<a href="pharmanewuser.php" class="btn btn-primary">Add New User</a></h2>
          <div class="table-responsive">
         
              <?php
			//  $compId = $_SESSION['CompId'];
				$compId = 1;
			//  echo $compId;
			  $query = "SELECT * from pharmacy_user WHERE p_muser = '$compId'";
			  $result = mysql_query($query);
			  $num = mysql_num_rows($result);
			  if($num)
			  {
				  ?>
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>User Name</th>
                          <th>Manager Name</th>
                          <th>Company Name</th>
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
                      <td><?php echo $row['p_userName'];?></td>
                      <td><?php echo $row['p_mangName'];?></td>
                      <td><?php echo $row['p_compName'];?></td>
                      <td>
                      <div class="col-md-6">
                       <select name="UserType" id="UserType_<?php echo $row['p_id']; ?>" class="form-control">
                                <option value="1" <?php if($row['p_usertype'] == 1)echo 'selected'; ?>>Administrator</option>
                                <option value="2" <?php if($row['p_usertype'] == 2)echo 'selected'; ?>>Manager</option>
                             </select>
                             </div>
                             <div class="col-md-5">
                             <button type="button" class="btn btn-primary changeRole" v_id="<?php echo $row['p_id']; ?>">Change</button>&nbsp;&nbsp;<a href="pharmanewuser.php?user=<?php echo $row['p_id']; ?>" class="btn btn-primary">Edit</a>
                             </div>
                      </td>
                    </tr>
				 <?php
				  }?>
                     </tbody>
            </table>
			 <?php }
			 else
			 {
				 echo "No Users are present currently";
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
