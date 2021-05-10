<?php
    include 'mysql.php';

     $section = $_POST['section'];
     $name = $_POST['name'];
     $ques = $_POST['ques'];

     $evln = fopen($_FILES['evaluation']['tmp_name'], "r");
     fgetcsv($evln);

     while($ev = fgetcsv($evln)){
        $id = $ev[0];
        $query = "SELECT enroll_id FROM enrollment WHERE section_id = $section AND student_id = $id";
        $enrl = $conn->query($query)->fetch_row()[0];
        for($q=1; $q<=$ques; $q++){
            $query = "SELECT assessment_id FROM assessment WHERE section_id = $section AND assessment_name = '$name' AND question_no = $q";
            $asmnt = $conn->query($query)->fetch_row()[0];
            $mark = $ev[$q+3];
            $query="INSERT INTO evaluation (obtained_marks, assessment_id, enroll_id)
                    VALUES ($mark, $asmnt, $enrl)";
            $conn->query($query);
        }
     }

     header("Location: ../faculty/assessment-list.php");

?>