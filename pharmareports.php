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
<style>

body{background:url(includes/images/whitetexture.png) repeat;}

</style>

</head>
      
<body>

<?php 
 $sidenav = 8;$native = 1;
 include('includes/navcp.php');
 include('includes/sidenav.php');
?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Pharmacy Reports</h2>
         <h4 class="sub-header">Total Locums Cost for <?php echo $_SESSION['compname'];?></h4>

          <div class="table-responsive">
              <?php
			  
			  function checkMinutes(&$hours, &$minutes)
			  {
				if($minutes >= 60)
				{
					$hours++;
					$minutes = $minutes-60;
					checkMinutes($hours, $minutes);
				}
			  }
			  $compId = $_SESSION['id'];
			//	$compId = 1;
			//  echo $compId;
			  $query = "SELECT * FROM locum_vacancy LEFT JOIN pharmacy_branch on locum_vacancy.lv_store=pharmacy_branch.pb_id WHERE locum_vacancy.lv_muser = '$compId'";
			  $result = mysql_query($query);
			  $num = mysql_num_rows($result);
			  if($num)
			  {
				  ?>
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Branch Name</th>
                          <th>Total Hours</th>
                          <th>Total Cost</th>
                        </tr>
                      </thead>
                      <tbody>
				  <?php
				  $totprice = 0;
				  $tothours = 0;
				  $totminutes = 0;
				  while($row = mysql_fetch_assoc($result))
				  {
				//  $query = 
					  ?>
                      <tr>
                      <td><?php echo $row['pb_name'];?></td>
                      <td><?php 
					 	$lv_data = unserialize($row['lv_data']);
					//	echo "<pre>", print_r($lv_data);
						$open= $lv_data['open'];
						$close= $lv_data['close'];
						$res  = array();
					
						for($i=0;$i<count($close);$i++){
							$end = explode(":", $close[$i]);
							$end_hour = $end[0];
							$end_minute = $end[1];
							
							$start = explode(":", $open[$i]);
							$start_hour = $start[0];
							$start_minute = $start[1];
							
							$result_minutes = $end_minute - $start_minute;
							$result_hours = $end_hour - $start_hour;
							
							if($result_minutes < 0)
							{
								$result_minutes += $result_hours*60;
								$result_hours = 0;
								checkMinutes($result_hours, $result_minutes);
							}
							
							$result_ = $result_hours.':'.$result_minutes;
						    $res[$i] = $result_;
						}
						
						$hours =0;$minutes = 0;
						for($i=0;$i<count($res);$i++){
							$end = explode(":", $res[$i]);
							$end_hour = $end[0];
							$end_minute = $end[1];
							$minutes += $end_minute;
							$hours += $end_hour;
						}
						checkMinutes($hours, $minutes);
						
						$tothours += $hours;
						$totminutes += $minutes;
						
						if($hours < 9)
						{
							$hours = '0'.$hours;
						}
						
						if($minutes < 9)
						{
							$minutes = '0'.$minutes;
						}

						echo $hours.':'.$minutes;
					//	print_r($res);
					  ?></td>
                      <td><?php 
						$lv_data = unserialize($row['lv_data']);
						$price= $lv_data['price'];
						
						$totprice += array_sum($price);
						echo '£ '.array_sum($price);
					  //echo $row['p_compName'];?></td>
                    </tr>
				 <?php
				  }?>
                     <tr>
                          <td><strong>Pharmacy Total</strong></td>
                          <td><strong><?php 
						  		checkMinutes($tothours, $totminutes);
								if($tothours < 9)
								{
									$tothours = '0'.$tothours;
								}
								
								if($totminutes < 9)
								{
									$totminutes = '0'.$totminutes;
								}
						  
						  		 echo $tothours.':'.$totminutes;
						  ?></strong></td>
                          <td><strong><?php echo  '£ '.$totprice; ?></strong></td>
                        </tr>
                     </tbody>
            </table>
			 <?php }
			 else
			 {
				 echo "No Users are present currently";
			 }
			  ?>
          </div>
        </div>
      </div>
    </div>
   <?php include('includes/footer.php'); ?>
  </body>
</html>
