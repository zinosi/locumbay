<?php
 ob_start();
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
 //include('includes/session.php');
 $title = "Welcome to LocumBay";
 $pageType = '1';
 include('includes/header.php');
 include('includes/connect.php');
 
 
?>
<link href="css/carousel.css" rel="stylesheet" />

</head>
      
<body>
<?php 
 $nav = 1;$native = 2;
 include('includes/nav.php');
 include('validate.php');
?>


    <div class="container">    
    <div class="row">
    <div class="col-md-8">
    </div>
    <div class="col-md-4">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                              <?php if(isset($error) && $error!=''){ ?>
                              <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
                              <?php } ?>
                             <?php
							 if(isset($_POST['login']) && $error == '')
							 {
								// print_r($_POST);
									$query = "SELECT * FROM common_users WHERE c_username = '$userName' OR c_emailadd = '$userName'";
									$result = mysql_query($query) or die(mysql_error());
									$num = mysql_num_rows($result);
									if($num)
									{
										$row = mysql_fetch_assoc($result);
										$native = $row['c_native'];
										if($native ==2)
										{
											$table = 'locum_user';
											$query1 = "SELECT * FROM $table WHERE l_userName = '$userName' OR l_emailadd = '$userName'";
											$result1 = mysql_query($query1) or die(mysql_error());
											$num1 = mysql_num_rows($result1);
											if($num1)
											{
												$row1 = mysql_fetch_assoc($result1);
												$pass = $row1['l_password'];
												if($pass == $password)
												{
													echo "<div class='alert alert-success col-md-12'>You are Successfully LoggedIn.</div>";
													$_SESSION['type'] = '2';
													$_SESSION['status'] = $row1['status'];
													$_SESSION['firstname'] = $row1['l_name'];
													$_SESSION['lastname'] = $row1['ll_name'];
													$_SESSION['email'] = $row1['l_emailadd'];
													$_SESSION['id'] = $row1['l_id'];
													header('location:pharmacp.php');
												}
												else
												{
													echo '<div class="alert alert-danger col-md-12">Username or password is wrong.</div>';
												}
											}
										}
										elseif($native == 1)
										{
											$table = 'pharmacy_user';
											$query1 = "SELECT * FROM $table WHERE p_userName = '$userName' OR p_emailadd = '$userName'";
											$result1 = mysql_query($query1) or die(mysql_error());
											$num1 = mysql_num_rows($result1);
											if($num1)
											{
												$row1 = mysql_fetch_assoc($result1);
												$pass = $row1['p_password'];
												if($pass == $password)
												{
													echo "<div class='alert alert-success col-md-12'>You are Successfully LoggedIn.</div>";
													$_SESSION['type'] = '1';
													$_SESSION['status'] = $row1['status'];
													$_SESSION['compname'] = $row1['p_compName'];
													$_SESSION['mangfname'] = $row1['p_mangName'];
													$_SESSION['manglname'] = $row1['p_mangLName'];
													$_SESSION['email'] = $row1['p_emailadd'];
													$_SESSION['id'] = $row1['p_id'];
													$_SESSION['parentID'] = $row1['p_muser'];
													header('location:pharmacp.php');
												}
												else
												{
													echo '<div class="alert alert-danger col-md-12">Username or password is wrong.</div>';
												}
											}
										}
									}
									else
									{
										echo '<div class="alert alert-danger col-md-12">Username does not exists.</div>';
									}
							 }
							 ?>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="userName" id="userName" value="" placeholder="Username or Email Address">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                    	<button class="btn btn-success" name="login" id="login" type="submit">Login</button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                        <div style=" font-size: 80%; padding-top:20px;border-top: 1px solid#888;"><a href="#">Forgot password?</a></div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
                </div>
         </div> 
    </div>
       <?php include('includes/footer.php'); ?>
   <script type="text/javascript">
   
	$('#login').on('click',function(e){
	   	var error = false;
	    var allfields = $('#loginform').serialize().split('&');
		
		for(var i=0;i<allfields.length;i++)
		{
		  	var need = allfields[i].split('=');
			var need1 = need[0];
			
			if(need1 == 'userName' || need1 == 'password')
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
		 
		 if(error)
		 {
			e.preventDefault(); 
		 } 
	});
   </script>




  </body>
</html>
