<?php
    include("../config.php");
    include('../../classes/Student.php');
    $student_class = new Student();
    $student_number=$_POST['student_number'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $completion_year=$_POST['completion_year'];
    $student_department=$_POST['student_department'];
    $confirm_password=$_POST['confirm_password'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    if(strlen(trim($student_number))>1 && strlen(trim($first_name))>1
    && strlen(trim($middle_name))>1 && strlen(trim($last_name))>1
    )
    {
        if($confirm_password == $password){
            $imageFile = $_FILES["image"];
            $extension = pathinfo($imageFile["name"], PATHINFO_EXTENSION);
            $targetDirectory = dirname(dirname(__DIR__)) ."/images/students/";
            $image_name = "P". $student_number . "." .$extension;
            $targetFilePath = $targetDirectory . $image_name;
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES["image"]["tmp_name"];
                if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                    $exec=$student_class->add_student_full($student_number,$first_name,$middle_name,$last_name,$gender,$student_department, $completion_year,$image_name,$password,$email);
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
                } else {
                    $url=BASE_URL.'pages/staff/add_student.php?errorMsg=Image Problem ';
                    header("Location: $url"); 
                }
            } else {
                $url=BASE_URL.'pages/staff/add_student.php?errorMsg=Image Problem ';
                header("Location: $url"); 
            }
        }else{
            $url=BASE_URL.'pages/add_student.php?errorMsg=Password does not match ';
            header("Location: $url"); 
        }



        
    }else{
        $url=BASE_URL.'pages/staff/add_student.php?errorMsg=Form is empty ';
        header("Location: $url"); 
    }
?>