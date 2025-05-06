<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Assessment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-section {
      display: none;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }
    .form-section.active {
      display: block;
      opacity: 1;
    }
    .form-check-input:checked {
      background-color: red;
      border-color: red;
    }
    .btn-primary {
      background-color: red;
      border-color: red;
    }
    .btn-primary:hover {
      background-color: white;
      color: red;
    }
    .container {
      max-width: 700px;
      margin-top: 40px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="text-center mb-4 text-danger">Career Assessment</h1>
    <form action="careerr.php" method="POST" id="careerForm">
      <!-- Progress Bar -->
      <div class="progress mb-4">
        <div class="progress-bar bg-danger" role="progressbar" style="width: 10%;" id="progressBar"></div>
      </div>

      <!-- Sections -->
      <div class="form-section active" id="section1">
        <div class="mb-3">
          <label class="form-label">Your Full Name</label>
          <input type="text" name="name" class="form-control" placeholder="Please enter your full name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Your Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">1. I feel most fulfilled when I:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="A" id="q1A" required> <label class="form-check-label" for="q1A">A) Solve problems</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="B" id="q1B"> <label class="form-check-label" for="q1B">B) Help others</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="C" id="q1C"> <label class="form-check-label" for="q1C">C) Create something new</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="D" id="q1D"> <label class="form-check-label" for="q1D">D) Organize things</label></div>
        </div>
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">2. I prefer working:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="A" id="q2A" required> <label class="form-check-label" for="q2A">A) With data and logic</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="B" id="q2B"> <label class="form-check-label" for="q2B">B) With people</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="C" id="q2C"> <label class="form-check-label" for="q2C">C) With my hands</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="D" id="q2D"> <label class="form-check-label" for="q2D">D) Behind the scenes</label></div>
        </div>
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">3. My ideal work environment is:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="A" id="q3A" required> <label class="form-check-label" for="q3A">A) Structured and quiet</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="B" id="q3B"> <label class="form-check-label" for="q3B">B) Lively and interactive</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="C" id="q3C"> <label class="form-check-label" for="q3C">C) Flexible and creative</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="D" id="q3D"> <label class="form-check-label" for="q3D">D) Fast-paced and energetic</label></div>
        </div>
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">4. I enjoy tasks that involve:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="A" id="q4A" required> <label class="form-check-label" for="q4A">A) Numbers or analysis</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="B" id="q4B"> <label class="form-check-label" for="q4B">B) Communication and support</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="C" id="q4C"> <label class="form-check-label" for="q4C">C) Building or repairing things</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q4" value="D" id="q4D"> <label class="form-check-label" for="q4D">D) Planning and logistics</label></div>
        </div>
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">5. I dislike:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="A" id="q5A" required> <label class="form-check-label" for="q5A">A) Emotional conversations</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="B" id="q5B"> <label class="form-check-label" for="q5B">B) Technical details</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="C" id="q5C"> <label class="form-check-label" for="q5C">C) Sitting still for long</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q5" value="D" id="q5D"> <label class="form-check-label" for="q5D">D) Too much routine</label></div>
        </div>
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
  
            <h5 class="text-danger">6. In a team, I usually:</h5>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="q6" value="A" id="q6A" required>
              <label class="form-check-label" for="q6A">A) Take the lead</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="q6" value="B" id="q6B">
              <label class="form-check-label" for="q6B">B) Support and listen</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="q6" value="C" id="q6C">
              <label class="form-check-label" for="q6C">C) Handle technical tasks</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="q6" value="D" id="q6D">
              <label class="form-check-label" for="q6D">D) Organize and manage time</label>
            </div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">7. I am most energized by:</h5>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q7" value="A" id="q7A" required>
            <label class="form-check-label" for="q7A">A) Solving a challenge</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q7" value="B" id="q7B">
            <label class="form-check-label" for="q7B">B) Helping someone succeed</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q7" value="C" id="q7C">
            <label class="form-check-label" for="q7C">C) Creating or designing</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q7" value="D" id="q7D">
            <label class="form-check-label" for="q7D">D) Hitting a goal</label>
          </div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">8. I’d rather work:</h5>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q8" value="A" id="q8A" required>
            <label class="form-check-label" for="q8A">A) In a lab</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q8" value="B" id="q8B">
            <label class="form-check-label" for="q8B">B) In a clinic or school</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q8" value="C" id="q8C">
            <label class="form-check-label" for="q8C">C) In a workshop or outdoors</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q8" value="D" id="q8D">
            <label class="form-check-label" for="q8D">D) In an office</label>
          </div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">9. People say I’m good at:</h5>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q9" value="A" id="q9A" required>
            <label class="form-check-label" for="q9A">A) Thinking things through</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q9" value="B" id="q9B">
            <label class="form-check-label" for="q9B">B) Empathy and understanding</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q9" value="C" id="q9C">
            <label class="form-check-label" for="q9C">C) Fixing or building</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q9" value="D" id="q9D">
            <label class="form-check-label" for="q9D">D) Multitasking</label>
          </div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">10. I value:</h5>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q10" value="A" id="q10A" required>
            <label class="form-check-label" for="q10A">A) Knowledge</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q10" value="B" id="q10B">
            <label class="form-check-label" for="q10B">B) Compassion</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q10" value="C" id="q10C">
            <label class="form-check-label" for="q10C">C) Freedom</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q10" value="D" id="q10D">
            <label class="form-check-label" for="q10D">D) Efficiency</label>
          </div>
        </div>

      </div>

      <div class="form-section" id="section2">
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">11. I often dream of:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q11" value="A" id="q11A" required> <label class="form-check-label" for="q11A">A) Discovering something new</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q11" value="B" id="q11B"> <label class="form-check-label" for="q11B">B) Making a difference </label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q11" value="C" id="q11C"> <label class="form-check-label" for="q11C">C) Starting a business </label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q11" value="D" id="q11D"> <label class="form-check-label" for="q11D">D) Traveling for work </label></div>
        </div>
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">12. I would NOT want a job that:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q12" value="A" id="q12A"><label class="form-check-label" for="q12A">A) Requires lots of small talk</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q12" value="B" id="q12B"><label class="form-check-label" for="q12B">B) Is too repetitive</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q12" value="C" id="q12C"><label class="form-check-label" for="q12C">C) Keeps me indoors</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q12" value="D" id="q12D"><label class="form-check-label" for="q12D">D) Involves lots of paperwork</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">13. I like watching:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q13" value="A" id="q13A"><label class="form-check-label" for="q13A">A) Documentaries</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q13" value="B" id="q13B"><label class="form-check-label" for="q13B">B) Medical dramas</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q13" value="C" id="q13C"><label class="form-check-label" for="q13C">C) DIY or tech shows</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q13" value="D" id="q13D"><label class="form-check-label" for="q13D">D) Business pitches</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">14. I prefer work that is:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q14" value="A" id="q14A"><label class="form-check-label" for="q14A">A) Mental</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q14" value="B" id="q14B"><label class="form-check-label" for="q14B">B) Emotional</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q14" value="C" id="q14C"><label class="form-check-label" for="q14C">C) Physical</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q14" value="D" id="q14D"><label class="form-check-label" for="q14D">D) Strategic</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">15. I would rather:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q15" value="A" id="q15A"><label class="form-check-label" for="q15A">A) Write a report</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q15" value="B" id="q15B"><label class="form-check-label" for="q15B">B) Counsel a friend</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q15" value="C" id="q15C"><label class="form-check-label" for="q15C">C) Build a model</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q15" value="D" id="q15D"><label class="form-check-label" for="q15D">D) Create a schedule</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">16. My strength is:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q16" value="A" id="q16A"><label class="form-check-label" for="q16A">A) Critical thinking</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q16" value="B" id="q16B"><label class="form-check-label" for="q16B">B) Empathy</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q16" value="C" id="q16C"><label class="form-check-label" for="q16C">C) Creativity</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q16" value="D" id="q16D"><label class="form-check-label" for="q16D">D) Organization</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">17. I enjoy reading about:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q17" value="A" id="q17A"><label class="form-check-label" for="q17A">A) Science and tech</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q17" value="B" id="q17B"><label class="form-check-label" for="q17B">B) Psychology or wellness</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q17" value="C" id="q17C"><label class="form-check-label" for="q17C">C) Engineering or crafts</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q17" value="D" id="q17D"><label class="form-check-label" for="q17D">D) Business and money</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">18. I avoid:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q18" value="A" id="q18A"><label class="form-check-label" for="q18A">A) Public speaking</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q18" value="B" id="q18B"><label class="form-check-label" for="q18B">B) Technical jargon</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q18" value="C" id="q18C"><label class="form-check-label" for="q18C">C) Sitting at a desk</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q18" value="D" id="q18D"><label class="form-check-label" for="q18D">D) Taking risks</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">19. I admire people who:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q19" value="A" id="q19A"><label class="form-check-label" for="q19A">A) Discover new things</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q19" value="B" id="q19B"><label class="form-check-label" for="q19B">B) Change lives</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q19" value="C" id="q19C"><label class="form-check-label" for="q19C">C) Build cool stuff</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q19" value="D" id="q19D"><label class="form-check-label" for="q19D">D) Lead companies</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">20. I prefer to learn:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q20" value="A" id="q20A"><label class="form-check-label" for="q20A">A) From books</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q20" value="B" id="q20B"><label class="form-check-label" for="q20B">B) From people</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q20" value="C" id="q20C"><label class="form-check-label" for="q20C">C) By doing</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q20" value="D" id="q20D"><label class="form-check-label" for="q20D">D) With visual aids</label></div>
        </div>

      </div>

      <div class="form-section" id="section3">
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">21. I’d rather intern at:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q21" value="A" id="q21A"><label class="form-check-label" for="q21A">A) A research institute</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q21" value="B" id="q21B"><label class="form-check-label" for="q21B">B) A hospital</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q21" value="C" id="q21C"><label class="form-check-label" for="q21C">C) A construction site</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q21" value="D" id="q21D"><label class="form-check-label" for="q21D">D) A startup</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">22. I stay motivated by:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q22" value="A" id="q22A"><label class="form-check-label" for="q22A">A) Curiosity</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q22" value="B" id="q22B"><label class="form-check-label" for="q22B">B) Connection</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q22" value="C" id="q22C"><label class="form-check-label" for="q22C">C) Movement</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q22" value="D" id="q22D"><label class="form-check-label" for="q22D">D) Rewards</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">23. I would NOT enjoy being:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q23" value="A" id="q23A"><label class="form-check-label" for="q23A">A) A counselor</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q23" value="B" id="q23B"><label class="form-check-label" for="q23B">B) An engineer</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q23" value="C" id="q23C"><label class="form-check-label" for="q23C">C) A manager</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q23" value="D" id="q23D"><label class="form-check-label" for="q23D">D) A researcher</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">24. I’m drawn to:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q24" value="A" id="q24A"><label class="form-check-label" for="q24A">A) Facts and evidence</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q24" value="B" id="q24B"><label class="form-check-label" for="q24B">B) Emotions and people</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q24" value="C" id="q24C"><label class="form-check-label" for="q24C">C) Tools and machines</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q24" value="D" id="q24D"><label class="form-check-label" for="q24D">D) Systems and growth</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">25. I enjoy doing:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q25" value="A" id="q25A"><label class="form-check-label" for="q25A">A) Puzzles or brain games</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q25" value="B" id="q25B"><label class="form-check-label" for="q25B">B) Listening and giving advice</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q25" value="C" id="q25C"><label class="form-check-label" for="q25C">C) Fixing broken things</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q25" value="D" id="q25D"><label class="form-check-label" for="q25D">D) Planning events</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">26. I am:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q26" value="A" id="q26A"><label class="form-check-label" for="q26A">A) Inquisitive</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q26" value="B" id="q26B"><label class="form-check-label" for="q26B">B) Caring</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q26" value="C" id="q26C"><label class="form-check-label" for="q26C">C) Practical</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q26" value="D" id="q26D"><label class="form-check-label" for="q26D">D) Ambitious</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">27. I’d like to improve at:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q27" value="A" id="q27A"><label class="form-check-label" for="q27A">A) Speaking confidently</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q27" value="B" id="q27B"><label class="form-check-label" for="q27B">B) Managing stress</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q27" value="C" id="q27C"><label class="form-check-label" for="q27C">C) Coding or mechanics</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q27" value="D" id="q27D"><label class="form-check-label" for="q27D">D) Time management</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">28. My ideal project involves:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q28" value="A" id="q28A"><label class="form-check-label" for="q28A">A) Research</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q28" value="B" id="q28B"><label class="form-check-label" for="q28B">B) Helping people directly</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q28" value="C" id="q28C"><label class="form-check-label" for="q28C">C) Building something</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q28" value="D" id="q28D"><label class="form-check-label" for="q28D">D) Coordinating tasks</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">29. I’m better at:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q29" value="A" id="q29A"><label class="form-check-label" for="q29A">A) Logic</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q29" value="B" id="q29B"><label class="form-check-label" for="q29B">B) Emotion</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q29" value="C" id="q29C"><label class="form-check-label" for="q29C">C) Action</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q29" value="D" id="q29D"><label class="form-check-label" for="q29D">D) Strategy</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">30. My friends come to me for:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q30" value="A" id="q30A"><label class="form-check-label" for="q30A">A) Advice on decisions</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q30" value="B" id="q30B"><label class="form-check-label" for="q30B">B) Support with problems</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q30" value="C" id="q30C"><label class="form-check-label" for="q30C">C) Help fixing things</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q30" value="D" id="q30D"><label class="form-check-label" for="q30D">D) Career or money tips</label></div>
        </div>


      </div>

      <div class="form-section" id="section4">
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">31. I avoid:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q31" value="A" id="q31A"><label class="form-check-label" for="q31A">A) Too much teamwork</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q31" value="B" id="q31B"><label class="form-check-label" for="q31B">B) Deadlines</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q31" value="C" id="q31C"><label class="form-check-label" for="q31C">C) Boredom</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q31" value="D" id="q31D"><label class="form-check-label" for="q31D">D) Uncertainty</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">32. I would love to:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q32" value="A" id="q32A"><label class="form-check-label" for="q32A">A) Publish a paper</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q32" value="B" id="q32B"><label class="form-check-label" for="q32B">B) Save lives</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q32" value="C" id="q32C"><label class="form-check-label" for="q32C">C) Design a product</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q32" value="D" id="q32D"><label class="form-check-label" for="q32D">D) Launch a brand</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">33. I am often described as:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q33" value="A" id="q33A"><label class="form-check-label" for="q33A">A) Smart</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q33" value="B" id="q33B"><label class="form-check-label" for="q33B">B) Kind</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q33" value="C" id="q33C"><label class="form-check-label" for="q33C">C) Handy</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q33" value="D" id="q33D"><label class="form-check-label" for="q33D">D) Focused</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">34. I get bored with:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q34" value="A" id="q34A"><label class="form-check-label" for="q34A">A) Drama</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q34" value="B" id="q34B"><label class="form-check-label" for="q34B">B) Repetition</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q34" value="C" id="q34C"><label class="form-check-label" for="q34C">C) Theory</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q34" value="D" id="q34D"><label class="form-check-label" for="q34D">D) Inactivity</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">35. I’m most confident when:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q35" value="A" id="q35A"><label class="form-check-label" for="q35A">A) Solving a problem</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q35" value="B" id="q35B"><label class="form-check-label" for="q35B">B) Guiding someone</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q35" value="C" id="q35C"><label class="form-check-label" for="q35C">C) Assembling something</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q35" value="D" id="q35D"><label class="form-check-label" for="q35D">D) Presenting an idea</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">36. I would rather NOT:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q36" value="A" id="q36A"><label class="form-check-label" for="q36A">A) Work in a group</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q36" value="B" id="q36B"><label class="form-check-label" for="q36B">B) Work alone</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q36" value="C" id="q36C"><label class="form-check-label" for="q36C">C) Read for hours</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q36" value="D" id="q36D"><label class="form-check-label" for="q36D">D) Talk all day</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">37. I thrive in:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q37" value="A" id="q37A"><label class="form-check-label" for="q37A">A) A calm environment</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q37" value="B" id="q37B"><label class="form-check-label" for="q37B">B) A nurturing environment</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q37" value="C" id="q37C"><label class="form-check-label" for="q37C">C) A dynamic environment</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q37" value="D" id="q37D"><label class="form-check-label" for="q37D">D) A competitive environment</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">38. I would enjoy:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q38" value="A" id="q38A"><label class="form-check-label" for="q38A">A) Researching diseases</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q38" value="B" id="q38B"><label class="form-check-label" for="q38B">B) Teaching children</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q38" value="C" id="q38C"><label class="form-check-label" for="q38C">C) Repairing cars</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q38" value="D" id="q38D"><label class="form-check-label" for="q38D">D) Running a company</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">39. I am most skilled at:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q39" value="A" id="q39A"><label class="form-check-label" for="q39A">A) Analyzing information</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q39" value="B" id="q39B"><label class="form-check-label" for="q39B">B) Understanding people</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q39" value="C" id="q39C"><label class="form-check-label" for="q39C">C) Working with tools</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q39" value="D" id="q39D"><label class="form-check-label" for="q39D">D) Leading a team</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">40. I admire careers that offer:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q40" value="A" id="q40A"><label class="form-check-label" for="q40A">A) Knowledge</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q40" value="B" id="q40B"><label class="form-check-label" for="q40B">B) Service</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q40" value="C" id="q40C"><label class="form-check-label" for="q40C">C) Creation</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q40" value="D" id="q40D"><label class="form-check-label" for="q40D">D) Influence</label></div>
        </div>

      </div>

      <div class="form-section" id="section5">
        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">41. My top goal is:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q41" value="A" id="q41A"><label class="form-check-label" for="q41A">A) To learn</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q41" value="B" id="q41B"><label class="form-check-label" for="q41B">B) To help</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q41" value="C" id="q41C"><label class="form-check-label" for="q41C">C) To make</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q41" value="D" id="q41D"><label class="form-check-label" for="q41D">D) To succeed</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">42. I dislike jobs that are:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q42" value="A" id="q42A"><label class="form-check-label" for="q42A">A) Vague</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q42" value="B" id="q42B"><label class="form-check-label" for="q42B">B) Cold or detached</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q42" value="C" id="q42C"><label class="form-check-label" for="q42C">C) Too theoretical</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q42" value="D" id="q42D"><label class="form-check-label" for="q42D">D) Too low-pressure</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">43. My personality is:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q43" value="A" id="q43A"><label class="form-check-label" for="q43A">A) Thoughtful</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q43" value="B" id="q43B"><label class="form-check-label" for="q43B">B) Warm</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q43" value="C" id="q43C"><label class="form-check-label" for="q43C">C) Energetic</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q43" value="D" id="q43D"><label class="form-check-label" for="q43D">D) Driven</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">44. I would be best at:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q44" value="A" id="q44A"><label class="form-check-label" for="q44A">A) Science or IT</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q44" value="B" id="q44B"><label class="form-check-label" for="q44B">B) Healthcare or social work</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q44" value="C" id="q44C"><label class="form-check-label" for="q44C">C) Mechanics or art</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q44" value="D" id="q44D"><label class="form-check-label" for="q44D">D) Management or business</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">45. I usually prefer:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q45" value="A" id="q45A"><label class="form-check-label" for="q45A">A) Quiet tasks</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q45" value="B" id="q45B"><label class="form-check-label" for="q45B">B) People-focused work</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q45" value="C" id="q45C"><label class="form-check-label" for="q45C">C) Moving around</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q45" value="D" id="q45D"><label class="form-check-label" for="q45D">D) Decision-making</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">46. I learn best:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q46" value="A" id="q46A"><label class="form-check-label" for="q46A">A) Through study</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q46" value="B" id="q46B"><label class="form-check-label" for="q46B">B) Through connection</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q46" value="C" id="q46C"><label class="form-check-label" for="q46C">C) Through experience</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q46" value="D" id="q46D"><label class="form-check-label" for="q46D">D) Through planning</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">47. I am interested in:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q47" value="A" id="q47A"><label class="form-check-label" for="q47A">A) Facts</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q47" value="B" id="q47B"><label class="form-check-label" for="q47B">B) Feelings</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q47" value="C" id="q47C"><label class="form-check-label" for="q47C">C) Functions</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q47" value="D" id="q47D"><label class="form-check-label" for="q47D">D) Finance</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">48. I’m likely to succeed in:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q48" value="A" id="q48A"><label class="form-check-label" for="q48A">A) Research, tech</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q48" value="B" id="q48B"><label class="form-check-label" for="q48B">B) Education, counseling</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q48" value="C" id="q48C"><label class="form-check-label" for="q48C">C) Design, mechanics</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q48" value="D" id="q48D"><label class="form-check-label" for="q48D">D) Business, leadership</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">49. I enjoy making:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q49" value="A" id="q49A"><label class="form-check-label" for="q49A">A) Diagrams</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q49" value="B" id="q49B"><label class="form-check-label" for="q49B">B) Connections</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q49" value="C" id="q49C"><label class="form-check-label" for="q49C">C) Devices</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q49" value="D" id="q49D"><label class="form-check-label" for="q49D">D) Deals</label></div>
        </div>

        <div class="question mb-4 p-3 bg-white rounded shadow-sm">
          <h5 class="text-danger">50. I would love to be:</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="q50" value="A" id="q50A"><label class="form-check-label" for="q50A">A) A scientist or analyst</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q50" value="B" id="q50B"><label class="form-check-label" for="q50B">B) A therapist or nurse</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q50" value="C" id="q50C"><label class="form-check-label" for="q50C">C) An architect or technician</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q50" value="D" id="q50D"><label class="form-check-label" for="q50D">D) A CEO or entrepreneur</label></div>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn">Previous</button>
        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
      </div>

      <!-- Submit Button -->
      <div class="text-center mt-4" id="submitDiv" style="display:none;">
        <button type="submit" class="btn btn-primary px-5">Submit</button>
      </div>

    </form>
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
