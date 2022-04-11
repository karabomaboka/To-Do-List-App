<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
	</head>


	<body style="font-family: 'Noto Sans TC', sans-serif; background-image: url('https://cdn.pixabay.com/photo/2018/09/03/23/56/sea-3652697_960_720.jpg'); background-repeat: no-repeat;background-size: cover;">

		<br><br><br>
		<div class="col-md-3"></div>
		<div class="col-md-6 well">
			<div style="text-align: center;">
				<h2 class="text-primary">To-Do List 📜</h2>
			</div>		
			<hr style="border-top:1px dotted #ccc;"/>
			<div class="col-md-12">
				<center>
					<form method="POST" class="form-inline" action="add_query.php">
						<input type="text" class="form-control" name="task" required placeholder="enter task here" />
						<button class="btn btn-primary form-control" name="add">Add Task</button>
					</form>
				</center>
			</div>
			
			<hr style="border-top:1px dotted #ccc;"/>
			<div class="col-md-12">
				<center><br>
					<h4>Filters:</h4>

					<form method="POST" name="index.php">						
						<input class="btn btn-info" type="submit" name="done" value="Show Done">
						<input class="btn btn-info" type="submit" name="pending" value="Show Pending">
						<input class="btn btn-warning" type="submit" name="clear" value="Clear Filter">						
					</form>
				</center>
			</div>
			<br>
			<hr style="border-top:1px dotted #ccc;"/>

			
			<br /><br /><br />
			<table class="table table-bordered">
				<thead>
					<tr>
						<th></th>
						<th>Task</th>
						<th>Status</th>
						<th>Date Added</th>
						<th><div style="text-align: center;">Action</div></th>
					</tr>
				</thead>
				<tbody>
					
					<?php

						require 'conn.php';
						if(isset($_POST['done']))
						{
							$query = $conn->query("SELECT * FROM `tasks` WHERE `status` = 'Done' ORDER BY `task_id` ASC");

						}
						elseif (isset($_POST['pending'])) {

							$query = $conn->query("SELECT * FROM `tasks` WHERE `status` = 'Pending' ORDER BY `task_id` ASC");
						}
						elseif (isset($_POST['clear'])) {

							$query = $conn->query("SELECT * FROM `tasks` ORDER BY `task_id` ASC");
						}
						else{
							$query = $conn->query("SELECT * FROM `tasks` ORDER BY `task_id` ASC");
						}
						

						$count = 1;
						while($fetch = $query->fetch_array()){
							$date =date_create($fetch['date_added']);
							$date_formatted = date_format($date,"d M Y");

					?>
					<tr>
						<td><?php echo $count++?></td>
						<td><?php echo $fetch['task_details']?></td>
						<td><?php echo $fetch['status']?></td>						
						<td><?php echo $date_formatted?></td>
						<td colspan="2">
							<center>
								<?php
									if($fetch['status'] != "Done"){
										echo 
										'<a title="Mark as done" href="update_task.php?task_id='.$fetch['task_id'].'" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a> &nbsp|&nbsp';
									}
								?>
								 <a title="Delete Task" href="delete_query.php?task_id=<?php echo $fetch['task_id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
							</center>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>