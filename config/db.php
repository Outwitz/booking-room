<?php
	$connect = new mysqli('localhost', 'root', 'root', 'webapp7');
	if ($connect->connect_error) {
		die("Something wrong.: " . $connect->connect_error);
	}
?>
