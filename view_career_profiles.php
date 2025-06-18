<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

$sql = "SELECT id, code, title, meaning, ideal_careers, strengths, watch_out, career_personality FROM career_profiles";
$result = $conn->query($sql);
$careers = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ETBS | Admin Dashboard - View Career Profiles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style> 
        .table thead {
            background-color: #f8d7da;
        }
        .table td, .table th {
            vertical-align: top;
            word-break: break-word;
        }
        .btn-sm {
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
<?php include 'header3.php'; ?>

<div class="container mt-4">
    <h2 class="fw-bold text-danger text-center">Admin - View Career Profiles</h2>
    <hr>

    <div class="mb-3 d-flex justify-content-between">
        <a href='admindashboard.php' class='btn btn-outline-secondary btn-sm'>Back to Dashboard</a>
        <a href='add_career_profile.php' class='btn btn-danger btn-sm'>Add New Career</a>
    </div>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($careers): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Meaning</th>
                        <th>Ideal Careers</th>
                        <th>Strengths</th>
                        <th>Watch Out</th>
                        <th>Personality</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($careers as $career): ?>
                        <tr>
                            <td><?= $career['id'] ?></td>
                            <td><?= $career['code'] ?></td>
                            <td><?= $career['title'] ?></td>
                            <td><?= $career['meaning'] ?></td>
                            <td><?= $career['ideal_careers'] ?></td>
                            <td><?= $career['strengths'] ?></td>
                            <td><?= $career['watch_out'] ?></td>
                            <td><?= $career['career_personality'] ?></td>
                            <td class="text-center">
                                <a href="edit_career_profile.php?id=<?= $career['id'] ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="<?= $career['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No career profiles available.</div>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <img src="source/img/delalert.png" alt="Delete Alert" style="width: 200px; height: 200px;" class="mx-auto mb-3">
      <h5>Are you sure you want to delete this career profile?</h5>
      <div class="d-flex justify-content-center mt-4 gap-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const deleteButtons = document.querySelectorAll('.btn-delete');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let selectedId = null;

  deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
      selectedId = this.getAttribute('data-id');
      confirmDeleteBtn.setAttribute('href', `delete_career_profile.php?id=${selectedId}`);
      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
    });
  });
</script>
</body>
</html>
