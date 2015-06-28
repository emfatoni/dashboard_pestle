<!DOCTYPE html>

<head>
	<title>PESTLE Dashboard</title>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fd-colors.css">
	<link rel="stylesheet" type="text/css" href="css/my-style.css">
	<link rel="stylesheet" type="text/css" href="css/angular-carousel.css">

	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/unislider.js"></script>

	<script src="js/angular.js"></script>
	<script src="js/angular-route.js"></script>
	<script src="js/ui-bootstrap.js"></script>
	<script src="js/angular-touch.min.js"></script>
	<script src="js/angular-carousel.js"></script>
	<script src="js/myscript.js"></script>
</head>

<body ng-app="daspestleApp" ng-controller="MainController">
	<!-- NAVBAR -->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">PESTLE Dashboard</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="#">Home</a></li>
	        <li><a href="#/politic">Politic</a></li>
	        <li><a href="#/economy">Economy</a></li>
	        <li><a href="#/social">Social</a></li>
	        <li><a href="#/technology">Technology</a></li>
	        <li><a href="#/legal">Legal</a></li>
	        <li><a href="#/environment">Environment</a></li>
	      </ul>
	      
	      <ul class="nav navbar-nav navbar-right">
	      	<li><a href="#/keyword">Keywords</a></li>
	      	<li><a href="#/site">Websites</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<!-- MAIN -->
	<div class="container" ng-view>
	</div>

	<!-- FOOTER -->
	<div class="col-md-12" style="margin-top: 50px">
		<div class="col-md-12 text-center" style="padding: 20px 0px; border-top: 1px solid #888888">
			Copyright &copy emf
		</div>
	</div>
</body>

</html>