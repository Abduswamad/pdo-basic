<?php
    include("../config.php");
    include('../../classes/Staff.php');
    $staff_class = new Staff();
    $id=$_GET['id'];
    $exec=$staff_class->dalete_staff($id);
    $url=BASE_URL.'pages/staff/staffs.php?successsMsg=Succesfully deleted staff '. $id . '.';
    header("Location: $url"); 
?>