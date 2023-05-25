<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "STAFF PROFILE ";
    $SessinUser=$account_class->staff_session_detail($login_session_id);
    $staff_profile=$account_class->staff_profile($login_session_id);
    
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
                        <h6 class="text-white  text-capitalize ps-3">STAFF NUMBER  <?php echo  $staff_profile->staff_number ?></h6>
                      </div>
                      <div class="col-6 text-end "> 
                      </div> 
                  </div>
                </div>
              </div>
              <div class="card-body  pb-2">
                <div class="row">
                  <div class="col-8">
                   <div class="row"> 
                      <div class="col-6">
                         Name:
                      </div>
                      <div class="col-6">
                      <?php
                         $name =   $staff_profile->last_name. ", ".$staff_profile->first_name. " ". $staff_profile->middle_name. ".";
                       echo  $name ?>
                      </div>
                      <div class="col-6">
                         Email:
                      </div>
                      <div class="col-6">
                      <?php
                         $email = $staff_profile->email;
                       echo  $email ?>
                      </div>
                      <div class="col-6">
                         Tittle:
                      </div>
                      <div class="col-6">
                      <?php
                         $title = $staff_profile->title;
                       echo  $title ?>
                      </div>
                      <div class="col-6">
                         Department Name:
                      </div>
                      <div class="col-6">
                      <?php
                         $department_name = $staff_profile->department_name;
                       echo  $department_name ?>
                      </div>
                      <div class="col-6">
                         System Role:
                      </div>
                      <div class="col-6">
                      <?php
                         $role_name = $staff_profile->role_name;
                       echo  $role_name ?>
                      </div>
                   </div>
                  </div>
                  <div class="col-4">
                    <!-- <img  style = "width:100%;height:150px" src="../../images/students/<?php echo   $form_detail->image?>"/> -->
                  </div>
                </div>
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          </div>
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