<?php
    include("../config.php");
    include('../../classes/Staff.php');
    $staff_class = new Staff();
    $staff_number=$_POST['staff_number'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $staff_type=$_POST['staff_type'];
    if(strlen(trim($staff_number))>1 && strlen(trim($first_name))>1
    && strlen(trim($middle_name))>1 && strlen(trim($last_name))>1
    )
    {
        
        $exec=$staff_class->add_staff($staff_number,$first_name,$middle_name,$last_name,$staff_type);
        if($exec)
        {
            $url=BASE_URL.'pages/staff/staffs.php?successsMsg=Succsfull added staff '. $staff_number . '.';
            header("Location: $url"); 
        }
        else
        {
            $url=BASE_URL.'pages/staff/add_staff.php?errorMsg=The staff '. $staff_number . ' is existed.';
            header("Location: $url"); 
        }
    }else{
        $url=BASE_URL.'pages/staff/add_staff.php?errorMsg=Form is empty ';
        header("Location: $url"); 
    }
?>