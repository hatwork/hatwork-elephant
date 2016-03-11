<?php
include_once 'common.php';

$description = isset ( $_POST ["description"] ) ? $_POST ["description"] : "";
$courseName = isset ( $_POST ["courseName"] ) ? $_POST ["courseName"] : "";
$message = "";

$conn = db_connect ();
$method = $_SERVER ['REQUEST_METHOD'];
if ($method === 'POST') {
	$message = "Good";
	
	if ( db_update( $conn, "INSERT INTO course (course_name, course_desc, course_status) VALUES ('$courseName', '$description', 0)" ) ) {
		$message = "Course created successfully.";
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
			<h3 class="panel-title">Add Course</h3>
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
				<label for="courseName" class="col-sm-4 control-label">Course Name</label>
				<div class="col-sm-8">
					<input name="courseName" id="courseName" type="text"
						value="<?php echo $courseName; ?>" placeholder="Course Name"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-4 control-label">Description</label>
				<div class="col-sm-8">
					<textarea name="description" id="description"
						placeholder="Description" class="form-control input-lg"><?php echo $description; ?></textarea>
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