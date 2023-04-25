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
				<a href="#">Sourabh Sanu</a>
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
			$row = mysqli_fetch_assoc($result);
			
			if (!empty($row['subject_name'])) {
   		 	// display the subject name
   		 	$subject_name = $row['subject_name'];
   		 	echo '<h4><span>' . $subject_name . '</span></h4>';
			} else {
 			   echo "No subject found for the current time.";
				}

			mysqli_close($conn);
			?>
			<p>Date and Time: <span id="datetime"></span></p>
			<?php
include '../connect.php';

if (isset($_POST['enabled'])) {
    
    $sql = "UPDATE subject SET attendancebutton = 'enabled' WHERE subject_name = 'CAD_Theory 1'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error updating dashboard settings: " . mysqli_error($conn));
    }

    echo "<script>alert('Attendance enabled for Students');</script>";
}
if (isset($_POST['disabled'])) {
    
    $sql = "UPDATE subject SET attendancebutton = 'disabled' WHERE subject_name = 'CAD_Theory 1'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error updating dashboard settings: " . mysqli_error($conn));
    }

    echo "<script>alert('Attendance disabled for Students');</script>";
}
?>

<form action="teacher_dashboard.php" method="POST">
    <button type="submit" name="enabled">Enable Attendance</button>
	<button type="submit" name="disabled">Disable Attendance</button>
</form>

<?php mysqli_close($conn); ?>

		</div>
	</div>

	<script>
		var dt = new Date();
		document.getElementById("datetime").innerHTML = dt.toLocaleString();
	</script>
</body>
</html>
