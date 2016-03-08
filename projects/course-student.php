<?php
include_once 'common.php';

// Get the course from URL
$course = isset ( $_GET ["course"] ) ? $_GET ["course"] : - 1;

$options = "";
$information = "";
$message = "";
$conn = db_connect ();
$institute = "No institute selected.";
$courseName = "";
$datetime = "";
$instituteDropDown = "";
$attendee = "";
$flag = false;

if ($course == - 1) {
	$message = "<tr><td colspan=3>No course selected.</td></tr>";
} else {
	$result = db_select ( $conn, "SELECT course_name FROM course 
			WHERE course_id = $course" );
	if (isset ( $result )) {
		$row = mysqli_fetch_row ( $result );
		$courseName = $row [0];
		
		$result = db_select ( $conn, "SELECT p.people_id, p.people_itsid, p.people_name 
				FROM people p, course_student cs, course c 
				WHERE p.role = 0 AND cs.course_student_people_id != p.people_id
				AND c.course_id = cs.course_student_course_id AND
				course_id = $course" );
		
		if (isset ( $result )) {
			while ( $row = mysqli_fetch_row ( $result ) ) {
				$id = $row [0];
				$name = $row [2];
				$options .= "<option value='$id'>$name</option>";
			}
		}
		
		
	} else {
		$message = "Invalid course id.";
	}
}

include_once 'page_header.php';
?>
<form id="Form1" method="post" action="" id="ctl01" role="form"
	class="form-horizontal minHt">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Course Students</h3>
		</div>
		<div class="panel-body">
			<?php if( strlen( $message ) > 0) { ?>
				<div class="form-group">
				<div class="alert alert-warning">
					<?php echo $message; ?>
					</div>
			</div>
			<?php } ?>
			<input name="course" id="course" type="hidden" value="<?php echo $course; ?>" />
			<div class="form-group">
				<label for="schedule" class="col-sm-4 control-label">Course</label>
				<div class="col-sm-8">
					<input name="schedule" id="courseName" type="text"
						value="<?php echo $course; ?>" placeholder="Course Name"
						class="form-control input-lg" readonly />
				</div>
			</div>
			<div class="form-group">
				<label for="schedule" class="col-sm-4 control-label">Add student</label>
				<div class="col-sm-8">
					<select name="students" multiselect="true">
						<?php echo $options; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12" align="right">
					<button type="submit" class="btn btn-primary input-lg">Save</button>
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