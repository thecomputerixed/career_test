<?php
// Delay for effect (simulate processing time)
sleep(2);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "earthtabservices";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize POST data
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);

$answers = [];
$counts = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];

// Collect answers and count selections
for ($i = 1; $i <= 50; $i++) {
    $key = "q" . $i;
    $answer = $_POST[$key] ?? '';
    $answers[$key] = $answer;
    if (isset($counts[$answer])) {
        $counts[$answer]++;
    }
}

// Determine dominant option
// Sort the counts array in descending order
arsort($counts);

// Get the dominant and second dominant options
$keys = array_keys($counts);
$dominant = $keys[0];
$second_dominant = $keys[1];


$totalAnswers = array_sum($counts); // Get the total answered

// Now calculate percentages safely
$percentages = [
    'A' => $totalAnswers > 0 ? round(($counts['A'] / $totalAnswers) * 100) : 0,
    'B' => $totalAnswers > 0 ? round(($counts['B'] / $totalAnswers) * 100) : 0,
    'C' => $totalAnswers > 0 ? round(($counts['C'] / $totalAnswers) * 100) : 0,
    'D' => $totalAnswers > 0 ? round(($counts['D'] / $totalAnswers) * 100) : 0,
];


// Save to DB
$answers_json = json_encode($answers);
$sql = "INSERT INTO user_results (name, email, answers, dominant) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $answers_json, $dominant);
$stmt->execute();
$stmt->close();
$conn->close();

// Define career descriptions
$career_messages = [
    'A' => "You’re a deep mind. Curious, analytical, highly independent, and deeply drawn to logic, knowledge, and understanding the 'why' behind everything. You don’t just want to do — you want to understand, dissect, and master.

You're not content with surface-level answers. You thrive in spaces where you're constantly learning, solving problems, and working with systems, ideas, or innovations.
",
    'B' => "Your are a heart-driven action taker. They're warm, caring, and deeply invested in the well-being of others — but they’re also practical and hands-on, ready to *do the work rather than just talk about it.

They want to help, and they want to *see results. Whether it’s solving people’s problems, building something meaningful, or simply making life easier for someone — they are at their best when they combine service with action.",
    'C' => "You're highly action-oriented, practical, and grounded — they believe in doing, not just planning. They're the kind of person who thrives in structured environments, hands-on work, and task-based roles where results are visible and immediate.

With a Thinker as a secondary trait, they aren’t just doing for the sake of it — they are methodical, precise, and strategic. They like knowing why they’re doing something and often bring a sharp problem-solving mindset to their work",
    'D' => "You're a strong person, and an action-driven leader. They have a powerful presence, enjoy taking charge, and are highly goal-oriented. They don’t just dream — they execute. Their style of leadership is practical, bold, and hands-on."
];

$description = $career_messages[$dominant];

$major_career = [
    'A' => "A Thinker",
    'B' => "A Helper",
    'C' => "A Doer",
    'D' => "A Leader"
];

$primary_career = $major_career[$dominant];

$second_major = $major_career[$second_dominant];

$strength = [
    'A' => "- Problem-solving  
- Working independently  
- Attention to detail  
- Analytical and logical thinking  
- Love for learning and understanding systems
",
    'B' => "- Genuinely kind and helpful  
- Takes initiative to solve problems for others  
- Great in support roles that need emotional and practical strength  
- Trustworthy, humble, and hardworking  
- Good under pressure and in active, people-driven spaces
",
    'C' => "- Reliable, practical, and hardworking  
- Problem-solver under pressure  
- Doesn’t wait around — takes initiative  
- Values teamwork and service  
- Grounded and loyal
",
    'D' => "- Decisive and confident  
- Gets things done efficiently  
- Inspires others with action and clarity  
- Great at organizing teams and moving them toward results  
- Natural authority in both corporate and entrepreneurial settings
"
];

$pick_strength = $strength[$dominant];

$watch_out = [
    'A' => "- Overthinking and analysis paralysis  
- Avoiding collaborative tasks (even though they may help you grow)  
- Staying too long in planning mode instead of execution
",
    'B' => "- Might overcommit or neglect self-care  
- Can downplay their leadership potential  
- Needs validation and balance to avoid burnout  
- May struggle with saying “no” when needed",
    'C' => "- May ignore emotions or deeper processing  
- Could undervalue their own intelligence or vision  
- Needs appreciation for their effort  
- Might burn out if doing too much for others without balance
",
    'D' => "- May come off as overly dominant or impatient  
- Could neglect softer interpersonal dynamics  
- Should avoid micromanaging and learn to delegate  
- Needs space to recharge to avoid burnout"
];

$pick_watch = $watch_out[$dominant];

// Output the HTML structure
echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>My Stats Dashboard</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <style>
    body {
      font-family: Arial, sans-serif;

      background: #f0f0f5;
    }
    
    .dashboard {
      display: flex;
      gap: 40px;
    }

    .circle-container {
      text-align: center;
    }

    .circle {
      width: 120px;
      height: 120px;
      background: conic-gradient(
        var(--color) calc(var(--percent) * 1%),
        #e0e0e0 0%
      );
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: auto;
      position: relative;
    }

    .circle::before {
      content: '';
      position: absolute;
      width: 80px;
      height: 80px;
      background: #fff;
      border-radius: 50%;
      z-index: 1;
    }

    .percentage {
      position: absolute;
      font-size: 20px;
      font-weight: bold;
      z-index: 2;
    }

    .label {
      margin-top: 10px;
      font-size: 16px;
      font-weight: bold;
    }

    .subtext {
      font-size: 12px;
      color: #666;
    }
    .btn-red {
      background-color: #dc3545;
      color: #fff;
    }
    .btn-red:hover {
      background-color: #c82333;
    }
    .feature-box {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
      padding: 1rem;
      background-color: #fff;
    }
  </style>
</head>
<body>
    <!-- Hero Section -->
    <section>
        <div class='container py-5'>
            
          
            <h1 class='display-5 fw-bold'>CAREER <span class='text-danger'> TEST STAT</span></h1>
            
            <div class='d-flex justify-content-between align-items-center mb-4'>
                 
                <div class='mt-5 row align-items-center'>
                    <div class='dashboard'>
                        <div class='circle-container'>
                            <div class='circle' style='--percent: 50; --color: #3ccf91;'>
                            <div class='percentage'>50%</div>
                            </div>
                            <div class='label'>Thinker</div>
                            <div class='subtext'>{$counts['A']} </div>
                        </div>

                        <div class='circle-container'>
                            <div class='circle' style='--percent: 25; --color: #3399ff;'>
                            <div class='percentage'>25%</div>
                            </div>
                            <div class='label'>Helper</div>
                            <div class='subtext'>{$counts['B']}</div>
                        </div>

                        <div class='circle-container'>
                            <div class='circle' style='--percent: 15; --color: #ff4d4d;'>
                            <div class='percentage'>15%</div>
                            </div>
                            <div class='label'>Doer</div>
                            <div class='subtext'>{$counts['C']}</div>
                        </div>
                        <div class='circle-container'>
                            <div class='circle' style='--percent: 10; --color: #ff4d4d;'>
                            <div class='percentage'>10%</div>
                            </div>
                            <div class='label'>Leader</div>
                            <div class='subtext'>{$counts['D']}</div>
                        </div>
                    </div>
                
                </div>
                <div class='col-md-6 mb-4 mb-md-0 text-center'>
                    <img src='cac1.png' alt='Hero Image' style='max-width: 60%; height: auto;' />
                </div>
            </div>
        </div>
</section>
<section class='py-5'>
  <div class='container'>
    <div class='row align-items-center'>
      <div class='col-md-12'>
      <h3 class='fw-bold'>Hello <span class='text-danger'> $name,</span></h3>
        <h4 class='fw-bold'>Your Primary Career Type is :   <span class='text-danger'> $primary_career.</span></h4>
        <h4 class='fw-bold'>But Your Secondary Trait is :   <span class='text-danger'> $second_major.</span></h4>
        <p class='lead text-muted'>$description</p>
        <div class='d-flex gap-3'>
           <p class='lead text-muted'>$second_dominant</p>
        </div>
        <div class='mt-4 d-flex align-items-center gap-2'>
          <span class='badge bg-primary'>JD</span>
          <span class='badge bg-info'>SK</span>
          <span class='badge bg-success'>MR</span>
          <small class='text-muted ms-2'>Join 2,500+ professionals who unlocked their potential</small>
        </div>
      </div>

    </div>
  </div>
</section>

<section class='py-5'>
  <div class='container'>
    <div class='row align-items-center'>
    <div class='col-md-6'>
        <div class='feature-box'>
          <ul class='list-unstyled'>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>1</span>Quick, tailored career assessment</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>2</span>Personalized career insights</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>3</span>Exclusive access to transformation course</li>
            <li><span class='fw-bold text-danger me-2'>4</span>Advance your career with confidence</li>
          </ul>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='feature-box'>
          <ul class='list-unstyled'>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>1</span>Quick, tailored career assessment</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>2</span>Personalized career insights</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>3</span>Exclusive access to transformation course</li>
            <li><span class='fw-bold text-danger me-2'>4</span>Advance your career with confidence</li>
          </ul>
        </div>
      </div>
      <div class='pt-3 col-md-6'>
        <div class='feature-box'>
          <ul class='list-unstyled'>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>1</span>Quick, tailored career assessment</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>2</span>Personalized career insights</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>3</span>Exclusive access to transformation course</li>
            <li><span class='fw-bold text-danger me-2'>4</span>Advance your career with confidence</li>
          </ul>
        </div>
      </div>
      <div class='pt-3 col-md-6'>
        <div class='feature-box'>
          <ul class='list-unstyled'>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>1</span>Quick, tailored career assessment</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>2</span>Personalized career insights</li>
            <li class='mb-2'><span class='fw-bold text-danger me-2'>3</span>Exclusive access to transformation course</li>
            <li><span class='fw-bold text-danger me-2'>4</span>Advance your career with confidence</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>

";
?>
