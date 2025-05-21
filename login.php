<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "student_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        die("Both email and password are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $query = "SELECT id, name, email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

   if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        echo "Login successful! Welcome, " . htmlspecialchars($user['name']) . "!";
        header("Location:https://sabinapraja15.github.io/bmi/");

    } else {
        echo "No user found with this email.";
    }


    mysqli_close($conn);
} else {
    echo "Please submit the form.";
}


