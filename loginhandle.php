<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "earthtabservices";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// login.php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM course_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: course_dashboard.php"); // Redirect after login
        exit();
    } else {
        echo "Invalid credentials";
    }
}
?>
