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
 $title = "LocumBay | Locum Registration";
 $pageType = 1;
 include('includes/header.php');
 include('includes/connect.php');
?>
<style>

</style>

</head>
      
<body>

<?php 
 $nav = 1;$native = 2;
 include('includes/nav.php');
// include('includes/sidenav.php');
 $page = 'locum_user';
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
    		<h2>Locum Registration</h2><br/>
    	</div>

		  <?php if($error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
          
          	<?php
               		if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
					   echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
						$query = "INSERT INTO locum_user(l_name, llname,l_userName,l_password,l_emailadd,l_dob,l_housenum,l_address,l_postcode,l_city,l_country,l_telnum,l_gphcNum,l_ninum,l_qualifyFrom,l_compinuse,l_nationality,l_mobnum, l_createdDate, l_createdTime, l_createdIP, l_modifiedDate, l_modifiedTime, l_modifiedIP )VALUES('$lname', '$llname','$userName','$password','$email','$dob','$housenum','$address','$postcode','$city','$country','$telnum','$GPhCnum','$ninum','$qualify','$csinuse','$nationality','$mobnumb', CURDATE(), CURTIME(), '', CURDATE(), CURTIME(), '')";
						
						mysql_query($query) or die(mysql_error());
					    $locId = mysql_insert_id();
					
					$query = "INSERT INTO common_users(c_userName,c_emailadd,c_native) VALUES('$userName','$email','$native')";
                    mysql_query($query) or die(mysql_error());
					$userId = mysql_insert_id();
			  		
					$_SESSION['type'] = '2';
					$_SESSION['status'] = '0';
					$_SESSION['firstname'] = $lname;
					$_SESSION['lastname'] = $llname;
					$_SESSION['email'] = $email;
					$_SESSION['id'] = $locId;
					header('location:pharmacp.php');
               		 }//if (isset($_POST['submit']) && $error == '') {
                ?>
                    
          <form class="form-horizontal" role="form" method="post" id="registerform" action="<?php $_SERVER['PHP_SELF']; ?>">
              	<div class="form-group col-md-12">
                	 <label for="lname" class="col-md-2 control-label">First Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="lname" id="lname" class="form-control col-md-12" value="<?php echo isset($lname) ? $lname : '';?>"> 
               		 </div>
                     
                     <label for="llname" class="col-md-2 control-label">Last Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="llname" id="llname" class="form-control col-md-12" value="<?php echo isset($llname) ? $llname : '';?>"> 
               		 </div>
                     
                     
              	</div>
                
                <div class="form-group col-md-12">
                     <label for="email" class="col-md-2 control-label">Email Address <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="email" name="email" id="email" class="form-control col-md-12" value="<?php echo isset($email) ? $email : '';?>">
               		 </div>

                    
                     <label for="userName" class="col-md-2 control-label">Username <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="userName" id="userName" class="form-control col-md-12" value="<?php echo isset($userName) ? $userName : '';?>">
               		 </div>

                
                
                </div>
               
                
        
              
              <div class="form-group col-md-12">
                	 <label for="password" class="col-md-2 control-label">Password <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="password" name="password" id="password" class="form-control col-md-12">
               		 </div>
                     
                     <label for="cpassword" class="col-md-2 control-label">Repeat Password <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="password" name="confirm_password" id="confirm_password" class="form-control col-md-12">
               		 </div>
               </div>
               
              <div class="form-group col-md-12">
                     
                     <label for="dob" class="col-md-2 control-label">Date of Birth :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="dob" id="dob" class="form-control col-md-12" value="<?php echo isset($dob) ? $dob : '';?>">
               		 </div>
                     
                                     	 <label for="housenum" class="col-md-2 control-label">Address 1 <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="housenum" id="housenum" class="form-control col-md-12" value="<?php echo isset($housenum) ? $housenum : '';?>">
               		 </div>

               </div>
               
           
               <div class="form-group col-md-12">
                     
                      <label for="address" class="col-md-2 control-label">Address 2 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="address" id="address" class="form-control col-md-12" value="<?php echo isset($address) ? $address : '';?>">
               		 </div>
                     
                    <label for="postcode" class="col-md-2 control-label">Post Code <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="postcode" id="postcode" class="form-control col-md-12" value="<?php echo isset($postcode) ? $postcode : '';?>">
               		 </div>

               </div>
               
               <div class="form-group col-md-12">
                     
                     <label for="city" class="col-md-2 control-label">City <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="city" id="city" class="form-control col-md-12" value="<?php echo isset($city) ? $city : '';?>">
               		 </div>
                     
                                     	 <label for="country" class="col-md-2 control-label">Country <font color="#FF0000">*</font>:</label>
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
                     <label for="telnum" class="col-md-2 control-label">Telephone Number <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="telnum" id="telnum" class="form-control col-md-12" value="<?php echo isset($telnum) ? $telnum : '';?>">
               		 </div>
                     
                    <label for="mobnumb" class="col-md-2 control-label">Mobile Number :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="mobnumb" id="mobnumb" class="form-control col-md-12" value="<?php echo isset($mobnumb) ? $mobnumb : '';?>">
               		 </div>
               </div>
               
                <div class="form-group col-md-12">
                	 <label for="GPhCnum" class="col-md-2 control-label">GPhC Pharmacy Registration Number <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="GPhCnum" id="GPhCnum" class="form-control col-md-12" value="<?php echo isset($GPhCnum) ? $GPhCnum : '';?>">
               		 </div>
                     
                     <label for="ninum" class="col-md-2 control-label">National Insurance Number <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ninum" id="ninum" class="form-control col-md-12" value="<?php echo isset($ninum) ? $ninum : '';?>">
               		 </div>
               </div>
               
               <div class="form-group col-md-12">
                	 <label for="qualify" class="col-md-2 control-label">Where did you qualify? <font color="#FF0000">*</font></label>
                	 <div class="col-md-3">
                         <select name="qualify" id="qualify" class="form-control col-md-12">
                        		 <option value="">Please Select From the List</option>
                        <?php
							$query1 = "SELECT * FROM qualifyfrom ORDER by q_name ASC";
							$result1 = mysql_query($query1);
							while($rows1 = mysql_fetch_assoc($result1))
							{
								$q_id = $rows1['q_id'];
								$q_name = $rows1['q_name'];
								if($q_id == $qualify)
								{$selected = "selected";}
								else
								{$selected = '';}
								echo '<option value="'.$q_id.'" '.$selected.'>'.$q_name.'</option>';
							}//while($rows1 = mysql_fetch_assoc($result1))
						?>
                         </select>
               		 </div>
                     
                      <label for="csinuse" class="col-md-2 control-label">Computer System in Use <font color="#FF0000">*</font>:</label>
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
								if($c_id == $csinuse)
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
                	 <label for="nationality" class="col-md-2 control-label">Nationality <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                         <select name="nationality" id="nationality" class="form-control col-md-12">
                         	<option value="">Please Select From the List</option>
                            <option value="12">ranf</option>
                         </select>
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
                 <button type="submit" name="submit" value="Submit" class="btn btn-primary" id="register">Register Now</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary" id="reset">Reset Form</button>
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
			
			if(need1 == 'lname' || need1 == 'userName' || need1 == 'password' || need1 == 'confirm_password' ||  need1 == 'email' ||  need1 == 'housenum' ||  need1 == 'postcode' ||  need1 == 'country' ||  need1 == 'telnum' ||  need1 == 'GPhCnum' ||  need1 == 'ninum'||  need1 == 'qualify'||  need1 == 'csinuse'||  need1 == 'nationality'||  need1 == 'city' )
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
	   	
		
		if(!error && !$('#agree').is(':checked'))
		{
			e.preventDefault(); 
			alert('Please agree on Terms and Conditions to Register');	
		}
	
	
	
	});
	
	
	</script>

   

	<script>
	/*	$('#register').on('click',function(){
			
			alert($('#agree').attr('checked'));
			
			if($('#agree').attr('checked') == 'checked')
			{
			alert('dsadas');	
			}
			
		});*/

	</script>




  </body>
</html>
