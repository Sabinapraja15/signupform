<?php
if ($_SERVER["REQUEST_METHOD"] =="POST") {
    $conn = mysqli_connect("localhost", "root", "", "student_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password =($_POST['password'] ?? '');

    if (empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "Please submit the form.";
}
?>