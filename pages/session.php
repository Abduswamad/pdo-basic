<?php
if(!empty($_SESSION['login_session_id']))
{
    $login_session_id=$_SESSION['login_session_id'];
    include('../../classes/Account.php');
    include('../../classes/Staff.php');
    include('../../classes/Student.php');
    $account_class = new Account();
    $staff_class = new Staff();
    $student_class = new Student();
}
if(empty($login_session_id))
{
    $url=BASE_URL.'index.php';
    header("Location: $url");
}
?>