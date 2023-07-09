<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "ADD NEW STAFF ";
    $SessinUser=$account_class->staff_session_detail($login_session_id);
    $staff_roles=$staff_class->get_all_staff_role();
    $staff_departments=$staff_class->get_all_staff_department();
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
                <div style="background-color:#fd7e14" class="bg-gradient shadow-primary border-radius-lg pt-4 pb-3">
                  <div class="row">
                      <div class="col-6">
                        <h6 class="text-white  text-capitalize ps-3">ADD NEW STAFF </h6>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="row">
                  <div class="col-2"></div>
                  <div class="col-8">
                    <form role="form" action="../actions/action_add_staff_full.php"  method="post"class="text-start">
                      <div class="input-group input-group-outline my-3">
                        <input type="text" placeholder="Staff Number"  required name="staff_number"class="form-control">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <input type="text"  required placeholder="Firs Name" name="first_name" class="form-control">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text"   placeholder="Middle Name " required name="middle_name" class="form-control">
                      </div> 
                      <div class="input-group input-group-outline mb-3">
                        <input type="text"   placeholder=" Last Name " required name="last_name" class="form-control">
                      </div>

                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="staff_role"  required>
                            <option value="">Select Staff Role</option>
                            <?php
                              foreach ($staff_roles as $staff_role) {
                                echo "
                                    <option value='{$staff_role['role_id']}'>{$staff_role['role_name']}</option>
                                ";
                              }
                            ?>
                        </select>
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="staff_department"  required>
                            <option value="">Select Staff Department</option>
                            <?php
                              foreach ($staff_departments as $staff_department) {
                                echo "
                                    <option value='{$staff_department['department_number']}'>{$staff_department['department_name']}</option>
                                ";
                              }
                            ?>
                        </select>
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <input type="password"   placeholder="Password " required name="password" class="form-control">
                      </div> 
                      <div class="input-group input-group-outline mb-3">
                        <input type="password"   placeholder=" Confirm Password " required name="confirm_password" class="form-control">
                      </div>
                      <div class="text-center">
                        <button style="background-color:#fd7e14" type="submit" name="Submit"  class="btn bg-gradient w-100 my-4 mb-2">Submit</button>
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
