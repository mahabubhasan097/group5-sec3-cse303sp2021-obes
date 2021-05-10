<?php
    include 'mysql.php';
    $university_id = strtolower($_POST['university_id']);
    $university_name = $_POST['university_name'];
    $vc = $_POST['vc'];

    $query = "INSERT INTO university (university_id, university_name, vc)
                VALUES('$university_id', '$university_name', '$vc')";
    $conn->query($query);
    header("Location: ../department/add-university.php");

?>