<?php
 ini_set('display_errors','1');
 include('includes/session.php');
 if($_SESSION['type'] == '1')
 {
	  header('location:pharmacp.php');
 }
 $title = "LocumBay | Pharmacy Control Panel";
 include('includes/header.php');
 include('includes/connect.php');
?>
<link href="css/jquery.timepicker.css" rel="stylesheet" />
</head>
<body>
<?php 
 $sidenav = 2;$native = 1;
 include('includes/navcp.php');
 include('includes/sidenavlocum.php');
 include('validate.php');
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
            
          <div class="col-md-offset-4">
            <h2>Edit Locum Details</h2><br/>
          </div>
      
		  <?php
		  		if(isset($Verification))
				{$Veri = serialize($Verification);}
				else{$Verification = array();$Veri = serialize($Verification);}
			//	print_r($Verification);
		  		for($k=0;$k<count($Verification);$k++)
				{
					if($image[$Verification[$k]-1] == '')
					{
						$error = 'Please Upload the Picture for the checked ones in <strong> UPLOAD VERIFICATION DOCUMENT</strong>';
					}
				}
		  
		   if(isset($error) && $error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
          
           <?php
		  	if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
			
				echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
//				$compName = $_SESSION['CompName'];
				if(isset($services))
				{$serv = serialize($services);}
				else{$serv = serialize(array());}
				
				if(isset($image))
				{$imageNames = serialize($image);}
				else{$imageNames = serialize(array());}
				
			

				$ref1 = serialize(array('fname'=>$ref1firstname, 'lname'=>$ref1lastname, 'reltionship'=>$ref1relationship, 'refknow'=>$ref1knowref,'compname'=>$ref1compName, 'add1'=>$ref1address1, 'add2'=>$ref1address, 'postcode'=>$ref1postcode, 'city'=>$ref1city, 'country'=>$ref1country,  'email'=>$ref1email, 'phone'=>$ref1telnum));
				
				$ref2 = serialize(array('fname'=>$ref2firstname, 'lname'=>$ref2lastname, 'reltionship'=>$ref2relationship, 'refknow'=>$ref2knowref, 'compname'=>$ref2compName, 'add1'=>$ref2address1, 'add2'=>$ref2address, 'postcode'=>$ref2postcode, 'city'=>$ref2city, 'country'=>$ref2country, 'email'=>$ref2email, 'phone'=>$ref2telnum));
				
				$compId = $_SESSION['id'];
				
				$query1 = "SELECT * FROM locum_info WHERE l_id = '$compId'";
				$result1 = mysql_query($query1);
				$num1= mysql_num_rows($result1);
				if($num1)
				{
					$query = "UPDATE locum_info SET lv_ref1 = '$ref1', lv_ref2 = '$ref2', lv_services = '$serv', lv_verification = '$Veri', lv_images = '$imageNames' WHERE l_id = '$compId'";
					$result = mysql_query($query);
				}
				else
				{
					$query = "INSERT INTO locum_info(lv_ref1, lv_ref2, lv_services, lv_verification, lv_images, l_id)VALUES('$ref1', '$ref2', '$serv', '$Veri', '$imageNames', '$compId')";
					mysql_query($query) or die(mysql_error());
				}
			}
			elseif(!isset($_POST['submit']))
			{
			
		  	$id = $_SESSION['id'];
		    $query1 = "SELECT * FROM locum_info WHERE l_id = '$id'";
		    $result1 = mysql_query($query1);
		    $num1= mysql_num_rows($result1);
			if($num1)
			{
				$row = mysql_fetch_assoc($result1);
				$lv_ref1 = unserialize($row['lv_ref1']);
				$lv_ref2 = unserialize($row['lv_ref2']);
				$services = unserialize($row['lv_services']);
				$Verification = unserialize($row['lv_verification']);
				$image = unserialize($row['lv_images']);
				
				$ref1firstname = $lv_ref1['fname'];
				$ref1lastname = $lv_ref1['lname'];
				$ref1relationship = $lv_ref1['reltionship'];
				$ref1knowref = $lv_ref1['refknow'];
				$ref1compName = $lv_ref1['compname'];
				$ref1address1 = $lv_ref1['add1'];
				$ref1address = $lv_ref1['add2'];
				$ref1postcode = $lv_ref1['postcode'];
				$ref1city = $lv_ref1['city'];
				$ref1country = $lv_ref1['country'];
				$ref1email = $lv_ref1['email'];
				$ref1telnum = $lv_ref1['phone'];
				
				$ref2firstname = $lv_ref2['fname'];
				$ref2lastname = $lv_ref2['lname'];
				$ref2relationship = $lv_ref2['reltionship'];
				$ref2knowref = $lv_ref2['refknow'];
				$ref2compName = $lv_ref2['compname'];
				$ref2address1 = $lv_ref2['add1'];
				$ref2address = $lv_ref2['add2'];
				$ref2postcode = $lv_ref2['postcode'];
				$ref2city = $lv_ref2['city'];
				$ref2country = $lv_ref2['country'];
				$ref2email = $lv_ref2['email'];
				$ref2telnum = $lv_ref2['phone'];
			}
			}
		//	print_r($Verification);
		  ?>
          
          <form class="form-horizontal" role="form" method="post" id="locuminfo" action="<?php $_SERVER['PHP_SELF']; ?>">
           <div class="form-group col-md-12">
                	 <label for="ref1firstname" class="col-md-2 control-label">Reference 1</label>
           </div>
           
              <div class="form-group col-md-12">
                	 <label for="ref1firstname" class="col-md-2 control-label">First Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1firstname" id="ref1firstname" class="form-control col-md-12" value="<?php echo isset($ref1firstname) ? $ref1firstname : '';?>"> 
               		 </div>
                     
                     <label for="ref1lastname" class="col-md-2 control-label">Last Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1lastname" id="ref1lastname" class="form-control col-md-12" value="<?php echo isset($ref1lastname) ? $ref1lastname : '';?>"> 
               		 </div>
              	</div>
                
                <div class="form-group col-md-12">
                	 <label for="ref1relationship" class="col-md-2 control-label">Relationship <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1relationship" id="ref1relationship" class="form-control col-md-12" value="<?php echo isset($ref1relationship) ? $ref1relationship : '';?>">
               		 </div>
                     
                      <label for="ref1knowref" class="col-md-2 control-label">How long have you known Reference <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1knowref" id="ref1knowref" class="form-control col-md-12" value="<?php echo isset($ref1knowref) ? $ref1knowref : '';?>">
               		 </div>
               </div>
               
                <div class="form-group col-md-12">
                	 <label for="ref1compName" class="col-md-2 control-label">Company Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1compName" id="ref1compName" class="form-control col-md-12" value="<?php echo isset($ref1compName) ? $ref1compName : '';?>">
               		 </div>
                     
                     <label for="ref1address1" class="col-md-2 control-label">Address 1 <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1address1" id="ref1address1" class="form-control col-md-12" value="<?php echo isset($ref1address1) ? $ref1address1 : '';?>">
               		 </div>
               </div>

                
                 <div class="form-group col-md-12">
                     <label for="ref1address" class="col-md-2 control-label">Address 2 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1address" id="ref1address" class="form-control col-md-12" value="<?php echo isset($ref1address) ? $ref1address : '';?>">
               		 </div>
                     
                     <label for="ref1postcode" class="col-md-2 control-label">Post Code <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1postcode" id="ref1postcode" class="form-control col-md-12" value="<?php echo isset($ref1postcode) ? $ref1postcode : '';?>">
               		 </div>

               </div>
                
                <div class="form-group col-md-12">
                	 <label for="ref1city" class="col-md-2 control-label">City :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1city" id="ref1city" class="form-control col-md-12" value="<?php echo isset($ref1city) ? $ref1city : '';?>">
               		 </div>
                     
                      <label for="ref1country" class="col-md-2 control-label">Country :</label>
                	 <div class="col-md-3">
                 	 <select name="ref1country" id="ref1country" class="form-control col-md-12">
                     	<option value="">Please Select From the List</option>
                    	<?php
			 			$query1 = "SELECT * FROM countries ORDER by c_name ASC";
						$result1 = mysql_query($query1);
						while($rows1 = mysql_fetch_assoc($result1))
						{
							$c_id = $rows1['c_id'];
							$c_name = $rows1['c_name'];
							if($c_id == $ref1country)
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
                     <label for="ref1email" class="col-md-2 control-label">Email Address <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1email" id="ref1email" class="form-control col-md-12" value="<?php echo isset($ref1email) ? $ref1email : '';?>">
               		 </div>
                    
                    <label for="ref1telnum" class="col-md-2 control-label">Telephone Number <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref1telnum" id="ref1telnum" class="form-control col-md-12" value="<?php echo isset($ref1telnum) ? $ref1telnum : '';?>">
               		 </div>
                </div>
                
                 <div class="form-group col-md-12">
                	 <label for="ref2firstname" class="col-md-2 control-label">Reference 2</label>
           </div>
           
              <div class="form-group col-md-12">
                	 <label for="ref2firstname" class="col-md-2 control-label">First Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2firstname" id="ref2firstname" class="form-control col-md-12" value="<?php echo isset($ref2firstname) ? $ref2firstname : '';?>">
               		 </div>
                     
                     <label for="ref2lastname" class="col-md-2 control-label">Last Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2lastname" id="ref2lastname" class="form-control col-md-12" value="<?php echo isset($ref2lastname) ? $ref2lastname : '';?>"> 
               		 </div>
              	</div>
                
                <div class="form-group col-md-12">
                	 <label for="ref2relationship" class="col-md-2 control-label">Relationship <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2relationship" id="ref2relationship" class="form-control col-md-12" value="<?php echo isset($ref2relationship) ? $ref2relationship : '';?>">
               		 </div>
                     
                      <label for="ref2knowref" class="col-md-2 control-label">How long have you known Reference <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2knowref" id="ref2knowref" class="form-control col-md-12" value="<?php echo isset($ref2knowref) ? $ref2knowref : '';?>">
               		 </div>
               </div>
               
                <div class="form-group col-md-12">
                	 <label for="ref2compName" class="col-md-2 control-label">Company Name <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2compName" id="ref2compName" class="form-control col-md-12" value="<?php echo isset($ref2compName) ? $ref2compName : '';?>">
               		 </div>
                     
                      <label for="ref2address1" class="col-md-2 control-label">Address 1 <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2address1" id="ref2address1" class="form-control col-md-12" value="<?php echo isset($ref2address1) ? $ref2address1 : '';?>">
               		 </div>
               </div>

                
                 <div class="form-group col-md-12">
                     <label for="ref2address" class="col-md-2 control-label">Address 2 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2address" id="ref2address" class="form-control col-md-12" value="<?php echo isset($ref2address) ? $ref2address : '';?>">
               		 </div>
                     
                     <label for="ref2postcode" class="col-md-2 control-label">Post Code <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2postcode" id="ref2postcode" class="form-control col-md-12" value="<?php echo isset($ref2postcode) ? $ref2postcode : '';?>">
               		 </div>
               </div>
                
                <div class="form-group col-md-12">
                	 <label for="ref2city" class="col-md-2 control-label">City :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2city" id="ref2city" class="form-control col-md-12" value="<?php echo isset($ref2city) ? $ref2city : '';?>">
               		 </div>
                     
                      <label for="ref2country" class="col-md-2 control-label">Country :</label>
                	 <div class="col-md-3">
                 	 <select name="ref2country" id="ref2country" class="form-control col-md-12">
                     	<option value="">Please Select From the List</option>
                    	<?php
							$query1 = "SELECT * FROM countries ORDER by c_name ASC";
							$result1 = mysql_query($query1);
							while($rows1 = mysql_fetch_assoc($result1))
							{
								$c_id = $rows1['c_id'];
								$c_name = $rows1['c_name'];
								if($c_id == $ref2country)
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
                     <label for="ref2email" class="col-md-2 control-label">Email Address <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2email" id="ref2email" class="form-control col-md-12" value="<?php echo isset($ref2email) ? $ref2email : '';?>">
               		 </div>
                    
                    <label for="ref2telnum" class="col-md-2 control-label">Telephone Number <font color="#FF0000">*</font>:</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="ref2telnum" id="ref2telnum" class="form-control col-md-12" value="<?php echo isset($ref2telnum) ? $ref2telnum : '';?>">
               		 </div>
                </div> 
                
 				<div class="form-group col-md-12">
                									<!-- <input type="hidden" name="imageNames" id="imageNames" value="<?php echo isset($imageNames) ? $imageNames : ''; ?>" />-->

                	 <label for="Verification" class="col-md-2 control-label">Upload verification document :</label>
                   
                 	 		<?php
								$query1 = "SELECT * FROM locum_verification";
								$result1 = mysql_query($query1);
								$i=0;
								while($rows1 = mysql_fetch_assoc($result1))
								{
									echo '<div class="row" style="margin-top:5px;">';
									$lv_id = $rows1['lv_id'];
									$lv_text = $rows1['lv_text'];
									if($i != 0)
									{echo '<label class="col-md-2"></label>';}
									if(isset($Verification))
									{
										if(array_search($lv_id, $Verification) !== false)
										{
										//	print_r($Verification);
										//	$index = array_search($lv_id, $Verification);
										//	echo $index;
											//print_r($imageNames);
											echo '<div class="col-md-4"><input type="checkbox" checked = "checked" name="Verification[]" class="Verification" value="'.$lv_id.'" />&nbsp;'.$lv_text.'<input type="hidden" name="image[]" id="image'.$lv_id.'" value="'.$image[$lv_id-1].'" /></div>';
										}
										else
										{
											echo '<div class="col-md-4"><input type="checkbox" name="Verification[]" class="Verification" value="'.$lv_id.'" />&nbsp;'.$lv_text.'<input type="hidden" name="image[]" id="image'.$lv_id.'" /></div>';
										}
									}
									else
									{
										echo '<div class="col-md-4"><input type="checkbox" name="Verification[]" class="Verification" value="'.$lv_id.'" />&nbsp;'.$lv_text.'<input type="hidden" name="image[]" id="image'.$lv_id.'" /></div>';
									}
									
									echo '<div class="col-md-3">
										 	<input type="file" name="fileToUpload" id="fileToUpload'.$lv_id.'" />
										 </div>
									  	<div class="col-md-2">';
									  ?>
                                      
									 <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload<?php echo $lv_id; ?>', '<?php echo $lv_id; ?>')">Upload</button>
							<?php		echo ' </div>';
									 echo '</div>';
									$i++;
								}
                            ?>
               </div>
            <!--   
               	<div class="form-group col-md-12">
					<div class="col-md-2"></div>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload" />
                
               		 </div>
                      <div class="col-md-2">
                     <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload')">Upload</button>
                     <input type="hidden" name="imageNames" id="imageNames" value="<?php //echo isset($imageNames) ? $imageNames : ''; ?>" />
               		 </div>
               </div>

-->
                 <div class="form-group col-md-12">
                	 <label for="Services" class="col-md-2 control-label">Services :</label>
                 	 		<?php
								$query1 = "SELECT * FROM pharmacy_services";
								$result1 = mysql_query($query1);
								$i=0;
								while($rows1 = mysql_fetch_assoc($result1))
								{
									$ps_id = $rows1['ps_id'];
									$ps_name = $rows1['ps_name'];
									if($i > 2)
									{echo '<div class="col-md-2"></div>';}
									if(isset($services))
									{
										if(array_search($ps_id, $services) !== false)
										{echo '<div class="col-md-5"><input type="checkbox" checked = "checked" name="services[]" class="services" value="'.$ps_id.'" />&nbsp;'.$ps_name.'</div>';}
										else
										{
											echo '<div class="col-md-5"><input type="checkbox" name="services[]" class="services" value="'.$ps_id.'" />&nbsp;'.$ps_name.'</div>';
										}
									}
									else
									{
										echo '<div class="col-md-5"><input type="checkbox" name="services[]" class="services" value="'.$ps_id.'" />&nbsp;'.$ps_name.'</div>';
									}
									$i++;
								}
                            ?>
               </div>
			
              <div class="form-group col-md-12">
                <div class="col-md-offset-4 col-md-2">
                 <button type="submit" name="submit" value="Submit" class="btn btn-success" id="register">Add New</button>
                </div>
                <div class="col-md-2">
                  <button type="submit" name="submit" value="Submit" class="btn btn-success" id="reset">Reset Form</button>
                </div>
              </div>
            </form>
      </div>
    </div>
   <?php include('includes/footerjs.php'); ?>
	<script>
	
	$(".Verification").click(function(e) {
        if($(this).is(':not(:checked)'))
		{
	//		alert($(this).attr('value'));
			var val = $(this).attr('value');
			$("#image"+val).val("");
		}
    });
	
	$('#reset').on('click',function(e){
		e.preventDefault(); 
		 var allfields = $('#locuminfo').serialize().split('&');
			for(var i=0;i<allfields.length;i++)
			{
				var need = allfields[i].split('=');
				var need1 = need[0];
				$('#'+need1).val('');
			}//for(var i=0;i<allfields.length;i++)
	});
	
	$('#register').on('click',function(e){
	   	var error = false;

	    var allfields = $('#locuminfo').serialize().split('&');
		
		for(var i=0;i<allfields.length;i++)
		{
		  	var need = allfields[i].split('=');
			var need1 = need[0];
			
			if(need1 != 'imageNames' )
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
		 
		  var x = $('#ref1email').val();
		 var atpos=x.indexOf("@");
		 var dotpos=x.lastIndexOf(".");
		 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
			$('#ref1email').parent('div').addClass('has-error');
			error = true;
		  }
		  else{
			  $('#ref1email').parent('div').removeClass('has-error');
			 }
			 
			 
			  var x = $('#ref2email').val();
		 var atpos=x.indexOf("@");
		 var dotpos=x.lastIndexOf(".");
		 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
			$('#ref2email').parent('div').addClass('has-error');
			error = true;
		  }
		  else{
			  $('#ref2email').parent('div').removeClass('has-error');
			 }
		 
		 if(error)
		 {
			e.preventDefault(); 
		 } 
	});
	</script>
   <script type="text/javascript" src="js/ajaxfileupload.js"></script>
   <script type="text/javascript">

function savepic(id, val)
{//alert(id);
//can perform cliaent side field required checking for "fileToUpload" field
	$.ajaxFileUpload
	(
		{
			url:'doajaxfileupload.php',
			secureuri:false,
			fileElementId:id,
			dataType: 'json',
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						alert(data.error);
					}else
					{
						alert(data.msg);
						alert("#image"+val);
						$("#image"+val).val(data.msg);
					//	var val = $("#imageNames").val();
					//	data = id+'(*-*)'+data.msg
					//	$("#imageNames").val(val+','+data)
						//alert(data.msg); // returns location of uploaded file
					}
				}
				else
				{
					alert(data.msg);
				}
			},
			error: function (data, status, e)
			{
			alert(e);
			}
		}
	)
	return false;
}
</script>

  </body>
</html>
