<?php
include_once 'common.php';

$cid = isset ( $_GET ["course"] ) ? $_GET ["course"] : - 1;

$options = "";
$information = "";
$message = "";
$conn = db_connect ();
$cname = "";

$course = "";


if ($cid == - 1) {
	$options = "<tr><td colspan=3>No course selected.</td></tr>";
} else {
	
	$result = db_select ( $conn, "SELECT c.course_name FROM course c WHERE c.course_id = $cid" );
	if (isset ( $result )) {
		$counter = 0;
		$selected = "";
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$course = $row [0];
		}
	}
	
	
	$result = db_select ( $conn, "select course_name from course WHERE course_id = $cid" );
	if (isset ( $result )) {
		$row = mysqli_fetch_row ( $result );
		$cname = $row [0];
	}
	
	$result = db_select ( $conn, "select * from course_schedule where course_schedule_course_id = $cid" );
	
	if (isset ( $result )) {
		
		$counter = 0;
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$id = $row [0];
			$name = $row [2];
			$counter ++;
			$options .= "<tr>
			<td>$counter</td>
			<td>$name</td>
			<td><a href='schedule-attendance.php?sid=$id' class='btn btn-primary'>Take Attendance</a></td>
			</tr>";
		}
	} else {
	}
}

include_once 'page_header.php';
?>
<form id="Form1" method="post" action="" role="form"
	class="form-horizontal minHt" enctype="multipart/form-data">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Course Schedule</h3>
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
				<label for="schedule" class="col-sm-4 control-label">Course</label>
				<div class="col-sm-8">
					<input name="schedule" id="courseName" type="text"
						value="<?php echo $course; ?>" placeholder="Course Name"
						class="form-control input-lg" readonly/>
				</div>
			</div>
			<div class="form-group">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th>S/No</th>
							<th>Name</th>
							<th>Schedules</th>
						</tr>
					<?php echo $options;?>
				</table>
				</div>
			</div>
		</div>
	</div>

</form>

<?php
include_once 'page_footer.php';
?>