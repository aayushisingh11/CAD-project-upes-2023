<?php
include 'connect.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User exists, create session and redirect to dashboard
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        if($role == 'student') {
            header('Location: student portal/student_dashboard.php');
            exit;
        } elseif ($role == 'teacher') {
            header('Location: teacher portal/teacher_dashboard.php');
            exit;
        }

    } else {
        // Invalid login credentials
        echo "Invalid login credentials";
    }
}
?>
