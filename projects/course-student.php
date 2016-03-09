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
$enrolled = "No student enrolled.";

if ($course == - 1) {
	$message = "<tr><td colspan=3>No course selected.</td></tr>";
} else {
	
	$method = $_SERVER ['REQUEST_METHOD'];
	if ($method === 'POST') {
		$message = "Good";

		$qry = "INSERT INTO course_student (course_student_people_id, course_student_course_id) VALUES ";
		$studentsPOST = $_POST["students"];
		$flag = false;
		foreach ( $studentsPOST as $stu ) {
			if( $flag ) {
				$qry .= ",";
			} else {
				$flag = true;
			}
			$qry .= "('$stu', '$course')";
		}
	
		if ( db_update( $conn, $qry ) ) {
			$message = "Institute created successfully.";
		} else {
			$message = "System error: Try again.";
		}
	}
	
	
	$result = db_select ( $conn, "SELECT course_name FROM course 
			WHERE course_id = $course" );
	if (isset ( $result )) {
		$row = mysqli_fetch_row ( $result );
		$courseName = $row [0];
		
		$result = db_select ( $conn, "SELECT p.people_id, p.people_itsid, p.people_name 
				FROM people p, course_student cs, course c 
				WHERE p.people_role = 0 AND cs.course_student_people_id = p.people_id
				AND c.course_id = cs.course_student_course_id AND
				course_id = $course" );
		
		if (isset ( $result )) {
			$counter = 0;
			$enrolled = "";
			while ( $row = mysqli_fetch_row ( $result ) ) {
				$counter++;
				$id = $row [0];
				$itsid = $row [1];
				$name = $row [2];
				//$options .= "<option value='$id'>$name</option>";
				$enrolled .= "<tr>
				<td>$counter</td>
				<td>$itsid</td>
				<td>$name</td>
				</tr>";
			}
		} else {
			echo "Error";
		}

		$result = db_select ( $conn, "SELECT people_id, people_itsid, people_name
				FROM people
				WHERE people_role = 0 AND people_id NOT IN ( SELECT p.people_id
				FROM people p, course_student cs
				WHERE cs.course_student_people_id = p.people_id
				AND cs.course_student_course_id = $course )" );
		
		if (isset ( $result )) {
			$counter = 0;
			while ( $row = mysqli_fetch_row ( $result ) ) {
				$counter++;
				$id = $row [0];
				$itsid = $row [1];
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
<form id="Form1" method="post" action="?course=<?php echo $course ?>" id="ctl01" role="form"
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
						value="<?php echo $courseName; ?>" placeholder="Course Name"
						class="form-control input-lg" readonly />
				</div>
			</div>
			<div class="form-group">
				<label for="students[]" class="col-sm-4 control-label">Add student</label>
				<div class="col-sm-8">
					<select name="students[]" class="form-control input-lg" multiple>
						<?php echo $options; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12" align="right">
					<button type="submit" class="btn btn-primary input-lg">Enroll</button>
				</div>
			</div>
			<div class="form-group">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th>S/No</th>
							<th>ITS ID</th>
							<th>Name</th>
						</tr>
					<?php echo $enrolled;?>
				</table>
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