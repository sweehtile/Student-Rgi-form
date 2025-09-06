<?php

    require 'connect.php';

    $stuName = '';
    $email = '';
    $stuNameError = '';
    $emailError = '';

    if (isset($_POST['register'])) {

        $stuName = $_POST['stuName'];
        $email = $_POST['email'];

        if(empty($stuName)) {
            $stuNameError = "The name field is required.";
        }

        if(empty($email)){
            $emailError = "The email field is required.";
        }

        if(!empty($stuName) && !empty($email)) {
            $query = "INSERT INTO registration (student name, email) VALUES ('$stuName', '$email')";
            mysqli_query($db, $query);
        }

    }

?>