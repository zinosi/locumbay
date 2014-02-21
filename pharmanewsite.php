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
<link href="css/jquery.timepicker.css" rel="stylesheet" />
</head>
<body>
<?php 
 $sidenav = 7;$native = 1;
 include('includes/navcp.php');
 include('includes/sidenav.php');
 include('validate.php');
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
            <a href="showBranches.php" class="btn btn-primary">Show All Branches</a>
      	  <div class="col-md-offset-4">
           <?php
			if(isset($_GET['branch']))
			{
				echo '<h2>Edit Pharmacy Branch (site)</h2><br/>';
				$id = $_GET['branch'];
			}
			else
			{
            echo '<h2>New Pharmacy Branch (site)</h2><br/>';
			}
			?>
          </div>
      
      
      
		  <?php if(isset($error) && $error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
          
           <?php
		   if (isset($_POST['submit']) && $error == '' && isset($_GET['branch'])) {
				
				echo "<div class='alert alert-success col-md-12'>Form has been Updated successfully.</div>"; // showing success message
//				$compName = $_SESSION['CompName'];
				if(isset($services))
				{$serv = serialize($services);}
				else{$serv = serialize(array());}

				$time = serialize(array('opentime'=>$opentime, 'closetime'=>$closetime, 'lunchstart'=>$lunchstart, 'lunchend'=>$lunchend));
				$compId = $_SESSION['id'];
				$query = "UPDATE pharmacy_branch SET p_name='$pharmacyName', pb_name='$branchName', pb_address1='$address1', pb_address2='$address', pb_postcode='$postcode', pb_city='$city', pb_country='$country', pb_phone='$telnum', pb_item_pday='$item_pday', pb_staff='$staff', pb_url='$branchurl', pb_muser='$compId', pb_services='$serv', pb_hours='$time', pb_desc='$desc', pb_images='$imageNames' WHERE pb_id='$id'";
				mysql_query($query) or die(mysql_error());
			}
			elseif (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
				echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
//				$compName = $_SESSION['CompName'];
				if(isset($services))
				{$serv = serialize($services);}
				else{$serv = serialize(array());}

				$time = serialize(array('opentime'=>$opentime, 'closetime'=>$closetime, 'lunchstart'=>$lunchstart, 'lunchend'=>$lunchend));
				$compId = $_SESSION['id'];
				$query = "INSERT INTO pharmacy_branch(p_name, pb_name, pb_address1, pb_address2, pb_postcode, pb_city, pb_country, pb_phone, pb_item_pday, pb_staff, 	pb_url, pb_muser, pb_services, pb_hours, pb_desc, pb_images, pb_createdDate, pb_createdTime, pb_createdIP, pb_modifiedDate, pb_modifiedTime, pb_modifiedIP )VALUES('$pharmacyName','$branchName','$address1','$address','$postcode','$city','$country','$telnum','$item_pday','$staff','$branchurl', '$compId', '$serv', '$time', '$desc', '$imageNames', CURDATE(), CURTIME(), '', CURDATE(), CURTIME(), '')";
				mysql_query($query) or die(mysql_error());
			}
			
			
			if(isset($_GET['branch']))
				{
					$query1 = "SELECT * FROM pharmacy_branch WHERE pb_id = '$id'";
					$result1 = mysql_query($query1);
					$num = mysql_num_rows($result1);
					if($num)
					{
						$row1 = mysql_fetch_assoc($result1);
						$pharmacyName = $row1['p_name'];
						$branchName = $row1['pb_name'];
						$address1 = $row1['pb_address1'];
						$address = $row1['pb_address2'];
						$postcode = $row1['pb_postcode'];
						$city = $row1['pb_city'];
						$country = $row1['pb_country'];
						$telnum = $row1['pb_phone'];
						$item_pday = $row1['pb_item_pday'];
						$staff = $row1['pb_staff'];
						$branchurl = $row1['pb_url'];
						$imageNames = $row1['pb_images'];
						$desc =  $row1['pb_desc'];
						$services = unserialize($row1['pb_services']);
						$time = unserialize($row1['pb_hours']);
						$opentime = $time['opentime'];
						$closetime = $time['closetime'];
						$lunchstart = $time['lunchstart'];
						$lunchend = $time['lunchend'];
						//echo '<pre>',print_r($services);
					}
				}
			  ?>
          
          
          
          <form class="form-horizontal" role="form" method="post" id="pharmacybranch" action="<?php $_SERVER['PHP_SELF']; ?>">
              	<div class="form-group col-md-12">
                     <label for="pharmacyName" class="col-md-2 control-label">Pharmacy Name :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="pharmacyName" id="pharmacyName" class="form-control col-md-12" value="<?php echo isset($pharmacyName) ? $pharmacyName : '';?>">
               		 </div>
                     
                   	 <label for="branchName" class="col-md-2 control-label">Branch Name :</label>
                	 <div class="col-md-3">
                 	 	<input type="text" name="branchName" id="branchName" class="form-control col-md-12" value="<?php echo isset($branchName) ? $branchName : '';?>">
                 	 </div>
              	</div>
              
          	 <div class="form-group col-md-12">
                	 <label for="address1" class="col-md-2 control-label">Address 1 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="address1" id="address1" class="form-control col-md-12" value="<?php echo isset($address1) ? $address1 : '';?>">
               		 </div>
                     
                     <label for="address" class="col-md-2 control-label">Address 2 :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="address" id="address" class="form-control col-md-12" value="<?php echo isset($address) ? $address : '';?>">
               		 </div>
               </div>
             
             <div class="form-group col-md-12">
                <label for="postcode" class="col-md-2 control-label">Post Code <font color="#FF0000">*</font>:</label>
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
                     
                	 <label for="item_pday" class="col-md-2 control-label">Number of Item/day :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="item_pday" id="item_pday" class="form-control col-md-12" value="<?php echo isset($item_pday) ? $item_pday : '';?>">
               		 </div>
               </div>
             
               <div class="form-group col-md-12">
                	 <label for="staff" class="col-md-2 control-label">Number of Staff :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="staff" id="staff" class="form-control col-md-12" value="<?php echo isset($staff) ? $staff : '';?>">
               		 </div>
                     
                      <label for="branchurl" class="col-md-2 control-label">Branch Url :</label>
                	 <div class="col-md-3">
                 	 <input type="text" name="branchurl" id="branchurl" class="form-control col-md-12" value="<?php echo isset($branchurl) ? $branchurl : '';?>">
               		 </div>
               </div>
               
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
               		<label for="telnum" class="col-md-2 control-label">Description :</label>
                	 <div class="col-md-8">
                 	 <textarea name="desc" id="desc" class="form-control col-md-12" rows="5"><?php echo isset($desc) ? $desc : '';?></textarea>
                     <input type="hidden" name="imageNames" id="imageNames" value="<?php echo isset($imageNames) ? $imageNames : ''; ?>" />
               		 </div>
               </div>
			<?php $days = array('mon'=> 'Monday', 'tue'=> 'Tuesday', 'wed'=> 'Wednesday', 'thr'=>'Thursday', 'fri'=> 'Friday', 'sat'=> 'Saturday', 'sun'=> 'Sunday');
			$g=0;
			foreach($days as $key => $val){
				?>
                <div class="form-group col-md-12">
                	 <label for="staff" class="col-md-2 control-label"><?php echo $val; ?> :</label>
                      <div class="col-md-2">
                      <?php 
						  if(isset($opentime))
						  {
							 $open = $opentime[$g];
							 $close = $closetime[$g];
							 $start = $lunchstart[$g];
							 $end = $lunchend[$g];
						  }
						  else
						  {
							 $open = '';
							 $close = '';
							 $start = '';
							 $end = '';
						  }
						  $g++;
					  ?>
                      <select name="opentime[]"  class="form-control col-md-12 opentime"  >
                      <option value="">Open Time</option>
                     <?php 
					 	for($o=0;$o<24;$o++)
						{
							if($o<10)
							{
								$o='0'.$o;
							}
							if($open == $o.':00')
							{
								echo '<option value="'.$o.':00" selected>'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
							elseif($open == $o.':30')
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30" selected>'.$o.':30</option>';
							}
							else
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
						}
					 ?>
                      </select>
               		 </div>
                      <div class="col-md-2">
                      <select name="closetime[]" class="form-control col-md-12 closetime" >
                       <option value="">Close Time</option>
                     <?php 
					 	for($o=0;$o<24;$o++)
						{
							if($o<10)
							{
								$o='0'.$o;
							}
                      		if($close == $o.':00')
							{
								echo '<option value="'.$o.':00" selected>'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
							elseif($close == $o.':30')
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30" selected>'.$o.':30</option>';
							}
							else
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
						}
					 ?>
                      </select>
               		 </div>
                      <div class="col-md-2">
                      <select name="lunchstart[]" class="form-control col-md-12 lunchstart"  >
                       <option value="">Lunch Start</option>
                     <?php 
					 	for($o=0;$o<24;$o++)
						{
							if($o<10)
							{
								$o='0'.$o;
							}
                      		if($start == $o.':00')
							{
								echo '<option value="'.$o.':00" selected>'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
							elseif($start == $o.':30')
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30" selected>'.$o.':30</option>';
							}
							else
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
						}
					 ?>
                      </select>
               		 </div>
                      <div class="col-md-2">
                      <select name="lunchend[]" class="form-control col-md-12 lunchend"  >
                      <option value="">Lunch End</option>
                     <?php 
					 	for($o=0;$o<24;$o++)
						{
							if($o<10)
							{
								$o='0'.$o;
							}
                      		if($end == $o.':00')
							{
								echo '<option value="'.$o.':00" selected>'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
							elseif($end == $o.':30')
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30" selected>'.$o.':30</option>';
							}
							else
							{
								echo '<option value="'.$o.':00">'.$o.':00</option>';
								echo '<option value="'.$o.':30">'.$o.':30</option>';
							}
						}
					 ?>
                      </select>
               		 </div>
                     <?php
					 
					 if($g==1)
					 {
						 ?>
						 <div class="col-md-1">
                         <button type="button" name="sametime" id="sametime" class="btn btn-warning">Make all Same</button>
                         </div>
                    					<?php }
					 ?>
               </div>
			<?php }
			 ?>
             <div class="form-group col-md-12">
                	 <label for="compName" class="col-md-2 control-label">Upload :</label>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload" />
                
               		 </div>
                      <div class="col-md-2">
                     <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload')">Upload</button>
                	
               		 </div>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload1" />
                
               		 </div>
                      <div class="col-md-2">
                     <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload1')">Upload</button>
                
               		 </div>
              	</div>
                  <div class="form-group col-md-12">
                	 <label for="compName" class="col-md-2 control-label"></label>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload2" />
                
               		 </div>
                      <div class="col-md-2">
                     <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload2')">Upload</button>
                
               		 </div>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload3" />
                
               		 </div>
                      <div class="col-md-2">
                     <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload3')">Upload</button>
               		 </div>
              	</div>
                  <div class="form-group col-md-12">
                  <label for="compName" class="col-md-2 control-label"></label>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload4" />
                
               		 </div>
                      <div class="col-md-3">
                     <button type="button" name="submit" value="Upload" class="btn btn-warning" onClick="savepic('fileToUpload4')">Upload</button>
               		 </div>
              	</div>
              <div class="form-group col-md-12">
                <div class="col-md-offset-4 col-md-2">
                 <button type="submit" name="submit" value="Submit" class="btn btn-success" id="register"><?php if(isset($_GET['branch'])){echo "Update";}else {echo "Add New";}?></button>
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
    $('.timepicker').timepicker();
	$('#reset').on('click',function(e){
		e.preventDefault(); 
		 var allfields = $('#pharmacybranch').serialize().split('&');
			for(var i=0;i<allfields.length;i++)
			{
				var need = allfields[i].split('=');
				var need1 = need[0];
				$('#'+need1).val('');
			}//for(var i=0;i<allfields.length;i++)
	});
	
	$(document).on('click', "#sametime", function(e) {
       var ot = $(".opentime:first").val();
	   var ct = $(".closetime:first").val();
	   var ls = $(".lunchstart:first").val();
	   var le = $(".lunchend:first").val();
	    $(".opentime").each(function(index, element) {
            $(this).val(ot);
        });
		
		$(".closetime").each(function(index, element) {
            $(this).val(ct);
        });
		
		$(".lunchstart").each(function(index, element) {
            $(this).val(ls);
        });
		
		$(".lunchend").each(function(index, element) {
            $(this).val(le);
        });
    });
	
	$('#register').on('click',function(e){
	   	var error = false;

	    var allfields = $('#pharmacybranch').serialize().split('&');
		
		for(var i=0;i<allfields.length;i++)
		{
		  	var need = allfields[i].split('=');
			var need1 = need[0];
			
			if(need1 == 'pharmacyName' || need1 == 'branchName' || need1 == 'address1' || need1 == 'telnum' ||  need1 == 'item_pday' ||  need1 == 'staff' ||  need1 == 'branchurl' ||  need1 == 'postcode' ||  need1 == 'city' ||  need1 == 'country')
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
	
    tinymce.init({
		menubar:false,
    statusbar: false,
        selector: "#desc",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste moxiemanager"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
	</script>
   <script type="text/javascript" src="js/ajaxfileupload.js"></script>
	<script type="text/javascript">

function savepic(id)
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
						var val = $("#imageNames").val();
						$("#imageNames").val(val+','+data.msg)
						//alert(data.msg); // returns location of uploaded file
					}
				}
				else
				{
					//alert(data.msg);
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
