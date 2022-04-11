<?php
	require_once 'conn.php';
	if(ISSET($_POST['add'])){
		if($_POST['task'] != ""){
			$task = $_POST['task'];
			
			$conn->query("INSERT INTO `tasks` VALUES('', '$task', 'Pending',CURRENT_DATE)");
			header('location:index.php');
		}
	}
?>