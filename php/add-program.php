<?php
    include 'mysql.php';

    $program_name = $_POST['program_name'];
    $department_id = $_POST['department_id'];
    
    $query = "INSERT INTO program (program_name, department_id)
                VALUES ('$program_name', '$department_id')";

    $conn->query($query);
    $program_id = $conn->insert_id;

    $plo_total = $_POST['plo_total'];
    foreach(range(1,$plo_total) as $plo){
        $plo_name = $_POST['plo'.$plo];
        $query = "INSERT INTO plo (plo_num, plo_name, program_id)
                    VALUES($plo, '$plo_name', $program_id)";
        $conn->query($query);
    }

    header("Location: ../department/add-program.php");
?>