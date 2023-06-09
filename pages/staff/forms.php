<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "STUDENTS FORMS";
    $SessinUser=$account_class->staff_session_detail($login_session_id);
    $forms=$form_class->staff_forms($login_session_id);
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
                        <h6 class="text-white  text-capitalize ps-3">LIST OF FORMS </h6>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Department</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Step</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        if($forms == null){
                            $forms = []; 
                        }
                        foreach ($forms as $form) {
                          echo "
                          <tr>
                            <td class='align-middle text-center text-sm'>
                              <span class='text-secondary text-xs font-weight-bold'>{$form['student']}</span>
                            </td>
                            <td class='align-middle text-center text-sm'>
                              <span class='text-secondary text-xs font-weight-bold'>{$form['department_name']}</span>
                            </td>
                            <td class='align-middle text-center text-sm'>
                              <span class='text-secondary text-xs font-weight-bold'>{$form['step_name']}</span>
                            </td>
                            <td class='align-middle text-center'>
                              <a href='./form_view.php?id={$form['form_id']}' class='btn btn-success'>VIEW</a>
                            </td>
                          </tr>
                        ";
                        }
                      ?>
                  </tbody>
                </table>
                </div>
              </div>
              <div class="card-footer">
                Total is <?php
                     echo count($forms);
                ?>
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
