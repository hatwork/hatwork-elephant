<?php

include_once 'common.php';

$method = $_SERVER ['REQUEST_METHOD'];
if ($method === 'POST') {
	
	$pcode = $_POST["Passcode"];
	$uname = $_POST["Username"];
	
		if( $uname =="admin" && $pcode == "admin") {
			
			$udetails = array("name" => "Hatim");

			header ( "Location: welcome.php" );
			
			
		} else {
			$this->message = "Invalid Username or Password";
		}
	
} 



include_once 'page_header.php';
$message = "";
$user = "";
?>
<form id="Form1" method="post" action="" id="ctl01" role="form"
	class="form-horizontal minHt">


	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Login Area</h3>
		</div>
		<div class="panel-body">

		<?php if( strlen( $message ) > 0) { ?>
			<div class="form-group">
				<div class="alert alert-warning">
				<?php echo $message; ?>
				</div>
			</div>
		<?php } ?>
		
		
			<div class="form-group">
				<div class="col-sm-12">
					<input name="Username" id="Username" type="text"
						value="<?php echo $user; ?>" placeholder="Username"
						class="form-control input-lg" />
				</div>

			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<input name="Passcode" id="Passcode" type="password"
						placeholder="Password"
						class="form-control input-lg" />
				</div>

			</div>
			<div class="form-group">
				<div class="col-sm-12" align="right">
					<button type="submit" name="ACTION_REFERENCE" value="Login"
						class="btn btn-primary form-control input-lg">Login</button>
				</div>
			</div>
		</div>

	</div>

</form>
<script type="text/javascript">
$(function() {
	// Setup form validation on the #register-form element
	$("#Form1").validate(
	{
		// Specify the validation rules
		rules : {
			User : {
				required : true,
				minlength : 2,
			},
			Passcode : {
				required : true,
				minlength : 2,
			}
		},
		submitHandler : function(form) {
			form.submit();
		}
	});
});


</script>

<?php
include_once 'page_footer.php';
?>