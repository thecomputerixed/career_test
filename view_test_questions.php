<?php
require_once 'config.php';

// Check if admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit();
}

$message = "";

// Handle delete question
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    $sql_delete = "DELETE FROM test_questions WHERE question_id = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $delete_id);

    if (mysqli_stmt_execute($stmt_delete)) {
        $message = "<p class='success'>Question deleted successfully.</p>";
    } else {
        $message = "<p class='error'>Error deleting question: " . mysqli_error($conn) . "</p>";
    }
    mysqli_stmt_close($stmt_delete);
}

// Fetch all test questions
$questions = [];
$sql_select_all = "SELECT question_id, question_text FROM test_questions";
$result_select_all = mysqli_query($conn, $sql_select_all);

if ($result_select_all && mysqli_num_rows($result_select_all) > 0) {
    while ($row = mysqli_fetch_assoc($result_select_all)) {
        $questions[] = $row;
    }
    mysqli_free_result($result_select_all);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - View Career Questions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
     table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
  </style>
</head>
<body>
 <?php include'header3.php'?>
     
    <div class="container">
        <h5 class="text-grey mt-5">Admin<span class="text-danger">  - Edit Career Question</span></h5>
        <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
         <a href='add_test_questions.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Add Career Question</a>
          
    <?php echo $message; ?>

    <?php if (!empty($questions)): ?>
        <table>
            <thead class="text-danger mt-2">
                <tr class="mt-3 py-3">
                    <th>ID</th>
                    <th>Question Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?php echo $question['question_id']; ?></td>
                        <td><?php echo htmlspecialchars(substr($question['question_text'], 0, 100)) . (strlen($question['question_text']) > 100 ? '...' : ''); ?></td>
                        <td class="actions">
                            <a class="btn btn-danger" href="edit_test_question.php?question_id=<?php echo $question['question_id']; ?>" class="edit-button">Edit</a>
                            <!--<button onclick="confirmDelete(<?php echo $question['question_id']; ?>)" class="delete-button">Delete</button>-->
                            <a href="#" class="btn-delete btn btn-outline-danger mt-2 mb-2" data-id="<?php echo $question['question_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No test questions found.</p>
    <?php endif; ?>
</div>
 <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">
      <img src="source/img/delalert.png" alt="Oops!" style="width: 400px; height:400px;" class="mx-auto mt-3" />
      <h5 class="mt-3">Are you sure you want to delete this Career Question?</h5>
      <div class="d-flex justify-content-center mt-4 mb-2 gap-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>
<script>
  const deleteLinks = document.querySelectorAll('.btn-delete');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let selectedId = null;

  deleteLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      selectedId = this.getAttribute('data-id');
      const deleteUrl = `delete_test_question.php?question_id=${selectedId}`;
      confirmDeleteBtn.setAttribute('href', deleteUrl);

      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
    });
  });
</script>
</body>
</html>
