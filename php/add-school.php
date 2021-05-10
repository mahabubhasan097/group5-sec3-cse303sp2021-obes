<?php
    include 'mysql.php';

    $school_name = $_POST['school_name'];
    $dean = $_POST['dean'];
    $university_id = strtolower($_POST['university_id']);

    $query = "INSERT INTO school (school_name, dean, university_id)
                VALUES('$school_name', '$dean', '$university_id')";
    $conn->query($query);
    header("Location: ../department/add-school.php");

?>