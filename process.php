<?php
require 'connect.php';

// Check if the form was submitted with the "register" button
if (isset($_POST['register'])) {
    $first_name = $_POST['fname'] ?? '';
    $last_name = $_POST['lname'] ?? '';
    $father_name = $_POST['father_name'] ?? '';
    $dob_day = $_POST['day'] ?? '';
    $dob_month = $_POST['month'] ?? '';
    $dob_year = $_POST['year'] ?? '';
    $mobile_no = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $departments = $_POST['department'] ?? [];
    $course = $_POST['course'] ?? '';
    $city = $_POST['city'] ?? '';
    $address = $_POST['address'] ?? '';

    // Convert departments array to a comma-separated string
    $departments_str = implode(", ", $departments);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?status=error&message=" . urlencode("Invalid email format."));
        exit;
    }

    // Check if email already exists
    $check_email_query = "SELECT id FROM students WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header("Location: index.php?status=error&message=" . urlencode("Email already registered."));
        exit;
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO students (first_name, last_name, father_name, dob_day, dob_month, dob_year, mobile_no, email, password, gender, department, course, city, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiisssssssss", $first_name, $last_name, $father_name, $dob_day, $dob_month, $dob_year, $mobile_no, $email, $hashed_password, $gender, $departments_str, $course, $city, $address);

    if ($stmt->execute()) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error&message=" . urlencode("Registration failed. " . $stmt->error));
    }
    $stmt->close();

} elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // Delete student
    $id = $_GET['id'] ?? null;
    if ($id) {
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: view.php?status=success&message=" . urlencode("Student deleted successfully."));
        } else {
            header("Location: view.php?status=error&message=" . urlencode("Failed to delete student."));
        }
        $stmt->close();
    }
} elseif (isset($_POST['update'])) {
    // Update student
    $id = $_POST['id'] ?? null;
    $first_name = $_POST['fname'] ?? '';
    $last_name = $_POST['lname'] ?? '';
    $father_name = $_POST['father_name'] ?? '';
    $dob_day = $_POST['day'] ?? '';
    $dob_month = $_POST['month'] ?? '';
    $dob_year = $_POST['year'] ?? '';
    $mobile_no = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $departments = $_POST['department'] ?? [];
    $course = $_POST['course'] ?? '';
    $city = $_POST['city'] ?? '';
    $address = $_POST['address'] ?? '';

    $departments_str = implode(", ", $departments);

    if ($id) {
        $sql = "UPDATE students SET first_name=?, last_name=?, father_name=?, dob_day=?, dob_month=?, dob_year=?, mobile_no=?, email=?, gender=?, department=?, course=?, city=?, address=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiissssssssi", $first_name, $last_name, $father_name, $dob_day, $dob_month, $dob_year, $mobile_no, $email, $gender, $departments_str, $course, $city, $address, $id);

        if ($stmt->execute()) {
            header("Location: view.php?status=success&message=" . urlencode("Student updated successfully."));
        } else {
            header("Location: view.php?status=error&message=" . urlencode("Failed to update student. " . $stmt->error));
        }
        $stmt->close();
    }
}

$conn->close();
?>