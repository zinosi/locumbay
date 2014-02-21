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
 $sidenav =5 ;

?>
            <?php    include('includes/navcp.php'); ?>
             
            <?php     include('includes/sidenav.php'); ?>
             
            
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                
                           
          <form class="form-horizontal" role="form" method="post" id="registerform" action="#">
              	<div class="form-group col-md-12">
                	 <label for="conName" class="col-md-2 control-label">CS in use Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="conName" id="conName" class="form-control col-md-12">
               		 </div>
                     <div class="col-md-3">
                     <button type="button" class="btn btn-primary" id="addCon">Enter CS</button>
                     </div>
                     
                     </div>
          </form>
                     
                     <div class="table-responsive">
         
              <?php
			//  $compId = $_SESSION['CompId'];
				$compId = 1;
			//  echo $compId;
			  $query = "SELECT * from csinuse ORDER BY c_name ASC";
			  $result = mysql_query($query);
			  $num = mysql_num_rows($result);
			  if($num)
			  {
				  ?>
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>CS in Use</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
				  <?php $i = 0;
				  while($row = mysql_fetch_assoc($result))
				  {$i++;
					  ?>
                     <tr id = "tr_<?php echo $row['c_id']; ?>">
                      <td><?php echo $i;?></td>
                      <td c_id="<?php echo $row['c_id'];?>" class="col-md-4"> 
                      <input type="text" name="compnumb" id="conname_<?php echo $row['c_id'];?>" class="form-control" value="<?php echo $row['c_name'];?>">
                      </td>
                      <td > <button type="button" class="btn btn-primary changeCon" v_id="<?php echo $row['c_id']; ?>">Change</button> <button type="button" class="btn btn-primary deleteCon" v_id="<?php echo $row['c_id']; ?>">Delete</button></td>
                    </tr>
				 <?php
				  }?>
                     </tbody>
            </table>
			 <?php }
			 else
			 {
				 echo "No Countries are present currently";
			 }
			  ?>
           
          </div>
                     
                     
             
                

          </div>


   <?php include('includes/footer.php'); ?>

	<script>
	$('#addCon').on('click',function(e){
		var c_name = $('#conName').val();
	
		//alert(role);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'c_name': c_name, 'flag': 'add_csinuse'},
		  success: function(html){
			  alert(html.msg);
			  window.location.reload();
		  }
		})
	});
	
	$('.changeCon').on('click',function(e){
		var c_id = $(this).attr('v_id');
	    var c_name = $('#conname_'+c_id).val();
		//alert(c_id);alert(c_name);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'c_name': c_name,'c_id': c_id, 'flag': 'change_csinuse'},
		  success: function(html){
			  alert(html.msg);
			  window.location.reload();
		  }
		})
	});
	
	$('.deleteCon').on('click',function(e){
		var id = $(this).attr('v_id');
		//alert(c_id);alert(c_name);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'id': id,'table': 'csinuse','col':'c_id', 'flag': 'delete'},
		  success: function(html){
			  alert(html.msg);
			  $('#tr_'+id).remove();
			  
		  }
		})
	});
	
	</script>


</body>
</html>