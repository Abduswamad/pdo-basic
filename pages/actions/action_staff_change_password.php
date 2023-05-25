<?php
    include("../config.php");
    include('../../classes/Account.php');
    $account_class = new Account();
    $staff_number=$_POST['staff_number'];
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];
    $confirm_new_password=$_POST['confirm_new_password'];
    if($new_password == $confirm_new_password)
    {
       
       
        $exec=$account_class->staff_change_password($staff_number,$current_password,$new_password);
        if($exec)
        {
            $url=BASE_URL.'pages/staff/profile.php?successsMsg=Password Changed..';
            header("Location: $url"); 
        }
        else
        {
            $url=BASE_URL.'pages/staff/profile.php?errorMsg=Wrong Current Password';
            header("Location: $url"); 
        }
    }else{
        $url=BASE_URL.'pages/staff/profile.php?errorMsg= Password is not match ';
        header("Location: $url"); 
    }
?>