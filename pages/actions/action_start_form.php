<?php
    include("../config.php");
    include('../../classes/Form.php');
    $form_class = new Form();
    $student_id=$_GET['student_id'];
    $exec=$form_class->create_form($student_id);
    if($exec){
         $url=BASE_URL.'pages/student/student_dashboard.php?successsMsg=Succesfully form Created. ';
    }else{
        $url=BASE_URL.'pages/student/student_dashboard.php?errorMsg=Your Form is in progress you can not create another form.';
    }
    
    header("Location: $url"); 
?>