<?php
 ini_set('display_errors','1');
 session_start();
 if(isset($_SESSION['type']) && isset($_SESSION['status']))
 {
	 if($_SESSION['type'] == '1')
	 {
		  header('location:pharmacp.php');
	 }
	 else
	 {
		  header('location:locumcp.php');
	 }
	
 }
// include('includes/session.php');
 $title = "Registration Page : Pharmacy";
 $pageType = 1;
 include('includes/header.php');
 include('includes/connect.php');
?>
<style>


</style>

</head>
      
<body>

<?php 
 $nav = 1;$native = 1;
 include('includes/nav.php');
 $page = 'pharmacy_user';
 include('validate.php');
?>

    <div class="container">


      <!-- Main component for a primary marketing message or call to action
      <div class="jumbotron">
        <h1>Navbar example</h1>
        <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>To see the difference between static and fixed top navbars, just scroll.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
        </p>
      </div> -->
          
	
      <div class="row">
            
          <div class="col-md-offset-4">
            <h2>Pharmacy Registration</h2><br/>
          </div>
      
		  <?php if($error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
          
          <?php
		  	if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
				echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
				$query = "INSERT INTO pharmacy_user(p_compName,p_mangName,p_managerLName, p_userName,p_password,p_emailadd,p_dob,p_housenum,p_address,p_postcode,p_city,p_country,p_telnum,p_vatnum,p_compnum,p_compinuse, alternum,p_fax, p_createdDate, p_createdTime, p_createdIP, p_modifiedDate, p_modifiedTime, p_modifiedIP)VALUES('$compName','$managerName', '$managerLName', '$userName','$password','$email','$dob','$housenum','$address','$postcode','$city','$country','$telnum','$vatnum','$compnumb','$csinuse', '$alternum','$fax', CURDATE(), CURTIME(), '', CURDATE(), CURTIME(), '')";
				
				mysql_query($query) or die(mysql_error());
				$compId = mysql_insert_id();
				
				$query = "INSERT INTO common_users(c_userName,c_emailadd,c_native) VALUES('$userName','$email','$native')";
				mysql_query($query) or die(mysql_error());
				$userId = mysql_insert_id();
				
				$_SESSION['type'] = '1';
				$_SESSION['status'] = '0';
				$_SESSION['compname'] =  $compName;
				$_SESSION['mangfname'] = $managerName;
				$_SESSION['manglname'] = $managerLName;
				$_SESSION['email'] = $email;
				$_SESSION['id'] = $compId;
				$_SESSION['parentID'] = '0';
				header('location:pharmacp.php');
						//var_dump($_POST);
			}
		  ?>
          
          <form class="form-horizontal" role="form" method="post" id="registerform" action="<?php $_SERVER['PHP_SELF']; ?>">
              	<div class="form-group col-md-12">
                	 <label for="compName" class="col-md-2 control-label">Company Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="compName" id="compName" class="form-control col-md-12" value="<?php echo isset($compName) ? $compName : '';?>">
               		 </div>
                     
                     <label for="compnumb" class="col-md-2 control-label">Company Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="compnumb" id="compnumb" class="form-control col-md-12" value="<?php echo isset($compnumb) ? $compnumb : '';?>">
               		 </div>
                     
                     
                     
              	</div>
              
              <div class="form-group col-md-12">
                	<label for="managerName" class="col-md-2 control-label">First Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="managerName" id="managerName" class="form-control col-md-12" value="<?php echo isset($managerName) ? $managerName : '';?>">
               		 </div>
                     
                     <label for="managerName" class="col-md-2 control-label">Last Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="managerLName" id="managerLName" class="form-control col-md-12" value="<?php echo isset($managerLName) ? $managerLName : '';?>">
               		 </div>
               </div>
              
          	 <div class="form-group col-md-12">
                	 <label for="userName" class="col-md-2 control-label">Username :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="userName" id="userName" class="form-control col-md-12" value="<?php echo isset($userName) ? $userName : '';?>">
               		 </div>
                     
                     <label for="email" class="col-md-2 control-label">Email Address :</label>
                	 <div class="col-md-3">
                 	 <input type="email" name="email" id="email" class="form-control col-md-12" value="<?php echo isset($email) ? $email : '';?>">
               		 </div>
                     
               </div>
               
             
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
             
               <div class="form-group col-md-12">
                	 <label for="dob" class="col-md-2 control-label">Date of Birth :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="dob" id="dob" class="form-control col-md-12" value="<?php echo isset($dob) ? $dob : '';?>">
               		 </div>
                     
                      <label for="housenum" class="col-md-2 control-label">Address 1 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="housenum" id="housenum" class="form-control col-md-12" value="<?php echo isset($housenum) ? $housenum : '';?>">
               		 </div>
               </div>
               
               <div class="form-group col-md-12">
                	 <label for="address" class="col-md-2 control-label">Address 2 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="address" id="address" class="form-control col-md-12" value="<?php echo isset($address) ? $address : '';?>">
               		 </div>
                     
                      <label for="postcode" class="col-md-2 control-label">Post-Code :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="postcode" id="postcode" class="form-control col-md-12" value="<?php echo isset($postcode) ? $postcode : '';?>">
               		 </div>
               </div>
               
               <div class="form-group col-md-12">
                	 <label for="city" class="col-md-2 control-label">City :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="city" id="city" class="form-control col-md-12" value="<?php echo isset($city) ? $city : '';?>">
               		 </div>
                     
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
               </div>
               
               <div class="form-group col-md-12">
                	 <label for="telnum" class="col-md-2 control-label">Telephone Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="telnum" id="telnum" class="form-control col-md-12" value="<?php echo isset($telnum) ? $telnum : '';?>">
               		 </div>
                     
                      <label for="alternum" class="col-md-2 control-label">Alternate Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="alternum" id="alternum" class="form-control col-md-12" value="<?php echo isset($telnum) ? $telnum : '';?>">
               		 </div>
                     
               </div>
               
              
                <div class="form-group col-md-12">
                
                     
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
                     
                     <label for="vatnum" class="col-md-2 control-label">VAT-Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="vatnum" id="vatnum" class="form-control col-md-12" value="<?php echo isset($vatnum) ? $vatnum : '';?>">
               		 </div>
               </div>
              
                <div class="form-group col-md-12">
                	 <label for="fax" class="col-md-2 control-label">Fax Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="fax" id="fax" class="form-control col-md-12" value="<?php echo isset($fax) ? $fax : '';?>">
               		 </div>
               </div>
               
             <div class="form-group col-md-12">
                <div class="col-md-offset-2 col-md-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="agree"><b> By Clicking the box you have agreed to the <u>Terms and Conditions</u>, <u>Website Disclaimer</u> and the <u>Privacy Policy</u>.</b>
                    </label>
                  </div>
                </div>
              </div>
              
              <div class="form-group col-md-12">
                <div class="col-md-offset-4 col-md-6">
                 <button type="submit" name="submit" value="Submit" class="btn btn-success" id="register">Register Now</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" name="submit" value="Submit" class="btn btn-success" id="reset">Reset Form</button>
                </div>
                
              </div>
            </form>
      </div>
    </div> <!-- /container -->
   <?php include('includes/footer.php'); ?>

	<script>
	$("#dob").datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1900:2000'
    });
	$('#reset').on('click',function(e){
		e.preventDefault(); 
		 var allfields = $('#registerform').serialize().split('&');
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
			
			if(need1 == 'compName' || need1 == 'managerName' || need1 == 'userName' || need1 == 'password' || need1 == 'confirm_password' ||  need1 == 'email' ||  need1 == 'telnum' ||  need1 == 'vatnum' ||  need1 == 'compnumb' ||  need1 == 'csinuse' ||  need1 == 'city' ||  need1 == 'country' ||  need1 == 'postcode' || need1 == 'housenum' || need1 == 'managerLName' || need1 == 'fax' )
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
	   	else if(!error && !$('#agree').is(':checked'))
		{
			e.preventDefault(); 
			alert('Please agree on Terms and Conditions to Register');	
		}
	});
	
	</script>




  </body>
</html>
