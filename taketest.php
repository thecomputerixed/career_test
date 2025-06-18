<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    // Optional: redirect to form if user jumps here directly
    header("Location: landingPage.php");
    exit();
}

$name = $_SESSION['user_name'];

$questions = [];
$sql = "SELECT * FROM test_questions";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $questions = $result->fetch_all(MYSQLI_ASSOC);
}

//if (count($questions) !== 9) {
//    die("Error: The test should have 10 questions. Please update the database.");
//}

if (isset($_POST['submit_test'])) {
    $answers = $_POST['answers'];
    $recommendations = [];

    foreach ($questions as $question) {
        $answer = isset($answers[$question['question_id']]) ? $answers[$question['question_id']] : null;
        if ($answer) {
            $recommendation_string = '';
            switch ($answer) {
                case 'a':
                    $recommendation_string = $question['recommendation_a'];
                    break;
                case 'b':
                    $recommendation_string = $question['recommendation_b'];
                    break;
                case 'c':
                    $recommendation_string = $question['recommendation_c'];
                    break;
                case 'd':
                    $recommendation_string = $question['recommendation_d'];
                    break;
            }
            if ($recommendation_string) {
                $recommendations = array_merge($recommendations, explode(',', $recommendation_string));
            }
        }
    }

    // Count the occurrences of each recommended course
    $recommended_counts = array_count_values($recommendations);

    // Sort the recommendations by count in descending order
    arsort($recommended_counts);

    // Get the top 3 recommended course IDs
    $top_recommendations = array_slice(array_keys($recommended_counts), 0, 3);

    // Store the recommendations in the session for the next page
    $_SESSION['test_recommendations'] = $top_recommendations;
    redirect("recommended_courses.php");
}

$current_question = isset($_GET['q']) ? intval($_GET['q']) : 0;
$total_questions = count($questions);

if ($current_question >= $total_questions) {
    // Should not happen if the form redirects correctly
    echo "Processing results...";
    exit();
}

$question = $questions[$current_question];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <title>ETBS | Career - Take Test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ETBS" name="keywords">
    <meta content="EarthTab Business School" name="description">
    <style>
        .test-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .question {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 4px;
        }
        .options label {
            display: block;
            margin-bottom: 10px;
        }
        .actions button {
            padding: 10px 15px;
            background-color:rgb(197, 7, 7);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .actions button:hover {
            background-color: grey;
        }
    </style>
</head>
<body>
    
    <div class="container">
      <div class="alert alert-danger text-center mt-2">
        Hello <?php echo htmlspecialchars($name); ?>, answer these questions to uncover more about yourself.
      </div>
        <?php if ($questions): ?>
           
            <div class="test-container">
                <form method="post" id="careerForm">
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 10%;" id="progressBar"></div>
                    </div>
                    <div class="question"  class="form-section active" id="section1">
                        <h3>Question <?php echo $current_question + 1; ?>: <?php echo htmlspecialchars($question['question_text']); ?></h3>
                        <div class="options question mb-4 p-3 bg-white rounded shadow-sm">
                            <label><input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="a" required> A) <?php echo htmlspecialchars($question['option_a']); ?></label>
                            <label><input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="b"> B) <?php echo htmlspecialchars($question['option_b']); ?></label>
                            <label><input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="c"> C) <?php echo htmlspecialchars($question['option_c']); ?></label>
                            <label><input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="d"> D) <?php echo htmlspecialchars($question['option_d']); ?></label>
                        </div>
                    </div>

                    <div class="actions">
                        <?php if ($current_question < $total_questions - 1): ?>
                            <!-- Navigation Buttons -->
                            <button class="btn btn-danger px-5" type="button" onclick="window.location.href='take_test.php?q=<?php echo $current_question - 1; ?>'">Previous Question</button>
                           
                            <button class="btn btn-danger px-5" type="button" onclick="window.location.href='take_test.php?q=<?php echo $current_question + 1; ?>'">Next Question</button>
                           
                           

                        <?php else: ?>
                        <button class="btn btn-danger px-5" type="button" onclick="window.location.href='take_test.php?q=<?php echo $current_question - 1; ?>'">Previous Question</button>
                        <button class="btn btn-danger px-5" type="submit" name="submit_test">Submit Test</button>
                             
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="current_q" value="<?php echo $current_question; ?>">
                </form>
            </div>
         
        <?php else: ?>
            <p>No questions available for the test.</p>
        <?php endif; ?>
    </div>
    <script>
    // Navigation Logic
    const sections = document.querySelectorAll('.form-section');
    const progressBar = document.getElementById('progressBar');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitDiv = document.getElementById('submitDiv');
    let currentSection = 0;

    function showSection(index) {
    sections.forEach((section, i) => {
        section.classList.remove('active');
        if (i === index) {
        section.classList.add('active');
        }
    });

    progressBar.style.width = `${((index + 1) / sections.length) * 100}%`;
    prevBtn.style.display = index === 0 ? 'none' : 'inline-block';
    nextBtn.style.display = index === sections.length - 1 ? 'none' : 'inline-block';
    submitDiv.style.display = index === sections.length - 1 ? 'block' : 'none';
    }

    // Handle next button with validation
    nextBtn.addEventListener('click', () => {
    const currentInputs = sections[currentSection].querySelectorAll('input[type="radio"]');
    const oneChecked = Array.from(currentInputs).some(input => input.checked);

    if (!oneChecked) {
        alert('Please select an answer before proceeding.');
        return;
    }

    if (currentSection < sections.length - 1) {
        currentSection++;
        showSection(currentSection);
    }
    });

    prevBtn.addEventListener('click', () => {
    if (currentSection > 0) {
        currentSection--;
        showSection(currentSection);
    }
    });

    showSection(currentSection); // Initialize view
  </script>
</body>
</html>