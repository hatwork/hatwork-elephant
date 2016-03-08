<?php
include_once 'common.php';

$options = "";
$information = "";
$message = "";
$conn = db_connect ();
$result = db_select ( $conn, "select * from institute" );

if (isset ( $result )) {
	
	$counter = 0;
	while ( $row = mysqli_fetch_row ( $result ) ) {
		$id = $row [0];
		$name = $row [1];
		$counter++;
		$options .= "<tr>
		<td>$counter</td>
		<td>$name</td>
		<td><a href='course-list.php?inst=$id' class='btn btn-primary'>Courses</a></td>
		</tr>";
	}
} else {
}

include_once 'page_header.php';
?>
<form id="Form1" method="post" action="" role="form"
	class="form-horizontal minHt" enctype="multipart/form-data">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Institutes</h3>
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
				<div class="col-sm-5">
					<label><?php echo $information; ?></label>
				</div>
			</div>
			<div class="form-group">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th>S/No</th>
							<th>Name</th>
							<th>Courses</th>
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