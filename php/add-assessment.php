<?php
    include 'mysql.php';

    $section = $_POST['section'];
    $name = $_POST['name'];
    $ques = $_POST['ques'];

    for($q=1; $q<=$ques; $q++){
        $mark = $_POST['mark'.$q];
        $co = $_POST['co'.$q];
        $query = "INSERT INTO assessment (assessment_name, marks, question_no, co_number, section_id)
                    VALUES ('$name', $mark, $q, $co, $section)";
        $conn->query($query);
    }

    header("Location: ../faculty/add-evaluation.php?section=$section&name=$name&ques=$ques");

?>