<?php
    include 'mysql.php';

    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        session_start();
        $_SESSION['role']='none';

        $query = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
        $data = $conn->query($query)->fetch_assoc();
        if($data){
            $_SESSION['id'] = $data['student_id'];
            $_SESSION['role'] = 'student';
        }else{
            $query = "SELECT * FROM faculty WHERE email = '$email' AND password = '$password'";
            $data = $conn->query($query)->fetch_assoc();
            if($data){
                $_SESSION['id'] = $data['faculty_id'];
                $_SESSION['role'] = 'faculty';
                $name = $data['fname']." ".$data['lname'];
                $query = "SELECT * FROM school WHERE LOWER(dean) = LOWER('$name')";
                $data = $conn->query($query)->fetch_assoc();
                if($data){
                    $_SESSION['role'] = 'dean';
                }
                $query = "SELECT * FROM department WHERE LOWER(head) = LOWER('$name')";
                $data = $conn->query($query)->fetch_assoc();
                if($data){
                    $_SESSION['role'] = 'head';
                }
            }
        }


        if($_SESSION['role'] == 'student'){
            header("Location: ../student/");
        }else if($_SESSION['role'] == 'faculty'){
            header("Location: ../faculty/");
        }else if($_SESSION['role'] == 'dean'){
            header("Location: ../department/");
        }else if($_SESSION['role'] == 'head'){
            header("Location: ../department/");
        }else{
            session_destroy();
            header("Location: ../login.php");
        }

    }else if(isset($_GET['logout'])){
        session_destroy();
        header("Location: ../login.php");
    }

?>