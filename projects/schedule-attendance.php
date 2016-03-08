<?php
include_once 'common.php';

$sid = isset ( $_GET ["sid"] ) ? $_GET ["sid"] : - 1;

$options = "";
$information = "";
$message = "";
$conn = db_connect ();
$institute = "No institute selected.";
$course = "";
$datetime = "";
$instituteDropDown = "";
$attendee = "";
$flag = false;

if ($sid == - 1) {
	$options = "<tr><td colspan=3>No institute selected.</td></tr>";
} else {
	$result = db_select ( $conn, "SELECT i.institute_name, c.course_name, s.course_schedule_datetime 
			FROM institute i, course c, course_schedule s 
			WHERE i.institute_id = c.course_institute_id 
			AND c.course_id = s.course_schedule_course_id AND s.course_schedule_id = $sid" );
	if (isset ( $result )) {
		$counter = 0;
		$selected = "";
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$institute = $row [0];
			$course = $row [1];
			$datetime = $row [2];
		}
	}
}


include_once 'page_header.php';
?>
<form id="Form1" method="post" action="" id="ctl01" role="form"
	class="form-horizontal minHt">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Attendance Sheet</h3>
		</div>
		<div class="panel-body">
			<?php if( strlen( $message ) > 0) { ?>
				<div class="form-group">
					<div class="alert alert-warning">
					<?php echo $message; ?>
					</div>
				</div>
			<?php } ?>
			<input name="sid" id="sid" type="hidden"
						value="<?php echo $sid; ?>"/>
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
				<label for="schedule" class="col-sm-4 control-label">Schedule</label>
				<div class="col-sm-8">
					<input name="schedule" id="courseName" type="text"
						value="<?php echo $datetime; ?>" placeholder="Course Name"
						class="form-control input-lg" readonly/>
				</div>
			</div>
			<div class="form-group">
				<label for="courseDesc" class="col-sm-4 control-label">Attendee List</label>
				<div class="col-sm-8">
					<textarea name="attendee" id="attendee"
						class="form-control input-lg"><?php echo $attendee; ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12" align="right">
					<button type="submit" 
						class="btn btn-primary input-lg">Save</button>
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