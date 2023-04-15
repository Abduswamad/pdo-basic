<?php
    include("../config.php");
    include('../../classes/Student.php');
    $student_class = new Student();
    $student_number=$_POST['student_number'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $exec=$student_class->edit_student($student_number,$first_name,$middle_name,$last_name,$gender);
    $url=BASE_URL.'pages/staff/students.php?successsMsg=Succesfully deleted student '. $student_number . '.';
    header("Location: $url"); 
?>