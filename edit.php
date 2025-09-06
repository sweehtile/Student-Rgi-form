<?php
require 'connect.php';

$student = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

if (!$student) {
    echo "<div class='container'><p>Student not found.</p><a href='view.php'>Back to list</a></div>";
    exit;
}

// Split departments string into an array for checkbox check
$student_departments = explode(", ", $student['department']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; }
        .form-row { display: flex; gap: 20px; }
        .form-group { flex: 1; margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="number"], input[type="password"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .date-inputs { display: flex; gap: 10px; }
        .date-inputs input { flex: 1; }
        .radio-group, .checkbox-group { display: flex; gap: 15px; margin-top: 5px; }
        .radio-group label, .checkbox-group label { font-weight: normal; display: flex; align-items: center; gap: 5px; }
        .actions { margin-top: 20px; text-align: center; }
        .actions button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        .actions a button { background-color: #6c757d; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: center; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Student Information</h1>
        <form action="process.php" method="POST">
            <input type="hidden" name="update" value="1">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name:</label>
                <input type="text" id="father_name" name="father_name" value="<?php echo htmlspecialchars($student['father_name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <div class="date-inputs">
                    <input type="number" name="day" placeholder="Day" min="1" max="31" value="<?php echo htmlspecialchars($student['dob_day']); ?>" required>
                    <input type="number" name="month" placeholder="Month" min="1" max="12" value="<?php echo htmlspecialchars($student['dob_month']); ?>" required>
                    <input type="number" name="year" placeholder="Year" min="1900" max="2100" value="<?php echo htmlspecialchars($student['dob_year']); ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="mobile">Mobile No.:</label>
                    <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($student['mobile_no']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="Male" <?php echo ($student['gender'] == 'Male') ? 'checked' : ''; ?> required> Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php echo ($student['gender'] == 'Female') ? 'checked' : ''; ?>> Female</label>
                </div>
            </div>
            <div class="form-group">
                <label>Department:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="department[]" value="English" <?php echo (in_array('English', $student_departments)) ? 'checked' : ''; ?>> English</label>
                    <label><input type="checkbox" name="department[]" value="Computer" <?php echo (in_array('Computer', $student_departments)) ? 'checked' : ''; ?>> Computer</label>
                    <label><input type="checkbox" name="department[]" value="Business" <?php echo (in_array('Business', $student_departments)) ? 'checked' : ''; ?>> Business</label>
                </div>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <select id="course" name="course" required>
                    <option value="">Select Course</option>
                    <option value="B.A." <?php echo ($student['course'] == 'B.A.') ? 'selected' : ''; ?>>B.A.</option>
                    <option value="B.Sc." <?php echo ($student['course'] == 'B.Sc.') ? 'selected' : ''; ?>>B.Sc.</option>
                    <option value="B.Com." <?php echo ($student['course'] == 'B.Com.') ? 'selected' : ''; ?>>B.Com.</option>
                    <option value="B.E." <?php echo ($student['course'] == 'B.E.') ? 'selected' : ''; ?>>B.E.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($student['city']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($student['address']); ?></textarea>
            </div>
            <div class="actions">
                <button type="submit">Update</button>
                <a href="view.php"><button type="button">Cancel</button></a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
$conn->close();
?>