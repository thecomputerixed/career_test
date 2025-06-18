<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

// Function to fetch courses with pagination
function get_paginated_courses($conn, $page, $per_page = 6) {
    $start = ($page - 1) * $per_page;
    $sql = "SELECT * FROM courses LIMIT $start, $per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of courses
function get_total_courses($conn) {
    $sql = "SELECT COUNT(*) as total FROM courses";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Function to search courses
function search_courses($conn, $search_term) {
    $search_term = $conn->real_escape_string($search_term);
    $sql = "SELECT * FROM courses WHERE title LIKE '%$search_term%' OR description LIKE '%$search_term%' OR teacher LIKE '%$search_term%'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
function convertYouTubeToEmbed($url) {
    if (preg_match('/watch\?v=([^\&]+)/', $url, $matches)) {
        return "https://www.youtube.com/embed/" . $matches[1];
    } elseif (preg_match('/youtu\.be\/([^\?]+)/', $url, $matches)) {
        return "https://www.youtube.com/embed/" . $matches[1];
    }
    return $url; // fallback
}

// ... Add more common functions here (e.g., add to wishlist, add to cart, etc.) ...
?>