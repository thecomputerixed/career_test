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

// STEP 2: Determine Primary and Secondary
arsort($counts);
$keys = array_keys($counts);
$dominant = $keys[0]; // Highest selected
$second_dominant = $keys[1]; // Second highest

// Mapping A, B, C, D to Names
$major_career = [
    'A' => "Thinker",
    'B' => "Helper",
    'C' => "Doer",
    'D' => "Leader"
];

// Primary and Secondary Career Types
$primary = $major_career[$dominant];
$secondary = $major_career[$second_dominant];

// STEP 3: Define the 12 outcomes

// Define career descriptions
$career_outcomes = [
    "Thinker_Helper" => [
        'meaning' => "You are still deeply driven by intellectual curiosity, systems thinking, and understanding how things work beneath the surface. But with Helper rising to second place, you're also motivated by making life easier for others, sharing knowledge, and being of service — especially through practical, thoughtful solutions.

You’re not just a thinker for thinking’s sake — you want your ideas to help people solve problems.
",
        'ideal_careers' => "1. Business Strategy Consultant <br>  
 2. Policy or Legal Advisor <br>
 3. Education Entrepreneur (Online courses, training programs) <br> 
 4. Digital Product Creator (like eguides or automation tools)<br>  
 5. NGO/Nonprofit Strategy Lead<br>  
 6. HumanCentered Research & Innovation
",
        'strengths' => "Solving realworld problems with clarity and compassion<br> 
 Designing systems or tools to help others<br>
 Listening deeply and advising wisely<br>
 Communicating complex info simply<br>
 Being a calm, logical presence in chaotic spaces.
",
        'watch_out' => "Avoid being too aggressive or impatient.",
        'career_personality' => "Bold, Strategic, Goal-Oriented"
    ],
    "Thinker_Leader" => [
        'meaning' => "This person is naturally analytical, strategic, and curious — a deep thinker who thrives when solving problems, working with ideas, and building systems. But paired with strong leadership instincts, they’re not content with just thinking — they want to build, guide, and influence.

They have a sharp mind and the confidence to lead.
",
        'ideal_careers' => "1. Business Consultant / Strategist <br> 
 2. Policy Analyst or Government Advisor <br>  
 3. Project Manager <br> 
 4. Startup Founder or Tech Entrepreneur<br> 
 5. Head of Research / Product Development<br> 
 6. Corporate Strategy Lead<br>
 7. Real Estate Developer / Investment Analyst.
",
        'strengths' => "Clear thinker<br> Big picture planner<br>  
 Strong at seeing patterns and solving complex problems<br>  
 Confident enough to take charge <br>
 Natural authority — people tend to follow their ideas<br>  
 Independent and focused
",
        'watch_out' => "May resist working in groups or taking advice  <br>
 Can overplan and underexecute without an action partner  <br>
 Might be impatient with slower thinkers or “nonlogical” people <br> 
 Needs to learn how to inspire, not just instruct.
",
        'career_personality' => "The Visionary Strategist"
    ],
    "Thinker_Doer" => [
        'meaning' => "You’re a deep mind. Curious, analytical, highly independent, and deeply drawn to logic, knowledge, and understanding the ‘why’ behind everything. You don’t just want to do — you want to understand, dissect, and master.

You're not content with surfacelevel answers. You thrive in spaces where you're constantly learning, solving problems, and working with systems, ideas, or innovations.
",
        'ideal_careers' => "1. Research & Analysis <br>
2. Technology & Innovation <br>
3. Science & Engineering <br>
4. Academia & Writing <br>
5. Strategy & Consulting

",
        'strengths' => " Problemsolving  <br>
 Working independently  <br>
 Attention to detail  <br>
 Analytical and logical thinking  <br>
 Love for learning and understanding systems

",
        'watch_out' => "Overthinking and analysis paralysis <br> 
 Avoiding collaborative tasks (even though they may help you grow)  <br>
 Staying too long in planning mode instead of execution.
",
        'career_personality' => "The Thinker"
    ],
    "Helper_Thinker" => [
        'meaning' => "This person is a natural caregiver, communicator, and supporter. They’re deeply empathetic, peopleoriented, and drawn to roles where they can guide, heal, teach, or serve others. They thrive on connection and purpose — making people feel seen, heard, and supported.

Their Thinker streak adds depth — they don’t just help emotionally, they want to understand people’s needs and offer thoughtful solutions.",
        'ideal_careers' => "1. Counselor / Therapist <br>
 2. Teacher / Educator <br>
 3. NGO or Social Worker, 
 4. Nurse or Healthcare Support,  
 5. Human Resources / Recruitment Officer,  
 6. Customer Relations Manager,  
 7. Life Coach or Spiritual Guide,  
 8. Community Organizer or Advocate
",
        'strengths' => "Deep empathy and emotional insight <br> 
 Excellent listener and supporter <br>
 Makes others feel safe and valued <br>
 Driven by purpose and heart <br>
 Can sense needs before they’re spoken
",
        'watch_out' => "Tendency to put others first and burn out <br>
 Might avoid conflict even when needed <br>
 Can be too selfcritical <br>
 Needs strong emotional boundaries
.",
        'career_personality' => "The Insightful Nurturer <br>

They work best in environments that are collaborative, meaningful, and compassionate — not competitive or mechanical. They shine in roles where emotional intelligence matters.
"
    ],
    "Helper_Doer" => [
        'meaning' => "This person is a heartdriven action taker. They're warm, caring, and deeply invested in the wellbeing of others — but they’re also practical and handson, ready to do the work rather than just talk about it.

They want to help, and they want to see results. Whether it’s solving people’s problems, building something meaningful, or simply making life easier for someone — they are at their best when they combine service with action.
",
        'ideal_careers' => "1. Nurse / Medical Support Worker  <br>
 2. NGO Field Officer / Community Organizer  <br>
 3. Social Worker or Youth Program Leader  <br>
 4. Event Coordinator  <br>
 5. Human Resources or People Management  <br>
 6. Customer Service or Support Agent  <br>
 7. Logistics / Project Support in a nonprofit or impactdriven business  <br>
 8. School Administrator / Educational Support Staff
",
        'strengths' => " Genuinely kind and helpful  <br>
 Takes initiative to solve problems for others  <br>
 Great in support roles that need emotional and practical strength  <br>
 Trustworthy, humble, and hardworking  <br>
 Good under pressure and in active, peopledriven spaces
",
        'watch_out' => "Might overcommit or neglect selfcare  <br>
 Can downplay their leadership potential  <br>
 Needs validation and balance to avoid burnout  <br>
 May struggle with saying “no” when needed
.",
        'career_personality' => "The Compassionate Builder <br>

They thrive in peoplefocused, realworld environments — where empathy, service, and physical or logistical involvement go handinhand.
"
    ],
    "Helper_Leader" => [
        'meaning' => "This person is a naturalborn guide and compassionate leader. They're driven by a deep desire to serve others, but unlike some Helpers who stay behind the scenes, they have a bold leadership streak that pushes them to take charge, speak up, and rally people toward change.

They combine heart with influence — making them ideal for roles where they can lead people, heal systems, and empower communities.
",
        'ideal_careers' => "Life Coach / Counselor / Mentor  <br>
 Social Enterprise Founder  <br>
 NGO / Charity Director  <br>
 Motivational Speaker / Advocate <br>  
 HR Manager or People Development Specialist  <br>
 School Principal / Community Leader  <br>
 Church or FaithBased Leader  <br>
 Public Health Leader or Social Reformer
",
        'strengths' => "Empathetic, inspiring, and bold  <br>
 Helps people believe in themselves  <br>
 Takes initiative to fix peoplerelated problems  <br>
 Leads with emotional intelligence  <br>
 Natural motivator and teacher  <br>
 Has a voice people listen to
",
        'watch_out' => "May take on too much emotional responsibility  <br>
 Needs to balance heartled work with systems and structure  <br>
 Might struggle with setting boundaries  <br>
 Needs rest and support too — not just giving
.",
        'career_personality' => "The Empowering ChangeMaker <br>

They’re here to help people grow and thrive — but they’ll do it from the front, not the sidelines.
"
    ],
    "Doer_Helper" => [
        'meaning' => "This person is a handson, action first individual — someone who loves getting things done, seeing tangible results, and solving problems in practical ways. They’re not about overthinking — they’re about doing. They thrive in environments where they can move, build, fix, or produce something real.

Their helper side shows that they’re not just taskdriven — they care deeply about people and are likely to go out of their way to make life easier or better for others through their actions.
.",
        'ideal_careers' => "1. Skilled Trades (e.g., Electrician, Carpenter, Technician)<br>  
 2. Logistics & Operations Coordinator <br> 
 3. Healthcare Assistant / Medical Technician<br> 
 4. Event Planning / Support Services  <br>
 5. Security or Emergency Services <br> 
 6. Customer Support Field Agent  <br>
 7. Construction or Property Maintenance <br> 
 8. Food & Hospitality Services  <br>
 9. Cleaning / Facility Management  <br>
 10. Handson NGO/Relief Work.
",
        'strengths' => " Reliable, practical, and hardworking<br>  
 Problemsolver under pressure  <br>
 Doesn’t wait around — takes initiative  <br>
 Values teamwork and service  <br>
 Grounded and loyal
",
        'watch_out' => " May ignore emotions or deeper processing  <br>
 Could undervalue their own intelligence or vision  <br>
 Needs appreciation for their effort  <br>
 Might burn out if doing too much for others without balance
.",
        'career_personality' => "The Practical Caregiver<br>

They combine strength with service — someone who may not always have the words, but always shows up and makes a difference through what they do.
"
    ],
    "Doer_Thinker" => [
        'meaning' => "This person is highly actionoriented, practical, and grounded — they believe in doing, not just planning. They're the kind of person who thrives in structured environments, handson work, and taskbased roles where results are visible and immediate.

With a Thinker as a secondary trait, they aren’t just doing for the sake of it — they are methodical, precise, and strategic. They like knowing why they’re doing something and often bring a sharp problemsolving mindset to their work.
",
        'ideal_careers' => "1. Engineering / Technical Fields  <br>
 2. Mechanic / Technician / Machine Operator  <br>
 3. IT Support / Network Technician <br> 
 4. Skilled Trades (e.g., Electrician, Plumber, Welder) <br> 
 5. Project Coordinator or Site Supervisor  <br>
 6. Manufacturing / Assembly Roles <br> 
 7. Logistics / Inventory / Warehouse Management  <br>
 8. Architecture Drafting / Surveying / CAD Operator <br> 
 9. Quality Control / Safety Inspector
",
        'strengths' => " Extremely reliable and resultsoriented <br> 
 Strong attention to detail  <br>
 Logical problemsolver  <br>
 Thrives in organized systems and routines  <br>
 Loyal, focused, and steady under pressure
",
        'watch_out' => "May get frustrated with abstract ideas or excessive talking  <br>
 Can be underappreciated in overly 'corporate' or emotional settings  <br>
 Might need encouragement to see their leadership potential  <br>
 Could avoid roles involving deep emotional work or unpredictable dynamics
.",
        'career_personality' => "The Logical Builder <br>

They value function over fluff, and they shine in careers that combine mental focus with realworld impact. They are dependable, highly efficient, and committed to tangible outcomes.
"
    ],
    "Doer_Leader" => [
        'meaning' => "This person is a gogetter with a strong drive for handson work and realworld results, but they’re also not afraid to take charge when needed. They are efficient, reliable, and actionfocused, with the inner strength and charisma to lead others by example.

They thrive in environments where they can move, build, fix, or coordinate — and they’re likely the type who gets frustrated when things are all talk and no action.

Their leadership trait shows they can organize people, manage projects, and push goals forward — especially when the job needs someone who gets things done and inspires others to do the same.
",
        'ideal_careers' => "1. Operations Manager / Site Supervisor  <br>
 2. Project Manager (especially in construction, logistics, events) <br> 
 3. Skilled Trades with Team Lead Roles  <br>
 4. Security / Emergency Response Leader  <br>
 5. Field Officer in NGO or Community Projects <br> 
 6. Event Planner / Logistics Coordinator  <br>
 7. Military, Law Enforcement, or Tactical Services <br> 
 8. Business Owner in a practical or servicebased field (e.g. cleaning, real estate, repair, or delivery services
",
        'strengths' => "Highly dependable and actionoriented  <br>
 Good at managing tasks and people  <br>
 Focused on results, not drama  <br>
 Leads by doing  <br>
 Thinks on their feet and thrives under pressure
",
        'watch_out' => "May overlook emotional needs (their own or others’) <br> 
 Can burn out if doing everything themselves  <br>
 Might avoid longterm strategy in favor of shortterm action <br>  
 Needs structure but should embrace flexibility too
.",
        'career_personality' => " The Tactical Leader <br>

They’re wired for action and prefer leading from the front lines — solving problems with their hands, heart, and head in sync
"
    ],
    "Leader_Thinker" => [
        'meaning' => "This person is a visionary powerhouse — highly driven, assertive, and confident in their ability to lead, influence, and build something impactful. They’re not afraid of responsibility and are often the one others naturally look to for direction, decisionmaking, and bold action.

With Thinker as a secondary trait, they don’t just lead for power’s sake — they have a strategic, intelligent edge. They analyze situations deeply, make informed decisions, and have the potential to combine intellect with influence
.",
        'ideal_careers' => "1. Entrepreneur / Business Founder  <br>
 2. CEO or Executive Roles  <br>
 3. Political Leader or Policy Maker <br>  
 4. Management Consultant / Business Strategist <br>  
 5. Motivational Speaker / Public Personality  <br>
 6. Tech Startup Leader or Product Manager  <br>
 7. Real Estate or Investment Executive  <br>
 8. Creative Director or Brand Architect
",
        'strengths' => "Inspires confidence and takes initiative <br> 
 Bold, persuasive, and influential  <br>
 Strategic mindset  <br>
 Natural risktaker with a longterm vision  <br>
 Thrives on challenge and achievement 
",
        'watch_out' => " Can be overly dominant or impatient with slower thinkers <br> 
 May neglect emotional nuance or team bonding  <br>
 Needs to avoid burnout from overcontrol  <br>
 Should cultivate collaboration and empathy for sustained impact
",
        'career_personality' => "The Strategic Trailblazer <br>

This is someone who’s wired for bigpicture thinking, bold goals, and highimpact leadership. They were likely born to create, command, and challenge the status quo.
"
    ],
    "Leader_Doer" => [
        'meaning' => "You are a strong, action driven leader. They have a powerful presence, enjoy taking charge, and are highly goaloriented. They don’t just dream — they execute. Their style of leadership is practical, bold, and handson.

The Doer trait shows they are not afraid to get involved in the work. They lead not only by direction but by example, often inspiring others with their energy and resultsoriented mindset.
",
        'ideal_careers' => "1. Business Founder / Entrepreneur  <br>
 2. Project Manager or Operations Director <br> 
 3. Real Estate Developer or Executive  <br>
 4. Military or Security Leadership Roles  <br>
 5. Political Campaign Leader / Community Organizer  <br>
 6. Senior Logistics or Supply Chain Manager  <br>
 7. Construction or Field Project Lead  <br>
 8. CEO or HighLevel Management in fastpaced companies.
",
        'strengths' => "Decisive and confident <br> 
 Gets things done efficiently  <br>
 Inspires others with action and clarity <br>  
 Great at organizing teams and moving them toward results <br>  
 Natural authority in both corporate and entrepreneurial settings
",
        'watch_out' => " May come off as overly dominant or impatient  <br>
 Could neglect softer interpersonal dynamics  <br>
 Should avoid micromanaging and learn to delegate <br> 
 Needs space to recharge to avoid burnou
",
        'career_personality' => "The Action Oriented Leader <br>

They are a natural commander, someone others look to for structure, clarity, and momentum. This personality thrives in highstakes roles where leadership and execution must go hand in hand.
"
    ],
    "Leader_Helper" => [
        'meaning' => "You're highly ambitious, focused, and resultsdriven. You enjoy taking charge, managing people or projects, 
        and seeing things grow. You likely prefer independence, responsibility, and measurable progress.",
        'ideal_careers' => "1. Business & Entrepreneurship <br>
2. Management & Administration <br>
3. Marketing & Communications <br>
4. Law & Policy <br>
5. Finance & Planning
",
        'strengths' => "Strong leadership instincts; easily steps into positions of authority and influence. <br> 
         People-Oriented Leadership: Balances leadership with care and empathy, thanks to the Helper trait. <br> 
 Highly Motivational: Can inspire, uplift, and mobilize others toward a common goal.  <br>
 Strong Communication Skills: Good at connecting with people, motivating them, and maintaining team morale.  <br>
 Decisive and Courageous: Doesn't shy away from big decisions or taking bold action when needed.  <br>
 Purpose-Driven: Often feels a strong sense of mission or responsibility to help others through leadership.
",
        'watch_out' => " Overburdening Self: Might take on too much responsibility for others, leading to stress or burnout. <br> 
 Emotional Exhaustion: With a strong Helper side, may absorb too much of others' problems while leading.  <br>
 Can Be Overprotective: May struggle to let people fail or learn lessons on their own, trying too hard to ‘fix’ things for them.  <br>
 Risk of Being Misunderstood: Assertive leadership mixed with emotional concern can confuse others if not communicated clearly.  <br>
 Needs Balance: Must balance personal ambition with genuine delegation and trust in others' abilities.
",
        'career_personality' => "Heart-centered leader <br> tough enough to lead but compassionate enough to care deeply about the people they lead."
    ],
];

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
$sql = "INSERT INTO user_results (name, email, answers, dominant, second_dominant) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $answers_json, $dominant, $second_dominant);
$stmt->execute();
$stmt->close();
$conn->close();





// STEP 4: Find correct outcome key
$outcome_key = "{$primary}_{$secondary}";

// STEP 5: Display the Result
if (isset($career_outcomes[$outcome_key])) {
    $outcome = $career_outcomes[$outcome_key];
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
          .hover-info-card {
          position: relative;
          overflow: hidden;
      }

      .hover-overlay {
          position: absolute;
          top: 0;
          left: 100;
          right: 0;
          bottom: 0;
          background-color: rgba(231, 11, 11, 0.7);
          padding: 1rem;
          display: none;
          z-index: 10;
          font-size: 0.875rem;
          color: #333;
      }

      .hover-info-card:hover .hover-overlay {
          display: block;
          animation: fadeIn 0.3s ease-in-out;
      }

      @keyframes fadeIn {
          from { opacity: 0; transform: translateY(10px); }
          to { opacity: 1; transform: translateY(0); }
      }
      /* Background transition */
    .animated-section {
      animation: bgTransition 10s ease-in-out forwards;
    }

    @keyframes bgTransition {
      0% { background-color: white; }
      100% { background-color: #dc3545; /* Bootstrap red */ }
    }

    /* Card animation */
    .feature-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
      transform: scale(1.03);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

     .animated-section {
    animation: bgTransition 10s ease-in-out forwards;
  }

  @keyframes bgTransition {
    0% { background-color: white; }
    100% { background-color: #dc3545; }
  }

  .carousel-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    overflow: hidden;
  }

  .feature-card {
    flex: 1 1 300px;
    max-width: 100%;
    background: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 300px;
  }

  .feature-card:hover {
    transform: scale(1.03);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  /* On mobile: horizontal scroll + swipe */
  @media (max-width: 768px) {
    .carousel-wrapper {
      flex-wrap: nowrap;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
    }

    .feature-card {
      flex: 0 0 80%;
      scroll-snap-align: start;
    }

    .carousel-wrapper::-webkit-scrollbar {
      display: none;
    }
    .carousel-wrapper {
      scrollbar-width: none;
    }
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
                                 <div class='circle' style='--percent:{$percentages['A']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['A']}%</div>
                                </div>
                                <div class='label'>Thinker</div>
                                <div class='subtext'>{$counts['A']} </div>
                            </div>

                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['B']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['B']}%</div>
                                </div>
                                <div class='label'>Helper</div>
                                <div class='subtext'>{$counts['B']}</div>
                            </div>

                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['C']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['C']}%</div>
                                </div>
                                <div class='label'>Doer</div>
                                <div class='subtext'>{$counts['C']}</div>
                            </div>
                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['D']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['D']}%</div>
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
                <h4 class='fw-bold'>Your Primary Career Type is :   <span class='text-danger'> {$primary}.</span> while your Secondary Trait is :   <span class='text-danger'> {$secondary}.</h4>
                
               <h5 class='text-danger'>What it means: </h5> <p class='lead text-muted'>{$outcome['meaning']}</p>
              </div>

            </div>
          </div>
        </section>

        <section class='py-5 animated-section'>
              <div class='container'>
                <div class='carousel-wrapper'>

                  <div class='feature-card'>
                    <h5 class='text-danger'>Ideal Career Paths</h5>
                    <p>{$outcome['ideal_careers']}</p>
                  </div>

                  <div class='feature-card'>
                    <h5 class='text-danger'>Strengths</h5>
                    <p>{$outcome['strengths']}</p>
                  </div>

                  <div class='feature-card'>
                    <h5 class='text-danger'>Watch Out</h5>
                    <p>{$outcome['watch_out']}</p>
                  </div>

                  <div class='feature-card'>
                    <h5 class='text-danger'>Career Personality</h5>
                    <p>{$outcome['career_personality']}</p>
                  </div>

                </div>
              </div>
        </section>

        <section class='py-5 bg-light'>
            <div class='container'>
                <h2 class='text-center fw-bold mb-4'>Ready to reimagine your career?</h2>
                <p class='text-center text-muted mb-5'>Get the skills and real-world experience employers want with Career Accelerators.</p>

                <div class='row g-4'>
                <!-- Card 1 -->
                <div class='col-md-4'>
                    <div class='card h-100 shadow-sm border-0 position-relative hover-info-card'>
                      <img src='cac1.png' class='card-img-top' alt='Full Stack Web Developer'>
                      <div class='card-body'>
                          <h5 class='card-title'>Full Stack Web Developer</h5>
                          <p class='card-text text-muted mb-2'> Standard</p>
                         
                      </div>
                       <div class='hover-overlay shadow'style='width: 80%; height: 415px;'>
                          <p class='mb-1 text-white'><strong>Updated:</strong> March 2025</p>
                          <p class='mb-1 text-white'>Master Figma, prototyping, and user research.</p>
                          <p class='mb-1 text-white'>Create intuitive and beautiful user experiences.</p>
                           <div class='d-flex align-items-center small text-muted'>
                              <span class='me-2 text-white'>⭐ 3.7</span>
                              <span class='me-2 text-white'>• 440K ratings</span>
                              <span>• 87 total hours</span>
                              
                           </div>
                            <a href='#' class='btn btn-sm btn-light mt-2' id='addToBasket'>Add to course Basket</a>
                      </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class='col-md-4'>
                  <div class='card h-100 shadow-sm border-0 position-relative hover-info-card'>
                      <img src='cac1.png' class='card-img-top' alt='Digital Marketer'>
                      <div class='card-body'>
                          <h5 class='card-title'>Digital Marketer</h5>
                          <p class='card-text text-muted mb-2'>Professional</p>
                      </div>
                      <div class='hover-overlay shadow'>
                            <p class='mb-1 text-white'><strong>Updated:</strong> March 2025</p>
                            <p class='mb-1 text-white'>Master Figma, prototyping, and user research.</p>
                            <p class='mb-1 text-white'>Create intuitive and beautiful user experiences.</p>
                            <div class='d-flex align-items-center small text-muted'>
                                <span class='me-2 text-white'>⭐ 3.7</span>
                                <span class='me-2 text-white'>• 440K ratings</span>
                                <span>• 87 total hours</span>
                                
                            </div>
                            <a href='#' class='btn btn-sm btn-light mt-2' id='addToBasket'>Add to course Basket</a>
                    </div>
                   </div>
                </div>

                <!-- Card 3 -->
                <div class='col-md-4'>
                    <div class='card h-100 shadow-sm border-0 position-relative hover-info-card'>
                      <img src='cac1.png' class='card-img-top' alt='Data Scientist'>
                      <div class='card-body'>
                          <h5 class='card-title'>Data Scientist</h5>
                          <p class='card-text text-muted mb-2'>Executive</p>
                        
                      </div>
                      <div class='hover-overlay shadow'>
                            <p class='mb-1 text-white'><strong>Updated:</strong> March 2025</p>
                            <p class='mb-1 text-white'>Master Figma, prototyping, and user research.</p>
                            <p class='mb-1 text-white'>Create intuitive and beautiful user experiences.</p>
                            <div class='d-flex align-items-center small text-muted'>
                                <span class='me-2 text-white'>⭐ 3.7</span>
                                <span class='me-2 text-white'>• 440K ratings</span>
                                <span>• 87 total hours</span>
                            </div>
                            <a href='#' class='btn btn-sm btn-light mt-2' id='addToBasket'>Add to course Basket</a>

                      </div>
                    </div>
                </div>
                </div>

                <!-- BACKDROP -->
                <div id='overlay' class='position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-none' style='z-index: 1040;'></div>
                

                <!-- CART MODAL -->
            
                <!-- CART MODAL -->
                <div id='cartPopup' class='card position-fixed top-50 start-50 translate-middle shadow d-none' style='width: 90%; max-width: 600px; z-index: 1050; max-height: 90vh; overflow-y: auto;'>

                    <div class='card-header bg-white d-flex justify-content-between align-items-center'>
                      <h5 class='mb-0'>Added to cart</h5>
                      <button type='button' class='btn-close' id='closeCart' aria-label='Close'></button>
                    </div>
                    <div class='card-body'>
                          <div class='d-flex align-items-center mb-3'>
                            <img src='sample.png' class='me-3' alt='Course 1' style='width: 100px; height: 100px; object-fit: cover;'>
                            <div class=''>
                                <h6 class='mb-0'>Artificial Intelligence AI Marketing to Grow your Business</h6>
                                <small>Diego Davila • 1,000,000+ Students</small>
                                <p class='mb-0 text-muted'>₦54,900</p>
                            </div>
                          </div>
                          <div>
                            <a href='#' class='btn btn-danger mt-3 w-100'>Go to Course Basket</a>
                          </div>
                  
                      <hr>
                      <h6 class='mb-3 text-danger'>Get Specialized by Taking these other Courses</h6>
                       <hr>
                      <div class='d-flex align-items-center mb-3'>
                        <img src='HrHr.png' class='me-3' alt='Course 2' style='width: 150px; height: 150px; object-fit: cover;'>
                        <div>
                          <h6 class='mb-0'>Neuromarketing: Applied Neuroscience to Grow...</h6>
                          <small>Diego Davila • 1,000,000+ Students</small>
                          <p class='mb-0 text-muted'>₦27,900</p>
                        </div>
                      </div>

                      <div class='d-flex align-items-center mb-3'>
                        <img src='sample.png' class='me-3' alt='Course 3' style='width: 150px; height: 150px; object-fit: cover;'>
                        <div>
                          <h6 class='mb-0'>Email Marketing Masterclass: Start &...</h6>
                          <small>Diego Davila • 1,000,000+ Students</small>
                          <p class='mb-0 text-muted'>₦35,900</p>
                        </div>
                      </div>

                      <hr>
                      <div class='d-flex justify-content-between'>
                      <div>
                        <strong>Total:</strong>
                        <strong>₦118,700</strong>
                      </div>
                      <a href='#' class='btn btn-danger mt-3 w-100'>Add all to Course Basket</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class='text-center mt-4'>
                  <a href='#' class='btn btn-outline-danger'>View Other Courses</a>
                </div>
            </div>

        </section>
      <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>

      <script>
          const showBtn = document.getElementById('addToBasket');
          const cartPopup = document.getElementById('cartPopup');
          const overlay = document.getElementById('overlay');
          const closeBtn = document.getElementById('closeCart');

          showBtn.addEventListener('click', function(e) {
            e.preventDefault();
            cartPopup.classList.remove('d-none');
            overlay.classList.remove('d-none');
          });

          closeBtn.addEventListener('click', function() {
            cartPopup.classList.add('d-none');
            overlay.classList.add('d-none');
          });

          // Optional: Click outside to close
          overlay.addEventListener('click', function() {
            cartPopup.classList.add('d-none');
            overlay.classList.add('d-none');
          });
          showBtn.addEventListener('click', function(e) {
            e.preventDefault();
            cartPopup.classList.remove('d-none');
            overlay.classList.remove('d-none');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
          });

          closeBtn.addEventListener('click', function() {
            cartPopup.classList.add('d-none');
            overlay.classList.add('d-none');
            document.body.style.overflow = ''; // Re-enable scroll
          });

      </script>

    </body>
    </html>

    ";
    } else {
      echo "<p>Sorry, we couldn't determine your career path. Please try again.</p>";
    }
// Output the HTML structure
?>














