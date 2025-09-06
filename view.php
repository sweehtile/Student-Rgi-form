<?php
require 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .container { max-width: 90%; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow-x: auto; }
        h1 { color: #333; text-align: center; }
        .actions { margin-bottom: 20px; text-align: center; }
        .actions a { text-decoration: none; }
        .actions button { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin: 0 5px; }
        .add-btn { background-color: #28a745; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-btns a { margin: 0 2px; }
        .edit-btn, .delete-btn { padding: 5px 10px; border: none; border-radius: 4px; color: white; cursor: pointer; }
        .edit-btn { background-color: #007bff; }
        .delete-btn { background-color: #dc3545; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registered Students</h1>
        <?php
            if(isset($_GET['status']) && $_GET['status'] == 'success') {
                echo '<div class="message success">' . htmlspecialchars($_GET['message']) . '</div>';
            } elseif(isset($_GET['status']) && $_GET['status'] == 'error') {
                echo '<div class="message error">' . htmlspecialchars($_GET['message']) . '</div>';
            }
        ?>
        <div class="actions">
            <a href="index.php"><button class="add-btn">Add New Student</button></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>DOB</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM students ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['father_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dob_day'] . "/" . $row['dob_month'] . "/" . $row['dob_year']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['mobile_no']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td class='action-btns'>";
                            echo "<a href='edit.php?id=" . $row['id'] . "'><button class='edit-btn'>Edit</button></a>";
                            echo "<a href='process.php?action=delete&id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this student?\")'><button class='delete-btn'>Delete</button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12' style='text-align:center;'>No students found.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>