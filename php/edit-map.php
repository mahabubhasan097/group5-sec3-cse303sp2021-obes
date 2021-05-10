<?php
    include 'mysql.php';

    $section = $_POST['section'];
    $program = $_POST['program'];
    $plos = $_POST['plos'];
    
    for($plo=1; $plo<=$plos; $plo++){
        if(isset($_POST['plo'.$plo])){
            foreach($_POST['plo'.$plo] as $co){
                $query = "SELECT plo_id FROM plo WHERE plo_num = $plo AND program_id = $program";
                $plo_id = $conn->query($query)->fetch_row()[0];
                $query = "INSERT INTO co (co_num, plo_id, section_id)
                            VALUES($co, $plo_id, $section)";
                $conn->query($query);
            }
        }
    }

    header("Location: ../faculty/section-list.php");

?>