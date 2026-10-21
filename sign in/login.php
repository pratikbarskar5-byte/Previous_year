<?php
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    if (password_verify($password, $hashedPassword)) {
        echo "Login successful! Welcome, $email";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No account found with this email.";
}
?>