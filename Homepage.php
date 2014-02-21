<?php
 ini_set('display_errors','1');
 include('includes/session.php');
 $title = "Home Page : Pharmacy";
 include('includes/header.php');
 include('includes/connect.php');
?>
<style>

body{background:url(images/whitetexture.png) repeat;}

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
            <h2>Upload Photo:</h2><br/>
          </div>
      
		  <?php if($error!=''){ ?>
          <div class="alert alert-danger col-md-12"><?php echo $error; ?></div>
          <?php } ?>
          
          <?php
		  	if (isset($_POST['submit']) && $error == '') { // if there is no error, then process further
					//	echo "<div class='alert alert-success col-md-12'>Form has been submitted successfully.</div>"; // showing success message
				$query = "INSERT INTO pharmacy_user(p_compName,p_mangName,p_userName,p_password,p_emailadd,p_dob,p_housenum,p_address,p_postcode,p_city,p_country,p_telnum,p_vatnum,p_compnum,p_compinuse)VALUES('$compName','$managerName','$userName','$password','$email','$dob','$housenum','$address','$postcode','$city','$country','$telnum','$vatnum','$compnumb','$csinuse')";
				
				mysql_query($query) or die(mysql_error());
				$compId = mysql_insert_id();
				
				$query = "INSERT INTO common_users(c_userName,c_emailadd,c_native) VALUES('$userName','$email','$native')";
				mysql_query($query) or die(mysql_error());
				$userId = mysql_insert_id();
						//var_dump($_POST);
			}
		  ?>
          
          <form class="form-horizontal" role="form" method="post" id="homepagesite" action="<?php $_SERVER['PHP_SELF']; ?>">
              	<div class="form-group col-md-12">
                	 <label for="compName" class="col-md-2 control-label">Upload :</label>
                	 <div class="col-md-3">
                     <input type="file" name="fileToUpload" id="fileToUpload" />
               		 </div>
              	</div>
              <div class="form-group col-md-12">
                <div class="col-md-offset-4 col-md-2">
                 <button type="button" name="submit" value="Upload" class="btn btn-success" onClick="savepic()">Upload</button>
                </div>
              </div>
            </form>
   		   </div>
           <div class="row">
           	<div class="form-group col-md-12" id="map" style="height: 512px;">      
			   <noscript>
                <!-- http://code.google.com/apis/maps/documentation/staticmaps/ -->
                <img src="http://maps.google.com/maps/api/staticmap?center=chandigarh&amp;zoom=16&amp;size=512x512&amp;maptype=roadmap&amp;sensor=false" />
              </noscript>
   		   </div>
           </div>
    </div> <!-- /container -->
   <?php include('includes/footer.php'); ?>
    <script type="text/javascript" src="js/ajaxfileupload.js"></script>
	<script type="text/javascript">

function savepic()
{
//can perform client side field required checking for "fileToUpload" field
	$.ajaxFileUpload
	(
		{
			url:'doajaxfileupload.php',
			secureuri:false,
			fileElementId:'fileToUpload',
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
						alert(msg); // returns location of uploaded file
					}
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


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">

// Define the address we want to map.
var address = "mamta enclave";

// Create a new Geocoder
var geocoder = new google.maps.Geocoder();

// Locate the address using the Geocoder.
geocoder.geocode( { "address": address }, function(results, status) {

  // If the Geocoding was successful
  if (status == google.maps.GeocoderStatus.OK) {

    // Create a Google Map at the latitude/longitude returned by the Geocoder.
    var myOptions = {
      zoom: 16,
      center: results[0].geometry.location,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"), myOptions);

    // Add a marker at the address.
    var marker = new google.maps.Marker({
      map: map,
      position: results[0].geometry.location
    });

  } else {
    try {
      console.error("Geocode was not successful for the following reason: " + status);
    } catch(e) {}
  }
});
</script>
  </body>
</html>
