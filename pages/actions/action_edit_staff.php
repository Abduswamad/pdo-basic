<?php
    include("../config.php");
    include('../../classes/Staff.php');
    $staff_class = new Staff();
    $staff_number=$_POST['staff_number'];
    $first_name=$_POST['first_name'];
    $middle_name=$_POST['middle_name'];
    $last_name=$_POST['last_name'];
    $staff_type=$_POST['staff_type'];
    $exec=$staff_class->edit_staff($staff_number,$first_name,$middle_name,$last_name,$staff_type);
    $url=BASE_URL.'pages/staff/staffs.php?successsMsg=Succesfully edited staff '. $staff_number . '.';
    header("Location: $url"); 
?>