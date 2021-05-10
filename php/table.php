<?php
    include 'mysql.php';

    $table = "CREATE TABLE university ( 
        university_id VARCHAR(5) NOT NULL , 
        university_name VARCHAR(255) NOT NULL , 
        vc VARCHAR(255) NOT NULL , 
        PRIMARY KEY (university_id))";
    if(!$conn->query($table)){
        echo "Error creating university table <br/>";
    }

    $table = "CREATE TABLE school ( 
        school_id INT NOT NULL AUTO_INCREMENT, 
        school_name VARCHAR(255) NOT NULL , 
        dean VARCHAR(255) NOT NULL ,
        university_id VARCHAR(5) NOT NULL, 
        PRIMARY KEY (school_id) ,
        FOREIGN KEY (university_id) REFERENCES university (university_id))";
    if(!$conn->query($table)){
        echo "Error creating school table <br/>";
    }

    $table = "CREATE TABLE department ( 
        department_id VARCHAR(5) NOT NULL , 
        department_name VARCHAR(255) NOT NULL , 
        head VARCHAR(255) NOT NULL , 
        school_id INT NOT NULL,
        PRIMARY KEY (department_id) ,
        FOREIGN KEY (school_id) REFERENCES school (school_id))";
    if(!$conn->query($table)){
        echo "Error creating department table <br/>";
    }

    $table = "CREATE TABLE program ( 
        program_id INT NOT NULL AUTO_INCREMENT, 
        program_name VARCHAR(255) NOT NULL , 
        department_id VARCHAR(5) NOT NULL, 
        PRIMARY KEY (program_id) ,
        FOREIGN KEY (department_id) REFERENCES department (department_id))";
    if(!$conn->query($table)){
        echo "Error creating program table <br/>";
    }

    $table = "CREATE TABLE plo ( 
        plo_id INT NOT NULL AUTO_INCREMENT , 
        plo_num INT NOT NULL , 
        plo_name VARCHAR(255) NOT NULL , 
        description TEXT NOT NULL , 
        program_id INT NOT NULL , 
        PRIMARY KEY (`plo_id`) ,
        FOREIGN KEY (program_id) REFERENCES program (program_id))";
    if(!$conn->query($table)){
        echo "Error creating plo table <br/>";
    }

    $table = "CREATE TABLE faculty ( 
        faculty_id INT NOT NULL , 
        fname VARCHAR(200) NOT NULL , 
        lname VARCHAR(200) NOT NULL , 
        gender VARCHAR(10) NOT NULL , 
        address TEXT NOT NULL , 
        dateofbirth DATE NOT NULL , 
        phone VARCHAR(20) NOT NULL , 
        email VARCHAR(255) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL , 
        department_id VARCHAR(5) NOT NULL , 
        PRIMARY KEY (`faculty_id`) ,
        FOREIGN KEY (department_id) REFERENCES department (department_id))";    
    if(!$conn->query($table)){
        echo "Error creating faculty table <br/>";
    }

    $table = "CREATE TABLE student ( 
        student_id INT NOT NULL , 
        fname VARCHAR(200) NOT NULL , 
        lname VARCHAR(200) NOT NULL , 
        gender VARCHAR(10) NOT NULL , 
        address TEXT NOT NULL , 
        dateofbirth DATE NOT NULL , 
        phone VARCHAR(20) NOT NULL , 
        email VARCHAR(255) NOT NULL UNIQUE, 
        password VARCHAR(255) NOT NULL , 
        program_id INT NOT NULL , 
        PRIMARY KEY (`student_id`) ,
        FOREIGN KEY (program_id) REFERENCES program (program_id))";    
    if(!$conn->query($table)){
        echo "Error creating student table <br/>";
    }

    $table = "CREATE TABLE course ( 
        course_id VARCHAR(10) NOT NULL , 
        course_name VARCHAR(255) NOT NULL , 
        no_credits DOUBLE NOT NULL , 
        course_type VARCHAR(100) NULL , 
        description TEXT NULL , 
        program_id INT NOT NULL , 
        PRIMARY KEY (`course_id`) ,
        FOREIGN KEY (program_id) REFERENCES program (program_id))";
    if(!$conn->query($table)){
        echo "Error creating course table <br/>";
    }


    $table = "CREATE TABLE section ( 
        section_id INT NOT NULL AUTO_INCREMENT, 
        section_no VARCHAR(20) NOT NULL , 
        semester VARCHAR(30) NOT NULL , 
        course_id VARCHAR(10) NOT NULL , 
        faculty_id INT NOT NULL , 
        PRIMARY KEY (`section_id`) ,
        FOREIGN KEY (course_id) REFERENCES course (course_id) ,
        FOREIGN KEY (faculty_id) REFERENCES faculty (faculty_id))";
    if(!$conn->query($table)){
        echo "Error creating section table <br/>";
    }

    $table = "CREATE TABLE co ( 
        co_id INT NOT NULL AUTO_INCREMENT , 
        co_num INT NOT NULL , 
        co_name VARCHAR(255) NULL , 
        description TEXT NULL , 
        plo_id INT NOT NULL , 
        section_id INT NULL , 
        PRIMARY KEY (`co_id`) ,
        FOREIGN KEY (plo_id) REFERENCES plo (plo_id) ,
        FOREIGN KEY (section_id) REFERENCES section (section_id))";
    if(!$conn->query($table)){
        echo "Error creating co table <br/>";
    }

    $table = "CREATE TABLE enrollment ( 
        enroll_id INT NOT NULL AUTO_INCREMENT , 
        semester VARCHAR(30) NOT NULL , 
        year YEAR NOT NULL , 
        student_id INT NOT NULL , 
        section_id INT NOT NULL , 
        PRIMARY KEY (`enroll_id`) ,
        FOREIGN KEY (student_id) REFERENCES student (student_id) ,
        FOREIGN KEY (section_id) REFERENCES section (section_id))";
    if(!$conn->query($table)){
        echo "Error creating enrollment table <br/>";
    }

    $table = "CREATE TABLE assessment ( 
        assessment_id INT NOT NULL AUTO_INCREMENT , 
        assessment_name VARCHAR(50) NOT NULL , 
        marks INT NOT NULL , 
        question_no INT NOT NULL , 
        co_id INT NOT NULL , student_id INT NOT NULL , 
        section_id INT NOT NULL , 
        PRIMARY KEY (`assessment_id`) ,
        FOREIGN KEY (co_id) REFERENCES co(co_id) ,
        FOREIGN KEY (section_id) REFERENCES section (section_id))";
    if(!$conn->query($table)){
        echo "Error creating assessment table <br/>";
    }

    $table = "CREATE TABLE evaluation ( 
        evaluation_id INT NOT NULL AUTO_INCREMENT , 
        obtained_marks INT NOT NULL , 
        assessment_id INT NOT NULL , 
        faculty_id INT NOT NULL , 
        PRIMARY KEY (`evaluation_id`) ,
        FOREIGN KEY (assessment_id) REFERENCES assessment (assessment_id) ,
        FOREIGN KEY (faculty_id) REFERENCES faculty (faculty_id))";
    if(!$conn->query($table)){
        echo "Error creating evaluation table <br/>";
    }
?>