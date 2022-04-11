<?php
	$conn = new mysqli("localhost", "root", "", "task_database");
	
	if(!$conn){
		die("Error: Cannot connect to the database");
	}
?>