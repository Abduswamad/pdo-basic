<?php
    include('../config.php');
    include('../session.php');
    $page_tittle = "EDIT STUDENT ";
    $SessinUser=$account_class->staff_session_detail($login_session_id);
    $genders=$student_class->get_all_gender();
    $id =$_GET['id'];
    $StudentData=$student_class->get_student($id);

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
                        <h6 class="text-white  text-capitalize ps-3">EDIT STUDENT: <?php  echo $id;?> </h6>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="row">
                  <div class="col-2"></div>
                  <div class="col-8">
                    <form role="form" action="../actions/action_edit_student.php"  method="post"class="text-start">
                      <div class="input-group input-group-outline my-3">  
                        <input type="text" placeholder="Student Number"  required readonly value ="<?php  echo $id;?>"  name="student_number"class="form-control">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <input type="text"  required placeholder="Firs Name"  value ="<?php  echo $StudentData->first_name;?>" name="first_name" class="form-control">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text"   placeholder="Middle Name " value ="<?php  echo $StudentData->middle_name;?>" required name="middle_name" class="form-control">
                      </div> 
                      <div class="input-group input-group-outline mb-3">
                        <input type="text"   placeholder=" Last Name " required value ="<?php  echo $StudentData->last_name;?>" name="last_name" class="form-control">
                      </div>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="gender"  required>
                            <?php
                              $selected_value = $StudentData->gender;
                              foreach ($genders as $gender) {
                                $selected = ($gender['type_id'] == $selected_value) ? 'selected' : '';
                                echo "<option value='{$gender['gender_id']}' $selected>{$gender['gender_name']}</option>";
                              }
                            ?>
                            
                        </select>
                      </div>
                      <div class="text-center">
                        <button style="background-color:#fd7e14"  type="submit" name="Submit"  class="btn bg-gradient w-100 my-4 mb-2">Submit</button>
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
