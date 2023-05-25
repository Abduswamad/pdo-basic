<?php
    include("../config.php");
    include('../../classes/Account.php');
    $account_class = new Account();
    $student_number=$_POST['student_number'];
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];
    $confirm_new_password=$_POST['confirm_new_password'];
    if($new_password == $confirm_new_password)
    {
       
       
        $exec=$account_class->student_change_password($student_number,$current_password,$new_password);
        if($exec)
        {
            $url=BASE_URL.'pages/student/profile.php?successsMsg=Password Changed..';
            header("Location: $url"); 
        }
        else
        {
            $url=BASE_URL.'pages/student/profile.php?errorMsg=Wrong Current Password';
            header("Location: $url"); 
        }
    }else{
        $url=BASE_URL.'pages/student/profile.php?errorMsg= Password is not match ';
        header("Location: $url"); 
    }
?>