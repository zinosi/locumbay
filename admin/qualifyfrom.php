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
 $sidenav =3 ;

?>
            <?php    include('includes/navcp.php'); ?>
             
            <?php     include('includes/sidenav.php'); ?>
             
            
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                
                           
          <form class="form-horizontal" role="form" method="post" id="registerform" action="#">
              	<div class="form-group col-md-12">
                	 <label for="conName" class="col-md-2 control-label">Qualify From :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="conName" id="conName" class="form-control col-md-12">
               		 </div>
                     <div class="col-md-3">
                     <button type="button" class="btn btn-primary" id="addCon">Enter</button>
                     </div>
                     
                     </div>
          </form>
                     
                     <div class="table-responsive">
         
              <?php
			//  $compId = $_SESSION['CompId'];
				$compId = 1;
			//  echo $compId;
			  $query = "SELECT * from qualifyfrom ORDER BY q_name ASC";
			  $result = mysql_query($query);
			  $num = mysql_num_rows($result);
			  if($num)
			  {
				  ?>
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Qualify From</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
				  <?php $i = 0;
				  while($row = mysql_fetch_assoc($result))
				  {$i++;
					  ?>
                          <tr  id = "tr_<?php echo $row['q_id']; ?>">
                      <td><?php echo $i;?></td>
                      <td q_id="<?php echo $row['q_id'];?>" class="col-md-4"> 
                      <input type="text" name="compnumb" id="conname_<?php echo $row['q_id'];?>" class="form-control" value="<?php echo $row['q_name'];?>">
                      </td>
                      <td > <button type="button" class="btn btn-primary changeCon" v_id="<?php echo $row['q_id']; ?>">Change</button> <button type="button" class="btn btn-primary deleteCon" v_id="<?php echo $row['q_id']; ?>">Delete</button> </td>
                   		 </tr>
				 <?php
				  }?>
                     </tbody>
            </table>
			 <?php }
			 else
			 {
				 echo "No Services are present currently";
			 }
			  ?>
           
          </div>
                     
                     
             
                

          </div>


   <?php include('includes/footer.php'); ?>

	<script>
	$('#addCon').on('click',function(e){
		var q_name = $('#conName').val();
	
		//alert(role);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'q_name': q_name, 'flag': 'add_qualifyfrom'},
		  success: function(html){
			  alert(html.msg);
			  window.location.reload();
		  }
		})
	});
	
	$('.changeCon').on('click',function(e){
		var q_id = $(this).attr('v_id');
	    var q_name = $('#conname_'+q_id).val();
		//alert(q_id);alert(q_name);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'q_name': q_name,'q_id': q_id, 'flag': 'change_qualifyfrom'},
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
		  data: { 'id': id,'table': 'qualifyfrom','col':'q_id', 'flag': 'delete'},
		  success: function(html){
			  alert(html.msg);
			  $('#tr_'+id).remove();
			  
		  }
		})
	});
	
	</script>


</body>
</html>