<?php
    include 'mysql.php';

    session_start();

    $faculty = $_SESSION['id'];
    
    $semester = strtolower($_POST['semester']);
    $year = substr($semester, -4);
    $section = strtolower($_POST['section']);
    $course = $_POST['course'];

    $query = "INSERT INTO section (section_no, semester, course_id, faculty_id)
                VALUES ('$section','$semester', '$course', $faculty )";

    $conn->query($query);
    $id = $conn->insert_id;

    $list = fopen($_FILES['enroll']['tmp_name'], "r");
    fgetcsv($list);

    while($data = fgetcsv($list)){

        $student = $data[2];
        $query = "INSERT INTO enrollment (semester, year, student_id, section_id)
                    VALUES('$semester', $year, $student, $id)";
        $conn->query($query);
    }
    
    header("Location: ../faculty/edit-map.php?section=$id");

?>