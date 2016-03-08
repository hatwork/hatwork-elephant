<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Career Counseling</title>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/jquery.datetimepicker.css" />

		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
		<script src="js/jquery.datetimepicker.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.validation.js"></script>
		<script src="js/common.min.js"></script>

		<style>
.navbar-default .nav li a {
	/*text-transform: uppercase;*/
	font-family: Montserrat, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: bold;
	font-size: 15px;
	letter-spacing: 1px;
	/*color: #697CBF*/;
	color: Blue;
}
</style>

</head>
<body>
	<div class="container">
		<div class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Navigation</span> <span class="icon-bar"></span>
					<span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<div class="navbar-brand">
					<a href='home.php'>Arabic Course</a>
				</div>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" style="text-color: white">Institute<b
							class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><a href='institute-create.php'>Add</a></li>
							<li><a href='institute-list.php'>List</a></li>
						</ul></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" style="text-color: white">Course<b
							class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><a href='course-create.php'>Add</a></li>
							<li><a href='course-list.php'>List</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href='<?php echo $path->url_signout;?>'>Sign out</a></li>
					<li><a href='<?php echo $path->url_signin; ?>'>Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">