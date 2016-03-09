<?php
include_once 'common.php';

$options = "";
$message = "";
$conn = db_connect ();

$result = db_select ( $conn, "select people_id,people_itsid,people_name,people_email,people_mobile from people WHERE people_role = 0" );
if (isset ( $result )) {
	$counter = 0;
	while ( $row = mysqli_fetch_row ( $result ) ) {
		$id = $row [0];
		$its = $row [1];
		$name = $row [2];
		$email = $row [3];
		$mobile = $row [4];
		$counter ++;
		$options .= "<tr>
		<td>$counter</td>
		<td>$its</td>
		<td>$name</td>
		<td>$email</td>
		<td>$mobile</td>
		<td><a href='schedule-list.php?course=$id'>List Schedules</a>&nbsp;|&nbsp;
		<a href='schedule-create.php?course=$id'>Create Schedule</a>&nbsp;|&nbsp;
		<a href='course-student.php?course=$id'>Add Students</a>
		</td>
		</tr>";
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
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th>S/No</th>
							<th>ITS</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
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