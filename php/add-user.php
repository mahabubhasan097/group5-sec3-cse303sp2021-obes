<?php
    include 'mysql.php';
    $id = $_POST['id'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $program = $_POST['program'];
    $department = $_POST['department'];

    if($role == 'student'){
        $query = "INSERT INTO student (student_id, fname, lname, email, password, program_id)
                VALUES ($id, '$f_name', '$l_name', '$email', '$password', $program)";
    }else{
        $query = "INSERT INTO faculty (faculty_id, fname, lname, email, password, department_id)
                VALUES ($id, '$f_name', '$l_name', '$email', '$password', '$department')";
    }

    $conn->query($query);

    header("Location: ../department/add-user.php");

?>