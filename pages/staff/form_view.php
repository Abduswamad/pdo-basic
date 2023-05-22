<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "FORM VIEW ";
    $SessinUser=$account_class->staff_session_detail($login_session_id);
    $forms=$form_class->staff_forms($login_session_id);
    $id =$_GET['id'];
    $form_detail=$form_class->form_detail($id);
    $form_comments=$form_class->form_comment($id);
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php';?>
  </head>
  <body class="g-sidenav-show  bg-gray-100">
    <?php include 'aside.php';?>
    <main class="main-content border-radius-lg ">
      <?php include 'navbar.php';?>
      <div class="container-fluid py-4">
        <h6 class="text-end">
          <div class="text-danger">
              <?php 
              if(isset($_GET['errorMsg'])) {
                  echo $_GET['errorMsg'];
                  }
              ?>
          </div>
          <div class="text-success">
              <?php 
              if(isset($_GET['successsMsg'])) {
                  echo $_GET['successsMsg'];
                  }
              ?>
          </div>
        </h6>
        <!--  body-->
        <div class="row"></div>
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <div class="row">
                      <div class="col-6">
                        <h6 class="text-white  text-capitalize ps-3">STUDENT NUMBER  <?php echo  $form_detail->student ?></h6>
                      </div>
                      <div class="col-6 text-end "> 
                      <?php
                          if ($role != 100){
                              echo "
                                <a href='comment.php?id=" . $form_detail->form_id . "' class='btn btn-outline-primary btn-sm mb-0 bg-white '>Comment</a>
                              ";
                          }else{
                            echo "
                              <a href='#?id=" . $form_detail->form_id . "' class='btn btn-outline-primary btn-sm mb-0 bg-white '>Print</a>
                          ";
                          }
                      ?>
                          
                      </div> 
                  </div>
                </div>
              </div>
              <div class="card-body  pb-2">
                <div class="row">
                  <div class="col-8">
                   <div class="row"> 
                      <div class="col-6">
                        Student Name:
                      </div>
                      <div class="col-6">
                      <?php
                         $name =   $form_detail->last_name. ", ".$form_detail->first_name. " ". $form_detail->middle_name. ".";
                       echo  $name ?>
                      </div>
                      <div class="col-6">
                        Student Gender:
                      </div>
                      <div class="col-6">
                      <?php
                         $gender = $form_detail->gender_name;
                       echo  $gender ?>
                      </div>
                      <div class="col-6">
                        Student Department:
                      </div>
                      <div class="col-6">
                      <?php
                         $dapartment = $form_detail->department_name;
                       echo  $dapartment ?>
                      </div>
                      <div class="col-6">
                        Completion Year:
                      </div>
                      <div class="col-6">
                      <?php
                         $year =  $form_detail->completion_year ;
                       echo  $year ?>
                      </div>
                      <div class="col-6">
                        Form Step:
                      </div>
                      <div class="col-6">
                      <?php
                         $step =  $form_detail->step_name ;
                       echo  $step ?>
                      </div>
                   </div>
                  </div>
                  <div class="col-4">
                    <img  style = "width:100%;height:150px" src="../../images/students/<?php echo   $form_detail->image?>"/>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
              if($form_comments == null){
                  $form_comments = []; 
              }
              foreach ($form_comments as $form_comment) {
                echo "
                <div class='row'>
                  <div class='col-12'>
                  <div class='card my-4'>
                    <div class='card-header p-0 position-relative mt-n4 mx-3 z-index-2'>
                      <div class='bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3'>
                        <div class='row'>
                            <div class='col-6'>
                              <h6 class='text-white  text-capitalize ps-3'>COMENTOR: {$form_comment['last_name']}, {$form_comment['first_name']} {$form_comment['middle_name']}. </h6>
                            </div>
                            <div class='col-6 text-end ''> 
                                <h6 class='text-white   text-capitalize ps-3'>ROLE: {$form_comment['role_name']}. </h6>
                            </div> 
                        </div>
                      </div>
                    </div>
                    <div class='card-body  pb-2'>
                      <div class='row'>
                        <div class='col-8'>
                        <div class='row'> 
                            <div class='col-6'>
                            {$form_comment['comment']}
                            </div>
                      </div>
                    </div>
                    <div class='card-footer'>
                      DATE: {$form_comment['comment_date']}
                    </div>
                  </div>
                </div>
                </div>
              ";
              }
            ?>
        </div>
        <!--  body-->
        <?php include 'footer.php';?>
      </div>
    </main>
    <script src="../../assets/js/core/popper.min.js" ></script>
    <script src="../../assets/js/core/bootstrap.min.js" ></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js" ></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js" ></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <script src="../../assets/js/material-dashboard.min.js?v=3.0.4"></script>
  </body>
</html>