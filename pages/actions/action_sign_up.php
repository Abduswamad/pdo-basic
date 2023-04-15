<?php
    include("../config.php");
    include('../../classes/Account.php');
    $account_class = new Account();
    $errorMsg='';
    $confirm_password=$_POST['confirm_password'];
    $password=$_POST['password'];
    $reg_number=$_POST['reg_number'];
    $email=$_POST['email'];
    if(strlen(trim($confirm_password))>1 && strlen(trim($password))>1
    && strlen(trim($reg_number))>1 && strlen(trim($email))>1 )
    {
        if($confirm_password == $password){
            $exec=$account_class->student_sign_up($reg_number,$email,$password);
            if($exec)
            {
                $url=BASE_URL.'index.php?successsMsg= Successfully Login';
                header("Location: $url"); 
            }
            else
            {
                $exec=$account_class->staff_sign_up($reg_number,$email,$password);
                if($exec)
                {
                    $url=BASE_URL.'index.php?successsMsg= Successfully Login';
                    header("Location: $url"); 
                }else{
                    $url=BASE_URL.'pages/sign_up.php?errorMsg= Not recognised Registration number';
                    header("Location: $url"); 
                }
            }
        }else{
            $url=BASE_URL.'pages/sign_up.php?errorMsg=Password does not match ';
            header("Location: $url"); 
        }
    }else{
        $url=BASE_URL.'pages/sign_up.php?errorMsg=Form is empty ';
        header("Location: $url"); 
    }
?>