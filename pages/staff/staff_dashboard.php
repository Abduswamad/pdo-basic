<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "STAFF DASHBOARD ";
    $SessinUser=$account_class->staff_session_detail($login_session_id);
    $form_statuses=$form_class->form_statuses();
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
                          <h6 class="text-white  text-capitalize ps-3">FORM STATUS  </h6>
                        </div>
                        <!-- <div class="col-6 text-end "> 
                            <a href="./add_staff.php" class="btn btn-outline-primary btn-sm mb-0 bg-white ">Add Staff</a>
                        </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 pb-2">
                  <?php
                    $statuses = array();
                    $values = array();
                    foreach ($form_statuses as $row) {
                        $statuses[] = $row['status'];
                        $values[] = $row['value'];
                    }
                  ?>
                  <div   class="row">
                    <div  class="col-12 ">
                      <canvas  id="form_statuses"></canvas>
                    </div>
                  </div>
                  <script>
                    var ctx = document.getElementById('form_statuses').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($statuses); ?>,
                            datasets: [{
                                label: 'Count',
                                data: <?php echo json_encode($values); ?>,
                                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                                borderColor: 'rgba(0, 123, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                  </script>
                 <div class="row"></div>
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
