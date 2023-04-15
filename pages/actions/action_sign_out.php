<?php
    include('../config.php');
    $login_session_id='';
    $_SESSION['login_session_id']='';
    if(empty($login_session_id) && empty($_SESSION['login_session_id']))
    {
        $url=BASE_URL.'index.php';
        header("Location: $url");
    }
?>