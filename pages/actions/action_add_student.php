<?php
    include("../config.php");
    include('../../classes/Student.php');
    $student_class = new Student();
    $student_number=$_POST['student_number'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $student_department=$_POST['student_department'];
    if(strlen(trim($student_number))>1 && strlen(trim($first_name))>1
    && strlen(trim($middle_name))>1 && strlen(trim($last_name))>1
    )
    {
        $exec=$student_class->add_student($student_number,$first_name,$middle_name,$last_name,$gender,$student_department);
        if($exec)
        {
            $url=BASE_URL.'pages/staff/students.php?successsMsg=Succsfull added student '. $student_number . '.';
            header("Location: $url"); 
        }
        else
        {
            $url=BASE_URL.'pages/staff/add_student.php?errorMsg=The student '. $student_number . ' is existed.';
            header("Location: $url"); 
        }
    }else{
        $url=BASE_URL.'pages/staff/add_student.php?errorMsg=Form is empty ';
        header("Location: $url"); 
    }
?>