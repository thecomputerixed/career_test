<?php
require 'config.php'; // config.php should call session_start()
header('Content-Type: application/json'); // ensure correct content type


$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone_number']);

$stmt = $conn->prepare("SELECT * FROM user_details WHERE name = ? AND email = ? AND phone_number = ?");
$stmt->bind_param("sss", $name, $email, $phone);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id']; // or the correct primary key
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_phone_number'] = $user['phone_number'];
    // Debug output
    
    file_put_contents("debug.log", print_r($_SESSION, true), FILE_APPEND);

    echo json_encode([
        'status' => 'exists',
        'name' => $user['name'],
        'phone_number' => $user['phone_number']
    ]);
} else {
    $insert = $conn->prepare("INSERT INTO user_details (name, email, phone_number) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $name, $email, $phone);

    if ($insert->execute()) {
        $new_id = $insert->insert_id;
        $_SESSION['user_id'] = $new_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_phone_number'] = $phone;

        echo json_encode([
            'status' => 'new'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error'
        ]);
    }
}
