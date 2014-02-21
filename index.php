<?php
 ini_set('display_errors','1');
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
 $nav = 2;$native = 2;
// include('includes/nav.php');
?>
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">LocumBay</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Hire a Locum</a></li>
                <li><a href="#about">Find Work</a></li>
                <li><a href="#contact">How it Works</a></li>
<!--                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
-->              </ul>
              
            <ul class="nav navbar-nav navbar-right">
           <li><a href="locumreg.php"><button class="btn btn-sm btn-primary">Register as Locum</button></a></li>
           <li><a href="pharmareg.php"><button class="btn btn-sm btn-primary">Register as Pharmacy</button></a></li>
           <li><a href="signin.php"><button class="btn btn-sm btn-primary">Sign In</button></a></li>
          </ul>

            </div>
          </div>
        </div>

      </div>
    </div>


	
        <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Find the Best Locums</h1>
              <p>Now you can find all available Locums in your area. Just signup for Free and Search.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Find the Best Locums</h1>
              <p>Now you can find all available Locums in your area. Just signup for Free and Search.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Find the Best Locums</h1>
              <p>Now you can find all available Locums in your area. Just signup for Free and Search.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->



    <div class="container">

		

      <!-- Main component for a primary marketing message or call to action-->
      <div class="jumbotron">
        <h1>Navbar example</h1>
        <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>To see the difference between static and fixed top navbars, just scroll.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
        </p>
      </div> 
          
	
      <div class="row">
      
            
      </div>

    </div> <!-- /container -->
   <?php include('includes/footer.php'); ?>
   




  </body>
</html>
