<?php
include('connection.php');
session_start();
 ?>
<html>
	<head>
		<title>IIT Notice Board</title>
		<script src="https://kit.fontawesome.com/9778dd3679.js" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery_library.js"></script>
<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
			<nav class="navbar navbar-default navbar-fixed-top" style="background:Aqua">
  <div class="container">

  <ul class="nav navbar-nav navbar-left">
    <li ><a href="index.php"><span class="glyphicon glyphicon-book"></span>&nbsp<b>IIT Notice Board</b></a></li>


	 

	</ul>


<ul class="nav navbar-nav navbar-right">
      <!-- <li ><a href="index.php?option=New_user"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
	  <li ><a href="Registration.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> 
	  <li><a href="index.php?option=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>



</div>
</nav>

<div class="container-fluid">
	<!-- slider -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/notice.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>

	 <div class="item">
      <img src="images/NSTU.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!-- slider end-->
</div>


<div class="container">
	<div class="row">
	<!-- container -->
		<div class="col-sm-8">
		<?php
		@$opt=$_GET['option'];

		if($opt!="")
		{
			
			if($opt=="New_user")
			{
			include('registration.php');
			}


			else if($opt=="login")
			{
			include('login.php');
			}
		}
		else
		{
		echo "<h2><b>'WELCOME USER TO OUR IIT NOTICE BOARD'</b></h2>
		<i> <b> Join us today to get the latest notice of your institute! </b></i>";
		}
		?>



		</div>

		<!-- container -->

		<div class="col-sm-4">
			<div class="panel panel-default">
  <div class="panel-heading"><b>Latest Notice</b></div>
  <div class="panel-body">
	From January 1,2023 weekly 5 day offline class will be started.
    </div>
</div>

		</div>
	
	</div>

</div>



<br/>
<br/>
<br/>
<br/>



	</body>
</html>
