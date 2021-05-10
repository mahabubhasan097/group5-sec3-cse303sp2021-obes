<?php
    include 'mysql.php';

    $course_id = strtolower($_POST['course_id']);
    $course_name = $_POST['course_name'];
    $no_credits = $_POST['no_credits'];
    $program_id = $_POST['program_id'];

    $query = "INSERT INTO course (course_id, course_name, no_credits, program_id)
                VALUES ('$course_id', '$course_name', $no_credits, $program_id)";
    $conn->query($query);

    foreach(range(1, 13) as $plo){
        if ($_POST['plo'.$plo]!=NULL){
            $plo_data = json_decode($_POST['plo'.$plo]);
            foreach($plo_data as $p){
                $query = "SELECT * FROM plo WHERE plo_num = $plo AND program_id = $program_id";
                $plo_id = $conn->query($query)->fetch_assoc()['plo_id'];
                $co = substr($p->value, 2);
                $query = "INSERT INTO co (co_num, plo_id) VALUES ('$co', $plo_id)";
                $conn->query($query);
            }
        }
    }

    header ("Location: ../department/add-course.php");

?>