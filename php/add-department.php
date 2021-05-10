<?php
    include 'mysql.php';

    $department_id = strtoupper($_POST['department_id']);
    $department_name = $_POST['department_name'];
    $head = $_POST['head'];
    $school_id = $_POST['school_id'];

    $query = "INSERT INTO department (department_id, department_name, head, school_id)
                VALUES('$department_id', '$department_name', '$head', $school_id)";
    $conn->query($query);
    header("Location: ../department/add-department.php");

?>