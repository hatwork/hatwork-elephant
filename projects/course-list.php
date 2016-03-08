<?php
include_once 'common.php';

$instid = isset ( $_GET ["inst"] ) ? $_GET ["inst"] : - 1;

$options = "";
$information = "";
$message = "";
$conn = db_connect ();
$institute = "No institute selected.";
$instituteDropDown = "";

$result = db_select ( $conn, "select institute_id, institute_name from institute" );
if (isset ( $result )) {
	$counter = 0;
	$selected = "";
	while ( $row = mysqli_fetch_row ( $result ) ) {
		$id = $row [0];
		$name = $row [1];
		$selected = $id == $instid ? "selected" : "";
		$instituteDropDown .= "<option value='$id' $selected>$name</option>";
	}
}

if ($instid == - 1) {
	$options = "<tr><td colspan=3>No institute selected.</td></tr>";
} else {

	
	/*
	$result = db_select ( $conn, "select institute_name from institute WHERE institute_id = $instid" );
	if (isset ( $result )) {
		$row = mysqli_fetch_row ( $result );
		$institute = $row [0];		
	}
	*/
	
	
	$result = db_select ( $conn, "select * from course where course_institute_id = $instid" );
	
	if (isset ( $result )) {
		
		$counter = 0;
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$id = $row [0];
			$name = $row [2];
			$counter ++;
			$options .= "<tr>
			<td>$counter</td>
			<td>$name</td>
			<td><a href='schedule-list.php?course=$id' class='btn btn-primary'>List Schedules</a> 
			<a href='schedule-create.php?course=$id' class='btn btn-primary'>Create Schedule</a></td>
			</tr>";
		}
	} else {
	}
}

include_once 'page_header.php';
?>
<form id="Form1" method="get" action="" role="form"
	class="form-horizontal minHt" enctype="multipart/form-data">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Courses</h3>
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
				<label for="courseName" class="col-sm-3 control-label">Institute</label>
				<div class="col-sm-6">
					<select name="inst" class="form-control input-lg">
						<option value="">Select...</option>
						<?php echo $instituteDropDown;?>
					</select>
				</div>
				<div class="col-sm-3">
				<button type="submit"
						class="btn btn-primary form-control input-lg">Change</button>
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