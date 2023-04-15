<?php
    include("../config.php");
    include('../../classes/Student.php');
    $student_class = new Student();
    $id=$_GET['id'];
    $exec=$student_class->delete_student($id);
    $url=BASE_URL.'pages/staff/students.php?successsMsg=Succesfully deleted student '. $id . '.';
    header("Location: $url"); 
?>