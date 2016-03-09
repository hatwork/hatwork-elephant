<?php
include_once 'common.php';

$message = "";
$name = "";
$itsid = "";
$password = "";
$email = "";
$mobile = "";

$conn = db_connect ();
$method = $_SERVER ['REQUEST_METHOD'];
if ($method === 'POST') {
	$message = "Good";
	
	$name = $_POST["name"];
	$itsid = $_POST["itsid"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$mobile = $_POST["mobile"];
	
	
	if ( db_update( $conn, "INSERT INTO people (people_name, people_itsid, people_email, people_pwd, people_mobile, people_role) 
			VALUES ('$name', $itsid, '$email', '$password' ,$mobile, 0)" ) ) {
		$message = "Institute created successfully.";
	} else {
		$message = "System error: Try again.";
	}
}

db_close($conn);

include_once 'page_header.php';
?>
<form id="Form1" method="post" action="" id="ctl01" role="form"
	class="form-horizontal minHt">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Add Student</h3>
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
				<label for="name" class="col-sm-4 control-label">Name</label>
				<div class="col-sm-8">
					<input name="name" id="name" type="text"
						value="<?php echo $name; ?>" placeholder="Student Name"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="itsid" class="col-sm-4 control-label">ITS ID</label>
				<div class="col-sm-8">
					<input name="itsid" id="itsid" type="text"
						value="<?php echo $itsid; ?>" placeholder="ITS ID"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-4 control-label">Password</label>
				<div class="col-sm-8">
					<input name="password" id="password" type="text"
						value="<?php echo $password; ?>" placeholder="Password"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-4 control-label">Email</label>
				<div class="col-sm-8">
					<input name="email" id="email" type="text"
						value="<?php echo $email; ?>" placeholder="Email"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="mobile" class="col-sm-4 control-label">Mobile</label>
				<div class="col-sm-8">
					<input name="mobile" id="mobile" type="text"
						value="<?php echo $mobile; ?>" placeholder="Mobile"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12" align="right">
					<button type="submit" name="ACTION_REFERENCE" value="Login"
						class="btn btn-primary form-control input-lg">Save</button>
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