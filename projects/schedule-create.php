<?php
include_once 'common.php';

$courseid = isset ( $_GET ["course"] ) ? $_GET ["course"] : "";

$scheduleDesc = isset ( $_POST ["scheduleDesc"] ) ? $_POST ["scheduleDesc"] : "";
$scheduleDate = isset ( $_POST ["scheduleDate"] ) ? $_POST ["scheduleDate"] : "";
$sc_course_id = isset ( $_POST ["course_id"] ) ? $_POST ["course_id"] : "";
$scheduleVenue = isset ( $_POST ["scheduleVenue"] ) ? $_POST ["scheduleVenue"] : "";

$message = "";

$institute = "No institute selected.";
$course = "";


$conn = db_connect ();
$result = db_select ( $conn, "SELECT i.institute_name, c.course_name 
		FROM institute i, course c 
		WHERE i.institute_id = c.course_institute_id AND c.course_id = $courseid" );
if (isset ( $result )) {
	$counter = 0;
	$selected = "";
	$row = mysqli_fetch_row ( $result );
	$institute = $row [0];
	$course = $row [1];
}

$method = $_SERVER ['REQUEST_METHOD'];
if ($method === 'POST') {
	$message = "Good";
	
	if ( db_update( $conn, "INSERT INTO course_schedule (course_schedule_course_id,course_schedule_datetime,
			course_schedule_venue,course_schedule_desc, course_schedule_status) 
			VALUES ($sc_course_id, '$scheduleDate', '$scheduleVenue', '$scheduleDesc', 0)" ) ) {
		$message = "schedule created successfully.";
	} else {
		$message = "System error: Try again.";
	}

	db_close($conn);
}

include_once 'page_header.php';
?>
<form id="Form1" method="post" action="?course=<?php echo $courseid; ?>" id="ctl01" role="form"
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
			<input name="course_id" type="hidden"
						value="<?php echo $courseid; ?>"/>
			<div class="form-group">
				<label for="schedule" class="col-sm-4 control-label">Institute</label>
				<div class="col-sm-8">
					<input name="schedule" id="courseName" type="text"
						value="<?php echo $institute; ?>" placeholder="Course Name"
						class="form-control input-lg" readonly/>
				</div>
			</div>
			<div class="form-group">
				<label for="schedule" class="col-sm-4 control-label">Course</label>
				<div class="col-sm-8">
					<input name="schedule" id="courseName" type="text"
						value="<?php echo $course; ?>" placeholder="Course Name"
						class="form-control input-lg" readonly/>
				</div>
			</div>
			<div class="form-group">
				<label for="scheduleDate" class="col-sm-4 control-label">Date & Time (DD/MM/YYYY HH:MM)</label>
				<div class="col-sm-8">
					<input name="scheduleDate" id="scheduleDate" type="text"
						value="<?php echo $scheduleDate; ?>" placeholder="Schedule Date"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="scheduleVenue" class="col-sm-4 control-label">Venue</label>
				<div class="col-sm-8">
					<input name="scheduleVenue" id="scheduleVenue" type="text"
						value="<?php echo $scheduleVenue; ?>" placeholder="Schedule Venue"
						class="form-control input-lg" />
				</div>
			</div>
			<div class="form-group">
				<label for="scheduleDesc" class="col-sm-4 control-label">Description</label>
				<div class="col-sm-8">
					<textarea name="scheduleDesc" id="scheduleDesc"
						placeholder="Description"
						class="form-control input-lg"><?php echo $scheduleDesc; ?></textarea>
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