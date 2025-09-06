<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
        <h1>Student Registration Form</h1>
        <?php
            if(isset($_GET['status']) && $_GET['status'] == 'success') {
                echo '<div class="message success">Student registered successfully!</div>';
            } elseif(isset($_GET['status']) && $_GET['status'] == 'error') {
                echo '<div class="message error">' . htmlspecialchars($_GET['message']) . '</div>';
            }
        ?>
        <form action="process.php" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name:</label>
                <input type="text" id="father_name" name="father_name" required>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <div class="date-inputs">
                    <input type="number" name="day" placeholder="Day" min="1" max="31" required>
                    <input type="number" name="month" placeholder="Month" min="1" max="12" required>
                    <input type="number" name="year" placeholder="Year" min="1900" max="2100" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="mobile">Mobile No.:</label>
                    <input type="text" id="mobile" name="mobile" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" name="gender" value="Female"> Female</label>
                </div>
            </div>
            <div class="form-group">
                <label>Department:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="department[]" value="English"> English</label>
                    <label><input type="checkbox" name="department[]" value="Computer"> Computer</label>
                    <label><input type="checkbox" name="department[]" value="Business"> Business</label>
                </div>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <select id="course" name="course" required>
                    <option value="">Select Course</option>
                    <option value="B.A.">B.A.</option>
                    <option value="B.Sc.">B.Sc.</option>
                    <option value="B.Com.">B.Com.</option>
                    <option value="B.E.">B.E.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="actions">
                <button type="submit" name="register">Register</button>
                <a href="view.php"><button type="button">View Students</button></a>
            </div>
        </form>
    </div>
</body>
</html>