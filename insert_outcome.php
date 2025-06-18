<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "earthtabservices";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the insert statement
    $stmt = $pdo->prepare("
        INSERT INTO career_types (
            type_combo,
            meaning,
            ideal_careers,
            strengths,
            watch_out,
            career_personality
        ) VALUES (
            :type_combo,
            :meaning,
            :ideal_careers,
            :strengths,
            :watch_out,
            :career_personality
        )
    ");

    // Define the data for thinker_helper
    $data = [
        ':type_combo' => 'thinker_helper',
        ':meaning' => 'You are a thoughtful and considerate person who values logic and supporting others.',
        ':ideal_careers' => 'Psychologist, Teacher, Counselor, Human Resources, Strategist, Mediator',
        ':strengths' => 'Analytical, empathetic, supportive, strategic, good listener',
        ':watch_out' => 'May overthink or become emotionally overwhelmed',
        ':career_personality' => 'You blend analytical thinking with empathy. You like solving people problems with logic.'
    ];

    // Execute the statement
    $stmt->execute($data);

    echo "thinker_helper data inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
