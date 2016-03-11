<?php
include_once 'common.php';

$options = "";
$information = "";
$message = "";
$conn = db_connect ();

$result = db_select ( $conn, "select * from course" );
if (isset ( $result )) {
	
	$counter = 0;
	while ( $row = mysqli_fetch_row ( $result ) ) {
		$id = $row [0];
		$name = $row [1];
		$counter ++;
		$options .= "<tr>
		<td>$counter</td>
		<td>$name</td>
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