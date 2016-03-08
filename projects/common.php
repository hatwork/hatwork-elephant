<?php
session_start ();

function db_connect() {
	return mysqli_connect ( "localhost", "admin", "admin", "studentmgmt" );
}

function db_select($conn, $query) {
	$rs = $conn->query ( $query );
	if ($rs instanceof mysqli_result) {
		if (mysqli_num_rows ( $rs ) > 0) {
			return $rs;
		}
	}
}

function db_close($conn) {
	$conn->close();
}

function db_update($conn, $query) {
	if (! $conn->query( $query )) {
		return false;
	} else {
		return true;
	}
}

?>
