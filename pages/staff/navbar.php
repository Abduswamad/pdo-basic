<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <?php echo $page_tittle;?>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      <?php
        $current_hour = date('H');
        if ($current_hour >= 5 && $current_hour < 12) {
            echo "Good Morning! ". $SessinUser->first_name;
        } elseif ($current_hour >= 12 && $current_hour < 18) {
            echo "Good Afternoon! ". $SessinUser->first_name;
        } else {
            echo "Good Evening! ". $SessinUser->first_name;
        }
      ?>
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-flex align-items-center">
           <?php include '../sign_out_link.php';?>
        </li>
      </ul>
    </div>
  </div>
</nav>
