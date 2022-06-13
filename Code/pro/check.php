<?php

include '../conn.php';
include '../constants.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_NAME; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b>
<?php echo SITE_NAME; ?>
</b></a>
  </div>
  <!-- User name -->
  <?php
if (isset($_POST['number'])){
  $code = $_POST['number'];
  $check = $conn->prepare("SELECT * FROM individual INNER JOIN state ON state.id = individual.state_id WHERE code = ?");
  $check->bind_param("s", $code);
  $check->execute();
  $res = $check->get_result();

  $row = $res->fetch_assoc();
  if ($res->num_rows != 1){
echo "<script>alert('Record not found!'); window.location='check.php';</script>";
    exit;
  }
  ?>
  <div class="lockscreen-name"></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <!-- lockscreen credentials (contains the form) -->
  <table class='table table-bordered table-hober table-info table-striped'>
    <tr>
      <th colspan='2' class='alert alert-success text-center'>Verified <i class='fas fa-check'></i></th>
    </tr>
    <tr>
      <th>Full Name</th><td><?php echo $row['fullname'] ?></td></tr><tr>
      <th>Date of Birth</th><td><?php echo $row['dob'] ?></td></tr><tr>
      <th>State</th><td><?php echo $row['state'] ?></td></tr><tr>
      <th>L.G.A</th><td><?php echo $row['lga'] ?></td></tr><tr>
      <th>Gender</th><td><?php echo $row['gender'] ?></td></tr><tr>
      <th>Issued Date</th><td><?php echo $row['issued_date'] ?></td>
  </table>
  </div>
  <div align='center'><a href="check.php"> <button type="button" class='btn btn-success' name="button">Check Again</button> </a></div>

  <?php
}else{
  ?>
  <div class="lockscreen-name">Verify Certificate</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../images/trainlg.png" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method='post'>
      <div class="input-group">
        <input type="text" minlength='8' name='number' required class="form-control" placeholder="Certificate Number">

        <div class="input-group-append">
          <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <?php

}
   ?>

  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    System
  </div>
  <div class="text-center">
    <a href="../">Go back</a>
  </div>
  <div class="lockscreen-footer text-center">
  <?php echo date("Y"); ?> - All Rights Reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
