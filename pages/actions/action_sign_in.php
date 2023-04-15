<?php
    include("../config.php");
    include('../../classes/Account.php');
    $account_class = new Account();
    $password=$_POST['password'];
    $email=$_POST['email'];
    if(strlen(trim($password))>1 && strlen(trim($email))>1)
    {
        
        $exec=$account_class->student_sign_in($email,$password);
        if($exec)
        {
            $url=BASE_URL.'pages/student/student_dashboard.php?successsMsg=You are in a home page';
            header("Location: $url"); 
        }
        else
        {
            $exec=$account_class->staff_sign_in($email,$password);
            if($exec)
            {
                $url=BASE_URL.'pages/staff/staff_dashboard.php?successsMsg=You are in a home page';
                header("Location: $url"); 
            }
            else{
                $url=BASE_URL.'index.php?errorMsg=Wrong username or password';
                header("Location: $url"); 
            }
        }
    }else{
        $url=BASE_URL.'index.php?errorMsg=Form is empty ';
        header("Location: $url"); 
    }
?>