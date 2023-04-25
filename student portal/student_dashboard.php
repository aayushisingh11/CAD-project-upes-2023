<?php
include '../connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<div class="user">
				<a href="#">Aayushi Singh</a>
			</div>
			<div class="logout">
				<a href="../logout.php">Logout</a>
			</div>
		</div>
		<div class="box">
			<h2>Welcome to the Dashboard</h2>
			<?php
        	include '../connect.php';

        	// get the current time
        	$current_time = date("Y-m-d H:i:s");
			// select the subject name from the database based on the current time
			$sql = "SELECT subject_name FROM subject WHERE start_time <= '$current_time' AND end_time >= '$current_time'";
			$result = mysqli_query($conn, $sql);

			if (!$result) {
	    	die("Error executing query: " . mysqli_error($conn));
			}

			if ($row = mysqli_fetch_assoc($result)) {
   		 	// display the subject name
   		 	$subject_name = $row['subject_name'];
   		 	echo '<h4><span>' . $subject_name . '</span></h4>';
			} else {
 			   echo "No subject found for the current time.";
				}

			mysqli_close($conn);
			?>
           
			<p>Date and Time: <span id="datetime"></span></p>
			<!-- <button id="dashboard-button" >Mark Present</button> -->
			<div id="dashboard-button">
    <?php
        include '../connect.php';

        // check if the dashboard button is enabled
        $sql = "SELECT attendancebutton FROM subject WHERE subject_name = 'CAD_Theory 1' AND attendancebutton = 'enabled'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
		if(!empty($row['attendancebutton'])){
			$enabled = $row['attendancebutton'];
			if ($enabled == 'enabled') {
            
				echo '<form action="student_dashboard.php" method="POST"><button id="dashboard-button" name="attendance" >Mark Present</button></form>';
			} 
	
		} else {
			echo "The student dashboard is currently disabled.";
		}
        

		if (isset($_POST['attendance'])) {
    
			$sql = "UPDATE student SET attendance = 'marked' WHERE fname = 'Aayushi' AND SubjectName = 'CAD_Theory 1'";
			$result = mysqli_query($conn, $sql);
		
			if (!$result) {
				die("Error updating dashboard settings: " . mysqli_error($conn));
			}
		
			echo "<script>alert('Attendance marked');</script>";
		}

        mysqli_close($conn);
    ?>
</div>

		</div>
	</div>

	<script>
		var dt = new Date();
		document.getElementById("datetime").innerHTML = dt.toLocaleString();
	</script>
</body>
</html>
