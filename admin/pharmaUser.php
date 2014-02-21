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
 if(isset($_GET['pageNum'])){$pageNum = $_GET['pageNum'];}
 else{$pageNum = 1;}
 
 
 
?>

</head>
      
<body>
<?php 
 $nav = 1;$native = 1;
 $sidenav =6;

?>
            <?php    include('includes/navcp.php'); ?>
             
            <?php     include('includes/sidenav.php'); ?>
             
            
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                
                           
         <!-- <form class="form-horizontal" role="form" method="post" id="registerform" action="#">
              	<div class="form-group col-md-12">
                	 <label for="conName" class="col-md-2 control-label">CS in use Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="conName" id="conName" class="form-control col-md-12">
               		 </div>
                     <div class="col-md-3">
                     <button type="button" class="btn btn-primary" id="addCon">Enter CS</button>
                     </div>
                     
                     </div>
          </form>-->
                     
                     <div class="table-responsive">
         
              <?php
			  
			  $start = ($pageNum*2)-2;
			  $end = $start+2;
			//  $compId = $_SESSION['CompId'];
				$compId = 1;
			//  echo $compId;
			  $query = "SELECT * from pharmacy_user ORDER BY p_id ASC LIMIT $start,$end";
			  $result = mysql_query($query);
			  $num = mysql_num_rows($result);
			  if($num)
			  {
				  ?>
                     <table class="table table-striped">
                      <tbody>
				  <?php $i = 0;
				  while($row = mysql_fetch_assoc($result))
				  {$i++;
					  ?>
                     <tr id = "tr_<?php echo $row['p_id']; ?>">
                      <td c_id="<?php echo $row['p_id'];?>" class="col-md-12"> 
                     
                     <div class="row"> 
                     	<div class="col-md-12"><center><b><?php echo $row['p_compName'];?></b></center></div><br/>
                     	<div class="col-md-2">
                      		 
                        	<img src="http://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/twDq00QDud4/s120-c/photo.jpg" alt="Alternate Text" class="img-responsive">
                     	</div>
                        <div class="col-md-3 col-md-offset-1">
                        <?php echo $row['p_mangName'].' '.$row['p_managerLName'];?><br/>
                        	Username : <?php echo $row['p_userName'];?><br/>
                            Password : *********<br/>
                            Email : <?php echo $row['p_emailadd'];?><br/>
                            Vat Number : <?php echo $row['p_vatnum'];?><br/>
                            Company Number : <?php echo $row['p_compnum'];?><br/>
                            CS in Use : <?php $csinuse = $row['p_compinuse'];
							
								$query_ = "SELECT c_name FROM csinuse WHERE c_id='$csinuse'";
								$result_ = mysql_query($query_);
								$num_ = mysql_num_rows($result_);
								if($num_)
								{
								$rows1 = mysql_fetch_assoc($result_);
								echo $rows1['c_name'];	
								}
							?><br/>
                        
                     	</div>
                     	 <div class="col-md-3 col-md-offset-1">
                         	<?php echo $row['p_housenum'];?><br/>
                         	<?php if($row['p_address']!=''){echo $row['p_address'].'<br/>';}?>
                         	<?php echo $row['p_postcode'];?><br/>
                            <?php echo $row['p_city'];?><br/>
                            <?php $country = $row['p_country'];
							
								$query_ = "SELECT c_name FROM countries WHERE c_id='$country'";
								$result_ = mysql_query($query_);
								$num_ = mysql_num_rows($result_);
								if($num_)
								{
								$rows1 = mysql_fetch_assoc($result_);
								echo $rows1['c_name'];	
								}
							?><br/>
                            <?php echo $row['p_telnum'];?><br/>
                         </div>
                         
                        <div class="col-md-2">
                         
                         <?php if($row['p_status']==1){?>
                         
                         <button type="button" class="btn btn-danger btn-large deactive" id="deac_<?php echo $row['p_id'];?>" v_id="<?php echo $row['p_id']; ?>">De-activate</button>
                          <button type="button" class="btn btn-success btn-large active" id="ac_<?php echo $row['p_id'];?>" style="display:none;" v_id="<?php echo $row['p_id']; ?>">Activate</button>
                         <?php }else{?>
                         <button type="button" class="btn btn-danger btn-large deactive" id="deac_<?php echo $row['p_id'];?>" style="display:none;" v_id="<?php echo $row['p_id']; ?>">De-activate</button>
                          <button type="button" class="btn btn-success btn-large active" id="ac_<?php echo $row['p_id'];?>"  v_id="<?php echo $row['p_id']; ?>">Activate</button>
                         <?php } ?>
                         </div>
                        
                     </div>
                     
                     
                     
                     
                      </td>
                     
                    </tr>
				 <?php
				 $check=$pageNum-1;
				 $check_=$pageNum+1;
				  }?>
                     </tbody>
            </table>
           
            <center><ul class="pagination"><li><a href="pharmaUser.php?pageNum=<?php if($check){echo $check;}else{echo 1;} ?>">&laquo;</a></li>
            <?php 
			 $query = "SELECT * from pharmacy_user";
			  $result = mysql_query($query);
			  $num_count = mysql_num_rows($result);
			  $pages = round($num_count/2, 0, PHP_ROUND_HALF_DOWN);
			  
			  for($i=1;$i<=$pages;$i++)
			  {
				  if($pageNum == $i)
				  {
					echo '<li class="active"><a href="pharmaUser.php?pageNum='.$i.'">'.$i.'</a></li>';  
				  }
				  else{
					echo '<li><a href="pharmaUser.php?pageNum='.$i.'">'.$i.'</a></li>';    
				 }
				  
			  }
			  
			  
 
			  
			?>
             <li><a href="pharmaUser.php?pageNum=<?php if($check_>$pages){echo $pages;}else{echo $check_;} ?>">&raquo;</a></li>
            </ul></center>
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
	
	
	$('.deactive').on('click',function(e){
		var id = $(this).attr('v_id');
		//alert(c_id);alert(c_name);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'id': id,'table': 'pharmacy_user','col':'p_status','col1':'p_id', 'flag': 'deactivate'},
		  success: function(html){
			  alert(html.msg);
			  $('#ac_'+id).show();
			  $('#deac_'+id).hide();
		  }
		})
	});
	
	$('.active').on('click',function(e){
		var id = $(this).attr('v_id');
		//alert(c_id);alert(c_name);
		$.ajax({
		  type: "POST",
		  url: "admin_backend.php",
		  dataType:"json",
		  data: { 'id': id,'table': 'pharmacy_user','col':'p_status','col1':'p_id', 'flag': 'activate'},
		  success: function(html){
			  alert(html.msg);
			  $('#ac_'+id).hide();
			  $('#deac_'+id).show();
		  }
		})
	});
	
	</script>


</body>
</html>