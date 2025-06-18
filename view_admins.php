<?php
require_once '../config.php';

// Check if admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";
$admins = [];

// Fetch all admins (excluding the admin with ID 1)
$sql_select_admins = "SELECT admin_id, email FROM admins WHERE admin_id != 1";
$result_select_admins = mysqli_query($conn, $sql_select_admins);

if ($result_select_admins && mysqli_num_rows($result_select_admins) > 0) {
    while ($row = mysqli_fetch_assoc($result_select_admins)) {
        $admins[] = $row;
    }
    mysqli_free_result($result_select_admins);
}

// Handle delete admin via POST request from the modal
if (isset($_POST['delete_admin_id']) && is_numeric($_POST['delete_admin_id'])) {
    $delete_admin_id = mysqli_real_escape_string($conn, $_POST['delete_admin_id']);

    // Ensure we don't accidentally delete admin with ID 1
    if ($delete_admin_id == 1) {
        $message = "<p class='error'>Cannot delete the primary administrator.</p>";
    } else {
        $sql_delete_admin = "DELETE FROM admins WHERE admin_id = ?";
        $stmt_delete_admin = mysqli_prepare($conn, $sql_delete_admin);
        mysqli_stmt_bind_param($stmt_delete_admin, "i", $delete_admin_id);

        if (mysqli_stmt_execute($stmt_delete_admin)) {
            $message = "<p class='success'>Admin deleted successfully.</p>";
            // Refresh the admin list
            $admins = [];
            $sql_select_admins_refresh = "SELECT admin_id, email FROM admins WHERE admin_id != 1";
            $result_select_admins_refresh = mysqli_query($conn, $sql_select_admins_refresh);
            if ($result_select_admins_refresh && mysqli_num_rows($result_select_admins_refresh) > 0) {
                while ($row = mysqli_fetch_assoc($result_select_admins_refresh)) {
                    $admins[] = $row;
                }
                mysqli_free_result($result_select_admins_refresh);
            }
        } else {
            $message = "<p class='error'>Error deleting admin: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt_delete_admin);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Administrators</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; }
        h2 { color: #333; margin-bottom: 20px; }
        .success { color: green; font-weight: bold; margin-top: 10px; }
        .error { color: red; font-weight: bold; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:hover { background-color: #f9f9f9; }
        .actions button { background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 0.9em; }
        .actions button:hover { background-color: #c82333; }
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; border-radius: 8px; position: relative; }
        .modal-header { padding: 10px; background-color: #f2f2f2; border-bottom: 1px solid #ddd; }
        .modal-body { padding: 20px; }
        .modal-footer { padding: 10px; background-color: #f2f2f2; border-top: 1px solid #ddd; text-align: right; }
        .modal-delete-button { background-color: #dc3545; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-size: 1em; margin-left: 10px; }
        .modal-back-button { background-color: #6c757d; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-size: 1em; margin-right: 10px; }
        .modal-close-button { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
        .modal-close-button:hover, .modal-close-button:focus { color: black; text-decoration: none; cursor: pointer; }
    </style>
</head>
<body>
    <?php include'header.php'?>
    
    
    <p><a href="dashboard.php">Back to Dashboard</a> | <a href="register_admin.php">Add New Admin</a></p>

    <h2>Admin - View Administrators</h2>

    <?php echo $message; ?>

    <?php if (!empty($admins)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?php echo $admin['admin_id']; ?></td>
                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        <td class="actions">
                            <?php if ($admin['admin_id'] != 1): ?>
                                <button onclick="openDeleteModal(<?php echo $admin['admin_id']; ?>)">Delete</button>
                            <?php else: ?>
                                <span style="color: #777;">Primary Admin</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-close-button" onclick="closeDeleteModal()">&times;</span>
                    <h2>Confirm Delete</h2>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete administrator with ID <span id="modal-admin-id"></span>?</p>
                    <form method="post">
                        <input type="hidden" name="delete_admin_id" id="delete_admin_id">
                        <div class="modal-footer">
                            <button type="button" class="modal-back-button" onclick="closeDeleteModal()">Back</button>
                            <button type="submit" class="modal-delete-button">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            var deleteModal = document.getElementById("deleteModal");
            var deleteAdminIdInput = document.getElementById("delete_admin_id");
            var modalAdminIdDisplay = document.getElementById("modal-admin-id");

            function openDeleteModal(adminId) {
                if (adminId === 1) {
                    alert("Cannot delete the primary administrator.");
                    return;
                }
                deleteAdminIdInput.value = adminId;
                modalAdminIdDisplay.textContent = adminId;
                deleteModal.style.display = "block";
            }

            function closeDeleteModal() {
                deleteModal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == deleteModal) {
                    deleteModal.style.display = "none";
                }
            }
        </script>
    <?php else: ?>
        <p>No other administrators found.</p>
    <?php endif; ?>

</body>
</html>