<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "STUDENT PROFILE ";
    $SessinUser=$account_class->student_session_detail($login_session_id);
    $student_profile=$account_class->student_profile($login_session_id);
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
                <div  style="background-color:#fd7e14" class="bg-gradient shadow-primary border-radius-lg pt-4 pb-3">
                  <div class="row">
                      <div class="col-6">
                        <h6 class="text-white  text-capitalize ps-3">STUDENT NUMBER  <?php echo  $student_profile->student_number ?></h6>
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
                         $name =   $student_profile->last_name. ", ".$student_profile->first_name. " ". $student_profile->middle_name. ".";
                       echo  $name ?>
                      </div>
                      <div class="col-6">
                         Email:
                      </div>
                      <div class="col-6">
                      <?php
                         $email = $student_profile->user_name;
                       echo  $email ?>
                      </div>
                      <div class="col-6">
                         Gender:
                      </div>
                      <div class="col-6">
                      <?php
                         $gender_name = $student_profile->gender_name;
                       echo  $gender_name ?>
                      </div>
                      <div class="col-6">
                         Department Name:
                      </div>
                      <div class="col-6">
                      <?php
                         $department_name = $student_profile->department_name;
                       echo  $department_name ?>
                      </div>
                      <div class="col-6">
                         Completion Year:
                      </div>
                      <div class="col-6">
                      <?php
                         $completion_year = $student_profile->completion_year;
                       echo  $completion_year ?>
                      </div>
                   </div>
                  </div>
                  <div class="col-4">
                    <img  style = "width:100%;height:150px" src="../../images/students/<?php echo   $student_profile->image?>"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2"></div>
                  <div class="col-8">
                    <h1> Change Password</h1>
                    <form role="form" action="../actions/action_student_change_password.php"  method="post"class="text-start">
                      <div class="input-group input-group-outline my-3">
                        <input type="hidden" value="<?php echo  $student_profile->student_number ?>"  required name="student_number"class="form-control">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <input type="password" placeholder="Current Password"  required name="current_password"class="form-control">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <input type="password" placeholder="New Password"  required name="new_password"class="form-control">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <input type="password" placeholder="Confirm New Password"  required name="confirm_new_password"class="form-control">
                      </div>
                      <div class="text-center">
                        <button  style="background-color:#fd7e14" type="submit" name="Submit"  class="btn bg-gradient w-100 my-4 mb-2">Submit</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-2"></div>
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