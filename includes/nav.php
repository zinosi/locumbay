    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
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
           
           <?php if($nav == 2){ ?>
                     <ul class="nav navbar-nav">

            <li><a href="#about">Hire a Locum</a></li>
            <li><a href="#contact">Find Work</a></li>
            <li><a href="#contact">How it Works</a></li>
<!--            <li class="dropdown">
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
-->            </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
           <li><a href="">Sign In</a></li>
           <li><a href="">Register Now</a></li>
          </ul>

          <?php } ?>
         
          
          
			<?php if($nav == 1){ ?>
                      <ul class="nav navbar-nav navbar-right">

            <li><a href="../navbar/">Already Have a LocumBay Account?</a></li>
            <li><a href="./">SignIn</a></li>
            </ul>
            <?php } ?>
           
          
          
          
        
        
        
        </div><!--/.nav-collapse -->
      </div>
    </div>

