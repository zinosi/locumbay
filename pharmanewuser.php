<?php
 ob_start();
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
 include('validate.php');
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-2 main">
          <div class="row">
           <a href="pharmachangeroles.php" class="btn btn-primary">Show All Users</a>
          <div class="col-md-offset-4">
          <?php
			if(isset($_GET['user']))
			{
				echo '<h2>User Edit Page:</h2><br/>';
				$id = $_GET['user'];
			}
			else
			{
            echo '<h2>User Registration Page:</h2><br/>';
			}
			?>
          </div>
      
		  <?php if(isset($error) && $error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
           <?php
		  	if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
				echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
				$compName = $_SESSION['compname'];
				$compId = $_SESSION['id'];
				$param = serialize(array());
				$query = "INSERT INTO pharmacy_user(p_compName,p_mangName,p_managerLName, p_userName,p_password,p_emailadd,p_dob,p_housenum,p_address,p_postcode,p_city,p_country,p_telnum,p_vatnum,p_compnum,p_compinuse,p_muser,p_usertype,p_bparam, alternum, p_createdDate, p_createdTime, p_createdIP, p_modifiedDate, p_modifiedTime, p_modifiedIP)VALUES('$compName','$managerName','$managerLName','$userName','$password','$email','$dob','$housenum','$address','$postcode','$city','$country','$telnum','','','$csinuse','$compId','$UserType', '$param','$alternum', CURDATE(), CURTIME(), '', CURDATE(), CURTIME(), '')";
				
				mysql_query($query) or die(mysql_error());
				$compId = mysql_insert_id();
				
				$query = "INSERT INTO common_users(c_userName,c_emailadd,c_native) VALUES('$userName','$email','$native')";
				mysql_query($query) or die(mysql_error());
				$userId = mysql_insert_id();
				header('location:pharmachangeroles.php');
			}
			else
			{
				if (isset($_POST['edit_details']) && $error == '') { // if there is no error, then process further
					echo "<div class='alert alert-success col-md-12'>Form has been Updated successfully.</div>"; // showing success message
					if(isset($param))
					{
						$param1 = serialize($param);
					}
					else
					{$param1 = serialize(array());}
					//echo $id;
				//	print_r($_POST);
				//	echo $managerName;
					$query = "UPDATE pharmacy_user SET p_mangName = '$managerName',p_userName = '$userName',p_emailadd = '$email',p_dob = '$dob',p_housenum = '$housenum',p_address = '$address',p_postcode = '$postcode',p_city = '$city',p_country = '$country',p_telnum = '$telnum',p_compinuse = '$csinuse', p_bparam = '$param1' WHERE p_id = '$id'";
					
					mysql_query($query) or die(mysql_error());
					$compId = mysql_insert_id();
					
					$query = "UPDATE common_users SET c_userName = '$userName', c_emailadd = '$email' WHERE c_id = '$id'";
					mysql_query($query) or die(mysql_error());
					$userId = mysql_insert_id();
					header('location:pharmachangeroles.php');
				}
			}

			if(isset($_GET['user']))
			{
				$query1 = "SELECT * FROM pharmacy_user WHERE p_id = '$id'";
				$result1 = mysql_query($query1);
				$num = mysql_num_rows($result1);
				if($num)
				{
					$row1 = mysql_fetch_assoc($result1);
					$managerName = $row1['p_mangName'];
					$managerLName = $row1['p_managerLName'];
					$userName = $row1['p_userName'];
					$email = $row1['p_emailadd'];
					$dob = $row1['p_dob'];
					$housenum = $row1['p_housenum'];
					$address = $row1['p_address'];
					$postcode = $row1['p_postcode'];
					$city = $row1['p_city'];
					$country = $row1['p_country'];
					$telnum = $row1['p_telnum'];
					$csinuse = $row1['p_compinuse'];
					$bparam = $row1['p_bparam'];
				}
			}
		  ?>
          
          <form class="form-horizontal" role="form" method="post" id="pharmacynewuser" action="<?php $_SERVER['PHP_SELF']; ?>">
              	<div class="form-group col-md-12">
                     <label for="managerName" class="col-md-2 control-label">Manager First Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="managerName" id="managerName" class="form-control col-md-12" value="<?php echo isset($managerName) ? $managerName : '';?>">
               		 </div>
                     
                     <label for="managerLName" class="col-md-2 control-label">Manager Last Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="managerLName" id="managerLName" class="form-control col-md-12" value="<?php echo isset($managerLName) ? $managerLName : '';?>">
               		 </div>
                   	 
              	</div>
              
          	 <div class="form-group col-md-12">
                	 <label for="userName" class="col-md-2 control-label">Username :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="userName" id="userName" class="form-control col-md-12" value="<?php echo isset($userName) ? $userName : '';?>">
               		 </div>
                     
                     
                     <label for="UserType" class="col-md-2 control-label">User Type :</label>
                	 <div class="col-md-3">
                        <select name="UserType" id="UserType" class="form-control col-md-12">
                            <option value="2">Manager</option>
                         </select>
                 	 </div>
               </div>
               
             <?php if(isset($_GET['user']))
			 {}
			 else
			 {
				 ?>
               <div class="form-group col-md-12">
               		<label for="password" class="col-md-2 control-label">Password :</label>
                	 <div class="col-md-3">
                 	 <input type="password" name="password" id="password" class="form-control col-md-12">
               		 </div>
                     
                	 <label for="cpassword" class="col-md-2 control-label">Repeat Password :</label>
                	 <div class="col-md-3">
                 	 <input type="password" name="confirm_password" id="confirm_password" class="form-control col-md-12">
               		 </div>
               </div>
             <?php } ?>
               <div class="form-group col-md-12">
                	 <label for="dob" class="col-md-2 control-label">Date of Birth :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="dob" id="dob" class="form-control col-md-12" value="<?php echo isset($dob) ? $dob : '';?>">
               		 </div>
                     
                       <label for="email" class="col-md-2 control-label">Email Address :</label>
                	 <div class="col-md-3">
                 	 <input type="email" name="email" id="email" class="form-control col-md-12" value="<?php echo isset($email) ? $email : '';?>">
               		 </div>
               </div>
               
               <div class="form-group col-md-12">
                   <label for="housenum" class="col-md-2 control-label">Address 1 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="housenum" id="housenum" class="form-control col-md-12" value="<?php echo isset($housenum) ? $housenum : '';?>">
               		 </div>
                     
                	 <label for="address" class="col-md-2 control-label">Address 2 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="address" id="address" class="form-control col-md-12" value="<?php echo isset($address) ? $address : '';?>">
               		 </div>
               </div>
               
               <div class="form-group col-md-12">
                	 <label for="city" class="col-md-2 control-label">City :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="city" id="city" class="form-control col-md-12" value="<?php echo isset($city) ? $city : '';?>">
               		 </div>
                     
                     
                         <label for="postcode" class="col-md-2 control-label">Post-Code :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="postcode" id="postcode" class="form-control col-md-12" value="<?php echo isset($postcode) ? $postcode : '';?>">
               		 </div>
               </div>
               
               <div class="form-group col-md-12">
                   <label for="country" class="col-md-2 control-label">Country :</label>
                	 <div class="col-md-3">
                 	 <select name="country" id="country" class="form-control col-md-12">
                     	<option value="">Please Select From the List</option>
                    	<?php
			 			$query1 = "SELECT * FROM countries ORDER by c_name ASC";
						$result1 = mysql_query($query1);
						while($rows1 = mysql_fetch_assoc($result1))
						{
							$c_id = $rows1['c_id'];
							$c_name = $rows1['c_name'];
							if($c_id == $country)
							{$selected = "selected";}
							else
							{$selected = '';}
							echo '<option value="'.$c_id.'" '.$selected.'>'.$c_name.'</option>';
						}
						?>
                     </select>
               		 </div>


    <label for="csinuse" class="col-md-2 control-label">Computer System in Use :</label>
                	 <div class="col-md-3">
                         <select name="csinuse" id="csinuse" class="form-control col-md-12">
                        	 <option value="">Please Select From the List</option>
							<?php
								$query1 = "SELECT * FROM csinuse ORDER by c_name ASC";
								$result1 = mysql_query($query1);
								while($rows1 = mysql_fetch_assoc($result1))
								{
									$c_id = $rows1['c_id'];
									$c_name = $rows1['c_name'];
									if($c_id == $country)
									{$selected = "selected";}
									else
									{$selected = '';}

									echo '<option value="'.$c_id.'" '.$selected.'>'.$c_name.'</option>';
								}
                            ?>
                          </select>
               		 </div>
               
                
               </div>
               
                  <div class="form-group col-md-12">
               		 <label for="telnum" class="col-md-2 control-label">Telephone Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="telnum" id="telnum" class="form-control col-md-12" value="<?php echo isset($telnum) ? $telnum : '';?>">
               		 </div>
                     
                     <label for="alternum" class="col-md-2 control-label">Alternate Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="alternum" id="alternum" class="form-control col-md-12" value="<?php echo isset($alternum) ? $alternum : '';?>">
               		 </div>
                     </div>
              <?php
			  if(isset($_GET['user']))
			  {
				 $bp = unserialize($bparam);
				 ?>
				   <div class="form-group col-md-12">
                	 <label for="staff" class="col-md-2 control-label">Branch Access :</label>
                 	 		<?php
							//	$compId = $_SESSION['CompId'];
								$compId = '1';
								$query1 = "SELECT * FROM pharmacy_branch WHERE pb_muser = '$compId'";
								$result1 = mysql_query($query1);
								$num = mysql_num_rows($result1);
								if($num)
								{
									$i=0;
									while($rows1 = mysql_fetch_assoc($result1))
									{
										$ps_id = $rows1['pb_id'];
										$ps_name = $rows1['pb_name'];
										if($i > 2)
										{echo '<div class="col-md-2"></div>';}
									//	echo array_search($ps_id, $bp);
										if(array_search($ps_id, $bp) !== false)
										{echo '<div class="col-md-5"><input type="checkbox" checked="checked" name="param[]" class="param" value="'.$ps_id.'" />&nbsp;'.$ps_name.'</div>';}
										else
										{
											echo '<div class="col-md-5"><input type="checkbox" name="param[]" class="param" value="'.$ps_id.'" />&nbsp;'.$ps_name.'</div>';
										}
										$i++;
									}
								}
								else
								{
									echo "No Pharmacy Branch has been Created";
								}
                            ?>
               </div>
			  <?php }
			  ?>
                <div class="form-group col-md-12">
                <div class="col-md-offset-4 col-md-2">
                <?php 
				 if(isset($_GET['user']))
				 {
                 	echo '<button type="submit" name="edit_details" value="Submit" class="btn btn-success" id="register">Edit Details</button>';
				 }
				 else
				 {
					echo '<button type="submit" name="submit" value="Submit" class="btn btn-success" id="register">Register Now</button>'; 
				 }?>
                 
                </div>
                
                <div class="col-md-2">
                  <button type="button" name="submit" value="Submit" class="btn btn-success" id="reset">Reset Form</button>
                </div>
              </div>

            </form>
      </div>
    </div>
   <?php include('includes/footer.php'); ?>

	<script>
	$("#dob").datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1900:2000'
    });
	
	$('#reset').on('click',function(e){
		e.preventDefault(); 
		 var allfields = $('#pharmacynewuser').serialize().split('&');
			for(var i=0;i<allfields.length;i++)
			{
				var need = allfields[i].split('=');
				var need1 = need[0];
				$('#'+need1).val('');
			}//for(var i=0;i<allfields.length;i++)
	});
	
	$('#register').on('click',function(e){
	   	var error = false;

	    var allfields = $('#registerform').serialize().split('&');
		
		for(var i=0;i<allfields.length;i++)
		{
		  	var need = allfields[i].split('=');
			var need1 = need[0];
			
			if(need1 == 'compName' || need1 == 'managerName' || need1 == 'userName' || need1 == 'password' || need1 == 'confirm_password' ||  need1 == 'email' ||  need1 == 'telnum' ||  need1 == 'vatnum' ||  need1 == 'compnumb' ||  need1 == 'csinuse' ||  need1 == 'city' ||  need1 == 'country' ||  need1 == 'UserType' ||  need1 == 'postcode' || need1 == 'housenum' )
			{	
				if($('#'+need1).val() == '')
				{
					$('#'+need1).parent('div').addClass('has-error');
					error = true;
				}
				else
				{
					$('#'+need1).parent('div').removeClass('has-error');
				}
			}
			
		}//for(var i=0;i<allfields.length;i++)
		 
		 if(($('#password').val() != $('#confirm_password').val()) || ($('#password').val() == ''))
		 {
			$('#password').parent('div').addClass('has-error');
			$('#confirm_password').parent('div').addClass('has-error');
			error = true;
		 }
		 else{
			$('#password').parent('div').removeClass('has-error');
			$('#confirm_password').parent('div').removeClass('has-error');
		 }
		 
		 var x = $('#email').val();
		 var atpos=x.indexOf("@");
		 var dotpos=x.lastIndexOf(".");
		 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
			$('#email').parent('div').addClass('has-error');
			error = true;
		  }
		  else{
			  $('#email').parent('div').removeClass('has-error');
			 }
		
		 if(error)
		 {
			e.preventDefault(); 
		 } 
	});
	
	</script>




  </body>
</html>
