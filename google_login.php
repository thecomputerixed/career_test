<?php
require 'db.php';
require_once 'vendor/autoload.php'; // Include Google API Client via Composer

$client = new Google_Client(['client_id' => 'YOUR_GOOGLE_CLIENT_ID']); // Use same ID from frontend

$data = json_decode(file_get_contents("php://input"));

$id_token = $data->credential;

$payload = $client->verifyIdToken($id_token);
if ($payload) {
    $email = $payload['email'];
    $fullname = $payload['name'];
    $googleId = $payload['sub'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM course_users WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO course_users (email, fullname, google_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $fullname, $googleId);
        $stmt->execute();
    }

    session_start();
    $_SESSION['user'] = $user ?: ['email' => $email, 'fullname' => $fullname];
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);
}
?>
