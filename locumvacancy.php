<?php
 ini_set('display_errors','1');
 include('includes/session.php');
 if($_SESSION['type'] == '2')
 {
	  header('location:locumcp.php');
 }
 $title = "LocumBay | Locum Control Panel";
 include('includes/header.php');
 include('includes/connect.php');
?>
<link href="css/jquery.timepicker.css" rel="stylesheet" />
</head>
<body>
<?php 
 $sidenav = 6;$native = 1;
 include('includes/navcp.php');
 include('includes/sidenav.php');
 include('validate.php');
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="row">
            <a href="showVacancies.php" class="btn btn-primary">Show All Vacancies</a>
          <div class="col-md-offset-4">
          
           <?php
			if(isset($_GET['lv']))
			{
				echo '<h2>Edit Locum Vacancy:</h2><br/>';
				$id = $_GET['lv'];
			}
			else
			{
            echo '<h2>New Locum Vacancy</h2><br/>';
			}
			?>
          </div>
      
      
		  <?php if(isset($error) && $error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
          
           <?php
		   $compId = $_SESSION['id'];
		  	if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
				echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
				$query1 = "SELECT p_lremaining FROM pharmacy_user WHERE p_id = '$compId'";
				$result1 = mysql_query($query1);
				$num1 = mysql_num_rows($result1);
				if($num1)
				{
					$row1 = mysql_fetch_assoc($result1);
					$p_lremain = $row1['p_lremaining'];
					if($p_lremain > 0)
					{
					  $p_lremain--;
	 				  $query2 = "UPDATE pharmacy_user SET p_lremaining = '$p_lremain' WHERE p_id = '$compId'";
					  mysql_query($query2);

					  $data = serialize(array('open'=>$opentime, 'close'=> $closetime, 'price'=> $price, 'datetext'=>$datetext));
					  $query = "INSERT INTO locum_vacancy(lv_store, lv_start, lv_end, lv_desc, lv_data, lv_muser, lv_createdDate, lv_createdTime, lv_createdIP, lv_modifiedDate, lv_modifiedTime, lv_modifiedIP)VALUES('$store', '$startdate', '$enddate', '$desc', '$data', '$compId', CURDATE(), CURTIME(), '', CURDATE(), CURTIME(), '')";
					  mysql_query($query) or die(mysql_error());
					}
					else
					{
						echo "Sorry you dont have enough points to submit a Vacancy";
					}
				}
			//	print_r($_POST);
//				$compName = $_SESSION['CompName'];
			}
			else
			{
				if (isset($_POST['edit_details']) && $error == '') { // if there is no error, then process further
					echo "<div class='alert alert-success col-md-12'>Form has been Updated successfully.</div>"; // showing success message
				//	echo $managerName;
					$data = serialize(array('open'=> $opentime, 'close'=> $closetime, 'price'=> $price, 'datetext'=> $datetext));
					$query = "UPDATE locum_vacancy SET lv_store = '$store', lv_start = '$startdate', lv_end = '$enddate',lv_desc = '$desc',lv_data = '$data' WHERE lv_id = '$id'";
					if(!mysql_query($query))
					{
						echo "Some problem occurred. Please try later";
					}
				}
			}
			
				if(isset($_GET['lv']))
				{
					$query1 = "SELECT * FROM locum_vacancy WHERE lv_id = '$id'";
					$result1 = mysql_query($query1);
					$num = mysql_num_rows($result1);
					if($num)
					{
						$row1 = mysql_fetch_assoc($result1);
						$store = $row1['lv_store'];
						$startdate = $row1['lv_start'];
						$enddate = $row1['lv_end'];
						$desc = $row1['lv_desc'];
						$data = unserialize($row1['lv_data']);
					}
				}
		  
		  ?>
          
          <form class="form-horizontal" role="form" method="post" id="locumvacancy" action="<?php $_SERVER['PHP_SELF']; ?>">
           <div class="form-group col-md-12">
            	 <label for="Advertise" class="col-md-2 control-label">Advertise</label>
           </div>
              <div class="form-group col-md-12">
                	 <label for="store" class="col-md-2 control-label">Select Store <font color="#FF0000">*</font>:</label>
                      <div class="col-md-3">
                     
                      <select name="store" id="store" class="form-control col-md-12">
                     	<option value="">Please Select From the List</option>
                    	<?php
								
								$query1 = "SELECT * FROM pharmacy_branch WHERE pb_muser = '$compId'";
								$result1 = mysql_query($query1);
								while($rows1 = mysql_fetch_assoc($result1))
								{
									$ps_id = $rows1['pb_id'];
									$ps_name = $rows1['pb_name'];
									if($ps_id == $store)
									{$selected = "selected";}
									else
									{$selected = '';}
									echo '<option value="'.$ps_id.'" '.$selected.'>'.$ps_name.'</option>';
								}
						?>
                     </select>
               		 </div>
              	</div>
                
                 <div class="form-group col-md-12" id="dates">
                	 <label for="startdate" class="col-md-2 control-label">Start date <font color="#FF0000">*</font>:</label>
                      <div class="col-md-3">
                      <input type="text" name="startdate" id="startdate" class="form-control col-md-12" value="<?php echo isset($startdate) ? $startdate : '';?>">

               		 </div>
                     
                      <label for="enddate" class="col-md-2 control-label">End date <font color="#FF0000">*</font>:</label>
                      <div class="col-md-3">
                      <input type="text" name="enddate" id="enddate" class="form-control col-md-12" value="<?php echo isset($enddate) ? $enddate : '';?>">
               		 </div>
              	</div>
				<?php
				if(isset($_GET['lv']))
				{
					$openarr = $data['open'];
					$closearr = $data['close'];
					$pricearr = $data['price'];
					$datetextarr = $data['datetext'];
					
					for($g=0;$g<count($openarr);$g++)
					{
						 $open = $openarr[$g];
						 $close = $closearr[$g];
						 $price = $pricearr[$g];
						 $datetext = $datetextarr[$g];
				?>
				 <div class="form-group col-md-12 newrange">
                 <input type="hidden" name="datetext[]" value="<?php echo $datetext;?>" />
                	 <label for="staff" class="col-md-2 control-label"><?php echo $datetext;?> :</label>
                      <div class="col-md-2">
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
                    <input type="text" name="price[]" placeholder="Price" class="form-control col-md-12 price" value="<?php echo $price;?>">
               		 </div>
                     <?php
					 if($g==0)
					 {
						 ?>
						 <div class="col-md-1">
                         <button class="btn btn-primary" id="sametime" type="button">Same for all</button>
                         </div>
                  <?php } ?>
               </div>
				 <?php } } ?>
                 
                  <div class="form-group col-md-12">
                	 <label for="desc" class="col-md-2 control-label">Description <font color="#FF0000">*</font>:</label>
                      <div class="col-md-8">
                      <textarea name="desc" id="desc" rows="5" class="form-control col-md-12"><?php echo isset($desc) ? $desc : '';?></textarea>
               		 </div>
              	</div>
			
              <div class="form-group col-md-12">
                <div class="col-md-offset-4 col-md-2">
                   <?php 
				 if(isset($_GET['lv']))
				 {
                 	echo '<button type="submit" name="edit_details" value="Submit" class="btn btn-success" id="register">Edit Details</button>';
				 }
				 else
				 {
					echo ' <button type="submit" name="submit" value="Submit" class="btn btn-success" id="register">Add New</button>'; 
				 }?>
                 
                
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
	$("#startdate").datepicker({
		 minDate: 0,
		 onClose: function(selectDate){
		 	 $("#enddate").datepicker("option", "minDate", selectDate);
			 getdiff();
		 }
	 });
	
	$("#enddate").datepicker({ minDate: 0,
		onClose: function(selectDate){
			 getdiff();
		 }});
		 
		 
		 function getdiff()
		 {   
			 $(".newrange").each(function(index, element) {
                $(this).remove();
            });
			 var startdate = $("#startdate").datepicker("getDate");
			 var enddate = $("#enddate").datepicker("getDate");
		//	 alert(startdate);
			// alert(enddate);
	//	if(startdate != '' && endate != "")
	//	{
			var	currentDate = new Date(startdate),
				between = []
			;
			while (currentDate <= enddate) {
				between.push(new Date(currentDate));
				currentDate.setDate(currentDate.getDate() + 1);
			}
			var text = '';
			for(var j=0;j<between.length;j++)
			{
				//	alert(typeof between[j]+'---'+between[j]);
				between[j] = String(between[j]);
			//	alert(typeof between[j]+'---'+between[j]);
			//	alert(between[j]);
				var date1 = between[j].split(' ');
				//alert("kuhk");
			//	alert(between[j].length);
				text += '<input type="hidden" name="datetext[]" value="'+date1[1]+' '+date1[2]+' '+date1[3]+'" />';
				text += '<div class="form-group col-md-12 newrange">';
				text += '<label for="price" class="col-md-2 control-label">'+date1[1]+' '+date1[2]+' '+date1[3]+'</label>';
                text += '<div class="col-md-2">';
				text += '<select name="opentime[]" class="form-control col-md-12 open">';
                            for(var o=0;o<24;o++)
                            {
                                if(o<10)
                                {
                                    o='0'+o;
                                }
                                text += '<option value="'+o+':00">'+o+':00</option>';
                                text += '<option value="'+o+':30">'+o+':30</option>';
                            }
							
                   text += '   </select>';
                   text += '	</div>';
                   
                   text += '   <div class="col-md-2">';
                   text += '    <select name="closetime[]"  class="form-control col-md-12 cls">';
                            for(var o=0;o<24;o++)
                            {
                                if(o<10)
                                {
                                    o='0'+o;
                                }
                                 text += '<option value="'+o+':00">'+o+':00</option>';
                                 text += '<option value="'+o+':30">'+o+':30</option>';
                            }
                    text += ' </select>';
               		text += ' </div>';
					 
                    text += '<div class="col-md-2">';
                    text += '<input type="text" name="price[]" placeholder="Price" class="form-control col-md-12 price" value="">';
					text += '</div>';
					if(j == 0)
					{
					 text += '<div class="col-md-2">';
					 text += '<button class="btn btn-primary" id="sametime" type="button">Same for all</button>';
					 text += '</div>';
					}
              	  text += ' </div>';
			}
	//	}
			$("#dates").after(text);
	 }
		//getdiff();
	$(document).on('click', "#sametime", function(e) {
       var op = $(".open:first").val();
	   var cl = $(".cls:first").val();
	   var pr = $(".price:first").val();
	    $(".open").each(function(index, element) {
            $(this).val(op);
        });
		
		$(".cls").each(function(index, element) {
            $(this).val(cl);
        });
		
		$(".price").each(function(index, element) {
            $(this).val(pr);
        });
    });
	
	$('#reset').on('click',function(e){
		e.preventDefault(); 
		$(".newrange").each(function(index, element) {
                $(this).remove();
        });
		var allfields = $('#locumvacancy').serialize().split('&');
		for(var i=0;i<allfields.length;i++)
		{
			var need = allfields[i].split('=');
			var need1 = need[0];
			$('#'+need1).val('');
		}//for(var i=0;i<allfields.length;i++)
	});
	
	$('#register').on('click',function(e){
	   	var error = false;

	    var allfields = $('#locumvacancy').serialize().split('&');
		
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
{alert(id);
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
						data = id+'(*-*)'+data.msg
						$("#imageNames").val(val+','+data)
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
