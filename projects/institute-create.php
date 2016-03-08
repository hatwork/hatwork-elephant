<?php
include_once 'common.php';

$description = isset ( $_POST ["description"] ) ? $_POST ["description"] : "";
$instName = isset ( $_POST ["instName"] ) ? $_POST ["instName"] : "";
$message = "";

$method = $_SERVER ['REQUEST_METHOD'];
if ($method === 'POST') {
	$message = "Good";
	
	$conn = db_connect ();
	if ( db_update( $conn, "INSERT INTO institute (institute_name,institute_desc, institute_status) VALUES ('$instName', '$description', 0)" ) ) {
		$message = "Institute created successfully.";
	} else {
		$message = "System error: Try again.";
	}

	db_close($conn);
}

include_once 'page_header.php';
?>
<form id="Form1" method="post" action="" id="ctl01" role="form"
	class="form-horizontal minHt">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Add Institute</h3>
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
				<label for="instName" class="col-sm-4 control-label">Institute Name</label>
				<div class="col-sm-8">
					<input name="instName" id="instName" type="text"
						value="<?php echo $instName; ?>" placeholder="Institute Name"
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