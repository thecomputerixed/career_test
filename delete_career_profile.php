<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM career_profiles WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Career profile deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete career profile.";
    }

    $stmt->close();
}

redirect("view_career_profiles.php");
?>
