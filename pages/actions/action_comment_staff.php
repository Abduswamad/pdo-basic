<?php
    include("../config.php");
    include('../../classes/Form.php');
    $form_class = new Form(); 
    $comment=$_POST['comment'];
    $decission=$_POST['decission']; 
    $form=$_POST['form'];
    $staff_id=$_POST['staff_id'];
    $exec=$form_class->add_comment_staff($form,$decission,$comment,$staff_id);
    if($exec)
    {
        $url=BASE_URL.'pages/staff/forms.php?successsMsg=Succesfully.';
        header("Location: $url"); 
    }
    else
    {
        $url=BASE_URL.'pages/staff/comment.php?id='.$form;
        header("Location: $url"); 
    }
?>