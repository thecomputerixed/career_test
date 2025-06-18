<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$courses_per_page = 9;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start_index = ($page - 1) * $courses_per_page;

// Get total pages
$total_courses_sql = "SELECT COUNT(*) as total FROM courses";
$total_courses = $conn->query($total_courses_sql)->fetch_assoc()['total'];
$total_pages = ceil($total_courses / $courses_per_page);

// Fetch paginated course list
$sql = "SELECT * FROM courses LIMIT $start_index, $courses_per_page";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <title>ETBS | Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .card-img-top {
      object-fit: cover;
      height: 200px;
    }
    .truncate-text {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
</head>
<body class="bg-light text-dark">

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Explore Courses</h2>
    <button id="toggleTheme" class="btn btn-outline-dark btn-sm">Toggle Dark Mode</button>
  </div>

  <!-- Search Input -->
  <div class="mb-4">
    <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Search courses...">
  </div>

  <!-- Course Cards -->
  <div class="row" id="courseList">
    <?php foreach ($courses as $course): ?>
      <?php
        $cleanText = strip_tags($course['description']);
        $words = preg_split('/\s+/', $cleanText);
        $limited = implode(' ', array_slice($words, 0, 15));
        $imagePath = !empty($course['image_path']) ? htmlspecialchars($course['image_path']) : 'uploads/default.jpg';
      ?>
      <div class="col-md-4 mb-4 course-card">
        <div class="card h-100 shadow-sm">
          <img src="<?php echo htmlspecialchars($course['image_path']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" style="width:100%">

          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
            <p class="card-text truncate-text"><?= html_entity_decode($limited) ?><?= count($words) > 15 ? '...' : '' ?></p>
            <p class="text-muted mb-1"><strong>Price:</strong> $<?= number_format($course['price']) ?></p>
            <p class="text-muted mb-1"><strong>Duration:</strong> <?= htmlspecialchars($course['duration_value']) ?> <?= htmlspecialchars($course['duration_unit']) ?></p>
            <button class="btn btn-outline-danger btn-sm mt-2" onclick="alert('Added to wishlist')">Add to Wishlist</button>
            <button class="btn btn-danger btn-sm mt-2" onclick="alert('Taking course...')">Take Course</button>
             <a href="course_detail.php?course_id=<?php echo $course['course_id']; ?>" class="btn btn-grey btn-sm mt-2">Details</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-4">
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Search functionality
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('input', function () {
    const term = this.value.toLowerCase();
    document.querySelectorAll('.course-card').forEach(card => {
      const text = card.innerText.toLowerCase();
      card.style.display = text.includes(term) ? 'block' : 'none';
    });
  });

  // Dark mode toggle
  document.getElementById('toggleTheme').addEventListener('click', () => {
    const html = document.documentElement;
    const isDark = html.getAttribute('data-bs-theme') === 'dark';
    html.setAttribute('data-bs-theme', isDark ? 'light' : 'dark');
  });
</script>
</body>
</html>
